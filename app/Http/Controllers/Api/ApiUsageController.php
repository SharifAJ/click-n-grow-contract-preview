<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiUsageLog;
use App\Models\RequestLogModel;
use Illuminate\Support\Facades\DB;

class ApiUsageController extends Controller
{
    public function log_index()
    {
        $usage = ApiUsageLog::selectRaw('
            DATE(created_at) as date,
            endpoint,
            COUNT(*) as total
            ')
            ->groupBy('date', 'endpoint')
            ->orderBy('date', 'desc')
            ->get();
    
        // Get total API hits per day
        $dailyUsage = ApiUsageLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->get();
    

        $summary_data = RequestLogModel::leftJoin('users', 'request_logs.user_id', '=', 'users.id')
            ->select(
                'users.name as users_name',
                'request_logs.*',
                'request_logs.created_at as request_logs_created_at'
            )
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.all_log', compact('usage', 'summary_data', 'dailyUsage'));
    }
}
