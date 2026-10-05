<?php

namespace App\Jobs;

use App\Models\Farm;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\APIController;

class SyncPestDiseaseForFarm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $farmId;
    public $language;

    public function __construct($farmId, $language)
    {
        $this->farmId = $farmId;
        $this->language = $language;
    }

    public function handle()
    {
        $request = new Request();
        $request->replace(['farm_id' => $this->farmId]);

        // You can inject or instantiate APIController
        $controller = new APIController();
        $controller->pest_and_disease($request, $this->language);
    }
}
