<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FarmModel;
use App\Models\SatelliteDataModel;
use App\Services\SatelliteDataService;
use App\Jobs\LogApiRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

// class SatelliteDataController extends Controller
// {
//     // protected $satelliteDataService;
//     // public function __construct(SatelliteDataService $satelliteDataService)
//     // {
//     //     $this->satelliteDataService = $satelliteDataService;
//     // }

//     /* 
//     This code is also written in FetchSatelliteData Job file, both serves different purposes
//     * Use the Controller:
//         - When you need to respond to a user request immediately. 
//         - When you want to manually trigger data fetching.
//         - e.g. A farmer visits the dashboard and clicks "Refresh Satellite Data.

//     * Use the Job:
//         - When you want to automate data fetching (e.g., daily at midnight).
//         - When the task is time-consuming and should run in the background.
//    */
//     public function getSatelliteData(FarmModel $farm)
//     {
//         try {
//             // Fetch and store data
//             (new SatelliteDataService)->fetchAndStoreData($farm);
//             // $this->satelliteDataService->fetchAndStoreData($farm); //if constructor is used to initialize Service

//             // Always return existing data even if API failed
//             $data = SatelliteDataModel::where('farm_id', $farm->farm_id)
//                 ->orderBy('date', 'desc')
//                 ->get();

//             return response()->json([
//                 'status' => true,
//                 'data' => $data
//             ]);
//         } catch (\Exception $e) {
//             // Fallback to stale data
//             $data = SatelliteDataModel::where('farm_id', $farm->farm_id)->get();

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Using cached data',
//                 'data' => $data
//             ], 200);
//         }
//     }
// }
