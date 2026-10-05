<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FarmModel;
use Illuminate\Support\Facades\Log;

class FetchSoilReports extends Command
{
    protected $signature = 'soil-report:fetch';
    protected $description = 'Fetch soil reports for all active farms';

    public function handle()
    {
        // $farms = FarmModel::where('status', 'Paid')
        //           ->whereNotNull('farm_id')
        //           ->cursor();


$farms = FarmModel::where('status', 'Paid')
            ->whereNotNull('farm_id')
            ->orderByDesc('id') // Latest records pehle uthane ke liye
            ->cursor();
            
            
        $processed = 0;
        $errors = 0;

        foreach ($farms as $farm) {
            try {
                $result = app()->call('App\Http\Controllers\APIController@soil_report', [
                    'farm_id' => $farm->farm_id
                ]);

                $result ? $processed++ : $errors++;
                
            } catch (\Exception $e) {
                Log::error("Soil report failed for farm {$farm->farm_id}: " . $e->getMessage());
                $errors++;
            }
        }

        $this->info("Soil reports completed. Success: $processed, Errors: $errors");
        Log::info("Soil report job completed", ['success' => $processed, 'errors' => $errors]);
    }
}