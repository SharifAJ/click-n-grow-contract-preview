<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CropCalendarModel;
use App\Models\CropListModel;
use App\Models\PackageServiceModel;
use Illuminate\Http\Request;
use App\Models\FarmModel;
use App\Models\IrrigationDataModel;
use App\Models\Notification;
use App\Models\PackageMasterModel;
use App\Models\PestAndDiseasesModel;
use App\Models\SatelliteDataModel;
use App\Models\ServiceMasterModel;
use App\Models\SoilReportModel;
use App\Models\WeatherModel;
use App\Services\ApiHelperService;
use App\Services\FarmService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class FarmController extends Controller
{
    protected $apiLogger;
    protected $farmService;

    public function __construct(ApiHelperService $apiLogger, FarmService $farmService)
    {
        $this->apiLogger = $apiLogger;
        $this->farmService = $farmService;
    }

    public function index()
    {
        $user_id = Auth::user()->id;

        // Define feature mapping (Database Service Name => Feature Key)
        $serviceMap = [
            'Weather Forecasting' => 'weather_forcasting',
            'Soil Nutrient Analysis' => 'soil_nutrient',
            'Pests & Diseases Forewarning' => 'pest_disease',
            'Crop Health Analysis' => 'crop_health',
            'Image-Based Diagnosis' => 'image_based_diagnosis',
            'Soil Moisture Estimation' => 'soil_moisture_estimation',
            'Crop Calendar' => 'crop_calendar',
            'Optimal Irrigation' => 'optimal_irrigation',
        ];

        // Fetch farms for the authenticated user
        $farms = FarmModel::with('subscriptions')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($farm) use ($serviceMap) {
                // Default feature flags (all false)
                $features = array_fill_keys(array_values($serviceMap), false);
                $hasActiveSubscription = false; // Track active subscriptions

                // Process subscriptions specific to this farm
                foreach ($farm->subscriptions as $subscription) {
                    if ($subscription->status !== 'active') {
                        continue; // Skip inactive subscriptions
                    }

                    $hasActiveSubscription = true; // At least one active subscription exists
                    $service_names = [];

                    if ($subscription->subscribable_type === 'App\Models\PackageMasterModel') {
                        // Get all service IDs linked to this package
                        $service_ids = PackageServiceModel::where('package_id', $subscription->subscribable_id)
                            ->pluck('service_id');

                        // Get service names for the retrieved service IDs
                        $service_names = ServiceMasterModel::whereIn('id', $service_ids)
                            ->pluck('name')
                            ->toArray();
                    } else {
                        // Get service name directly for a premium service
                        $service_name = ServiceMasterModel::where('id', $subscription->subscribable_id)
                            ->value('name');

                        if ($service_name) {
                            $service_names[] = $service_name;
                        }
                    }

                    // Enable features based on the retrieved service names
                    foreach ($service_names as $serviceName) {
                        $serviceName = trim($serviceName); // Remove extra spaces
                        if ($serviceName && isset($serviceMap[$serviceName])) {
                            $features[$serviceMap[$serviceName]] = true;
                        }
                    }
                }

                // 🔹 If no active subscription, reset all features to false
                if (!$hasActiveSubscription) {
                    $features = array_fill_keys(array_values($serviceMap), false);
                }

                // Merge feature flags into the current farm data
                return array_merge($farm->toArray(), ['features' => $features], ['subscriptions' => '']);
            });


        return response()->json([
            'status' => true,
            'message' => 'Farms fetched successfully',
            'data' => $farms
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FarmModel $farm)
    {
        return response()->json([
            'status' => true,
            'message' => 'Farm details retrieved successfully',
            'data' => $farm
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user_id = Auth::user()->id;

        $result = $this->farmService->storeFarm($request->all(), $user_id);

        // 8. Immediate Response with Log Info
        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'],
            'data' => $result['data'] ?? null,
            'errors' => $result['errors'] ?? null
        ], $result['statusCode']);
    }

    /*
    ? Get all logs for a farm
    $farm->requestLogs()->orderBy('created_at', 'desc')->get();

    ? Find farms with failed API calls
    Farm::whereHas('requestLogs', function($q) {
        $q->where('is_successful', false);
    })->get();

    */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmModel $farm)
    {
        $result = $this->farmService->updateFarm($request->all(), $farm);
        // Log::info("FarmController@update: result: ");
        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'],
            'data' => $result['data'] ?? null,
            'errors' => $result['errors'] ?? null
        ], $result['statusCode']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmModel $farm)
    {
        $result = $this->farmService->destroyFarm($farm);

        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'],
            'data' => $result['data'] ?? null,
            'errors' => $result['errors'] ?? null
        ], $result['statusCode']);
    }

    /**
     * Store a new farm image
     */
    // public function storeOrUpdateFarmImage(Request $request, FarmModel $farm)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Validation Error',
    //             'errors' => $validator->errors()
    //         ], 400);
    //     }
    //     $imageName = $farm->farm_id . '.' . $request->image->extension();
    //     $directory = storage_path('app/public/farm_images');

    //     if (!is_dir($directory)) {
    //         mkdir($directory, 0755, true);
    //     }

    //     // Check if the file already exists and delete it
    //     $existingImagePath = $directory . '/' . $imageName;
    //     if (file_exists($existingImagePath)) {
    //         unlink($existingImagePath);
    //     }

    //     // Move the new image to the directory
    //     $request->image->move($directory, $imageName);

    //     // Save the image name in the database
    //     $farm->update(['image' => $imageName]);

    //     return response()->json([
    //         'status' => true,
    //         'message' => $farm->fresh()->image
    //     ], 200);
    // }
    public function storeOrUpdateFarmImage(Request $request, FarmModel $farm)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required', // Allow both base64 & file uploads
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 400);
        }

        $directory = storage_path('app/public/farm_images');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $imageData = null;
        $imageExtension = 'jpg'; // Default extension

        // Check if input is base64
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image, $matches)) {
            $imageExtension = $matches[1]; // Extract extension
            $imageData = base64_decode(substr($request->image, strpos($request->image, ',') + 1));
        } else {
            // Handle normal file upload
            $imageFile = $request->file('image');
            if (!$imageFile->isValid()) {
                return response()->json(['status' => false, 'message' => 'Invalid Image Upload'], 400);
            }
            $imageExtension = $imageFile->extension();
            $imageData = file_get_contents($imageFile->path());
        }

        // ✅ Generate a unique filename (to avoid caching issues)
        $uniqueName = $farm->farm_id . '_' . time() . '.' . $imageExtension;
        $imagePath = $directory . '/' . $uniqueName;

        // ✅ Delete the previous image if it exists
        if ($farm->image) {
            $oldImagePath = $directory . '/' . $farm->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // ✅ Save the new image
        file_put_contents($imagePath, $imageData);

        // ✅ Update database with new filename
        $farm->update(['image' => $uniqueName]);

        return response()->json([
            'status' => true,
            'message' =>  $farm->fresh()->image
        ], 200);
    }


    /* ----------------------------------------------- Farm related APIs end here, below are other APIs ----------------------------------------------- */
    /**
     * Show Satellite Data for a farm
     */
    public function showSatellite(FarmModel $farm)
    {
        $satelliteData = SatelliteDataModel::with('farm')
            ->where('farm_id', $farm->farm_id)
            ->get()
            ->map(function ($data) {
                // Convert file_paths to an array
                $filePaths = json_decode(json_encode($data->file_paths), true);

                if (isset($filePaths['png']['sm'])) {
                    $filePaths['png']['sm'] = asset('storage/satellite_data/png/' . $filePaths['png']['sm']);
                }

                if (isset($filePaths['zonal_stats']['sm'])) {
                    $filePaths['zonal_stats']['sm'] = asset('storage/satellite_data/stats/' . $filePaths['zonal_stats']['sm']);
                }
                
                 if (isset($filePaths['png']['ndvi'])) {
                    $filePaths['png']['ndvi'] = asset('storage/satellite_data/png/' . $filePaths['png']['ndvi']);
                }

                if (isset($filePaths['zonal_stats']['ndvi'])) {
                    $filePaths['zonal_stats']['ndvi'] = asset('storage/satellite_data/stats/' . $filePaths['zonal_stats']['ndvi']);
                }

                // Assign the modified array back to the model attribute
                $data->file_paths = $filePaths;

                return $data;
            });

        return response()->json([
            'status' => $satelliteData->isNotEmpty(),
            'message' => $satelliteData->isNotEmpty()
                ? 'Satellite Data retrieved successfully for farm_id ' . $farm->farm_id . ' and name ' . $farm->name
                : 'No data available',
            'data' => $satelliteData->isNotEmpty() ? $satelliteData : null
        ], 200);
    }


    /**
     * Show Pest and Disease for a farm
     */
    public function showPestAndDisease(FarmModel $farm)
    {
        $pest_and_disease = PestAndDiseasesModel::with('farm')->where('farm_id', $farm->farm_id)->get();

        if ($pest_and_disease->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Pest and Disease Data retrieved successfully',
                'data' => $pest_and_disease
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data available',
                'data' => null
            ], 200);
        }
    }

    /**
     * Show all Service Master data 
     */
    public function showServiceMaster()
    {
        $serviceList = ServiceMasterModel::where('status', 'active')->get();

        if ($serviceList->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Service List retrieved successfully',
                'data' => $serviceList
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data available',
                'data' => null
            ], 200);
        }
    }

    /**
     * Show all Package Master data 
     */
    public function showPackageMaster()
    {
        $packageList = PackageMasterModel::where('status', 'active')->get();

        if ($packageList->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Package List retrieved successfully',
                'data' => $packageList
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data available',
                'data' => null
            ], 200);
        }
    }

    /**
     * Show all Package and Service Master data 
     */
    public function showPackageServiceMaster()
    {
        $serviceList = ServiceMasterModel::where('status', 'active')
            ->whereIn('id', [4, 7])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'amount' => (int) $item->amount,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'type' => 'service',
                    'duration' => $item->duration ?? [], // ✅ Always an array (handled by model cast)
                    'duration_labels' => $item->duration_labels // ✅ Always an array from model
                ];
            });

        $packageList = PackageMasterModel::where('status', 'active')
            ->whereIn('id', [2, 3, 4])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'amount' => (int) $item->amount,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'type' => 'package',
                    'duration' => $item->duration ?? [], // ✅ Always an array (handled by model cast)
                    'duration_labels' => $item->duration_labels // ✅ Always an array from model
                ];
            });

        $mergedData = $packageList->concat($serviceList);

        return response()->json([
            'status' => $mergedData->isNotEmpty(),
            'message' => $mergedData->isNotEmpty() ? 'Package and Service List retrieved successfully' : 'No data available',
            'data' => $mergedData
        ], 200);
    }

    /**
     * Show Crop Calendar for a farm
     */
    public function showCropCalendar(FarmModel $farm)
    {
        $cropCalendarData = CropCalendarModel::with('farm')->where('farm_id', $farm->farm_id)->get();

        if ($cropCalendarData->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Crop Calendar Data retrieved successfully',
                'data' => $cropCalendarData
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data is available',
                'data' => null
            ], 200);
        }
    }

    /**
     * Show All Crop List
     */
    // public function showCropList()
    // {
    //     $cropList = CropListModel::select('crop_name')->get(); //json

    //     if ($cropList->isNotEmpty()) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Internal Crop List retrieved successfully',
    //             'data' => $cropList
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'No data available',
    //             'data' => null
    //         ], 200);
    //     }
    // }
    public function showCropList()
    {
        $cropList = CropListModel::select('crop_name')->get(); // Fetch JSON data

        if ($cropList->isNotEmpty()) {
            // Modify crop names by replacing "_" with " "
            $cropList = $cropList->map(function ($crop) {
                $crop->crop_name = str_replace('_', ' ', $crop->crop_name);
                return $crop;
            });

            return response()->json([
                'status' => true,
                'message' => 'Internal Crop List retrieved successfully',
                'data' => $cropList
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data available',
                'data' => null
            ], 200);
        }
    }



    /**
     * Show all Weather Data
     */
    public function showWeather(FarmModel $farm)
    {
        // $weatherData = WeatherModel::with('farm')
        //     ->where('farm_id', $farm->farm_id)
        //     ->whereDate('updated_at', now()->toDateString())
        //     ->get();
        $weatherData = WeatherModel::with('farm')
            ->where('farm_id', $farm->farm_id)
            ->whereDate('sunrise_time_local', '>=', now()->toDateString())
            ->orderBy('sunrise_time_local', 'asc')
            ->get();


        if ($weatherData->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Weather Data retrieved successfully',
                'data' => $weatherData
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data available',
                'data' => null
            ], 200);
        }
    }

    /**
     * Show Soil Report Data for a farm
     */
    public function showSoilReport(FarmModel $farm)
    {
        // $soilReportData = SoilReportModel::with('farm')->where('farm_id', $farm->farm_id)
        //     ->orderBy('created_at', 'desc')
        //     ->get()
        //     ->map(function ($report) {
        //         // Generate full PDF URL if it exists
        //         $report->pdf = $report->pdf
        //             ? asset('storage/soil_reports/' . $report->pdf)
        //             : null;

        //         return $report;
        //     });
            
            
            $soilReportData = SoilReportModel::with('farm')
    ->where('farm_id', $farm->farm_id)
    ->orderBy('created_at', 'desc')
    ->get()
    ->map(function ($report) {
        // Set full PDF URL if exists
        if ($report->pdf && file_exists(storage_path('app/public/soil_reports/' . $report->pdf))) {
            $report->pdf = asset('storage/soil_reports/' . $report->pdf);
        } else {
            // Find the previous valid PDF
            $previous = SoilReportModel::where('farm_id', $report->farm_id)
                ->where('created_at', '<', $report->created_at)
                ->orderBy('created_at', 'desc')
                ->get()
                ->first(function ($prev) {
                    return $prev->pdf && file_exists(storage_path('app/public/soil_reports/' . $prev->pdf));
                });

            $report->pdf = $previous
                ? asset('storage/soil_reports/' . $previous->pdf)
                : null;
        }

        return $report;
    });

            

        if ($soilReportData->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Soil Report Data retrieved successfully',
                'data' => $soilReportData
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Soil Report Data available',
                'data' => null
            ], 200);
        }
    }

    public function showIrrigationData(FarmModel $farm)
    {
        $today = Carbon::today();

        // Try fetching today's data
        $irrigationData = IrrigationDataModel::with('farm')
            ->where('farm_id', $farm->farm_id)
            ->whereDate('data_fetched_at', $today)
            ->get();

        // If today's data is empty, fallback to the latest available data
        if ($irrigationData->isEmpty()) {
            $latestDate = IrrigationDataModel::where('farm_id', $farm->farm_id)
                ->max('data_fetched_at');

            if ($latestDate) {
                $irrigationData = IrrigationDataModel::with('farm')
                    ->where('farm_id', $farm->farm_id)
                    ->whereDate('data_fetched_at', Carbon::parse($latestDate)->toDateString())
                    ->get();
            }
        }

        if ($irrigationData->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Irrigation Data retrieved successfully',
                'data' => $irrigationData
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Irrigation Data available',
                'data' => null
            ], 200);
        }
    }


    /**
     * Show Notification for a user
     */
    // public function showNotification()
    // {
    //     $user_id = Auth::user()->id;

    //     $notifications = Notification::
    //         // with('farm')-> // Uncomment if you want to include farm details
    //         where('user_id', $user_id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return response()->json([
    //         'status' => $notifications->isNotEmpty(),
    //         'message' => $notifications->isNotEmpty()
    //             ? 'Notifications fetched successfully'
    //             : 'No notifications available',
    //         'data' => $notifications
    //     ], 200);
    // }

    public function showNotification()
    {
        $user_id = Auth::id();

        $notifications = Notification::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->where('read_at', null)
            ->get();

        $formattedNotifications = $notifications->map(function ($notification) {
            $farm_name = FarmModel::where('farm_id', $notification->farm_id)->pluck('name')->first();

            $titles = [
                'soil_health' => 'Soil Report is ready',
                'image_advisory' => 'New Image Advisory Report',
            ];

            $messages = [
                'soil_health' => "Your soil report PDF for farm '{$farm_name}' ({$notification->farm_id}) is ready. Please open the Kisansat app to download it.",
                'image_advisory' => "Your image advisory report for farm '{$farm_name}' ({$notification->farm_id}) is available. Check the Kisansat app for details.",
            ];


            return [
                'id' => $notification->id,
                'farm_id' => $notification->farm_id,
                'farm_name' => $farm_name,
                'title' => $titles[$notification->type] ?? 'New Notification',
                'message' => $messages[$notification->type] ?? 'You have a new notification.',
                'date' => $notification->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'status' => $formattedNotifications->isNotEmpty(),
            'message' => $formattedNotifications->isNotEmpty()
                ? 'Notifications fetched successfully'
                : 'No notifications available',
            'data' => $formattedNotifications
        ], 200);
    }



    public function clearNotifications(Request $request, $id = null)
    {
        $user = Auth::user();

        if ($id) {
            // If an ID is provided in the route, clear a specific notification
            $notification = Notification::where('user_id', $user->id)
                ->where('id', $id)
                ->where('read_at', null)
                ->first();

            if (!$notification) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Notification not found'
                ], 404);
            }

            $notification->update(['read_at' => now()]);
            return response()->json([
                'status'  => true,
                'message' => 'Notification cleared successfully',
                'data'    => [
                    'id'   => $notification->id,
                    'type' => $notification->type
                ]
            ], 200);
        } else {
            // If no ID is provided, clear all notifications
            $data = Notification::where('user_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return response()->json([
                'status'  => true,
                'message' => 'All notifications cleared successfully',
                'data' => $data
            ], 200);
        }
    }
}
