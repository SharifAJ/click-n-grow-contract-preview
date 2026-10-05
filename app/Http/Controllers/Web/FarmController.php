<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AdvisoryResponse;
use App\Models\CropListModel;
use App\Models\MandiRate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FarmModel;
use App\Services\FarmService;
use App\Models\CropCalendarModel;
use App\Models\ImageAdvisoryModel;
use App\Models\IrrigationDataModel;
use App\Models\PestAndDiseasesModel;
use App\Models\RetrieveImagesModel;
use App\Models\SatelliteDataModel;
use App\Models\SoilReportModel;
use App\Models\WeatherModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


use Illuminate\Validation\ValidationException;

class FarmController extends Controller
{

    protected $farmService;

    public function __construct(FarmService $farmService)
    {
        $this->farmService = $farmService;
    }
    /**
     * Display a listing of the resource.`
     */
    public function index()
    {
        // $paid_farms = FarmModel::leftJoin('users', 'farms.user_id', '=', 'users.id')
        //     ->withTrashed()
        //     ->leftJoin('subscriptions', 'farms.farm_id', '=', 'subscriptions.farm_id')
        //     // ->where('farms.status', 'active')
        //     ->select('farms.*', 'subscriptions.subscription_code', 'farms.name as farm_name', 'farms.deleted_at as farm_deleted_at', 'farms.id as farmid', 'users.name as user_name', 'users.*')
        //     ->where('farms.status', 'paid')
        //     ->orderBy('farms.id', 'desc')
        //     ->get();
        $paid_farms = FarmModel::withTrashed()
            ->leftJoin('users', 'farms.user_id', '=', 'users.id')
            ->leftJoin('subscriptions', 'farms.farm_id', '=', 'subscriptions.farm_id')
            ->select('farms.*', 'subscriptions.subscription_code', 'farms.name as farm_name', 'farms.deleted_at as farm_deleted_at', 'farms.id as farmid', 'users.name as user_name', 'users.*')
            ->where('farms.status', 'paid')
            ->distinct('farms.id') // ✅ Only distinct farms
            ->orderBy('farms.id', 'desc')
            ->get();
        $unpaid_farms = FarmModel::withTrashed()
            ->leftJoin('users', 'farms.user_id', '=', 'users.id')
            ->leftJoin('subscriptions', 'farms.farm_id', '=', 'subscriptions.farm_id')
            ->select('farms.*',  'farms.name as farm_name', 'farms.deleted_at as farm_deleted_at', 'farms.id as farmid', 'users.name as user_name', 'users.*')
            ->where('farms.status', 'unpaid')
            ->distinct('farms.id') // ✅ Only distinct farms
            ->orderBy('farms.id', 'desc')
            ->get();

        // $unpaid_farms = FarmModel::leftJoin('users', 'farms.user_id', '=', 'users.id')
        //     ->leftJoin('subscriptions', 'farms.farm_id', '=', 'subscriptions.farm_id')
        //     ->withTrashed()
        //     // ->where('farms.status', 'active')
        //     ->select('farms.*', 'subscriptions.subscription_code', 'farms.name as farm_name', 'farms.deleted_at as farm_deleted_at', 'farms.id as farmid', 'users.name as user_name', 'users.*')
        //     ->where('farms.status', 'unpaid')
        //     ->distinct('farms.id')
        //     ->orderBy('farms.id', 'desc')
        //     ->get();
        
        $farmers = User::withCount([
            'farms', // Total farms count
            'farms as farms_with_subscriptions_count' => function ($query) {
                $query->whereHas('subscriptions'); // Count only farms that have subscriptions
            }
        ])
            ->withSum('farms', 'area') // Automatically sums `area` from `farms`
            ->orderByDesc('id')
            ->get();
        // dd($farmers);

        $monitoring_log = User::all();

        $data = [
            'paid_farms' => $paid_farms,
            'unpaid_farms' => $unpaid_farms,
            'farmers' => $farmers,
        ];
        // dd($farmers);
        return view('dashboard.farm.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $crop_data = CropListModel::get();
        $farmer_data = User::where('user_status', 'active')->get();
        // dd($crop_data[0]);
        $data = [
            'crop_data' => $crop_data,
            'farmer_data' => $farmer_data,
        ];
        return view('dashboard.farm.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Assuming the admin is creating the farm on behalf of a farmer
        $user_id = $request->input('user_id'); // Pass the farmer's user ID from the dashboard form
        // dd($user_id);
        $result = $this->farmService->storeFarm($request->all(), $user_id);
        // dd($result);

        if ($result['status']) {
            // dd('success : ');
            return redirect()->route('farm.index')->with('success', 'Farm created successfully');
        } else {
            // dd('error : ');
            // return redirect()->route('farm.index')->with('error', 'Failed to create farm');
            return redirect()->back()->withErrors($result['errors'])->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $farm_data = FarmModel::leftJoin('users', 'farms.user_id', '=', 'users.id')
            ->withTrashed()
            ->leftJoin('subscriptions', 'farms.farm_id', '=', 'subscriptions.farm_id')

            // ->where('farms.status', 'active')
            ->select('farms.*', 'farms.name as farm_name', 'farms.deleted_at as farm_deleted_at' ,'subscriptions.subscription_code', 'farms.status as farm_status', 'farms.id as farmid', 'users.name as user_name', 'users.*')
            ->where('farms.id', $id)
            ->first();

        $data = [
            'farm_data' => $farm_data,
        ];
        // dd($data);
        return view('dashboard.farm.view', $data);
    }
    public function farm_monitoring_api_error_log(string $id)
    {
        // dd($id);
        $farm_data = FarmModel::leftJoin('users', 'farms.user_id', '=', 'users.id')
            ->leftJoin('subscriptions', 'farms.farm_id', '=', 'subscriptions.farm_id')

            // ->where('farms.status', 'active')
            ->select('farms.*', 'farms.name as farm_name', 'subscriptions.subscription_code', 'farms.status as farm_status', 'farms.id as farmid', 'users.name as user_name', 'users.*')
            ->where('farms.id', $id)
            ->first();

        $data = [
            'farm_data' => $farm_data,
        ];
        // dd($data);
        return view('dashboard.farm.farm_monitoring_api_error_log', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $farm_data = FarmModel::where('id', $id)->first();
        $crop_data = CropListModel::get();
        $farmer_data = User::where('user_status', 'active')->get();
        // dd($crop_data[0]);

        // dd($farm_data);
        $data = [
            'farm_data' => $farm_data,
            'crop_data' => $crop_data,
            'farmer_data' => $farmer_data,
        ];
        return view('dashboard.farm.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmModel $farm)
    {
        // dd($request, $farm);
        $result = $this->farmService->updateFarm($request->all(), $farm);

        if ($result['status']) {
            return redirect()->route('farm.index')->with('success', 'Farm updated successfully!');
        } else {
            return back()->withErrors($result['errors'] ?? [])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Check if user exists
            $user = FarmModel::find($id);
            if (!$user) {
                return redirect()->route('addfarm.index')->with('error', 'Farm not found');
            }

            // Perform soft delete
            $user->delete();
            return redirect()->route('addfarm.index')->with('success', 'Farm deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('addfarm.index')->with('error', 'Farm deleted UnSuccessfully.');
        }
    }
    public function farm_restore(string $id)
    {
        try {
            // Check if user exists
            $user = FarmModel::withTrashed()->find($id);
            if (!$user) {
                return redirect()->route('addfarm.index')->with('error', 'Farm not found');
            }

            // Perform soft delete
            $user->restore();
            return redirect()->route('addfarm.index')->with('success', 'Farm restore successfully.');
        } catch (\Exception $e) {
            return redirect()->route('addfarm.index')->with('error', 'Farm restore UnSuccessfully.');
        }
    }



    public function farm_data(string $id)
    {
        $farm_id = $id;
        $farmer_data = FarmModel::join('users', 'farms.user_id', '=', 'users.id')
            ->select(
                'users.name as user_name',
                'farms.name as farm_name',
                'farms.farm_id',
                'farms.geo_json',
                'farms.center'
            )
            ->where('farms.id', $farm_id)
            ->get();
        // dd($farm_id);

        return response()->json($farmer_data);
    }


    public function farm_status(Request $request)
    {
        $farm_id = $request->farm_id;
        $status = $request->status;

        // Fetch the user data
        $user_data = FarmModel::where('id', $farm_id)->first();

        // Check if user data exists
        if (!$user_data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Farmer data not found.',
            ]);
        }

        // Update the user status
        FarmModel::where('id', $farm_id)->update(['status' => $status]);

        // Set message based on status
        $message = ($status === 'active') ? 'Farmer activated successfully.' : 'Farmer deactivated successfully.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }







    public function farm_monitoring($farm_id, $crop_name)
    {
        // dd("Farmid=", $farm_id);
        $today = Carbon::today();
        $endDate = Carbon::today()->addDays(14);
        // dd("date=", $today);

        // Get farm data by farm_id
        $farm = FarmModel::with('user')->where('farms.farm_id', $farm_id)->first();

        // dd($farm); 
        // Ensure farm exists before accessing its properties
        $farm_state = $farm ? $farm->state : null;
        $farm_dis = $farm ? $farm->district : null;

        // Ensure state is not null before fetching districts
        $all_districtes = $farm_state
            ? DB::table('cities_and_states')->where('state', $farm_state)->get()
            : collect(); // Empty collection if no state is found
        // dd($all_districtes);
        // Ensure 'center' is properly decoded
        $farmCenter = is_string($farm->center) ? json_decode($farm->center, true) : $farm->center;
        if (!is_array($farmCenter) || count($farmCenter) != 2) {
            $farmCenter = [21.1322, 81.7807]; // Default fallback location
        }

        // Ensure geo_json is properly decoded
        $geoJson = is_string($farm->geo_json) ? json_decode($farm->geo_json, true) : $farm->geo_json;

        // Extract coordinates
        $coordinates = [];
        if (isset($geoJson['geometry']['coordinates'][0])) {
            foreach ($geoJson['geometry']['coordinates'][0] as $coord) {
                if (is_array($coord) && count($coord) == 2) {
                    // Convert [lng, lat] to [lat, lng] for Leaflet.js
                    $coordinates[] = [$coord[1], $coord[0]];
                }
            }
        }

        // =============== get state list ==================

        $states = DB::table('cities_and_states')
            ->select('state')
            ->distinct()
            ->get();


        // Fetch 14 days of weather data with 2-day intervals
        // $all_weather_data = WeatherModel::where('farm_id', '97905')
        $latest_weather_data = WeatherModel::where('farm_id', $farm_id)
            ->whereBetween('sunrise_time_local', [$today, $endDate])
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($latest_weather_data) {
            $latest_updated_at = $latest_weather_data->updated_at; // Updated_at value
        } else {
            $latest_updated_at = null;
        }



        $all_weather_data = WeatherModel::where('farm_id', $farm_id)
            ->whereBetween('sunrise_time_local', [$today, $endDate])
            ->orderBy('sunrise_time_local', 'asc')
            ->get();

        // dd($all_weather_data);
        // Filter every 2nd day
        $wheather_data = $all_weather_data->filter(function ($value, $key) {
            return $key % 2 == 0;
        })->values();

        // Prepare Data for ChartJS
        $chartData = $wheather_data->map(function ($day) {
            $temperature = json_decode(trim($day->temperature, '"'), true);
            return [
                'date' => \Carbon\Carbon::parse($day->sunrise_time_local)->format('d M'),
                'maxTemp' => isset($temperature[0]) ? round($temperature[0]) : null,
                'minTemp' => isset($temperature[1]) ? round($temperature[1]) : null,
            ];
        });

        // Prepare Data for Rainfall Chart
        $rainfallChartData = $wheather_data->map(function ($day) {
            return [
                'date' => \Carbon\Carbon::parse($day->sunrise_time_local)->format('d M'),
                'rainfall' => (float) $day->qpf // QPF is the rainfall in mm
            ];
        });

        // Convert to JSON for JavaScript
        $rainfallChartDataJson = json_encode($rainfallChartData);

        // Convert to JSON for JavaScript
        $chartDataJson = json_encode($chartData);

        // Fetching all other necessary data
        // $today_wheather_data = WeatherModel::where('farm_id', '97905')
        $today_wheather_data = WeatherModel::where('farm_id', $farm_id)
            ->whereDate('sunrise_time_local', $today)
            ->first();


        // Fetch the first satellite data record
        $satellite_date = SatelliteDataModel::where('farm_id', $farm_id)
            ->get('date');

        // Get the latest date available in the database
        $latestDate = SatelliteDataModel::where('farm_id', $farm_id)->max('date'); // Latest available date

        // Get the satellite data for the latest date
        $satelliteData = SatelliteDataModel::where('farm_id', $farm_id)
            ->where('date', $latestDate)
            ->first();

        $formattedDate = $satelliteData ? Carbon::parse($satelliteData->date)->format('Ymd') : null;

        // ================== Function to Find the Most Recent Existing File ==================
        function getLatestExistingFile($farm_id, $latestDate, $formattedDate, $prefix)
        {
            $crop_sm_date_as_at = null; // Variable to store the found date

            // First, check for today's file
            if ($formattedDate) {
                $filename = "{$prefix}_{$farm_id}_{$formattedDate}.png";
                $path = "storage/satellite_data/png/{$filename}";

                if (file_exists(public_path($path))) {
                    $crop_sm_date_as_at = Carbon::parse($latestDate)->format('d-M-Y'); // Store found date
                    return ['path' => $path, 'date' => $crop_sm_date_as_at]; // ✅ Return file path & date
                }
            }

            // If today's file is not available, check for older data
            while (true) {

                if (!$latestDate) {
                    return ['path' => null, 'date' => null]; // Agar latestDate null ho, loop exit karein
                }

                $previousDate = SatelliteDataModel::where('farm_id', $farm_id)
                    ->where('date', '<', $latestDate)
                    ->orderBy('date', 'desc')
                    ->value('date');

                if (!$previousDate) {
                    return ['path' => null, 'date' => null]; // ❌ No older file found, return null
                }

                $formattedDate = Carbon::parse($previousDate)->format('Ymd');
                $filename = "{$prefix}_{$farm_id}_{$formattedDate}.png";
                $path = "storage/satellite_data/png/{$filename}";

                if (file_exists(public_path($path))) {
                    $crop_sm_date_as_at = Carbon::parse($previousDate)->format('d-M-Y'); // Store found date
                    return ['path' => $path, 'date' => $crop_sm_date_as_at]; // ✅ Return file path & date
                }

                // Update `latestDate` so that the query fetches the next older date
                $latestDate = $previousDate;
            }
        }

        // =================== Get Soil Moisture Image ===================
        $soil_result = getLatestExistingFile($farm_id, $latestDate, $formattedDate, 'sm');
        $soil_image = $soil_result['path'];
        $soil_date_as_at = $soil_result['date'];

        // =================== Get Crop Health Image ===================
        $crop_result = getLatestExistingFile($farm_id, $latestDate, $formattedDate, 'ndvi');
        $crop_image = $crop_result['path'];
        $crop_date_as_at = $crop_result['date'];

        // dd($soil_date_as_at, $crop_date_as_at);

        // dd($sm_path, $path);
        // dd($soil_image, $crop_image);

        $monthsAgo = Carbon::now()->subMonths(6)->timestamp;

        $satellite_json = SatelliteDataModel::where('farm_id', $farm_id)
            ->where('date', '>=', $monthsAgo) // Get last 6 months data
            ->get();


        $smChartData = []; // Soil Moisture Data
        $ndviChartData = []; // Crop Health Data

        foreach ($satellite_json as $json_data) {
            $filePaths = is_string($json_data->file_paths) ? json_decode($json_data->file_paths, true) : $json_data->file_paths;

            if (!is_array($filePaths)) {
                continue;
            }

            $date = Carbon::createFromTimestamp($json_data->date)->toDateString();

            // ==================== Soil Moisture JSON ====================
            $soil_mean = null;

            if (!empty($filePaths['zonal_stats']['sm'])) {
                // ✅ Ensure correct path for public storage
                $sm_json_path = public_path('storage/satellite_data/stats/' . basename($filePaths['zonal_stats']['sm']));


                if (file_exists($sm_json_path)) {
                    $soil_json = json_decode(file_get_contents($sm_json_path), true);
                    if (isset($soil_json[0]['mean'])) {
                        $soil_mean = round((float) $soil_json[0]['mean'], 3); // ✅ Round to 3 decimal places
                    }
                }
            }


            // ==================== Crop NDVI JSON ====================
            $crop_mean = null;
            if (!empty($filePaths['zonal_stats']['ndvi'])) {
                $ndvi_json_path = public_path('storage/satellite_data/stats/' . basename($filePaths['zonal_stats']['ndvi']));

                if (file_exists($ndvi_json_path)) {
                    $crop_json = json_decode(file_get_contents($ndvi_json_path), true);
                    if (isset($crop_json[0]['mean'])) {
                        $crop_mean = round((float) $crop_json[0]['mean'], 3); // ✅ Round to 3 decimal places
                    }
                }
            }


            // Store data for Soil Moisture Chart
            $smChartData[] = [
                'date' => $date,
                'value' => $soil_mean ?? 0, // Ensure default value
            ];

            // Store data for NDVI Crop Health Chart
            $ndviChartData[] = [
                'date' => $date,
                'value' => $crop_mean ?? 0, // Ensure default value
            ];
        }

        // dd($smChartData, $ndviChartData);

        // Sort data by date
        usort($smChartData, fn($a, $b) => strcmp($a['date'], $b['date']));
        usort($ndviChartData, fn($a, $b) => strcmp($a['date'], $b['date']));

        // Convert to JSON for JavaScript
        $smChartDataJson = json_encode($smChartData);
        $ndviChartDataJson = json_encode($ndviChartData);

        // dd($smChartDataJson, $ndviChartDataJson);



        // $image_ad_data = ImageAdvisoryModel::where('farm_id', '97905')
        $image_ad_data = AdvisoryResponse::with('submission')->where('farm_id', $farm_id)
            // ->where('crop_name', 'Pomegranate')->first();
            // ->where('crop_name', $crop_name)
            ->get();
        // dd($image_ad_data );


        // $deas_data = PestAndDiseasesModel::where('farm_id', '97905')->
        $deas_data = PestAndDiseasesModel::where('farm_id', $farm_id)
            ->where('pest', null)
            ->get();
        // $pest_data = PestAndDiseasesModel::where('farm_id', '97905')->
        $pest_data = PestAndDiseasesModel::where('farm_id', $farm_id)
            ->where('disease', null)
            ->get();

        // dd($deas_data, $pest_data);




        // Fetch the latest soil report, prioritizing today's data
        $soil_data = SoilReportModel::where('farm_id', $farm_id)
            ->whereDate('created_at', $today)
            ->orderByDesc('created_at') // Ensure latest entry for today
            ->first(['pdf', 'created_at']);

        if (!$soil_data) {
            // If no report found for today, get the latest available report
            $soil_data = SoilReportModel::where('farm_id', $farm_id)
                ->orderByDesc('created_at') // Get the most recent report overall
                ->first(['pdf', 'created_at']);
        }

        // Initialize variable
        $soil_repo_data = null;

        if ($soil_data) {
            $pdfPath = 'storage/soil_reports/' . $soil_data->pdf;

            // ✅ Check if the file exists in the public folder
            if (file_exists(public_path($pdfPath))) {
                $soil_repo_data = asset($pdfPath); // ✅ Full URL
            } else {
                // If file does not exist, find another existing file
                $availableReport = SoilReportModel::where('farm_id', $farm_id)
                    ->whereNotNull('pdf') // Only consider records with a PDF
                    ->orderByDesc('created_at') // Get the most recent report first
                    ->get(['pdf', 'created_at']);

                foreach ($availableReport as $report) {
                    $alternativePath = 'storage/soil_reports/' . $report->pdf;
                    if (file_exists(public_path($alternativePath))) {
                        $soil_repo_data = asset($alternativePath);
                        break; // ✅ Stop at the first available existing file
                    }
                }
            }
        }


        // dd($pdfPath);


        $crop_cale_data = CropCalendarModel::all();
        // $irrigations = IrrigationDataModel::where('farm_id', $farm_id)
        // ->get();

        // ✅ Fetch irrigation data for the given farm for today
        $irrigations = IrrigationDataModel::where('farm_id', $farm_id)
            ->whereDate('data_fetched_at', $today) // Only fetch records where the date matches today
            ->latest('data_fetched_at') // Order by the latest fetched date first
            ->get();

        // ✅ If no irrigation data is available for today, fetch the most recent past data
        if ($irrigations->isEmpty()) {
            $previousDate = $today;

            // Keep reducing the date until data is found
            do {
                $previousDate = \Carbon\Carbon::parse($previousDate)->subDay()->toDateString();

                $irrigations = IrrigationDataModel::where('farm_id', $farm_id)
                    ->whereDate('data_fetched_at', $previousDate) // Fetch data for the previous day
                    ->latest('data_fetched_at')
                    ->get();
            } while ($irrigations->isEmpty() && IrrigationDataModel::where('farm_id', $farm_id)->exists());
        }

        // ✅ Now, $irrigations contains either today's data or the most recent past data

        // dd($irrigations);

        $calenders = CropCalendarModel::where('farm_id', $farm_id)
            ->orderByRaw("CAST(SUBSTRING_INDEX(`range`, '-', 1) AS UNSIGNED)")
            ->get();


        // dd($calenders);

        $retr_data = RetrieveImagesModel::all();

        return view('dashboard.farm.farm_monitoring', [

            'irrigations' => $irrigations,


            'farm' => $farm,
            'farm_state' => $farm_state,
            'farm_dis' => $farm_dis,
            'all_districtes' => $all_districtes,

            'farmCenter' => $farmCenter,
            'coordinates' => $coordinates,



            'states' => $states,

            'latest_updated_at' => $latest_updated_at,

            'soil_date_as_at' => $soil_date_as_at,
            'crop_date_as_at' => $crop_date_as_at,
            'soilMoistureImg' => $soil_image,
            'cropHealthImg' => $crop_image,
            'smChartData' => $smChartDataJson,
            'ndviChartData' => $ndviChartDataJson,




            'calenders' => $calenders,


            'today_wheather_data' => $today_wheather_data,
            'all_weather_data' => $all_weather_data,


            'image_ad_data' => $image_ad_data,
            'deas_data' => $deas_data,
            'pest_data' => $pest_data,


            'soil_repo_data' => $soil_repo_data,

            'crop_cale_data' => $crop_cale_data,


            'retr_data' => $retr_data,
            'rainfallChartDataJson' => $rainfallChartDataJson,
            'chartDataJson' => $chartDataJson // 👈 Chart js extra JSON
        ]);
    }



    public function irrigation_data(Request $request)
    {
        $farmId = (int) $request->farm_id;

        if (empty($farmId)) {
            return response()->json([
                'message' => 'Validation Error',
                'error' => 'Farm ID is required.'
            ], 400);
        }

        $apiKey = "9iQmP5MpxekitLp7O04PmTjLEHIo5pJW7rMEAC6EIzM=";

        if (empty($apiKey)) {
            return response()->json([
                'message' => 'Configuration Error',
                'error' => 'API key is missing. Please check the .env file.'
            ], 500);
        }

        $url = "https://micro.satyukt.com/Irrigation/data?apikey=$apiKey&farmid=$farmId";

        try {
            // 1st API Call - Get Response URL
            $response = Http::get($url);

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'API Error',
                    'error' => "Failed to fetch irrigation data. Status Code: " . $response->status()
                ], $response->status());
            }

            $responseData = $response->json();
            Log::info('Satyukt API Response:', $responseData);

            // ✅ Fix: Check for 'Irrigation_data' key instead of 'url'
            if (!isset($responseData['Irrigation_data']) || empty($responseData['Irrigation_data'])) {
                return response()->json([
                    'message' => 'Data Error',
                    'error' => 'Irrigation data URL is missing in the API response.'
                ], 500);
            }

            // 2nd API Call - Fetch Irrigation Data
            $dataUrl = $responseData['Irrigation_data']; // ✅ Correct key
            $irrigationResponse = Http::get($dataUrl);

            if (!$irrigationResponse->successful()) {
                return response()->json([
                    'message' => 'API Error',
                    'error' => "Failed to fetch irrigation details. Status Code: " . $irrigationResponse->status()
                ], $irrigationResponse->status());
            }

            $irrigationData = $irrigationResponse->json();
            Log::info('Irrigation Data:', $irrigationData);

            return response()->json([
                'message' => 'Success',
                'data' => $irrigationData,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching irrigation data: ' . $e->getMessage());

            return response()->json([
                'message' => 'Server Error',
                'error' => 'An unexpected error occurred while processing the request.',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function get_city_list(Request $request)
    {
        $state_id = $request->state_id;
        $where = [
            'state' => $state_id
        ];
        $data = DB::table('cities_and_states')->where($where)->get();
        // $data = City::where($where)->get();
        return json_encode($data);
    }



    public function fetchMandiRates(Request $request)
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

            // $perPage = $request->per_page ?? 50; // Default 50 items per page
            // $mandiRates = $query->orderBy('arrival_date', 'desc')
            //     ->paginate($perPage);
            $mandiRates = $query->orderBy('arrival_date', 'desc')->get();
            // dd($mandiRates);
            // dd($normalizedState, $request->from_date, $request->to_date);

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
}
