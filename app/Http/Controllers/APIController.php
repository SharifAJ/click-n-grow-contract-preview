<?php

namespace App\Http\Controllers;

use App\Models\CropCalendarModel;
use App\Models\IrrigationDataModel;
use App\Models\MandiRate;
use App\Models\SoilReportModel;
use App\Models\User;
use App\Models\WeatherModel;
use App\Services\MonitoringStatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SyncCropCalendarForFarm;
use App\Jobs\SyncPestDiseaseForFarm;
use App\Models\AdvisoryResponse;
use App\Models\FarmModel;
use App\Models\PestAndDiseasesModel;
use App\Services\ApiHelperService;
use App\Services\SatelliteService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{
    public function fetchSatelliteData(Request $request, SatelliteService $satelliteService)
    {
        $request->validate([
            'farm_id' => 'required|numeric'
        ]);

        $farm = FarmModel::where('farm_id', $request->farm_id)->firstOrFail();

        $satelliteService->fetchData($farm);
        Log::info('Satellite data fetch initiated', [
            'farm_id' => $request->farm_id,
            'user_id' => Auth::id(),
            'timestamp' => now()
        ]);

        return response()->json(['message' => 'Satellite data fetch initiated']);
    }

    public function image_advisory(Request $request)
    {
        $farm_id = $request->farm_id;

        $apiKey = config('services.satyukt_api.key');
        $apiUrl = config('services.satyukt_api.url');

        if (empty($apiKey) || empty($farm_id)) {
            return response()->json([
                'message' => 'Key or Farm ID is empty',
                'status' => 0
            ], 400);
        }

        try {

            // //! Start testing: Dummy API response Data
            // // Load raw JSON data from file
            // $dummyJson = file_get_contents(base_path('development/dummy_data.json'));

            // // Create a PSR-7 response (Guzzle)
            // $psrResponse = new \GuzzleHttp\Psr7\Response(
            //     200,              // HTTP status code
            //     [],               // Headers
            //     $dummyJson        // Response body (raw JSON string)
            // );

            // // Wrap in Laravel's HTTP Client Response
            // $response = new \Illuminate\Http\Client\Response($psrResponse);
            // //! End testing: Dummy API response Data

            // *Actual API
            $response = Http::get("$apiUrl/user/get/image/advisory", [
                'key' => $apiKey,
                'farm_id' => $farm_id
            ]);

            $responseData = $response->json();

            // Handle error cases
            if (isset($responseData['error'])) {
                Log::warning("API error for farm $farm_id", $responseData);
                return response()->json($responseData, 400);
            }

            if (isset($responseData['message']) && $responseData['message'] === 'No data.') {
                Log::info("No data for farm $farm_id");
                return response()->json($responseData, 200);
            }

            if (!is_array($responseData) || empty($responseData)) {
                Log::error("Invalid response format for farm $farm_id", $responseData);
                return response()->json(['message' => 'Invalid API response'], 400);
            }



            $processedCount = 0;
            foreach ($responseData as $data) {
                try {
                    // $submission = AdvisorySubmission::where('farm_id', (string) $data['farm_id'])
                    //     ->where('img_id', (string) $data['img_id'])
                    //     ->first();

                    // $submission_id = $submission ? $submission->id : null;
                    AdvisoryResponse::updateOrCreate(
                        [
                            'farm_id' => $data['farm_id'],
                            'img_id' => $data['img_id']
                        ],
                        [
                            // 'submission_id'       => $submission_id, // Foreign key
                            'SKU' => $data['SKU'] ?? null,
                            'crop_name' => $data['crop_name'] ?? null,
                            'description' => $data['description'] ?? null,
                            'disease_name' => $data['disease_name'] ?? null,
                            'disease_solution' => $data['disease_solution'] ?? null,
                            'img_name' => $data['img_name'] ?? null,
                            'nutrient_deficiency' => $data['nutrient_deficiency'] ?? null,
                            'nutrient_management' => $data['nutrient_management'] ?? null,
                            'pest_name' => $data['pest_name'] ?? null,
                            'pest_solution' => $data['pest_solution'] ?? null,
                            'status' => $data['status'] ?? 'failed',
                            'responded_at' => now(),
                        ]
                    );

                    // $submission->update(['status' => 'completed']);

                    $processedCount++;
                } catch (\Exception $e) {
                    Log::error("Failed to process record for farm $farm_id", [
                        'error' => $e->getMessage(),
                        'data' => $data
                    ]);
                }
            }

            return response()->json([
                'message' => "Processed $processedCount records",
                'count' => $processedCount
            ], 201);
        } catch (\Exception $e) {
            Log::error("API request failed for farm $farm_id: " . $e->getMessage());
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function unlock_farm(Request $request)
    {
        $farm_id = $request->farm_id;
        $lockstatus = $request->lockstatus;

        if (empty($farm_id) || empty($lockstatus)) {
            return response()->json([
                'status' => false,
                'message' => 'Farm ID or lock status is missing'
            ], 400);
        }

        $key = env('UNLOCK_SATYUKT_API_KEY');
        $apiUrl = config('services.satyukt_api.url');

        try {
            $response = Http::retry(3, 100)->get("$apiUrl/unlock_farmid_app", [
                'farm_id' => $farm_id,
                'lockstatus' => $lockstatus,
                'key' => $key
            ]);

            // Decode JSON response into an associative array
            $responseData = json_decode($response->body(), true);

            // Log API response for debugging
            Log::info('Unlock farm API Response: ', $responseData);

            // Validate API response format
            if (!is_array($responseData) || !isset($responseData['status'])) {
                Log::info('Invalid API response format.');

                Mail::raw(
                    "Unlock Farm API Request Failed\n\n" .
                        "Farm ID: {$farm_id}\n" .
                        "Lock Status: {$lockstatus}\n" .
                        "Time: " . now(),
                    function ($message) {
                        $message->to(env('ADMIN_EMAIL'))
                            ->subject('⚠ Unlock API Failure');
                    }
                );

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid API response format',
                    'data' => $responseData
                ], 400);
            }

            // Handle special case: API returns failure status with message 'farm already unlock'
            if ($responseData['status'] === 'Failure') {
                if (
                    isset($responseData['mesage']) &&
                    strtolower($responseData['mesage']) === 'farm already unlock'
                ) {
                    Log::info("Farm is already unlocked. Treating as successful.");
                    // Proceed as if it was unlocked successfully.
                } else {
                    // Log and send alert for genuine failure
                    Log::info('API reported failure during unlocking.');

                    Mail::raw(
                        "Unlock Farm API Request Failed\n\n" .
                            "Farm ID: {$farm_id}\n" .
                            "Lock Status: {$lockstatus}\n" .
                            "Time: " . now(),
                        function ($message) {
                            $message->to(env('ADMIN_EMAIL'))
                                ->subject('⚠ Unlock API Failure');
                        }
                    );

                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid API response format',
                        'data' => $responseData
                    ], 400);
                }
            }

            // If reached here, treat it as a successful unlock
            FarmModel::where('farm_id', $farm_id)
                ->update(['status' => 'Paid']);

            return response()->json([
                'status' => true,
                'message' => 'Farm lock status updated successfully',
                'data' => $responseData
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error making API request: ' . $e->getMessage());

            // Send a detailed email alert to the admin
            Mail::raw(
                "Unlock Farm API Request Failed\nFarm ID: {$farm_id}\nLock Status: {$lockstatus}\nError: {$e->getMessage()}\nTime: " . now(),
                function ($message) {
                    $message->to(env('ADMIN_EMAIL'))
                        ->subject('⚠ Unlock Farm API Failed');
                }
            );

            return response()->json([
                'status' => false,
                'message' => 'An error occurred while making the API request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function unlock_farm(Request $request)
    // {
    //     $farm_id = $request->farm_id;
    //     $lockstatus = $request->lockstatus;

    //     if (empty($farm_id) || empty($lockstatus)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Farm ID or lock status is missing'
    //         ], 400);
    //     }

    //     $key = config('services.satyukt_api.key');
    //     $apiUrl = config('services.satyukt_api.url');

    //     try {
    //         $response = Http::retry(3, 100)->get("$apiUrl/unlock_farmid_app", [
    //             'farm_id' => $farm_id,
    //             'lockstatus' => $lockstatus,
    //             'key' => $key
    //         ]);

    //         // Ensure the response is always an array
    //         $responseData = json_decode($response->body(), true);

    //         // Log API response for debugging
    //         Log::info('Unlock farm fn API Response: ', $responseData);

    //         // Validate API response format
    //         if (!is_array($responseData) || !isset($responseData['status'])) {
    //             Log::info('Invalid API response format.');

    //             // Send an email alert for invalid response
    //             Mail::raw(
    //                 "Unlock Farm API Request Failed\n\n" .
    //                     "Farm ID: {$farm_id}\n" .
    //                     "Lock Status: {$lockstatus}\n" .
    //                     "Time: " . now(),
    //                 function ($message) {
    //                     $message->to(env('ADMIN_EMAIL'))
    //                         ->subject('⚠ Unlock API Failure');
    //                 }
    //             );


    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Invalid API response format',
    //                 'data' => $responseData
    //             ], 400);
    //         }

    //         FarmModel::where('farm_id', $farm_id)
    //             ->update(['status' => 'Paid']);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Farm lock status updated successfully',
    //             'data' => $responseData
    //         ], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Error making API request: ' . $e->getMessage());

    //         // Send a detailed email to the admin
    //         Mail::raw("Unlock Farm API Request Failed\nFarm ID: {$farm_id}\nLock Status: {$lockstatus}\nError: {$e->getMessage()}\nTime: " . now(), function ($message) {
    //             $message->to(env('ADMIN_EMAIL'))->subject('⚠ Unlock Farm API Failed');
    //         });

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'An error occurred while making the API request',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // ==========================pest-and-disease==================================
    public function pest_and_disease(Request $request, $language = 'en')
    {
        Log::info('Pest/Disease API Request', [
            'farm_id' => $request->farm_id,
            'language' => $language,
            'time' => now()->toDateTimeString()
        ]);
        try {
            $params = [
                'key' => config('services.satyukt_api.key'), // Use config instead of request input
                'farm_id' => $request->farm_id,
                'language' => $language
            ];

            $url = config('services.satyukt_api.url') . '/cropadvisory/info';

            // Log::info('Pest/Disease API Request');

            // /* ------------------------------------------------------------------------------------------------------------------------------------------------
            // !                                                     START testing: Dummy API response Data
            //  ------------------------------------------------------------------------------------------------------------------------------------------------ */
            // // Load raw JSON data from file
            // $dummyJson = file_get_contents(base_path('development/dummy_data.json'));

            // // Create a PSR-7 response (Guzzle)
            // $psrResponse = new \GuzzleHttp\Psr7\Response(
            //     200,              // HTTP status code
            //     [],               // Headers
            //     $dummyJson        // Response body (raw JSON string)
            // );

            // // Wrap in Laravel's HTTP Client Response
            // $response = new \Illuminate\Http\Client\Response($psrResponse);
            // /* ------------------------------------------------------------------------------------------------------------------------------------------------
            // !                                                     END testing: Dummy API response Data
            // ------------------------------------------------------------------------------------------------------------------------------------------------ */

            // *Actual API
            $response = Http::get($url, $params);


            if (!$response->successful()) {
                Log::error('API Request Failed', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                $apiStatus = 'failed';
                $errorMessage = $response->body();
                MonitoringStatusService::MonitoringlogStatus($request->farm_id, 'pest_and_disease', $apiStatus, $errorMessage);

                return response()->json(['message' => 'API request failed'], 502);
            }

            $responseData = $response->json();

            // Handle different response formats
            if (!isset($responseData[0])) {
                $responseData = [$responseData];
            }

            $check_Datasave = false;
            foreach ($responseData as $data) {
                // Validate required fields
                if (empty($data['Crop_name']) || empty($data['Date'])) {
                    Log::warning('Invalid data record', $data);

                    $apiStatus = 'failed';
                    $errorMessage = $data['exception'];
                    MonitoringStatusService::MonitoringlogStatus($request->farm_id, 'pest_and_disease', $apiStatus, $errorMessage);
                    continue;
                }

                // Process image URLs
                $diseaseImgUrls = $this->processImageUrls($data['Disease_img_url'] ?? $data['disease_images'] ?? '');
                $pestImgUrls = $this->processImageUrls($data['Pest_img_url'] ?? $data['pest_images'] ?? '');

                // Parse the date range from the API response
                $dateRange = $data['Date']; // Example: "06-Aug-2024 to 10-Aug-2024"
                [$startDate, $endDate] = explode(' to ', $dateRange);

                // Convert the dates to the correct format
                $startDate = Carbon::createFromFormat('d-M-Y', trim($startDate))->format('Y-m-d');
                $endDate = Carbon::createFromFormat('d-M-Y', trim($endDate))->format('Y-m-d');

                // Log::info('Storing Disease Data for farm: ' . $request->farm_id);

                // Update or create the record
                $result = PestAndDiseasesModel::updateOrCreate(
                    [
                        'farm_id' => $params['farm_id'],
                        'crop_name' => $data['Crop_name'],
                        'disease' => $data['Disease'] ?? null,
                        'language' => $params['language'],
                        'pest' => $data['Pest'] ?? null,
                    ],
                    [
                        'date' => $data['Date'],
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'affected_part' => $data['Affected_Part'] ?? null,
                        'disease' => $data['Disease'] ?? null,
                        'disease_img_urls' => json_encode($data['Disease_img_url'] ?? []),
                        'pest' => $data['Pest'] ?? null,
                        'pest_img_urls' => json_encode($data['Pest_img_url'] ?? []),
                        'mode_of_spread' => $data['Mode_of_Spread'] ?? null,
                        'pathogen' => $data['Pathogen'] ?? null,
                        'solution' => $data['Solution'] ?? null,
                        'stage_of_infection' => $data['Stage_of_Infection'] ?? null,
                        'symptoms' => $data['Symptoms'] ?? null,
                    ]
                );
                if ($result) {
                    $check_Datasave = true; // At least one record is saved successfully
                    Log::info(" result: " . $result);
                }
            }
            Log::info("Pest/Disease data saved for farm: " . $request->farm_id);

            if ($check_Datasave) {
                $apiStatus = 'success';
                $errorMessage = null;
                MonitoringStatusService::MonitoringlogStatus($request->farm_id, 'pest_and_disease', $apiStatus, $errorMessage);
                Log::info("Pest/Disease data saved and status updated for farm: " . $request->farm_id);
            } else {
                Log::warning("No valid data saved, skipping status update.");
            }

            // ✅ Debug log
            Log::info('Check status: ' . ($check_Datasave ? 'true' : 'false'));

            return response()->json([
                'message' => 'Data synced successfully',
                'count' => count($responseData)
            ], 200);
        } catch (\Exception $e) {
            Log::error('Pest/Disease API Error: ' . $e->getMessage());

            $apiStatus = 'failed';
            if (strpos($e->getMessage(), 'SQLSTATE') !== false) {
                $errorMessage = 'Database Internal server error.';
            } else {
                $errorMessage = $e->getMessage();
            }
            MonitoringStatusService::MonitoringlogStatus($request->farm_id, 'pest_and_disease', $apiStatus, $errorMessage);

            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public static function syncLanguageSpecificData($farmId, $languageCode)
    // {
    //     try {
    //         $params = [
    //             'key' => config('services.satyukt_api.key'),
    //             'farm_id' => $farmId,
    //             'language' => $languageCode
    //         ];

    //         $url = config('services.satyukt_api.url') . '/cropadvisory/info';

    //         $response = Http::get($url, $params);

    //         if (!$response->successful()) {
    //             MonitoringStatusService::MonitoringlogStatus($farmId, 'pest_and_disease', 'failed', $response->body());
    //             return;
    //         }

    //         $responseData = $response->json();

    //         if (!isset($responseData[0])) {
    //             $responseData = [$responseData];
    //         }

    //         foreach ($responseData as $data) {
    //             if (empty($data['Crop_name']) || empty($data['Date'])) {
    //                 MonitoringStatusService::MonitoringlogStatus($farmId, 'pest_and_disease', 'failed', 'Missing fields');
    //                 continue;
    //             }

    //             [$startDate, $endDate] = explode(' to ', $data['Date']);
    //             $startDate = Carbon::createFromFormat('d-M-Y', trim($startDate))->format('Y-m-d');
    //             $endDate = Carbon::createFromFormat('d-M-Y', trim($endDate))->format('Y-m-d');

    //             PestAndDiseasesModel::updateOrCreate(
    //                 [
    //                     'farm_id' => $params['farm_id'],
    //                     'crop_name' => $data['Crop_name'],
    //                     'disease' => $data['Disease'] ?? null,
    //                     'pest' => $data['Pest'] ?? null,
    //                     'language' => $languageCode // 👈 Add language
    //                 ],
    //                 [
    //                     'date' => $data['Date'],
    //                     'start_date' => $startDate,
    //                     'end_date' => $endDate,
    //                     'affected_part' => $data['Affected_Part'] ?? null,
    //                     'disease_img_urls' => json_encode($data['Disease_img_url'] ?? []),
    //                     'pest_img_urls' => json_encode($data['Pest_img_url'] ?? []),
    //                     'mode_of_spread' => $data['Mode_of_Spread'] ?? null,
    //                     'pathogen' => $data['Pathogen'] ?? null,
    //                     'solution' => $data['Solution'] ?? null,
    //                     'stage_of_infection' => $data['Stage_of_Infection'] ?? null,
    //                     'symptoms' => $data['Symptoms'] ?? null,
    //                 ]
    //             );
    //         }

    //         MonitoringStatusService::MonitoringlogStatus($farmId, 'pest_and_disease', 'success', null);
    //     } catch (\Exception $e) {
    //         MonitoringStatusService::MonitoringlogStatus($farmId, 'pest_and_disease', 'failed', $e->getMessage());
    //     }
    // }


    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:en,hi,kn,mr,ta,te,bn,gu,as,ms,pa,or,sw,fr,pt,es,ar,tr',
        ]);

        $user = Auth::user(); // or use User::find($request->user_id) if auth not used

        $newLang = $request->language;

        // If the language is not already set
        if ($user->language !== $newLang) {
            $user->update(['language' => $newLang]);

            foreach ($user->farms->where('status', 'Paid') as $farm) {
                Log::info('Dispatching SyncPestDiseaseForFarm job', [$farm->farm_id]);
                // SyncPestDiseaseForFarm::dispatch($farm->farm_id, $newLang);
                SyncCropCalendarForFarm::dispatch($farm->farm_id, $newLang);
            }
        }

        return response()->json([
            'message' => 'Language updated successfully',
            'language' => $newLang
        ]);
    }

    private function processImageUrls($urlString)
    {
        if (empty($urlString))
            return [];

        // Handle both JSON arrays and comma-separated strings
        if (is_array($urlString)) {
            return $urlString;
        }

        return array_filter(array_map('trim', explode(',', $urlString)));
    }

    // ==========================Soil Report==================================
    public function soil_report(string $farm_id)
    {
        $key = config('services.satyukt_api.key');
        $baseUrl = config('services.satyukt_api.url');

        try {
                Log::info("Soil API Start Hiiii");

            // $response = Http::retry(3, 100)->get("$baseUrl/user/soilreport/pdf/$farm_id", [
            //     'key' => $key
            // ]);

            $start = microtime(true);
            $response = Http::timeout(60)->retry(3, 100)->get("$baseUrl/user/soilreport/pdf/$farm_id", [
                'key' => $key
            ]);
            $duration = microtime(true) - $start;

            Log::info("Soil API duration for farm $farm_id: " . round($duration, 2) . " seconds");


            // ✅ Log API response for debugging
            // Log::info("Soil report API response for farm $farm_id", [
            //     'status' => $response->status(),
            //     'response' => $response->json()
            // ]);


            if (!$response->successful()) {
                Log::error("Soil report API failed for farm $farm_id", [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                $apiStatus = 'failed';
                $errorMessage = $response->body();
                MonitoringStatusService::MonitoringlogStatus($farm_id, 'soilreport', $apiStatus, $errorMessage);

                return false;
            }

            $responseData = $response->json();

            // Handle empty response
            if (empty($responseData) || !is_array($responseData)) {
                $apiStatus = 'failed';
                $errorMessage = $responseData->body();
                MonitoringStatusService::MonitoringlogStatus($farm_id, 'soilreport', $apiStatus, $errorMessage);

                Log::info("No soil data available for farm $farm_id");
                return false;
            }

            // Define the directory (public folder)
            $directory = base_path('public/storage/soil_reports/');

            // Ensure the directory exists
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // Define the new file name
            $pdfFileName = 'soil_report_' . $farm_id . '_' . time() . '.pdf';
            $pdfFilePath = $directory . $pdfFileName;

            // Download and save the PDF
            $pdfUrl = $responseData['pdf'] ?? null;
            if ($pdfUrl) {
                try {
                    $pdfContent = Http::get($pdfUrl)->body(); // Fetch PDF
                    file_put_contents($pdfFilePath, $pdfContent); // Save PDF locally

                    // Store only the file name in the database
                    $processedData['pdf'] = $pdfFileName;
                } catch (\Exception $e) {
                    $apiStatus = 'failed';
                    if (strpos($e->getMessage(), 'SQLSTATE') !== false) {
                        $errorMessage = 'Database Internal server error.';
                    } else {
                        $errorMessage = $e->getMessage();
                    }
                    MonitoringStatusService::MonitoringlogStatus($farm_id, 'soilreport', $apiStatus, $errorMessage);

                    Log::error("Soil report PDF error for farm $farm_id: " . $e->getMessage());
                    return false;
                }
            }

            // Process nested data
            $processedData = [
                'farm_id' => $farm_id,
                'csv' => $this->processField($responseData['csv'] ?? null),
                'pdf' => $pdfFileName, // Save only the filename
                'recommendation' => $this->processField($responseData['recommendation'] ?? null),
                'remark' => $responseData['remark'] ?? null,
                'more_Info' => $this->processField($responseData['more_Info'] ?? null),
            ];

            // Process nested objects
            foreach (['png', 'statistics', 'xyz'] as $type) {
                foreach (['K', 'N', 'OC', 'P', 'pH'] as $param) {
                    $fieldName = "{$type}_$param";
                    $processedData[$fieldName] = $responseData[$type][$param] ?? null;
                }
            }

            // Save with conflict resolution
            SoilReportModel::create($processedData);

            Log::info("Soil report saved for farm $farm_id");

            $apiStatus = 'succes';
            $errorMessage = null;
            MonitoringStatusService::MonitoringlogStatus($farm_id, 'soilreport', $apiStatus, $errorMessage);

            return true;
        } catch (\Exception $e) {
            Log::error("Soil report error for farm $farm_id: " . $e->getMessage());
            return false;
        }
    }



    private function processField($value)
    {
        if (is_array($value)) {
            return json_encode($value);
        }
        return $value;
    }

    // ==========================Crop Calendar==================================
    public function crop_calendar(Request $request)
    {
        $key = $request->key;
        $farm_id = $request->farm_id;
        $sowing_date = $request->sowing_date;
        $crop = $request->crop;
        $lang = $request->lang;
        $url = "https://micro.satyukt.com/display/crop/calender/v2?key=$key&farm_id=$farm_id&sowing_date=$sowing_date&crop=$crop&lang=$lang";

        try {
            $response = Http::get($url);
            $responseData = $response->json();

            // Log API response for debugging
            Log::info('API Response: ', $responseData);

            if (!is_array($responseData)) {
                return response()->json([
                    'message' => 'Invalid API response format'
                ], 400);
            }

            foreach ($responseData as $data) {
                CropCalendarModel::updateOrCreate([
                    'farm_id' => $farm_id,
                    'crop' => $crop,
                    'range' => $data['Range'],
                    'recommended' => $data['Recommended'],
                    'status' => $data['status'],
                ]);
            }

            return response()->json([
                'message' => 'Data saved successfully',
                'data' => $responseData
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error making API request: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while making the API request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ==========================retrieve-images==================================
    // public function retrieve_images(Request $request)
    // {
    //     $farm_id = $request->farm_id;
    //     // return response()->json([
    //     //     'message' => $farm_id
    //     // ], 400);
    //     $url = "https://micro.satyukt.com/retrieve/image?farm_id=$farm_id";

    //     try {
    //         $response = Http::get($url);
    //         $responseData = $response->json();

    //         // Log API response for debugging
    //         Log::info('API Response: ', $responseData);

    //         if (!is_array($responseData)) {
    //             return response()->json([
    //                 'message' => 'Invalid API response format'
    //             ], 400);
    //         }

    //         foreach ($responseData as $data) {
    //             RetrieveImagesModel::updateOrCreate([
    //                 'farm_id' => $data['Farm_ID'] ?? null,
    //                 'comments' => $data['Comments'] ?? null,
    //                 'image_id' => !empty($data['Image_ID']) && is_numeric($data['Image_ID']) ? (int) $data['Image_ID'] : null, // Ensure it's an integer or set it to NULL
    //                 'image_name' => $data['Image_Name'] ?? null,
    //                 'image_url' => $data['Image_URL'] ?? null,
    //                 'flag' => $data['flag'] ?? null,
    //             ]);
    //         }


    //         return response()->json([
    //             'message' => 'Data saved successfully',
    //             'data' => $responseData
    //         ], 201);
    //     } catch (\Exception $e) {
    //         Log::error('Error making API request: ' . $e->getMessage());

    //         return response()->json([
    //             'message' => 'An error occurred while making the API request',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    // ==========================irrigation data==================================
    // public function irrigation_data(Request $request)
    // {
    //     $farm_id = $request->farmid;
    //     $key = $request->apikey;
    //     $url = "https://micro.satyukt.com/Irrigation/data?apikey=$key=&farmid=$farm_id";

    //     try {
    //         $response = Http::get($url);
    //         $responseData = $response->json();

    //         // Log API response for debugging
    //         Log::info('API Response: ', $responseData);

    //         if (!is_array($responseData)) {
    //             return response()->json([
    //                 'message' => 'Invalid API response format'
    //             ], 400);
    //         }

    //         // Ensure Irrigation_data exists to avoid errors
    //         if (isset($responseData['Irrigation_data'])) {
    //             IrrigationDataModel::updateOrCreate([
    //                 'irrigation_data' => $responseData['Irrigation_data'],
    //                 'status' => $responseData['status'],
    //             ]);

    //             return response()->json([
    //                 'message' => 'Data saved successfully',
    //                 'data' => $responseData
    //             ], 201);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Irrigation data is missing',
    //                 'data' => $responseData
    //             ], 422);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error making API request: ' . $e->getMessage());

    //         return response()->json([
    //             'message' => 'An error occurred while making the API request',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function fetchIrrigationData(Request $request)
    {
        // Validate farm ID
        $request->validate([
            'farmid' => 'required|numeric'
        ]);

        $farmId = $request->farmid;
        Log::info('Fetching irrigation data', ['farm_id' => $farmId]);
        try {
            $response = Http::get(config('services.satyukt_api.url') . '/Irrigation/data', [
                'apikey' => config('services.satyukt_api.key'),
                'farmid' => $farmId
            ]);

            if (!$response->successful()) {
                $apiStatus = 'failed';
                $errorMessage = $response->body();
                MonitoringStatusService::MonitoringlogStatus($farmId, 'irrigation', $apiStatus, $errorMessage);

                return response()->json([
                    'message' => 'Failed to fetch irrigation data',
                    'error' => $response->body()
                ], 502);
            }

            $responseData = $response->json();

            // Handle error response
            if (isset($responseData['error'])) {
                $apiStatus = 'failed';
                $errorMessage = 'No irrigation data available';
                MonitoringStatusService::MonitoringlogStatus($farmId, 'irrigation', $apiStatus, $errorMessage);


                return response()->json([
                    'message' => 'No irrigation data available',
                    'data' => $responseData
                ], 404);
            }

            // Validate successful response
            if (!isset($responseData['Irrigation_data'])) {
                $apiStatus = 'failed';
                $errorMessage = $responseData['exception'];
                MonitoringStatusService::MonitoringlogStatus($farmId, 'irrigation', $apiStatus, $errorMessage);

                return response()->json([
                    'message' => 'Invalid API response format'
                ], 400);
            }

            // Fetch actual irrigation data
            $irrigationResponse = Http::get($responseData['Irrigation_data']);

            if (!$irrigationResponse->successful()) {
                $apiStatus = 'failed';
                $errorMessage = 'Invalid API response format';
                MonitoringStatusService::MonitoringlogStatus($farmId, 'irrigation', $apiStatus, $errorMessage);

                return response()->json([
                    'message' => 'Failed to fetch irrigation details',
                    'error' => $irrigationResponse->body()
                ], 502);
            }

            $irrigationData = $irrigationResponse->json();

            // Process and store data
            $this->processIrrigationData($farmId, $irrigationData);

            $apiStatus = 'success';
            $errorMessage = null;
            MonitoringStatusService::MonitoringlogStatus($farmId, 'irrigation', $apiStatus, $errorMessage);

            return response()->json([
                'message' => 'Irrigation data stored successfully',
                'count' => count($irrigationData)
            ], 200);
        } catch (\Exception $e) {

            $apiStatus = 'failed';
            if (strpos($e->getMessage(), 'SQLSTATE') !== false) {
                $errorMessage = 'Database Internal server error.';
            } else {
                $errorMessage = $e->getMessage();
            }
            MonitoringStatusService::MonitoringlogStatus($farmId, 'irrigation', $apiStatus, $errorMessage);


            Log::error('Irrigation data fetch failed', [
                'farm_id' => $request->farmid,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function processIrrigationData($farmId, $data)
    {
        $now = now();

        foreach ($data as $date => $methods) {
            foreach ($methods as $type => $values) {
                IrrigationDataModel::updateOrCreate(
                    [
                        'farm_id' => $farmId,
                        'irrigation_date' => $date,
                        'type' => $type
                    ],
                    [
                        'gross_irrig' => $values['Gross_Irrig'],
                        'irrig_freq' => $values['Irrig_freq'],
                        'data_fetched_at' => $now
                    ]
                );
                Log::info("Irrigation data saved for $farmId on $date");
            }
        }
    }


    // ==========================weather data==================================
    public function weather_data(string $farm_id)
    {
        $key = config('services.satyukt_api.key');
        $baseUrl = config('services.satyukt_api.url');
        $url = "$baseUrl/weather/data/daypart?key=$key&farm_id=$farm_id";

        try {
            $response = Http::get($url);

            if (!$response->successful()) {
                Log::error('Weather API Error', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                $apiStatus = 'failed';
                $errorMessage = $response->body();
                MonitoringStatusService::MonitoringlogStatus($farm_id, 'weather', $apiStatus, $errorMessage);
                return false;
            }

            $responseData = $response->json();



            if (empty($responseData)) {
                Log::info('Empty weather response for farm', ['farm_id' => $farm_id]);
                return false;
            }

            // Add this validation
            if (!array_key_exists(0, $responseData)) {
                Log::error('Unexpected API response format', $responseData);
                $apiStatus = 'failed';
                $errorMessage = "Empty response or unexpected format.";
                MonitoringStatusService::MonitoringlogStatus($farm_id, 'weather', $apiStatus, $errorMessage);
                return false;
            }

            // Handle different response formats
            if (!isset($responseData[0])) {
                $responseData = [$responseData];
            }


            foreach ($responseData as $data) {
                try {
                    // Handle missing/non-standard keys
                    $validTimeUtc = $data['validTimeUtc'] ?? $data['valid_time_utc'] ?? null;
                    $windSpeed = $data['WindSpeed'] ?? $data['wind_speed'] ?? null;

                    // Skip invalid records
                    if (empty($validTimeUtc) || empty($windSpeed)) {
                        Log::warning('Invalid weather data record', $data);
                        continue;
                    }

                    WeatherModel::updateOrCreate(
                        [
                            'farm_id' => $farm_id,
                            'valid_time_utc' => $validTimeUtc,
                        ],
                        [
                            'wind_speed' => $windSpeed,
                            'cloud_cover' => $data['cloudCover'] ?? $data['cloud_cover'] ?? null,
                            'narrative' => $data['narrative'] ?? null,
                            'precip_chance' => $data['precipChance'] ?? $data['precip_chance'] ?? null,
                            'precip_type' => $data['precipType'] ?? $data['precip_type'] ?? null,
                            'qpf' => $data['qpf'] ?? null,
                            'relative_humidity' => $data['relativeHumidity'] ?? $data['relative_humidity'] ?? null,
                            'sunrise_time_local' => isset($data['sunriseTimeLocal'])
                                ? Carbon::parse($data['sunriseTimeLocal'])
                                : null,
                            'temperature' => $data['temperature'] ?? [],
                            'thunder_category' => $data['thunderCategory'] ?? $data['thunder_category'] ?? null,
                            'wind_direction' => $data['windDirection'] ?? $data['wind_direction'] ?? null,
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error('Failed to process weather record', [
                        'error' => $e->getMessage(),
                        'data' => $data
                    ]);
                }
            }

            $apiStatus = 'success';
            $errorMessage = null;
            MonitoringStatusService::MonitoringlogStatus($farm_id, 'weather', $apiStatus, $errorMessage);

            Log::info("Successfully updated weather data for farm $farm_id");
            return true;
        } catch (\Exception $e) {

            // Log monitoring status using the service
            Log::error("Weather data error for farm $farm_id: " . $e->getMessage());
            $apiStatus = 'failed';
            if (strpos($e->getMessage(), 'SQLSTATE') !== false) {
                $errorMessage = 'Database Internal server error.';
            } else {
                $errorMessage = $e->getMessage();
            }
            MonitoringStatusService::MonitoringlogStatus($farm_id, 'weather', $apiStatus, $errorMessage);

            return false;
        }
    }




    // ==========================Farm List==================================
    // public function farm_list(Request $request)
    // {
    //     $key = $request->key;

    //     $url = "https://micro.satyukt.com/farm/list?key=$key";

    //     try {
    //         $response = Http::get($url);
    //         $responseData = $response->json();

    //         // Log API response for debugging
    //         Log::info('API Response: ', $responseData);

    //         // Check if response has "Farm IDs" key and it's an array
    //         if (!isset($responseData['Farm IDs']) || !is_array($responseData['Farm IDs'])) {
    //             return response()->json([
    //                 'message' => 'Invalid API response format'
    //             ], 400);
    //         }

    //         // Insert farm IDs into the database
    //         foreach ($responseData['Farm IDs'] as $farmId) {
    //             FarmListModel::updateOrCreate(
    //                 ['farm_id' => $farmId] // Prevent duplicate entries
    //             );
    //         }

    //         return response()->json([
    //             'message' => 'Farm data saved successfully',
    //             'data' => $responseData['Farm IDs']
    //         ], 201);
    //     } catch (\Exception $e) {
    //         Log::error('Error making API request: ' . $e->getMessage());

    //         return response()->json([
    //             'message' => 'An error occurred while making the API request',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // ==========================Crop list==================================
    // public function crop_list(Request $request)
    // {
    //     $baseUrl = config('services.satyukt_api.url');
    //     $url = "$baseUrl/Crops"; // No key/farm_id needed

    //     try {
    //         $response = Http::get($url);
    //         $responseData = $response->json();

    //         if (!is_array($responseData) || empty($responseData)) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Invalid or empty API response'
    //             ], 400);
    //         }

    //         // Convert crop names into an array of associative arrays for bulk insert
    //         $cropData = array_map(fn($cropName) => ['crop_name' => $cropName], $responseData);

    //         // Perform bulk upsert
    //         CropListModel::upsert($cropData, ['crop_name']);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Crops data saved successfully',
    //             'data' => $responseData
    //         ], 201);
    //     } catch (\Exception $e) {
    //         Log::error('Crop List API Error: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Failed to fetch crops from API',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    // public function mandi_rates(Request $request)
    // {
    //     try {
    //         $query = MandiRate::query();

    //         if ($request->state) {
    //             $normalizedState = strtolower(str_replace(' ', '', trim($request->state))); // Remove spaces & normalize
    //             $query->whereRaw("REPLACE(LOWER(state), ' ', '') LIKE ?", ["%{$normalizedState}%"]);
    //         }

    //         if ($request->district) {
    //             $normalizedDistrict = strtolower(str_replace(' ', '', trim($request->district))); // Remove spaces & normalize
    //             $query->whereRaw("REPLACE(LOWER(district), ' ', '') LIKE ?", ["%{$normalizedDistrict}%"]);
    //         }

    //         if ($request->from_date && $request->to_date) {
    //             $query->whereBetween('arrival_date', [$request->from_date, $request->to_date]);
    //         }


    //         $mandiRates = $query->orderBy('arrival_date', 'desc')->get();
    //         // dd($normalizedState, $normalizedDistrict, $request->from_date, $request->to_date);

    //         return response()->json([
    //             'success' => true,
    //             'data' => $mandiRates
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error fetching data: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function mandi_rates(Request $request)
    {
        try {
            $query = MandiRate::query();

            // Existing filters
            if ($request->state) {
                $normalizedState = strtolower(str_replace(' ', '', trim($request->state)));
                $query->whereRaw("REPLACE(LOWER(state), ' ', '') LIKE ?", ["%{$normalizedState}%"]);
            }

            if ($request->district) {
                $normalizedDistrict = strtolower(str_replace(' ', '', trim($request->district)));
                $query->whereRaw("REPLACE(LOWER(district), ' ', '') LIKE ?", ["%{$normalizedDistrict}%"]);
            }

            if ($request->from_date && $request->to_date) {
                $query->whereBetween('arrival_date', [$request->from_date, $request->to_date]);
            }

            // Pagination
            $perPage = $request->per_page ?? 50; // Default 50 items per page
            $mandiRates = $query->orderBy('arrival_date', 'desc')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $mandiRates
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function get_state(Request $request)
    {
        try {
            $state = MandiRate::select('state')->distinct()->get();
            if (count($state) !== 0) {
                return response()->json([
                    'success' => true,
                    'data' => $state
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function get_city(Request $request)
    {
        try {
            $city = MandiRate::where('state', $request->city)->select('district as city')->distinct()->get();

            if (count($city) !== 0) {
                return response()->json([
                    'success' => true,
                    'data' => $city
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function payment_history(Request $request)
    {
        try {
            $user = Auth::user();

            // 🔹 If user not found, return a 404 response
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // 🔹 Get pagination parameters from the request
            $perPage = $request->input('per_page', 10);
            $transactions = $user->paymentTransactions()
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            // 🔹 If there are no transactions, return response immediately
            if ($transactions->total() == 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'No transaction history available',
                    'data' => [],
                    'pagination' => [
                        'current_page' => 1,
                        'per_page' => $perPage,
                        'total' => 0,
                        'total_pages' => 0,
                        'next_page_url' => null,
                        'prev_page_url' => null,
                    ]
                ], 200);
            }

            $responseData = [];

            // 🔹 Loop through each transaction to process payment details
            foreach ($transactions as $transaction) {
                $farms = []; // This will store farms linked to the transaction

                // ✅ Decode the JSON string if `items` is stored as a string in the database
                $items = is_string($transaction->items) ? json_decode($transaction->items, true) : $transaction->items;

                // 🔹 If `items` is empty or not an array, log the error and continue to next transaction
                if (empty($items) || !is_array($items)) {
                    Log::error('Transaction Items are Empty or Invalid', ['items' => $transaction->items]);
                    continue; // Skip processing this transaction
                }

                // 🔹 Iterate over each item in the transaction
                foreach ($items as $item) {
                    $farmId = $item['farm_id'] ?? null; // Get farm ID, default to null if not found
                    $itemName = $item['item_name'] ?? 'Unknown Item'; // Get item name
                    $price = (float) ($item['amount'] ?? 0.0); // Convert amount to float
                    $duration = 'Unknown Duration'; // Default duration

                    // 🔹 If no farm is linked, skip this item
                    if (!$farmId) {
                        continue;
                    }

                    // 🔹 Check if item belongs to a package and fetch duration if available
                    if ($item['item_type'] === 'App\\Models\\PackageMasterModel') {
                        $package = \App\Models\PackageMasterModel::find($item['item_id']);
                        if ($package) {
                            $durations = is_array($package->duration_labels) ? $package->duration_labels : json_decode($package->duration_labels, true);
                            $duration = is_array($durations) && count($durations) > 0 ? reset($durations) : 'Unknown Duration';
                        }
                    }

                    // 🔹 Check if item belongs to a service and fetch duration if available
                    if ($item['item_type'] === 'App\\Models\\ServiceMasterModel') {
                        $service = \App\Models\ServiceMasterModel::find($item['item_id']);
                        if ($service) {
                            $durations = is_array($service->duration_labels) ? $service->duration_labels : json_decode($service->duration_labels, true);
                            $duration = is_array($durations) && count($durations) > 0 ? reset($durations) : 'Unknown Duration';
                        }
                    }

                    // 🔹 Fetch farm details using `farm_id`
                    $farm = FarmModel::where('farm_id', $farmId)->first();
                    $farmName = $farm ? $farm->name : 'Unknown Farm'; // Assign farm name or default value

                    // 🔹 If farm is not already in the list, initialize it
                    if (!isset($farms[$farmId])) {
                        $farms[$farmId] = [
                            'farmId' => (int) $farmId, // Convert farm ID to integer
                            'farmName' => $farmName, // Assign farm name
                            'packages' => [] // Initialize package list for this farm
                        ];
                    }

                    // 🔹 Add item details under the respective farm
                    $farms[$farmId]['packages'][] = [
                        'itemName' => $itemName,
                        'duration' => $duration,
                        'price' => $price
                    ];
                }

                // 🔹 Add processed transaction details to response data
                $responseData[] = [
                    'transactionId' => $transaction->transaction_id ?? null, // Transaction ID
                    'date' => $transaction->created_at->format('d F Y'), // Formatted date
                    'status' => ucfirst($transaction->status), // Capitalize first letter of status
                    'total' => (float) $transaction->amount, // Convert total amount to float
                    'farms' => array_values($farms) // Convert farms array to indexed array
                ];
            }

            // 🔹 Return response with formatted transaction data and pagination details
            return response()->json([
                'status' => true,
                'data' => $responseData,
                'pagination' => [
                    'current_page' => $transactions->currentPage(),
                    'per_page' => $transactions->perPage(),
                    'total' => $transactions->total(),
                    'total_pages' => $transactions->lastPage(),
                    'next_page_url' => $transactions->nextPageUrl(),
                    'prev_page_url' => $transactions->previousPageUrl(),
                ]
            ]);
        } catch (\Exception $e) {
            // 🔹 Catch any unexpected errors and return an error response
            return response()->json([
                'status' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function payment_history(Request $request)
    // {
    //     try {
    //         $user_id = Auth::user();

    //         $user = User::where('id', $user_id->id)
    //             ->with([
    //                 'paymentTransactions' => function ($query) {
    //                     $query->orderBy('created_at', 'desc'); // Order transactions by most recent first
    //                 }
    //             ]) // Load transactions related to the user
    //             ->first();

    //         // 🔹 If user not found, return a 404 response
    //         if (!$user) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'User not found'
    //             ], 404);
    //         }

    //         // 🔹 Convert the transactions into a collection for easy handling
    //         $transactions = collect($user->paymentTransactions ?? []);

    //         // 🔹 If there are no transactions, return response immediately
    //         if ($transactions->isEmpty()) {
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'No transaction history available',
    //                 'data' => []
    //             ], 200);
    //         }

    //         $responseData = [];

    //         // 🔹 Loop through each transaction to process payment details
    //         foreach ($transactions as $transaction) {
    //             $farms = []; // This will store farms linked to the transaction

    //             // ✅ Decode the JSON string if `items` is stored as a string in the database
    //             $items = is_string($transaction->items) ? json_decode($transaction->items, true) : $transaction->items;

    //             // 🔹 If `items` is empty or not an array, log the error and continue to next transaction
    //             if (empty($items) || !is_array($items)) {
    //                 Log::error('Transaction Items are Empty or Invalid', ['items' => $transaction->items]);
    //                 continue; // Skip processing this transaction
    //             }

    //             // 🔹 Iterate over each item in the transaction
    //             foreach ($items as $item) {
    //                 $farmId = $item['farm_id'] ?? null; // Get farm ID, default to null if not found
    //                 $itemName = $item['item_name'] ?? 'Unknown Item'; // Get item name
    //                 $price = (float) ($item['amount'] ?? 0.0); // Convert amount to float
    //                 $duration = 'Unknown Duration'; // Default duration

    //                 // 🔹 If no farm is linked, skip this item
    //                 if (!$farmId) {
    //                     continue;
    //                 }

    //                 // 🔹 Check if item belongs to a package and fetch duration if available
    //                 if ($item['item_type'] === 'App\\Models\\PackageMasterModel') {
    //                     $package = \App\Models\PackageMasterModel::find($item['item_id']);
    //                     if ($package) {
    //                         $durations = is_array($package->duration_labels) ? $package->duration_labels : json_decode($package->duration_labels, true);
    //                         $duration = is_array($durations) && count($durations) > 0 ? reset($durations) : 'Unknown Duration';
    //                     }
    //                 }

    //                 // 🔹 Check if item belongs to a service and fetch duration if available
    //                 if ($item['item_type'] === 'App\\Models\\ServiceMasterModel') {
    //                     $service = \App\Models\ServiceMasterModel::find($item['item_id']);
    //                     if ($service) {
    //                         $durations = is_array($service->duration_labels) ? $service->duration_labels : json_decode($service->duration_labels, true);
    //                         $duration = is_array($durations) && count($durations) > 0 ? reset($durations) : 'Unknown Duration';
    //                     }
    //                 }

    //                 // 🔹 Fetch farm details using `farm_id`
    //                 $farm = FarmModel::where('farm_id', $farmId)->first();
    //                 $farmName = $farm ? $farm->name : 'Unknown Farm'; // Assign farm name or default value

    //                 // 🔹 If farm is not already in the list, initialize it
    //                 if (!isset($farms[$farmId])) {
    //                     $farms[$farmId] = [
    //                         'farmId' => (int) $farmId, // Convert farm ID to integer
    //                         'farmName' => $farmName, // Assign farm name
    //                         'packages' => [] // Initialize package list for this farm
    //                     ];
    //                 }

    //                 // 🔹 Add item details under the respective farm
    //                 $farms[$farmId]['packages'][] = [
    //                     'itemName' => $itemName,
    //                     'duration' => $duration,
    //                     'price' => $price
    //                 ];
    //             }

    //             // 🔹 Add processed transaction details to response data
    //             $responseData[] = [
    //                 'transactionId' => $transaction->transaction_id ?? null, // Transaction ID
    //                 'date' => $transaction->created_at->format('d F Y'), // Formatted date
    //                 'status' => ucfirst($transaction->status), // Capitalize first letter of status
    //                 'total' => (float) $transaction->amount, // Convert total amount to float
    //                 'farms' => array_values($farms) // Convert farms array to indexed array
    //             ];
    //         }

    //         // 🔹 Return response with all formatted transaction data
    //         return response()->json([
    //             'status' => true,
    //             'data' => $responseData
    //         ]);
    //     } catch (\Exception $e) {
    //         // 🔹 Catch any unexpected errors and return an error response
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Error fetching data: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
}
