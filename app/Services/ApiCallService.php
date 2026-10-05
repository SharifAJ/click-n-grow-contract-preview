<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiCallService
{
    protected $apiLogger;
    protected $baseUrl;
    protected $apiKey;

    public function __construct(ApiHelperService $apiLogger)
    {
        $this->apiLogger = $apiLogger;
        $this->baseUrl = config('services.satyukt_api.url');
        $this->apiKey = config('services.satyukt_api.key');
    }

    /**
     * Send an API request.
     *
     * @param string $method HTTP method (get, post, put, delete, etc.)
     * @param string $endpoint API endpoint (appended to base URL)
     * @param array $data Data to send with the request
     * @param array $headers Additional headers to include
     * @param int $timeout Request timeout in seconds
     * @param int $retries Number of retries
     * @param int $retryDelay Delay between retries in milliseconds
     * @param string $serviceName Name of the service for logging
     * @param integer $farmId ID of the farm associated with the request
     * @return array Response with status, message, data, and HTTP status code.
     */
    public function sendRequest(
        string $method,
        string $endpoint,
        array $data = [],
        array $headers = [],
        int $timeout = 60,
        int $retries = 3,
        int $retryDelay = 500,
        string $serviceName = '',
        $farmId = null
    ): array {

        $method = strtolower($method);
        $url = $this->baseUrl . $endpoint;
        $headers['Content-Type'] = $headers['Content-Type'] ?? 'application/json';
        $headers['Accept'] = $headers['Accept'] ?? 'application/json';

        try {
            $startTime = microtime(true);
            $response = Http::timeout($timeout)
                ->retry($retries, $retryDelay)
                ->withHeaders($headers)
                ->{$method}($url, $data);

            $executionTime = microtime(true) - $startTime;

            // Log::info("API call execution time: {$executionTime} seconds for URL: {$url}");
            // Log::debug("API Request Data: " . json_encode($data));
            // Log::debug("API Response: " . $response["error"]);

            // Parse response data
            $responseData = $response->json() ?? [];
            if (!is_array($responseData)) {
                $responseData = [];
            }

            //in if statement is external status check, write here with OR condition all the success statuses from external API
            if (
                ($responseData['status'] ?? '') === 'success' || //add farm
                ($responseData['Status'] ?? '') === 'Success' || // update farm
                ($responseData['status'] ?? '') === 'Deactivated' //delete farm
            ) {
                return [
                    'i_status' => true, //this is internal status means add farm, update farm, delete farm etc done from external api side
                    'message' => 'API request successful',
                    'data' => $responseData,
                    'statusCode' => $response->status(),
                    'executionTime' => $executionTime
                ];
            } else {
                $errorMessage = array_filter([
                    $response["exception"] ?? null,
                    $response["message"] ?? null,
                    $response["error"] ?? null
                ]);
                return [
                    'i_status' => false,
                    'message' => !empty($errorMessage) ? reset($errorMessage) : 'API request failed',
                    'data' => $responseData,
                    'statusCode' => $response->status(),
                    'executionTime' => $executionTime
                ];
            }
        } catch (\Throwable $e) {
            Log::error("API Request Failed: " . $e->getMessage());
            Log::error("Request URL: {$url}");
            Log::error("Request Data: " . json_encode($data));

            $this->apiLogger->logRequest(
                serviceName: $serviceName,
                method: strtoupper($method),
                url: $url,
                statusCode: 500,
                isSuccessful: false,
                requestData: $data,
                responseData: ['error' => $e->getMessage()],
                error: $e->getMessage(),
                farmId: $farmId,
                executionTime: null
            );

            return [
                'i_status' => false,
                'message' => 'API request failed: ' . $e->getMessage(),
                'data' => null,
                'statusCode' => 500,
                'executionTime' => $executionTime ?? null
            ];
        }
    }
}
