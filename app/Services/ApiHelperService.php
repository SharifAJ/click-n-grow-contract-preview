<?php

namespace App\Services;

use App\Jobs\LogApiRequest;
use App\Models\RequestLogModel;
use Illuminate\Support\Facades\Auth;

class ApiHelperService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function logRequest($serviceName, $method, $url, $statusCode, $isSuccessful, $requestData = [], $responseData = [], $error = null, $farmId = null, $executionTime = null)
    {
        LogApiRequest::dispatch([
            'service_name' => $serviceName,
            'request_method' => $method,
            'request_url' => $url,
            'response_status' => $statusCode,
            'is_successful' => $isSuccessful,
            'request_data' => $requestData,
            'response_data' => $responseData,
            'error_message' => $error,
            'farm_id' => $farmId,
            'user_id' => Auth::check() ? Auth::id() : null, // Handle unauthenticated requests
            'execution_time' => $executionTime,
        ]);
        // Create log SYNC immediately (don't use queue)
        // RequestLogModel::create([
        //     'farm_id' => $farmId,
        //     'user_id' => Auth::check() ? Auth::id() : null,
        //     'service_name' => $serviceName,
        //     'request_method' => $method,
        //     'request_url' => $url,
        //     'response_status' => $statusCode,
        //     'request_data' => $requestData,
        //     'response_data' => $responseData,
        //     'is_successful' => $isSuccessful,
        //     'error_message' => $error,
        // ]);
    }

    // public function handleApiError($apiResponse, $statusCode, $customMessage = 'Sorry, our API service is currently unavailable. Try again later.')
    // {
    //     return response()->json([
    //         'status' => false,
    //         'message' => $customMessage,
    //         'error' => $apiResponse['message'] ?? 'Unknown API error',
    //     ], $statusCode >= 400 && $statusCode < 500 ? $statusCode : 500);
    // }

    // public function handleBusinessLogicError($apiResponse, $customMessage = 'Sorry, our service is currently unavailable. Try again later.')
    // {
    //     return response()->json([
    //         'status' => false,
    //         'message' => $customMessage,
    //         'api_error' => $apiResponse['message'] ?? 'Unknown API error'
    //     ], 500);
    // }
}
