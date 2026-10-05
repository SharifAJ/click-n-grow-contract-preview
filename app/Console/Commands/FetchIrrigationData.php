<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\FarmModel;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\APIController;

class FetchIrrigationData extends Command
{
    protected $signature = 'irrigation:fetch';
    protected $description = 'Fetch irrigation data for all farms';

    public function handle()
    {
        Log::info('Starting irrigation data fetch');

        $farms = FarmModel::where('status', 'Paid')->cursor();
        $processedCount = 0;
        $errorCount = 0;

        foreach ($farms as $farm) {
            try {
                // Log::info("Processing farm {$farm->farm_id}");

                $response = (new APIController())->fetchIrrigationData(new Request([
                    'farmid' => $farm->farm_id
                ]));

                // Log::info("Farm {$farm->farm_id} processed", [
                //     'response' => $response->getContent()
                // ]);

                $processedCount++;
            } catch (\Exception $e) {
                Log::error("Failed processing farm {$farm->farm_id}", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                $errorCount++;

                // Skip to next farm if API error occurs
                continue;
            }
        }

        Log::info("Irrigation data fetch completed. Processed: $processedCount, Errors: $errorCount");
        $this->info("Completed: Processed $processedCount farms, $errorCount errors");
    }
}
