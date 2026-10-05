<?php

namespace App\Jobs;

use App\Models\AdvisorySubmission;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessAdvisorySubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public AdvisorySubmission $submission
    ) {}

    public function handle()
    {
       Log::info('Starting to process advisory submission', ['submission_id' => $this->submission->id]);
        Log::info('Preparing to send API request', [
            'key' => config('services.satyukt_api.key'),
            'farm_id' => $this->submission->farm_id,
            'img_id' => $this->submission->img_id,
            'croptype' => $this->submission->croptype
        ]);

        $http = Http::attach(
            'image',
            Storage::disk('public')->get("advisories/images/{$this->submission->image_file_name}"),
            $this->submission->image_file_name
        );

       Log::info('Image attached', ['image_file_name' => $this->submission->image_file_name]);

        if ($this->submission->audio_file_name) {
            $http->attach(
            'audio',
            Storage::disk('public')->get("advisories/audio/{$this->submission->audio_file_name}"),
            $this->submission->audio_file_name
            );
           Log::info('Audio attached', ['audio_file_name' => $this->submission->audio_file_name]);
        }

        $response = $http->post(config('services.satyukt_api.url') . '/save/image', [
            'key' => config('services.satyukt_api.key'),
            'farm_id' => $this->submission->farm_id,
            'img_id' => $this->submission->img_id,
            'croptype' => $this->submission->croptype
        ]);

       Log::info('API request sent', ['url' => config('services.satyukt_api.url') . '/save/image', 'response_status' => $response->status()]);

        if (!$response->successful()) {
           Log::error('API request failed', ['response_body' => $response->body()]);
            throw new Exception("API request failed: ".$response->body());
        }

       Log::info('Advisory submission processed successfully', ['submission_id' => $this->submission->id]);
    }
}
