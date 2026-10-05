<?php

namespace App\Services;

use App\Jobs\StoreSatelliteData;
use App\Models\FarmModel;
use Illuminate\Support\Facades\Http;

// class SatelliteApiService
// {
//     protected $apiLogger;

//     public function __construct(ApiHelperService $apiLogger)
//     {
//         $this->apiLogger = $apiLogger;
//     }

//     public function fetchFarmData(string $farmId): array
//     {
//         $serviceName = 'Satellite Data Fetch';
//         $method = 'GET';
//         $url = config('services.satyukt_api.url').'/api/info?key='
//               . config('services.satyukt_api.key').'&farm_id='.$farmId;

//         try {
//             $startTime = microtime(true);
//             $response = Http::timeout(30)
//                 ->retry(3, 500)
//                 ->get($url);

//             $executionTime = round((microtime(true) - $startTime) * 1000, 2);
//             $responseData = $response->json() ?? [];

//             // Custom success check for satellite API
//             $isSuccessful = $this->isValidResponse($responseData);

//             // Logging
//             $this->apiLogger->logRequest(
//                 $serviceName,
//                 $method,
//                 $url,
//                 $response->status(),
//                 $isSuccessful,
//                 [],
//                 $responseData,
//                 $isSuccessful ? null : 'Invalid zonalStats data',
//                 $farmId,
//                 $executionTime
//             );

//             return [
//                 'success' => $isSuccessful,
//                 'data' => $responseData,
//                 'status' => $response->status(),
//                 'execution_time' => $executionTime
//             ];

//         } catch (\Throwable $e) {
//             $this->apiLogger->logRequest(...);
//             return ['success' => false, 'error' => $e->getMessage()];
//         }
//     }

//     protected function isValidResponse(array $data): bool
//     {
//         // Check if zonalStats contains at least one non-null value
//         $zonalStats = $data['zonalStats'] ?? [];
//         $hasValidZonalStats = !empty(array_filter($zonalStats, fn($v) => $v !== "None" && $v !== null));

//         // Check if Date property exists in the data
//         $hasDateProperty = isset($data['Date']);

//         return $hasValidZonalStats && $hasDateProperty;
//     }
// }