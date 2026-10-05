<?php

namespace App\Console\Commands;

use App\Models\CropCalendarModel;
use App\Models\CropHarvestEnd;
use App\Services\MonitoringStatusService;
use Illuminate\Console\Command;
use App\Models\FarmModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Pest\Mutate\Mutators\Math\RoundToCeil;

/* --------------------------------------------------- Working code with logs and many functions -------------------------------------------------- */
// class FetchCropCalendars extends Command
// {
//     protected $signature = 'calendar:fetch';
//     protected $description = 'Sync crop calendar data with simplified error handling';

//     public function handle()
//     {
//         $processed = 0;
//         $errors = [];

//         $farms = FarmModel::where('status', 'Paid')
//             ->whereNotNull('sowingdate')
//             ->whereNotNull('croptype')
//             ->cursor();

//         foreach ($farms as $farm) {
//             try {
//                 Log::info("Processing farm: {$farm->farm_id}");
//                 $result = $this->processFarm($farm);
//                 if (isset($result['error'])) {
//                     Log::error("Error for farm {$farm->farm_id}: " . json_encode($result['error']));
//                     $errors[$farm->farm_id] = $result['error'];
//                 } else {
//                     Log::info("Successfully processed farm {$farm->farm_id}, iterations: {$result['processed']}");
//                     $processed += $result['processed'];
//                 }
//             } catch (\Exception $e) {
//                 Log::error("Exception for farm {$farm->farm_id}: " . $e->getMessage());
//                 $errors[$farm->farm_id] = 'Exception: ' . $e->getMessage();
//             }
//         }

//         $this->info("Processed: $processed");
//         if (!empty($errors)) {
//             $this->warn("Errors: " . json_encode($errors, JSON_PRETTY_PRINT));
//         }

//         return $processed > 0 ? 0 : 1;
//     }

//     protected function processFarm($farm)
//     {
//         Log::info("Starting process for farm {$farm->farm_id}");
//         $currentDay = ((int) \Carbon\Carbon::createFromFormat('d-m-Y', $farm->sowingdate)
//             ->diffInDays(now(), false)) + 1;
//         Log::info("Current day for farm $currentDay");

//         if ($currentDay < 1) {
//             Log::warning("Future sowing date for farm {$farm->farm_id}");
//             return ['error' => "Future sowing date for farm {$farm->farm_id}"];
//         }

//         $processedCount = 0;

//         for ($i = 0; $i < 10; $i++) {
//             // Check if current day's range already exists for this crop
//             $existingRange = CropCalendarModel::where('crop', $farm->croptype)
//                 ->whereRaw(
//                     '? BETWEEN 
//                 CAST(SUBSTRING_INDEX(`range`, "-", 1) AS UNSIGNED) AND 
//                 CAST(SUBSTRING_INDEX(`range`, "-", -1) AS UNSIGNED)',
//                     [$currentDay]
//                 )->first();


//             if ($existingRange) {
//                 // Move to next range
//                 $rangeEnd = (int) explode('-', $existingRange->range)[1];
//                 $currentDay = $rangeEnd + 1;
//                 Log::info("Skipping existing range for crop {$farm->croptype} (day $currentDay)");
//                 continue;
//             }

//             Log::info("Fetching data for farm {$farm->farm_id}, iteration: " . ($i + 1) . ", currentDay: $currentDay");
//             $response = Http::retry(3, 200)->get(
//                 config('services.satyukt_api.url') . '/display/crop/calender/v2',
//                 [
//                     'key'         => config('services.satyukt_api.key'),
//                     'farm_id'     => $farm->farm_id,
//                     'sowing_date' => $currentDay,
//                     'crop'        => $farm->croptype,
//                     'lang'        => 'en'
//                 ]
//             );

//             if (!$response->successful()) {
//                 Log::error("API error for farm {$farm->farm_id}, HTTP status: {$response->status()}");
//                 return ['error' => "API error (HTTP {$response->status()}) for farm {$farm->farm_id}"];
//             }

//             $data = $response->json();
//             Log::info("API response for farm {$farm->farm_id}, iteration: " . ($i + 1), ['data' => $data]);

//             if (isset($data[0]['Range']) && $data[0]['Range'] === '0') {
//                 Log::info("Harvesting period over for farm {$farm->farm_id}");
//                 return ['error' => "Harvesting period over for farm"];
//             }

//             $maxRange = 0;
//             foreach ($data as $entry) {
//                 if (!isset($entry['Range']) || strpos($entry['Range'], '-') === false) {
//                     Log::warning("Invalid range format for farm {$farm->farm_id}, entry: " . json_encode($entry));
//                     continue;
//                 }

//                 CropCalendarModel::updateOrCreate(
//                     ['crop' => $farm->croptype, 'range' => $entry['Range']],
//                     [
//                         'farm_id'     => $farm->farm_id,
//                         'recommended' => $entry['Recommended'] ?? null,
//                         'status'      => $entry['status'] ?? 'pending'
//                     ]
//                 );

//                 [$start, $end] = explode('-', $entry['Range']);
//                 $maxRange = max($maxRange, (int) $end);
//             }

//             if ($maxRange <= $currentDay) {
//                 Log::info("No new range found for farm {$farm->farm_id}, stopping iterations");
//                 break;
//             }

//             $currentDay = $maxRange + 1;
//             $processedCount++;
//         }

//         Log::info("Finished processing farm {$farm->farm_id}, total iterations: $processedCount");
//         return ['processed' => $processedCount];
//     }
// }

/* ------------------------------------------------------ Properly Working Code, DONT DELETE, ----------------------------------------------------- */
// class FetchCropCalendars extends Command
// {
//     protected $signature = 'calendar:fetch';
//     protected $description = 'Sync crop calendar data with simplified error handling';

//     public function handle()
//     {
//         $processed = 0;
//         $errors = [];

//         $farms = FarmModel::where('status', 'Paid')
//             ->whereNotNull('sowingdate')
//             ->whereNotNull('croptype')
//             ->cursor();

//         foreach ($farms as $farm) {
//             try {
//                 $result = $this->processFarm($farm);
//                 if (isset($result['error'])) {
//                     Log::error("Error for farm {$farm->farm_id}: " . $result['error']);
//                     $errors[$farm->farm_id] = $result['error'];
//                 } else {
//                     Log::info("Successfully processed farm {$farm->farm_id} in {$result['processed']} iterations");
//                     $processed += $result['processed'];
//                 }
//             } catch (\Exception $e) {
//                 Log::error("Exception for farm {$farm->farm_id}: " . $e->getMessage());
//                 $errors[$farm->farm_id] = 'Exception: ' . $e->getMessage();
//             }
//         }

//         $this->info("Processed: $processed");
//         if (!empty($errors)) {
//             $this->warn("Errors: " . implode(', ', $errors));
//         }

//         return $processed > 0 ? 0 : 1;
//     }

//     protected function processFarm($farm)
//     {
//         $currentDay = ((int) \Carbon\Carbon::createFromFormat('d-m-Y', $farm->sowingdate)
//             ->diffInDays(now(), false)) + 1;

//         if ($currentDay < 1) {
//             return ['error' => "Future sowing date for farm {$farm->farm_id}"];
//         }

//         $processedCount = 0;

//         for ($i = 0; $i < 10; $i++) {
//             // Check if current day's range already exists for this crop
//             $existingRange = CropCalendarModel::where('crop', $farm->croptype)
//                 ->whereRaw(
//                     '? BETWEEN 
//                     CAST(SUBSTRING_INDEX(`range`, "-", 1) AS UNSIGNED) AND 
//                     CAST(SUBSTRING_INDEX(`range`, "-", -1) AS UNSIGNED)',
//                     [$currentDay]
//                 )->first();

//             if ($existingRange) {
//                 // Move to next range
//                 $rangeEnd = (int) explode('-', $existingRange->range)[1];
//                 $currentDay = $rangeEnd + 1;
//                 continue;
//             }

//             $response = Http::retry(3, 200)->get(
//                 config('services.satyukt_api.url') . '/display/crop/calender/v2',
//                 [
//                     'key'         => config('services.satyukt_api.key'),
//                     'farm_id'     => $farm->farm_id,
//                     'sowing_date' => $currentDay,
//                     'crop'        => $farm->croptype,
//                     'lang'        => 'en'
//                 ]
//             );

//             if (!$response->successful()) {
//                 return ['error' => "API error (HTTP {$response->status()}) for farm {$farm->farm_id}"];
//             }

//             $data = $response->json();

//             if (isset($data[0]['Range']) && $data[0]['Range'] === '0') {
//                 return ['error' => "Harvesting period over for farm {$farm->farm_id}"];
//             }

//             $maxRange = 0;
//             foreach ($data as $entry) {
//                 if (!isset($entry['Range']) || strpos($entry['Range'], '-') === false) {
//                     continue;
//                 }

//                 CropCalendarModel::updateOrCreate(
//                     ['crop' => $farm->croptype, 'range' => $entry['Range']],
//                     [
//                         'farm_id'     => $farm->farm_id,
//                         'recommended' => $entry['Recommended'] ?? null,
//                         'status'      => $entry['status'] ?? 'pending'
//                     ]
//                 );

//                 [$start, $end] = explode('-', $entry['Range']);
//                 $maxRange = max($maxRange, (int)$end);
//             }

//             if ($maxRange <= $currentDay) {
//                 break;
//             }

//             $currentDay = $maxRange + 1;
//             $processedCount++;
//         }

//         return ['processed' => $processedCount];
//     }
// }

/* -------------------------------------------------------------------- TESTING ------------------------------------------------------------------- */

class FetchCropCalendars extends Command
{
    protected $signature = 'calendar:fetch';
    protected $description = 'Sync crop calendar data with simplified error handling';

    public function handle()
    {
        $processed = 0;
        $errors = [];

        $farms = FarmModel::where('status', 'Paid')
            ->whereNotNull('sowingdate')
            ->whereNotNull('croptype')
            ->cursor();

        foreach ($farms as $farm) {
            try {
                $result = $this->processFarm($farm);
                if (isset($result['error'])) {
                    Log::error("Error for farm {$farm->farm_id}: " . $result['error']);
                    $apiStatus = 'failed';
                    $errorMessage = $result['error'];
                    MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

                    $errors[$farm->farm_id] = $result['error'];
                } else {
                    Log::info("Successfully processed farm {$farm->farm_id} in {$result['processed']} iterations");
                }
            } catch (\Exception $e) {
                Log::error("Exception for farm {$farm->farm_id}: " . $e->getMessage());
                $apiStatus = 'failed';
                $errorMessage = $e->getMessage();
                MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

                $errors[$farm->farm_id] = 'Exception: ' . $e->getMessage();
            }
        }

        $this->info("Processed: $processed");
        if (!empty($errors)) {
            $apiStatus = 'failed';
            $errorMessage = implode(', ', $errors);
            MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

            $this->warn("Errors: " . implode(', ', $errors));
        }

        return $processed > 0 ? 0 : 1;
    }

    protected function processFarm($farm)
    {
        $currentDay = ((int) \Carbon\Carbon::createFromFormat('d-m-Y', $farm->sowingdate)
            ->diffInDays(now(), false)) + 1;

        if ($currentDay < 1) {
            return ['error' => "Future sowing date for farm {$farm->farm_id}"];
        }

        $processedCount = 0;
        $harvestEndDay = $this->getLastHarvestDay($farm->croptype);

        for ($i = 0; $i < 10; $i++) {
            // Check if we already know the harvest ended before this day
            if ($harvestEndDay !== null && $currentDay > $harvestEndDay) {
                Log::info("Skipping day $currentDay - harvest ended at $harvestEndDay");
                
                return ['error' => "Harvesting period over for farm {$farm->farm_id}"];
            }

            // Check if current day's range already exists for this crop
            $existingRange = CropCalendarModel::where('crop', $farm->croptype)
                ->whereRaw(
                    '? BETWEEN 
                    CAST(SUBSTRING_INDEX(`range`, "-", 1) AS UNSIGNED) AND 
                    CAST(SUBSTRING_INDEX(`range`, "-", -1) AS UNSIGNED)',
                    [$currentDay]
                )->first();

            if ($existingRange) {
                // Move to next range
                $rangeEnd = (int) explode('-', $existingRange->range)[1];
                $currentDay = $rangeEnd + 1;
                continue;
            }

            $response = Http::retry(3, 200)->get(
                config('services.satyukt_api.url') . '/display/crop/calender/v2',
                [
                    'key' => config('services.satyukt_api.key'),
                    'farm_id' => $farm->farm_id,
                    'sowing_date' => $currentDay,
                    'crop' => $farm->croptype,
                    'lang' => 'en'
                ]
            );

            if (!$response->successful()) {
                $apiStatus = 'failed';
                $errorMessage = $response->status();
                MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

                return ['error' => "API error (HTTP {$response->status()}) for farm {$farm->farm_id}"];
            }

            $data = $response->json();

            // Handle harvest period over response
            if (isset($data[0]['Range']) && $data[0]['Range'] === '0') {
                $apiStatus = 'failed';
                $errorMessage = "API error (HTTP {$response->status()}) for farm {$farm->farm_id}";
                MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

                $this->updateHarvestDay($farm->croptype, $currentDay);
                return ['error' => "Harvesting period over for farm {$farm->farm_id}"];
            }

            if (isset($data[0]['Range']) && $data[0]['Range'] === '0') {
                $apiStatus = 'failed';
                $errorMessage = "API error (HTTP {$response->status()}) for farm {$farm->farm_id}";
                MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

                return ['error' => "Harvesting period over for farm {$farm->farm_id}"];
            }

            $maxRange = 0;
            foreach ($data as $entry) {
                if (!isset($entry['Range']) || strpos($entry['Range'], '-') === false) {
                    continue;
                }

                CropCalendarModel::updateOrCreate(
                    ['crop' => $farm->croptype, 'range' => $entry['Range']],
                    [
                        'farm_id' => $farm->farm_id,
                        'recommended' => $entry['Recommended'] ?? null,
                        'status' => $entry['status'] ?? 'pending'
                    ]
                );

                [$start, $end] = explode('-', $entry['Range']);
                $maxRange = max($maxRange, (int) $end);

                $apiStatus = 'success';
                $errorMessage = null;
                MonitoringStatusService::MonitoringlogStatus($farm->farm_id, 'cropcalendar', $apiStatus, $errorMessage);

            }

            if ($maxRange <= $currentDay) {
                break;
            }

            $currentDay = $maxRange + 1;
            $processedCount++;
        }

        return ['processed' => $processedCount];
    }

    // With cache
    protected function getLastHarvestDay($cropType)
    {
        Log::info("Fetching last harvest day for crop type: {$cropType}");
        return Cache::remember("harvest_end_{$cropType}", now()->addDay(), function () use ($cropType) {
            $lastDay = CropHarvestEnd::where('crop', $cropType)->value('last_day');
            Log::info("Last harvest day retrieved from database for crop type {$cropType}: " . ($lastDay ?? 'null'));
            return $lastDay;
        });
    }

    // // without cache
    // protected function getLastHarvestDay($cropType)
    // {
    //     Log::info("Fetching last harvest day for crop type: {$cropType}");
    //     $lastDay = CropHarvestEnd::where('crop', $cropType)->value('last_day');
    //     Log::info("Last harvest day retrieved from database for crop type {$cropType}: " . ($lastDay ?? 'null'));
    //     return $lastDay;
    // }

    // protected function updateHarvestDay($cropType, $currentDay)
    // {
    //     Log::info("Updating harvest day for crop type: {$cropType} with current day: {$currentDay}");
    //     CropHarvestEnd::updateOrCreate(
    //         ['crop' => $cropType],
    //         ['last_day' => DB::raw("LEAST(COALESCE(`last_day`, 9999), $currentDay)")]
    //     );
    //     Log::info("Harvest day updated for crop type: {$cropType}, cache will be cleared.");
    //     Cache::forget("harvest_end_{$cropType}");
    //     Log::info("Cache cleared for crop type: {$cropType}");
    // }
    protected function updateHarvestDay($cropType, $currentDay)
    {
        Log::info("Updating harvest day for crop type: {$cropType} with current day: {$currentDay}");

        $record = CropHarvestEnd::firstOrNew(['crop' => $cropType]);
        // Use PHP's min() to calculate the least value between the existing last_day (or 9999 if null) and currentDay
        $record->last_day = min($record->last_day ?? 9999, $currentDay);
        $record->save();

        Log::info("Harvest day updated for crop type: {$cropType}, cache will be cleared.");
        Cache::forget("harvest_end_{$cropType}");
        Log::info("Cache cleared for crop type: {$cropType}");
    }

    // Example flow:

    // 1. First request for day 200 → API returns harvest over → stores 200

    // 2. Next request for day 180 → makes API call

    // 3. If API returns harvest over → updates to 180

    // 4. Subsequent requests for any day >180 will skip API calls
}
