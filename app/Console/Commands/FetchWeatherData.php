<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\APIController;
use App\Models\FarmModel; // Assuming you have a Farm model
use Illuminate\Support\Facades\Log;

class FetchWeatherData extends Command
{
    protected $signature = 'weather:fetch';
    protected $description = 'Fetch weather data for all farms';

    public function handle()
    {
        $farms = FarmModel::where('status', 'Paid')->get();
        $successCount = 0;
        $errorCount = 0;

        foreach ($farms as $farm) {
            Log::info("Fetching weather data for farm ID: {$farm->farm_id}, Name: {$farm->name}, Location: {$farm->location}");

            try {
                $result = (new APIController())->weather_data($farm->farm_id);
                $result ? $successCount++ : $errorCount++;
            } catch (\Exception $e) {
                Log::error("Failed processing farm {$farm->farm_id}: " . $e->getMessage());
                $errorCount++;
            }
        }

        $this->info("Weather data fetch completed. Success: $successCount, Errors: $errorCount");
    }
}
