<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\RequestLogModel;
use App\Models\SubscriptionModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FarmModel;
use App\Models\RequestLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        // For farmsers cards
        $total_farmer = User::count();
        $active_farmer = User::where('user_status', 'active')->count();
        $inactive_farmer = User::where('user_status', 'inactive')->count();

        // For farm cards
        $total_farms = FarmModel::withTrashed()->count();
        $paid_farms = FarmModel::withTrashed()
            ->where('status', 'paid')
            ->count();
        $unpaid_farms = FarmModel::withTrashed()
            ->where('status', 'unpaid')
            ->count();


        // For service & package cards
        $total_service = SubscriptionModel::where('subscribable_type', 'App\Models\ServiceMasterModel')->count();
        $premium_service_1 = SubscriptionModel::where('subscribable_type', 'App\Models\ServiceMasterModel')
            ->where('subscribable_id', 4)
            ->count();
        // dd($premium_service_1);
        $premium_service_2 = SubscriptionModel::where('subscribable_type', 'App\Models\ServiceMasterModel')
            ->where('subscribable_id', 7)
            ->count();
        $total_package = SubscriptionModel::where('subscribable_type', 'App\Models\PackageMasterModel')->count();
        $gold_service = SubscriptionModel::where('subscribable_type', 'App\Models\PackageMasterModel')
            ->where('subscribable_id', 4)
            ->count();
        $silver_service = SubscriptionModel::where('subscribable_type', 'App\Models\PackageMasterModel')
            ->where('subscribable_id', 3)
            ->count();
        $basic_service = SubscriptionModel::where('subscribable_type', 'App\Models\PackageMasterModel')
            ->where('subscribable_id', 2)
            ->count();
        // $farms_area  = FarmModel::where('status', 'active')->sum('area');

        // For farm area cards
        // $farms_area = FarmModel::selectRaw('SUM(CAST(area AS DECIMAL(10,6))) as total_area')
        //     ->value('total_area');
        // $paid_area_farms = FarmModel::where('status', 'paid')->selectRaw('SUM(CAST(area AS DECIMAL(10,6))) as total_area')->value('total_area');
        // $unpaid_area_farms = FarmModel::where('status', 'unpaid')->selectRaw('SUM(CAST(area AS DECIMAL(10,6))) as total_area')->value('total_area');

        // ✅ Total area (unique farm_id + area)
        $farms_area = DB::table(DB::raw('(SELECT DISTINCT farm_id, area FROM farms) as unique_farms'))
            ->selectRaw('SUM(CAST(area AS DECIMAL(10,6))) as total_area')
            ->value('total_area');

        // ✅ Total paid area (unique farm_id + area where status = paid)
        $paid_area_farms = DB::table(DB::raw('(SELECT DISTINCT farm_id, area FROM farms WHERE status = "paid") as unique_paid_farms'))
            ->selectRaw('SUM(CAST(area AS DECIMAL(10,6))) as total_area')
            ->value('total_area');

        // ✅ Total unpaid area (unique farm_id + area where status = unpaid)
        $unpaid_area_farms = DB::table(DB::raw('(SELECT DISTINCT farm_id, area FROM farms WHERE status = "unpaid") as unique_unpaid_farms'))
            ->selectRaw('SUM(CAST(area AS DECIMAL(10,6))) as total_area')
            ->value('total_area');

        // For farm cards
        $total_rec_amt = PaymentTransaction::sum('amount');
        $moblie_rec_amt = PaymentTransaction::where('gateway_name', 'razorpay')->sum('amount');
        $admin_rec_amt = PaymentTransaction::where('gateway_name', 'admin')->sum('amount');
        // dd($active_farmer,  $inactive_farmer);


        $data = [
            'total_farmer' => $total_farmer,
            'active_farmer' => $active_farmer,
            'inactive_farmer' => $inactive_farmer,

            'total_farms' => $total_farms,
            'paid_farms' => $paid_farms,
            'unpaid_farms' => $unpaid_farms,

            'farms_area' => $farms_area,
            'paid_area_farms' => $paid_area_farms,
            'unpaid_area_farms' => $unpaid_area_farms,

            'total_service' => $total_service,
            'premium_service_1' => $premium_service_1,
            'premium_service_2' => $premium_service_2,
            'total_package' => $total_package,
            'gold_service' => $gold_service,
            'silver_service' => $silver_service,
            'basic_service' => $basic_service,

            'total_rec_amt' => $total_rec_amt,
            'moblie_rec_amt' => $moblie_rec_amt,
            'admin_rec_amt' => $admin_rec_amt,

            // 'summary_data' => $summary_data,
        ];
        return view('dashboard.dashboard', $data);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
