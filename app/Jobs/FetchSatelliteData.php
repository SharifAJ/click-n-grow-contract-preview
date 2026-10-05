<?php

namespace App\Jobs;

use App\Models\FarmModel;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\ApiHelperService;
use App\Services\SatelliteService;
use Exception;

class FetchSatelliteData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;
    
    
    /*
        |--------------------------------------------------------------------------
        | OLD IMPLEMENTATION (DO NOT USE)
        |--------------------------------------------------------------------------
        | Issue:
        | - Agar kisi ek farm pe error / timeout aata tha
        |   to poori job fail ho jaati thi.
        | - Job beech me crash hone par baaki farms execute nahi hote the.
        | - Scheduler ko resume point ka pata nahi hota tha.
        |
        | Isliye ye code production ke liye unsafe tha.
        |
        */
    // public function handle()
    // {
    //     $apiLogger = app(ApiHelperService::class);
    //     $satelliteService = new SatelliteService($apiLogger);

    //     FarmModel::where('status', 'Paid')->orderBy('id', 'desc')->chunk(10, function ($farms) use ($satelliteService) {
    //         foreach ($farms as $farm) {
    //             $satelliteService->fetchData($farm);
    //         }
    //     });
    // }
    
    
    public function handle()
    {
    // Log to confirm scheduler actually triggered the job
    Log::info('FetchSatelliteData job started');

    $apiLogger = app(ApiHelperService::class);
    $satelliteService = new SatelliteService($apiLogger);

    FarmModel::where('status', 'Paid')
        ->orderBy('id', 'desc')

        /*
         | chunkById is used instead of chunk()
         | Reason:
         | - This job is long-running
         | - chunk() may skip or repeat records if DB changes during execution
         | - chunkById() guarantees stable iteration for large datasets
         */
        ->chunkById(10, function ($farms) use ($satelliteService) {

            foreach ($farms as $farm) {

                try {
                    /*
                     | Each farm is processed independently.
                     | API call failure for one farm
                     | MUST NOT stop the entire job.
                     */
                    $satelliteService->fetchData($farm);

                } catch (\Throwable $e) {

                    /*
                     | IMPORTANT:
                     | - Error is intentionally swallowed.
                     | - This prevents job failure and retry storm.
                     | - Other farms must continue processing.
                     */
                    Log::error('Satellite fetch failed for farm', [
                        'farm_id' => $farm->id,
                        'error'   => $e->getMessage(),
                    ]);

                    // Continue with next farm safely
                    continue;
                }
            }
        });

    // Log to know when full farm cycle is completed
    Log::info('FetchSatelliteData job finished');
}

 
}
// class FetchSatelliteData implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     public $tries = 3;
//     public $timeout = 120;

//     protected ApiHelperService $apiLogger;

//     public function __construct(ApiHelperService $apiLogger)
//     {
//         $this->apiLogger = $apiLogger;
//     }

//     public function handle()
//     {
//         // FarmModel::chunk(10, function ($farms) {
//         FarmModel::where('status', 'Paid')->where('farm_id', 101415)->chunk(10, function ($farms) {
//             $apiKey = config('services.satyukt_api.key');
//             $endpoint = "/api/info";
//             $headers = [
//                 'Content-Type' => 'application/json',
//             ];
//             $serviceName = "Satellite API";

//             foreach ($farms as $farm) {
//                 $apiUrl = config('services.satyukt_api.url') . $endpoint;
//                 try {
//                     $startTime = microtime(true);

//                     //! Start testing: Dummy API response Data
//                     // Load raw JSON data from file
//                     // $dummyJson = file_get_contents(base_path('development/dummy_data.json'));

//                     // // Create a PSR-7 response (Guzzle)
//                     // $psrResponse = new \GuzzleHttp\Psr7\Response(
//                     //     200,              // HTTP status code
//                     //     [],               // Headers
//                     //     $dummyJson        // Response body (raw JSON string)
//                     // );

//                     // // Wrap in Laravel's HTTP Client Response
//                     // $response = new \Illuminate\Http\Client\Response($psrResponse);
//                     //! End testing: Dummy API response Data

//                     // * Actual API
//                     $response = Http::timeout(60)
//                         ->retry(3, 500)
//                         ->withHeaders($headers)
//                         ->get($apiUrl, [
//                             "key" => $apiKey,  // Ensure key placement matches API requirements
//                             "farm_id" => $farm->farm_id
//                         ]);

//                     $endTime = microtime(true);
//                     $executionTime = $endTime - $startTime;

//                     $responseData = $response->json() ?? [];

//                     if ($response->successful()) {
//                         if (!empty($responseData)) {
//                             StoreSatelliteData::dispatch($farm, $responseData)
//                                 ->onQueue('satellite-data');
//                         } 
//                         // else {
//                         //     Log::info("API returned empty data", ['farm_id' => $farm->farm_id]);

//                         //     $this->apiLogger->logRequest(
//                         //         serviceName: $serviceName,
//                         //         method: 'GET',
//                         //         url: $endpoint,
//                         //         statusCode: $response->status(),
//                         //         isSuccessful: true,  // API call was successful, just no data
//                         //         requestData: ["farm_id" => $farm->farm_id],  // Use farm_id consistently
//                         //         responseData: $responseData,
//                         //         error: 'API returned empty dataset',  // More accurate message
//                         //         farmId: $farm->farm_id,
//                         //         executionTime: $executionTime ?? null
//                         //     );
//                         // }
//                     } else {
//                         Log::warning("API request failed", [
//                             'farm_id' => $farm->farm_id,
//                             'status' => $response->status()
//                         ]);

//                         $this->apiLogger->logRequest(
//                             serviceName: $serviceName,
//                             method: 'GET',
//                             url: $endpoint,
//                             statusCode: $response->status(),
//                             isSuccessful: false,
//                             requestData: ["farm_id" => $farm->farm_id],
//                             responseData: $responseData,
//                             error: 'API request failed with status: ' . $response->status(),
//                             farmId: $farm->farm_id,
//                             executionTime: $executionTime ?? null
//                         );
//                     }
//                 } catch (Exception $e) {
//                     $this->apiLogger->logRequest(
//                         serviceName: $serviceName,
//                         method: 'GET',
//                         url: $endpoint,
//                         statusCode: 500,
//                         isSuccessful: false,
//                         requestData: ["farm_id" => $farm->farm_id] ?? [],
//                         responseData: ['error' => $e->getMessage()],
//                         error: $e->getMessage(),
//                         farmId: $farm->farm_id,
//                         executionTime: $executionTime ?? null
//                     );
//                 }

//             }
//         });
//     }
// }

