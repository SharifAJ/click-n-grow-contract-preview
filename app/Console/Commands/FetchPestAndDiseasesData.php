<?php

namespace App\Console\Commands;

use App\Http\Controllers\APIController;
use App\Models\FarmModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FetchPestAndDiseasesData extends Command
{
    protected $signature = 'pest:fetch';
    protected $description = 'Sync pest and disease data for all farms';

    public function handle()
    {
        $farms = FarmModel::where('status', 'Paid')->pluck('farm_id');

        foreach ($farms as $farmId) {
            try {
            (new APIController())->pest_and_disease(new Request([
                'farm_id' => $farmId
            ]));
            } catch (\Exception $e) {
            Log::error("Pest sync failed for farm $farmId: " . $e->getMessage());
            }
        }

        Log::info('Done Successfully - Pest and disease fetched for ' . count($farms) . ' farms');
    }
}
