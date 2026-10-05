<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ApiHelperService;
use App\Jobs\StoreSatelliteData;
use Exception;

class SatelliteService
{
    public function __construct(protected ApiHelperService $apiLogger) {}

    public function fetchData($farm)
    {
        $apiKey = config('services.satyukt_api.key');
        $endpoint = "/api/info";
        $headers = ['Content-Type' => 'application/json'];
        $apiUrl = config('services.satyukt_api.url') . $endpoint;
        $serviceName = "Satellite API";

        try {
            $startTime = microtime(true);

            $response = Http::timeout(60)
                ->retry(3, 500)
                ->withHeaders($headers)
                ->get($apiUrl, [
                    "key" => $apiKey,
                    "farm_id" => $farm->farm_id
                ]);

            $executionTime = microtime(true) - $startTime;
            $responseData = $response->json() ?? [];


Log::info('Satellite API RESPONSE', [
    'farm_id' => $farm->farm_id,
    'status'  => $response->status(),
    'body'    => $response->json(),
]);


            if ($response->successful()) {
                if (!empty($responseData)) {
                    StoreSatelliteData::dispatch($farm, $responseData)
                        ->onQueue('satellite-data');
                }
            } else {
                Log::warning("API request failed", [
                    'farm_id' => $farm->farm_id,
                    'status' => $response->status()
                ]);

                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'GET',
                    url: $endpoint,
                    statusCode: $response->status(),
                    isSuccessful: false,
                    requestData: ["farm_id" => $farm->farm_id],
                    responseData: $responseData,
                    error: 'API request failed with status: ' . $response->status(),
                    farmId: $farm->farm_id,
                    executionTime: $executionTime
                );
            }
        } catch (Exception $e) {
            $this->apiLogger->logRequest(
                serviceName: $serviceName,
                method: 'GET',
                url: $endpoint,
                statusCode: 500,
                isSuccessful: false,
                requestData: ["farm_id" => $farm->farm_id],
                responseData: ['error' => $e->getMessage()],
                error: $e->getMessage(),
                farmId: $farm->farm_id,
                executionTime: $executionTime ?? null
            );
        }
    }
}
