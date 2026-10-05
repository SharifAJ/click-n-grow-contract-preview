<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FarmModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncFarmsCommandDevelopment extends Command
{
    protected $signature = 'farms:sync';
    protected $description = 'Sync farm data from third-party API';

    //Sync all farm
    // public function handle()
    // {
    //     $key = config('services.satyukt_api.key');
    //     $baseUrl = config('services.satyukt_api.url');

    //     Log::info('Starting farm sync process');

    //     try {
    //         // Step 1: Get all farm IDs
    //         $response = Http::get("$baseUrl/farm/list", ['key' => $key]);

    //         if (!$response->successful()) {
    //             $this->error("Failed to fetch farm list: " . $response->body());
    //             Log::error("Failed to fetch farm list: " . $response->body());
    //             return;
    //         }

    //         $farmIds = $response->json()['Farm IDs'] ?? [];

    //         if (empty($farmIds)) {
    //             $this->info('No farms found in API response');
    //             Log::info('No farms found in API response');
    //             return;
    //         }

    //         $this->info("Found " . count($farmIds) . " farms to process");
    //         Log::info("Found " . count($farmIds) . " farms to process");

    //         // Step 2: Process each farm
    //         $successCount = 0;
    //         foreach ($farmIds as $farmId) {
    //             try {
    //                 $this->processFarm($farmId, $baseUrl, $key);
    //                 $successCount++;
    //                 $this->info("Processed farm $farmId");
    //                 Log::info("Processed farm $farmId");
    //             } catch (\Exception $e) {
    //                 Log::error("Failed to process farm $farmId: " . $e->getMessage());
    //                 $this->error("Error processing farm $farmId");
    //             }
    //         }

    //         $this->info("Sync completed. Success: $successCount/" . count($farmIds));
    //         Log::info("Sync completed. Success: $successCount/" . count($farmIds));
    //     } catch (\Exception $e) {
    //         Log::error("Farm sync failed: " . $e->getMessage());
    //         $this->error("Job failed: " . $e->getMessage());
    //     }
    // }

    //sync manually by id - Few farms with coordinates of actual farm land
    // 101415, 101414, 99472
    // other farm - 109351, 109911, 110008
    public function handle()
    {
        $farmIds = [101415, 101414, 99472, 109351, 109911, 110008]; //Paid Farms
        // $farmIds = [110286,109943, 109924, 109922, 109352]; //Unpaid Farms

        foreach ($farmIds as $farmId) {
            try {
                $this->processFarm($farmId);
                $this->info("Processed farm $farmId");
                Log::info("Processed farm $farmId");
            } catch (\Exception $e) {
                Log::error("Failed to process farm $farmId: " . $e->getMessage());
                $this->error("Error processing farm $farmId");
            }
        }
    }
    
    private function processFarm($farmId)
    {
        $baseUrl = config('services.satyukt_api.url');
        $key = config('services.satyukt_api.key');

        $response = Http::get("$baseUrl/showPolygon", [
            'farmID' => $farmId,
            'key' => $key
        ]);

        if (!$response->successful()) {
            throw new \Exception("API error: " . $response->body());
        }

        $data = $response->json();

        // Transform API response to match DB structure
        $farmData = [
            'user_id' => 2, // Static user ID as per requirement
            'name' => $data['name'] ?? null,
            'croptype' => $data['crop_type'] ?? null,
            'category' => $data['category'] ?? null,
            'sowingdate' => $data['Sowing_date'] ?? null,
            'crop_variety' => $data['variety'] ?? null,
            'area' => $data['area'] ?? null,
            'center' => $data['Center'] ?? null, // Already an array

            'district' => $data['District'] ?? null,
            'state' => $data['State'] ?? null,
            'geo_json' => $data['geo_json'] ?? null, // Already an array
            'geometry_type' => $data['geo_json']['geometry']['type'] ?? null,
            'geo_json_properties' => $data['geo_json']['properties'] ?? null, // Already an array
            'geo_json_type' => $data['geo_json']['type'] ?? null,
            'type' => $data['type'] ?? null,
            'status' => $data['Status'] ?? null,
            'farm_id' => $farmId
        ];

        // Handle dates
        // if (!empty($data['Expired_Date'])) {
        //     $farmData['expired_at'] = \Carbon\Carbon::createFromTimestampMs($data['Expired_Date']);
        // }
        // Update or create farm record
        FarmModel::updateOrCreate(
            ['farm_id' => $farmId],
            $farmData
        );
        Log::info("Insertion Done for farm $farmId");
    }
}
