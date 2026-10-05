<?php

namespace App\Jobs;

use App\Models\FarmModel;
use App\Models\SatelliteDataModel;
use App\Services\ApiHelperService;
use App\Services\MonitoringStatusService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Throwable;

class StoreSatelliteData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 180;

    protected ApiHelperService $apiLogger;

    public function __construct(
        protected FarmModel $farm,
        protected array $apiData
    ) {
        $this->apiLogger = new ApiHelperService();
    }

    public function handle()
    {
        try {
            $existingDates = SatelliteDataModel::where('farm_id', $this->farm->id)
                ->pluck('date')
                ->toArray();

            $newData = [];

            foreach ($this->apiData as $entry) {
                if (!$this->isValidEntry($entry)) {
                    continue;
                }

                $date = (int) ($entry['Date'] / 1000);
                if (in_array($date, $existingDates)) {
                    Log::debug("Skipping duplicate date: {$date} for farm: {$this->farm->farm_id}");
                    continue;
                }

                if ($this->hasInvalidZonalStats($entry)) {
                    // Log::debug("Skipping entry with invalid zonal stats for farm: {$this->farm->farm_id}");
                    continue;
                }

                // Process file downloads and get file paths
                $filePaths = $this->processFiles($entry, $date);

                $newData[] = [
                    'farm_id' => $this->farm->farm_id,
                    'date' => (int) ($entry['Date'] / 1000),
                    'png_data' => json_encode($entry['png']),  // Convert array to JSON
                    // 'tif_data' => json_encode($entry['tif']),  // Convert array to JSON
                    'tif_data' => null, // We don't need this field data
                    'zonal_stats' => json_encode($entry['zonalStats']),  // Convert array to JSON
                    'file_paths' => json_encode($filePaths),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($newData)) {

                if (empty($this->farm->farm_id)) {
                    Log::error("Missing farm_id in StoreSatelliteData job for farm: " . json_encode($this->farm));
                    return;
                }
                try {
                    SatelliteDataModel::upsert($newData, ['farm_id', 'date'], ['png_data', 'tif_data', 'zonal_stats', 'file_paths', 'updated_at']);
                    Log::info("Inserted " . count($newData) . " new satellite records for farm: {$this->farm->farm_id}");
                    $apiStatus = 'success';
                    $errorMessage = null;
                    MonitoringStatusService::MonitoringlogStatus($this->farm->farm_id, 'satellite', $apiStatus, $errorMessage);
                } catch (\Exception $e) {
                    Log::error("Inserted processing failed: " . $e->getMessage());
                    $apiStatus = 'failed';
                    $errorMessage = $e->getMessage();
                    MonitoringStatusService::MonitoringlogStatus($this->farm->farm_id, 'satellite', $apiStatus, $errorMessage);
                }


            }
            Log::info("Satellite data fetch completed. Processed: " . count($newData) . " records. Errors: " . (count($this->apiData) - count($newData)));


            // Update the last check timestamp
            $this->farm->fresh()->update([
                'last_satellite_api_check' => now()
            ]);

            // $this->apiLogger->logRequest(
            //     serviceName: 'Satellite API',
            //     method: 'POST',
            //     url: 'Database Insert',
            //     statusCode: 200,
            //     isSuccessful: true,
            //     requestData: ['farm_id' => $this->farm->farm_id],
            //     responseData: ['Satellite Data stored_records' => count($newData)],
            //     error: null,
            //     farmId: $this->farm->farm_id,

            // );
        } catch (Throwable $e) {
            $apiStatus = 'failed';
            $errorMessage = $e->getMessage();
            MonitoringStatusService::MonitoringlogStatus($this->farm->farm_id, 'satellite', $apiStatus, $errorMessage);

            Log::error("Failed to store satellite data for farm: {$this->farm->farm_id}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->apiLogger->logRequest(
                serviceName: 'Satellite API',
                method: 'POST',
                url: 'Database Insert',
                statusCode: 500,
                isSuccessful: false,
                requestData: ['farm_id' => $this->farm->farm_id],
                responseData: [],
                error: $e->getMessage(),
                farmId: $this->farm->farm_id,
                executionTime: null
            );

            $this->fail($e);
        }
    }

    protected function isValidEntry($entry): bool
    {
        if (!is_array($entry) || !isset($entry['Date'])) {
            // $this->apiLogger->logRequest(
            //     serviceName: 'Satellite API',
            //     method: 'GET',
            //     url: 'N/A',
            //     statusCode: 400,
            //     isSuccessful: false,
            //     requestData: [],
            //     responseData: "Satellite data entry is invalid",
            //     error: 'Invalid satellite data entry',
            //     farmId: $this->farm->farm_id,
            //     executionTime: null
            // );
            return false;
        }
        return true;
    }

    protected function hasInvalidZonalStats(array $entry): bool
    {
        $zonalStats = $entry['zonalStats'] ?? [];

        if (!empty($zonalStats) && collect($zonalStats)->every(fn($v) => $v === 'None')) {
            // $this->apiLogger->logRequest(
            //     serviceName: 'Satellite API',
            //     method: 'GET',
            //     url: 'N/A',
            //     statusCode: 200,
            //     isSuccessful: true,
            //     requestData: [],
            //     responseData: ['farm_id' => $this->farm->id],
            //     error: 'Skipped all-None zonalStats',
            //     farmId: $this->farm->farm_id,
            //     executionTime: null
            // );
            return true;
        }

        return false;
    }

    private function processFiles(array $entry, int $date): array
    {
        $filePaths = [];
        $dateString = date('Ymd', $date);
        $farmId = $this->farm->farm_id;

        try {
            // Process PNG files
            foreach ($entry['png'] as $type => $url) {
                if ($url !== 'None' && ($type === 'ndvi' || $type === 'sm')) {
                    $filename = "{$type}_{$farmId}_{$dateString}.png";
                    $path = "satellite_data/png/{$filename}"; // Public folder path
                    $this->storeFile($url, $path);
                    $filePaths['png'][$type] = $filename; // Store public URL
                }
            }

            // Process Zonal Stats JSON files
            foreach ($entry['zonalStats'] as $type => $url) {
                if ($url !== 'None' && ($type === 'ndvi' || $type === 'sm')) {
                    $filename = "{$type}_{$farmId}_{$dateString}.json";
                    $path = "satellite_data/stats/{$filename}"; // Public folder path
                    $this->storeFile($url, $path);
                    $filePaths['zonal_stats'][$type] = $filename; // Store public URL
                }
            }
        } catch (\Exception $e) {
            Log::error("File processing failed: " . $e->getMessage());
            $apiStatus = 'failed';
            $errorMessage = $e->getMessage();
            MonitoringStatusService::MonitoringlogStatus($this->farm->farm_id, 'satellite', $apiStatus, $errorMessage);

        }

        return $filePaths;
    }

    //to save file in public
    private function storeFile(string $url, string $storagePath): string
    {
        $response = Http::timeout(30)->get($url);

        if ($response->successful()) {
            // Use the "public" disk
            $disk = Storage::disk('public');

            // Extract the directory path
            $directory = dirname($storagePath);

            // Create the directory if it doesn't exist
            if (!$disk->exists($directory)) {
                $disk->makeDirectory($directory);
            }

            // Save the file to the public disk
            $disk->put($storagePath, $response->body());

            // Return the public URL (e.g., http://yourdomain.com/storage/satellite_data/png/ndvi_101414_20250116.png)
            // return asset('storage/' . $storagePath);
            return 'storage/' . $storagePath;
        }
         
        throw new \Exception("Failed to download file from {$url}");
    }
}
