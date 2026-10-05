<?php

namespace App\Console\Commands;

use App\Http\Controllers\APIController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\FarmModel;
use Illuminate\Support\Facades\Log;

// class FetchAdvisoryResponse extends Command
// {
//     protected $signature = 'advisory-response:fetch';
//     protected $description = 'Fetch image advisory data for all active farms';

//     public function handle()
//     {
//         $activeFarms = FarmModel::where('status', 'Paid')->get();

//         $processed = 0;
//         $errors = 0;

//         foreach ($activeFarms as $farm) {
//             try {
//                 $request = new Request([
//                     'farm_id' => $farm->farm_id
//                 ]);

//                 $response = (new APIController())->image_advisory($request);
//                 $content = json_decode($response->getContent(), true);

//                 if ($response->getStatusCode() === 201) {
//                     Log::info("Processed farm {$farm->farm_id}", ['count' => count($content['data'] ?? [])]);
//                     $processed++;
//                 } else {
//                     Log::error("Failed for farm {$farm->farm_id}", ['response' => $content]);
//                     $errors++;
//                 }
//             } catch (\Exception $e) {
//                 Log::error("Farm {$farm->farm_id} error: " . $e->getMessage());
//                 $errors++;
//             }
//         }

//         $this->info("Completed: $processed farms processed, $errors errors");
//     }
// }
