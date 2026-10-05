<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FarmModel;
use App\Models\CropCalendarModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Services\MonitoringStatusService;

class SyncCropCalendarForFarm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $farmId;
    public $lang;

    public function __construct($farmId, $lang = 'en')
    {
        $this->farmId = $farmId;
        $this->lang = $lang;
    }

    public function handle()
    {
        try {
            $farm = FarmModel::where('farm_id', $this->farmId)
                ->where('status', 'Paid')
                ->first();

            if (!$farm || !$farm->sowingdate || !$farm->croptype) {
                Log::error("Invalid farm data for farm_id: {$this->farmId}");
                return;
            }

            $currentDay = $this->calculateCurrentDay($farm->sowingdate);

            $response = Http::retry(3, 200)->get(
                config('services.satyukt_api.url') . '/display/crop/calender/v2',
                [
                    'key' => config('services.satyukt_api.key'),
                    'farm_id' => $this->farmId,
                    'sowing_date' => $currentDay,
                    'crop' => $farm->croptype,
                    'lang' => $this->lang
                ]
            );

            if (!$response->successful()) {
                $this->logError("API error for farm {$this->farmId}", $response->status());
                return;
            }

            $data = $response->json();
            $this->processCalendarData($data, $farm->croptype);

            MonitoringStatusService::MonitoringlogStatus(
                $this->farmId,
                'cropcalendar',
                'success',
                null,
                $this->lang
            );
        } catch (\Exception $e) {
            $this->logError("Exception for farm {$this->farmId}: " . $e->getMessage());
        }
    }

    protected function calculateCurrentDay($sowingDate)
    {
        return ((int) Carbon::createFromFormat('d-m-Y', $sowingDate)
            ->diffInDays(now(), false)) + 1;
    }

    protected function processCalendarData($data, $cropType)
    {
        foreach ($data as $entry) {
            if (!isset($entry['Range']) || strpos($entry['Range'], '-') === false) {
                continue;
            }

            CropCalendarModel::updateOrCreate(
                [
                    'farm_id' => $this->farmId,
                    'crop' => $cropType,
                    'range' => $entry['Range'],
                    'language' => $this->lang
                ],
                [
                    'recommended' => $entry['Recommended'] ?? null,
                    'status' => $entry['status'] ?? 'pending'
                ]
            );
        }
    }

    protected function logError($message, $statusCode = null)
    {
        Log::error($message);
        MonitoringStatusService::MonitoringlogStatus(
            $this->farmId,
            'cropcalendar',
            'failed',
            $statusCode ? "HTTP $statusCode: $message" : $message,
            $this->lang
        );
    }
}
