<?php

namespace App\Http\Controllers;

use App\Models\CropCalendarModel;
use App\Models\ImageAdvisoryModel;
use App\Models\IrrigationDataModel;
use App\Models\MandiRate;
use App\Models\MonitoringStatusModel;
use App\Models\PestAndDiseasesModel;
use App\Models\RetrieveImagesModel;
use App\Models\SatelliteDataModel;
use App\Models\SoilReportModel;
use App\Models\SubscriptionModel;
use App\Models\WeatherModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Log;
use PhpParser\NodeVisitor\FirstFindingVisitor;
class FarmMonitoringController extends Controller
{
    public function index()
    {
        // $monitorings = SubscriptionModel::with(['farms', 'farms.user'])->get();

        $monitorings = SubscriptionModel::with(['farms', 'farms.user'])
            ->whereHas('farms', function ($query) {
                $query->whereNull('deleted_at'); // ✅ Apply condition inside the related model
            })
            ->orderByDesc('subscriptions.id')
            ->get();
        // dd($monitorings);
        return view('dashboard.monitoring.index', compact('monitorings'));
    }



    public function farm_monitoring_api_error_log(string $farm_id)
    {
        // dd($farm_id);

        // for mandi rates
        $mandirate = MandiRate::orderBy('updated_at', 'desc')
            ->first();

        $weather = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()
        // for Weather Forecasting 
        $weatherCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $weather = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()

        // dd($weather );

        // for Soil Nutrient Analysis 
        $SoilNutrientCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'soilreport')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $SoilNutrient = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'soilreport')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()
        // dd($SoilNutrient);

        // for Pests & Diseases Forewarning
        $PestsDiseasesCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'pest_and_disease')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $PestsDiseases = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'pest_and_disease')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()

        // for Crop Health Analysis 
        $CropHealthCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $CropHealth = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()

        // for Image-Based Diagnosis 
        $ImageDiagnosisCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'advisory')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $ImageDiagnosis = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'advisory')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()

        // for Soil Moisture Estimation
        $SoilMoistureCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $SoilMoisture = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'weather')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()

        // for Crop Calendar
        $CropCalendarCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'cropcalendar')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $CropCalendar = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'cropcalendar')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()

        // for Optimal Irrigation
        $OptimalIrrigationCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'irrigation')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()

        $OptimalIrrigation = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'irrigation')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()


        // for Optimal Irrigation
        $setallitesCount = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'satellite')
            ->where('monitoring_status.farm_id', $farm_id)
            ->count(); // ✅ Only count, no get()
        $setallites = MonitoringStatusModel::leftJoin('subscriptions', 'monitoring_status.farm_id', '=', 'subscriptions.farm_id')
            ->where('subscriptions.status', '!=', 'expired')
            ->where('monitoring_status.service_type', '=', 'satellite')
            ->where('monitoring_status.farm_id', $farm_id)
            ->select('monitoring_status.*')
            ->distinct()
            ->orderBy('monitoring_status.updated_at', 'desc')
            ->first(); // ✅ Remove count()


        // dd($weather);
        return view('dashboard.monitoring.farm_monitoring_api_error_log', compact(
            'mandirate',
            'weather',
            'weatherCount',
            'SoilNutrient',
            'SoilNutrientCount',
            'PestsDiseases',
            'PestsDiseasesCount',
            'CropHealth',
            'CropHealthCount',
            'ImageDiagnosis',
            'ImageDiagnosisCount',
            'SoilMoisture',
            'SoilMoistureCount',
            'CropCalendar',
            'CropCalendarCount',
            'OptimalIrrigation',
            'setallites',
            'setallitesCount',
            'OptimalIrrigationCount'
        ));
        ;
    }


}
