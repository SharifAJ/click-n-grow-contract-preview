<?php

namespace App\Listeners;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\ApiUsageLog;

class TrackSatyuktApiRequests
{
    public function handleRequestSending(RequestSending $event)
    {
        $satyuktUrl = config('services.satyukt_api.url'); // https://micro.satyukt.com

        // Check if the request is to Satyukt's API
        if (Str::startsWith($event->request->url(), $satyuktUrl)) {
            // Get the full URL (e.g., https://micro.satyukt.com/weather/data/daypart?key=...&farm_id=...)
            $fullUrl = $event->request->url();

            // Remove the base URL and query parameters
            $endpoint = Str::before(Str::after($fullUrl, $satyuktUrl), '?'); // /weather/data/daypart

            Log::info("Tracking Satyukt API request: {$endpoint}");

            // Save the request to the database
            ApiUsageLog::create([
                'endpoint' => $endpoint,
                // 'request_date' => now()->format('Y-m-d'),
            ]);
        }
    }

    // public function subscribe($events)
    // {
    //     $events->listen(
    //         RequestSending::class,
    //         [TrackSatyuktApiRequests::class, 'handleRequestSending']
    //     );
    // }
}