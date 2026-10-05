<?php

namespace App\Services;

use App\Models\FarmModel;
use App\Services\ApiHelperService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FarmService
{
    protected $apiLogger;
    protected $apiCallService;
    /**
     * Create a new class instance.
     */
    public function __construct(ApiHelperService $apiLogger, ApiCallService $apiCallService)
    {
        $this->apiLogger = $apiLogger;
        $this->apiCallService = $apiCallService;
    }

    public function storeFarm(array $data, int $user_id)
    {
        set_time_limit(120); // Increase to 120 seconds (or higher if needed), temporarily increase the execution time limit
        $serviceName = 'Add Farm API';
        $endpoint = '/postjson2';

        // Convert JSON string to an array
        if (isset($data['coordinates']) && is_string($data['coordinates'])) {
            $data['coordinates'] = json_decode($data['coordinates'], true);
        }

        // 1. Validate Input, $validator->validated() = contains all validated data in an array
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'coordinates' => 'required|array',
            'croptype' => 'required|string',
            'category' => 'required|string',
            'sowingdate' => 'required|date_format:d-m-Y',
            'crop_variety' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            // $this->apiLogger->logRequest(
            //     serviceName: $serviceName,
            //     method: 'POST',
            //     url: 'validation',
            //     statusCode: 422,
            //     isSuccessful: false,
            //     requestData: [],
            //     responseData: $validator->errors()->toArray(),
            //     error: 'Validation failed',
            //     farmId: null // No farm ID yet
            // );
            return [
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'statusCode' => 422
            ];
        }

        // Prepare API Request
        $apiRequestData = [
            'name' => $data['name'],
            'coordinates' => json_encode($data['coordinates']),
            'croptype' => $data['croptype'],
            'category' => $data['category'],
            'sowingdate' => $data['sowingdate'],
            'crop_variety' => $data['crop_variety'] ?? '',
            'key' => config('services.satyukt_api.key')
        ];

        // dd($apiRequestData);

        // Save minimal farm data to the database
        try {
            // 4. Call the API using ApiCallService
            $response = $this->apiCallService->sendRequest(
                method: 'GET',
                endpoint: $endpoint,
                data: $apiRequestData,
                headers: [],
                timeout: 60,
                retries: 3,
                retryDelay: 500,
                serviceName: $serviceName,
                farmId: null
            );

            // 5. Update Farm Status, if status=true
            if ($response['i_status']) {
                // Log::info('API response:', ['response' => $response]);
                // dd();
                $apiResponse = $response['data'];

                $farm = FarmModel::create([
                    'user_id' => $user_id,
                    // Add validated fields: $data = $validator->validated();
                    // Since we assigned $data during validation, we can now use $data to access the validated values.
                    'name' => $data['name'],
                    'croptype' => $data['croptype'],
                    'category' => $data['category'],
                    'sowingdate' => $data['sowingdate'],
                    'crop_variety' => $data['crop_variety'] ?? null,
                    // API response fields
                    'farm_id' => $apiResponse['ID'],
                    'area' => $apiResponse['Area'],
                    'center' => $apiResponse['Center'],
                    'district' => $apiResponse['District'],
                    'state' => $apiResponse['State'],
                    'geo_json' => $apiResponse['geo_json'],
                    'geometry_type' => $apiResponse['geo_json']['geometry']['type'],
                    'geo_json_properties' => $apiResponse['geo_json']['properties'],
                    'geo_json_type' => $apiResponse['geo_json']['type'],
                    'type' => $apiResponse['type'],
                    'status' => 'Unpaid',
                ]);

                // Add API Request Log
                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'POST',
                    url: $endpoint,
                    statusCode: $response['statusCode'],
                    isSuccessful: $response['i_status'],
                    requestData: $apiRequestData,
                    responseData: $response['data'],
                    error: $response['i_status'] ? null : $response['message'],
                    farmId: $farm->farm_id,
                    executionTime: $response['executionTime'] ?? 0
                );
                return [
                    'status' => true,
                    'message' => 'Farm created successfully',
                    'data' => $farm->fresh(),
                    'farm_id' => $farm->farm_id,
                    'statusCode' => $response['statusCode'] ?? 201
                ];
            } else {
                // API Failure
                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'POST',
                    url: $endpoint,
                    statusCode: $response['statusCode'],
                    isSuccessful: $response['i_status'],
                    requestData: $apiRequestData,
                    responseData: $response['data'],
                    error: $response['i_status'] ? null : $response['message'],
                    farmId: null,
                    executionTime: $response['executionTime'] ?? 0
                );
                return [
                    'status' => false,
                    'message' => 'Farm creation failed. ' .  $response['message'],
                    // 'error' => $response['message'],
                    'statusCode' => 200
                ];
            }
        } catch (\Throwable $e) {
            // Handle Unexpected Errors
            $this->apiLogger->logRequest(
                serviceName: $serviceName,
                method: 'POST',
                url: $endpoint,
                statusCode: 500,
                isSuccessful: false,
                requestData: $apiRequestData ?? [],
                responseData: ['error' => $e->getMessage()],
                error: $e->getMessage(),
                farmId: null,
                executionTime: $response['executionTime'] ?? null
            );

            return [
                'status' => false,
                'message' => 'Farm creation failed. ' . $e->getMessage(),
                // 'error' => $e->getMessage(),
                'statusCode' => 500
            ];
        }
    }

    public function updateFarm(array $data, FarmModel $farm)
    {
        set_time_limit(120); // Increase execution time limit

        $serviceName = 'Update Farm API';
        $endpoint = '/update/cropdetails';

        // Convert JSON string to an array
        if (isset($data['coordinates']) && is_string($data['coordinates'])) {
            $data['coordinates'] = json_decode($data['coordinates'], true);
        }

        // 1. Validate Input
        $validator = Validator::make($data, [
            'croptype' => [
                'sometimes',
                'string',
                Rule::exists('crop_list', 'crop_name') // Validate against `name` column in `crop_list` table
            ],
            'sowingdate' => 'sometimes|date_format:d-m-Y',
            'crop_variety' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            // $this->apiLogger->logRequest(
            //     serviceName: $serviceName,
            //     method: 'PUT',
            //     url: 'validation',
            //     statusCode: 422,
            //     isSuccessful: false,
            //     requestData: [],
            //     responseData: $validator->errors()->toArray(),
            //     error: 'Validation failed',
            //     farmId: $farm->farm_id
            // );

            return [
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'statusCode' => 422
            ];
            // Log::info("validation done pass");
        }

        // 3. Prepare API request data (use existing values if not provided in the request)
        $apiRequestData = [
            'croptype' => $data['croptype'] ?? $farm->croptype, //mandatory
            'farm_id' => $farm->farm_id, //mandatory
            'variety' => $data['crop_variety'] ?? $farm->crop_variety, // in api sat2farm used variety, we have crop_variety in our db
            'sowing_date' => $data['sowingdate'] ?? $farm->sowingdate, //mandatory // satyukt update api has sowing_date with underscore, otherwise in all places we will use sowingdate
            'key' => config('services.satyukt_api.key')
        ];
        // Log::info("api request data=", $apiRequestData);
        try {
            // 4. Use ApiCallService to make the request
            $response = $this->apiCallService->sendRequest(
                method: 'GET', //satyukt uses get method for update
                endpoint: $endpoint,
                data: $apiRequestData,
                headers: [],
                timeout: 60,
                retries: 3,
                retryDelay: 500,
                serviceName: $serviceName,
                farmId: $farm->farm_id
            );
            // Log::info("api call send request done", $response);

            // 5. Update Farm , i_status = internal status = true means data updated in e_api, now we can add in our db the same updated data
            if ($response['i_status']) {

                $updateData = [
                    'farm_id' => $farm->farm_id,
                    'croptype' => $data['croptype'] ?? $farm->croptype,
                    'sowingdate' => $data['sowingdate'] ?? $farm->sowingdate,
                    'crop_variety' => $data['crop_variety'] ?? $farm->crop_variety,
                ];

                $farm->update($updateData);

                // Add API Request Log
                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'PUT',
                    url: $endpoint,
                    statusCode: $response['statusCode'],
                    isSuccessful: $response['i_status'],
                    requestData: $apiRequestData,
                    responseData: $response['data'],
                    error: $response['i_status'] ? null : $response['message'],
                    farmId: $farm->farm_id,
                    executionTime: $response['executionTime'] ?? 0
                );
                return [
                    'status' => true,
                    'message' => 'Farm updated successfully',
                    'data' => $farm->fresh(),
                    'farm_id' => $farm->farm_id,
                    'statusCode' => 201
                ];
            } else {
                // Add API Request Log
                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'PUT',
                    url: $endpoint,
                    statusCode: $response['statusCode'],
                    isSuccessful: $response['i_status'],
                    requestData: $apiRequestData,
                    responseData: $response['data'],
                    error: $response['i_status'] ? null : $response['message'],
                    farmId: $farm->farm_id,
                    executionTime: $response['executionTime'] ?? 0
                );
                return [
                    'status' => false,
                    'message' => 'Farm update failed. ' . $response['message'],
                    // 'error' => $response['message'],
                    'statusCode' => 200
                ];
            }
        } catch (\Throwable $e) {
            $this->apiLogger->logRequest(
                serviceName: $serviceName,
                method: 'PUT',
                url: $endpoint,
                statusCode: 500,
                isSuccessful: false,
                requestData: $apiRequestData ?? [],
                responseData: ['error' => $e->getMessage()],
                error: $e->getMessage(),
                farmId: $farm->farm_id
            );

            return [
                'status' => false,
                'message' => 'Farm update failed. ' . $e->getMessage(),
                // 'error' => $e->getMessage(),
                'statusCode' => 500
            ];
        }
    }

    public function destroyFarm(FarmModel $farm)
    {
        set_time_limit(120); // Increase execution time limit

        $serviceName = 'Delete Farm API';
        $endpoint = '/deletePolygon';

        $apiRequestData = [
            'farmID' => $farm->farm_id,
            'key' => config('services.satyukt_api.key')
        ];

        try {
            // Call the 3rd party API
            $response = $this->apiCallService->sendRequest(
                method: 'GET', // Satyukt uses GET method for deletion
                endpoint: $endpoint,
                data: $apiRequestData,
                headers: [],
                timeout: 60,
                retries: 3,
                retryDelay: 500,
                serviceName: $serviceName,
                farmId: $farm->farm_id
            );
            Log::info("apiResponse=", $response);

            // Validate API response
            if ($response['i_status']) {
                // Log::info("API response status exists: ", ['status' => $apiResponse['status'] ?? 'not set']);

                // Soft delete the farm
                $farm->delete();
                // Log::info("farm deleted");
                // Log the successful deletion
                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'DELETE',
                    url: $endpoint,
                    statusCode: 200, // HTTP status for successful deletion
                    isSuccessful: true,
                    requestData: ['farm_id' => $farm->farm_id],
                    responseData: $response['data'],
                    error: $response['i_status'] ? null : $response['message'],
                    farmId: $farm->farm_id
                );

                return [
                    'status' => true,
                    'message' => 'Farm deleted successfully',
                    'data' => null,
                    'farm_id' => $farm->farm_id,
                    'statusCode' => 200 // Use 200 for successful deletion
                ];
            } else {
                // Extract error message
                // $errorMessage = $apiResponse['error'] ?? $apiResponse['message'] ?? 'Farm deletion failed';

                // Log the API failure
                $this->apiLogger->logRequest(
                    serviceName: $serviceName,
                    method: 'DELETE',
                    url: $endpoint,
                    statusCode: $apiResponse['statusCode'] ?? 500, // Default to 500 if statusCode is missing
                    isSuccessful: false,
                    requestData: ['farm_id' => $farm->farm_id],
                    responseData: $apiResponse['data'] ?? [],
                    error: $response['i_status'] ? null : $response['message'],
                    farmId: $farm->farm_id
                );

                return [
                    'status' => false,
                    'message' => 'Farm deletion failed. ' .  $response['message'],
                    // 'error' => "Farm deletion failed. ",// Use the extracted error message
                    'farm_id' => $farm->farm_id, // Include farm_id for consistency
                    'statusCode' => $apiResponse['statusCode'] ?? 500 // Default to 500 if statusCode is missing
                ];
            }
        } catch (\Throwable $e) {
            // Log unexpected exceptions
            $this->apiLogger->logRequest(
                serviceName: $serviceName,
                method: 'DELETE',
                url: $endpoint,
                statusCode: 500,
                isSuccessful: false,
                requestData: ['farm_id' => $farm->farm_id],
                responseData: ['error' => $e->getMessage()],
                error: $e->getMessage(),
                farmId: $farm->farm_id
            );

            return [
                'status' => false,
                'message' => 'Farm deletion failed, Please try again later! ' . $e->getMessage(),
                // 'error' => $e->getMessage(),
                'farm_id' => $farm->farm_id, // Include farm_id for consistency
                'statusCode' => 500
            ];
        }
    }

    // We are not using api for view farm, so we will not write view farm function here
}
