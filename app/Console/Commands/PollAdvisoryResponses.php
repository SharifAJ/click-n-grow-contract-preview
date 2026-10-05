<?php

namespace App\Console\Commands;

use App\Services\MonitoringStatusService;
use Illuminate\Console\Command;
use App\Models\AdvisorySubmission;
use App\Models\AdvisoryResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PollAdvisoryResponses extends Command
{
    protected $signature = 'advisory:poll';
    protected $description = 'Poll third-party API for advisory responses';

    public function handle()
    {
        Log::info('Starting to poll advisory responses.');

        // Get all unique farm IDs with pending submissions
        $farmIds = AdvisorySubmission::where('status', 'pending')
            ->distinct()
            ->pluck('farm_id');

        Log::info('Found farm IDs with pending submissions: ' . $farmIds->implode(', '));

        foreach ($farmIds as $farmId) {
            Log::info("Processing submissions for farm ID: $farmId");
            $this->processFarmSubmissions($farmId);
        }

        Log::info('Finished polling advisory responses.');
    }

    private function processFarmSubmissions($farmId)
    {
        try {
            // Log::info("Polling third-party API for farm ID: $farmId");

            $response = Http::get(config('services.satyukt_api.url') . '/user/get/image/advisory', [
                'key' => config('services.satyukt_api.key'),
                'farm_id' => $farmId
            ]);

            if ($response->successful()) {
                // Log::info("Received successful response for farm ID: $farmId");

                $advisories = $response->json();
                // Log::info("Advisories received: " . json_encode($advisories));



                $processedCount = 0;
                foreach ($advisories as $advisory) {
                    // Handle error cases
                    if (isset($advisory['error'])) {
                        Log::warning("API error for farm $farmId", $advisory);
                        $apiStatus = 'failed';
                        $errorMessage = "API error for farm $farmId" . $advisory;
                        MonitoringStatusService::MonitoringlogStatus($farmId, 'advisory', $apiStatus, $errorMessage);

                        return response()->json($advisory, 400);
                    }

                    if (!is_array($advisories) || empty($advisories)) {
                        Log::warning("Unexpected response format for farm $farmId: " . json_encode($advisories));
                        $apiStatus = 'failed';
                        $errorMessage = "Unexpected response format for farm $farmId: " . json_encode($advisories);
                        MonitoringStatusService::MonitoringlogStatus($farmId, 'advisory', $apiStatus, $errorMessage);

                        return response()->json(['message' => 'Invalid API response'], 400);
                    }

                    // ✅ Check if response contains advisories 
                    if (!isset($advisory['img_id']) && !isset($advisory['farm_id'])) {
                        Log::info("No advisory data found for farm ID: $farmId");
                        $apiStatus = 'failed';
                        $errorMessage = "No advisory data found for farm ID: $farmId";
                        MonitoringStatusService::MonitoringlogStatus($farmId, 'advisory', $apiStatus, $errorMessage);

                        return response()->json($advisories, 200);
                    }

                    $this->processAdvisory($advisory);
                    $processedCount++;
                    Log::info($processedCount . " Processing advisory: ");
                }
            } else {
                $apiStatus = 'failed';
                $errorMessage = $response->getMessage();
                MonitoringStatusService::MonitoringlogStatus($farmId, 'advisory', $apiStatus, $errorMessage);

                Log::warning("Failed to receive a successful response for farm ID: $farmId. Status: " . $response->status());
            }
        } catch (\Exception $e) {
            $apiStatus = 'failed';
            $errorMessage = $e->getMessage();
            MonitoringStatusService::MonitoringlogStatus($advisory['farm_id'], 'advisory', $apiStatus, $errorMessage);

            Log::error("Error polling advisory for farm $farmId: " . $e->getMessage());
        }
    }


    private function processAdvisory($advisory)
    {
        try {
            // Log::info("Processing advisory for farm ID: {$advisory['farm_id']} and image ID: {$advisory['img_id']}");

            $submission = AdvisorySubmission::where([
                'farm_id' => $advisory['farm_id'],
                'img_id' => $advisory['img_id']
            ])->first();

            if ($submission) {
                // Log::info("Found submission for farm ID: {$advisory['farm_id']} and image ID: {$advisory['img_id']}");

                // Create or update response
                AdvisoryResponse::updateOrCreate(
                    [
                        'farm_id' => $advisory['farm_id'],
                        'img_id' => $advisory['img_id']
                    ],
                    [
                        'submission_id' => $submission->id ?? null, // Foreign key
                        'SKU' => $advisory['SKU'] ?? null,
                        'crop_name' => $advisory['crop_name'] ?? null,
                        'description' => $advisory['description'] ?? null,
                        'disease_name' => $advisory['disease_name'] ?? null,
                        'disease_solution' => $advisory['disease_solution'] ?? null,
                        'img_name' => $advisory['img_name'] ?? null,
                        'nutrient_deficiency' => $advisory['nutrient_deficiency'] ?? null,
                        'nutrient_management' => $advisory['nutrient_management'] ?? null,
                        'pest_name' => $advisory['pest_name'] ?? null,
                        'pest_solution' => $advisory['pest_solution'] ?? null,
                        'status' => $advisory['status'] ?? 'failed',
                        'responded_at' => now(),
                    ]
                );

                // Update submission status
                $submission->update(['status' => $advisory['status']]);
                // Log::info("Updated submission status to: {$advisory['status']}");

                $apiStatus = 'success';
                $errorMessage = null;
                MonitoringStatusService::MonitoringlogStatus($advisory['farm_id'], 'advisory', $apiStatus, $errorMessage);

                // Log::info("Processed response for farm {$advisory['farm_id']} image {$advisory['img_id']}");
            } else {
                Log::warning("No submission found for farm ID: {$advisory['farm_id']} and image ID: {$advisory['img_id']}");
            }
        } catch (\Exception $e) {
            $apiStatus = 'failed';
            $errorMessage = $e->getMessage();
            MonitoringStatusService::MonitoringlogStatus($advisory['farm_id'], 'advisory', $apiStatus, $errorMessage);

            Log::error("Error processing advisory response: " . $e->getMessage());
        }
    }
}
