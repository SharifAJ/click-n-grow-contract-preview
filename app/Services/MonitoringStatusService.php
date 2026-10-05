<?php

namespace App\Services;

use App\Models\MonitoringStatusModel;
use Illuminate\Support\Facades\Log;

class MonitoringStatusService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public static function MonitoringlogStatus($farm_id, $service_type, $apiStatus, $errorMessage = null)
    {
        try {
            // ✅ Normalize API Status (ensure it's always lowercase)
            $apiStatus = strtolower($apiStatus);

            MonitoringStatusModel::updateOrCreate(
                [
                    'farm_id' => $farm_id,
                    'service_type' => $service_type,
                ],
                [
                    'api_status' => $apiStatus,
                    'error_message' => $errorMessage,
                    'updated_at' => now()
                ]
            );

            Log::info("✅ Monitoring status logged", [
                'farm_id' => $farm_id,
                'service_type' => $service_type,
                'api_status' => $apiStatus,
                'error_message' => $errorMessage,
            ]);
        } catch (\Exception $e) {
            Log::error("Failed to log monitoring status", [
                'error' => $e->getMessage(),
                'farm_id' => $farm_id,
                'service_type' => $service_type
            ]);
        }
    }
}
