<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FarmModel;
use App\Models\Notification;
use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ProcessWebhookNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $validated,
        public array $requestData,
        public string $webhookId
    ) {}

    // In handle() method
    public function handle(FirebaseNotificationService $fcmService)
    {
        if ($this->validated['type'] === 'image_advisory' && empty($this->validated['img_id'])) {
            Log::error("Image Advisory requires img_id [Webhook ID: {$this->webhookId}]");
            return; // Exit early if validation fails
        }

        Log::info("inside handle method of ProcessWebhookNotification");
        try {
            $farm_id = $this->validated['farm_id'];
            $type = $this->validated['type'];

            Log::info("Processing webhook [ID: {$this->webhookId}, Type: {$type}, Farm: {$farm_id}]");

            $farm = FarmModel::with('user')->where('farm_id', $farm_id)->firstOrFail();
            $user = $farm->user;

            // 1. Create Notification Record
            Notification::create([
                'user_id' => $user->id,
                'farm_id' =>  $farm_id,
                'type' =>  $type,
                'data' => [
                    ...$this->requestData,
                    'webhook_id' => $this->webhookId
                ],
                'processed_at' => now()
            ]);
            Log::info("Notification created");

            // 2. Send Push Notification
            $fcmService->sendToUser($user, [
                'title' => ucfirst($type) . ' Ready',
                'body' => 'New report available',
                'type' => $type,
                'farm_id' =>  $farm_id
            ]);
            Log::info("Push Notification sent");

            // 3. Process Data
            if ($type === 'soil_health') {
                Log::info("Processing Soil Health Report");
                app()->call('App\Http\Controllers\APIController@soil_report', [
                    'farm_id' => $farm_id
                ]);
            } elseif ($type === 'image_advisory') {
                $img_id = $this->requestData['img_id']; // Access from original payload request->all()

                if (!isset($img_id) || is_null($img_id)) {
                    Log::warning("Image ID is missing or null for Image Advisory Report [Webhook ID: {$this->webhookId}]");
                    return;
                }
                Log::info("Processing Image Advisory Report");
                app()->call('App\Http\Controllers\APIController@image_advisory', [
                    'farm_id' =>  $farm_id
                ]);
            }

            Log::info("Webhook processed successfully [ID: {$this->webhookId}]");
        } catch (\Exception $e) {
            Log::error("Notification failed: " . $e->getMessage());
            throw $e;
        }
    }
}


// class ProcessWebhookNotification implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected array $validated;
//     protected array $requestData;
//     protected string $webhookId;

//     /**
//      * Create a new job instance.
//      */
//     public function __construct(array $validated, array $requestData, string $webhookId)
//     {
//         $this->validated = $validated;
//         $this->requestData = $requestData;
//         $this->webhookId = $webhookId;
//     }

//     /**
//      * Execute the job.
//      */
//     public function handle(FirebaseNotificationService $notificationService): void
//     {
//         Log::info("Processing webhook [ID: {$this->webhookId}, Type: {$this->validated['type']}, Farm: {$this->validated['farm_id']}]");

//         try {
//             DB::transaction(function () use ($notificationService) {
//                 // Get associated user
//                 $farm = FarmModel::with('user')->where('farm_id', $this->validated['farm_id'])->firstOrFail();
//                 $user = $farm->user;

//                 // Create notification
//                 $notification = Notification::create([
//                     'user_id' => $user->id,
//                     'type' => $this->validated['type'],
//                     'farm_id' => $this->validated['farm_id'],
//                     'data' => $this->extractRelevantData($this->requestData), // Extract only needed data
//                     'processed_at' => now()
//                 ]);

//                 // Send push notification
//                 $success = $notificationService->sendToUser($user, [
//                     'id' => $notification->id,
//                     'title' => ucfirst($this->validated['type']) . ' Report Ready',
//                     'body' => "Your {$this->validated['type']} analysis is available",
//                     'type' => $this->validated['type']
//                 ], $this->requestData);

//                 if (!$success) {
//                     $notification->update(['processed_at' => null]);
//                     Log::warning("Notification processing failed for user {$user->id} [Webhook ID: {$this->webhookId}]");
//                 }

//                // Call specific handlers and pass necessary data for further processing.
//                $this->callSpecificHandler($this->validated['type'], $this->validated['farm_id']);

//             }); // End DB Transaction
//         } catch (\Exception $e) {
//             Log::error("Webhook processing failed [ID: {$this->webhookId}]: " . $e->getMessage());
//             // Consider more sophisticated error handling here, such as:
//             // - Incrementing a retry count
//             // - Sending an alert to your monitoring system
//             // - Failing the job after a certain number of retries (using $this->fail($e))
//             throw $e;  // Re-throw the exception to allow the queue to handle retries
//         }

//         Log::info("Webhook processed successfully [ID: {$this->webhookId}]");
//     }

//     private function extractRelevantData(array $requestData): array
//     {
//         // Extract and return only the data you need to store in the notification
//         // This is important for security and data privacy.  Example:
//         return [
//             'farm_id' => $requestData['farm_id'],
//             'date' => $requestData['date'],
//             // Add other fields you need to store
//         ];
//     }


//     private function callSpecificHandler(string $type, int $farmId): void
//     {
//         // $result = null;
//         switch ($type) {
//             case 'soil_health':
//                  app()->call('App\Http\Controllers\APIController@soil_report', [
//                     'farm_id' => $farmId
//                 ]);
//                 break;
//             case 'image_advisory':
//                 //app()->call('App\Http\Controllers\APIController@image_advisory', ['farm_id' => $farmId, 'data' => $this->requestData]);
//                  app()->call('App\Http\Controllers\APIController@image_advisory', [
//                     'farm_id' => $farmId
//                 ]);
//                 break;
//             default:
//                 Log::warning("Unknown webhook type: {$type}");
//         }

//         // if ($result === false) {
//         //     Log::error("Handler failed for {$type} [Webhook ID: {$this->webhookId}]");
//         //     // Consider throwing an exception here if the handler failing should cause a retry
//         //     // throw new \Exception("Handler failed for {$type}");
//         // }
//     }
// }

// class ProcessWebhookNotification implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     public function __construct(
//         public array $validated,
//         public array $requestData,
//         public string $webhookId
//     ) {}

//     public function handle()
//     {
//         try {
//             // Process based on type
//             switch ($this->validated['type']) {
//                 case 'soil_health':
//                     app()->call('App\Http\Controllers\APIController@soil_report', [
//                         'farm_id' => $this->validated['farm_id']
//                     ]);
//                     break;

//                 case 'image_advisory':
//                     app()->call('App\Http\Controllers\APIController@image_advisory', [
//                         'farm_id' => $this->validated['farm_id']
//                     ]);
//                     break;
//             }

//             // Create notification
//             Notification::create([
//                 'farm_id' => $this->validated['farm_id'],
//                 'type' => $this->validated['type'],
//                 'data' => $this->requestData,
//                 'processed_at' => now()
//             ]);
//         } catch (\Exception $e) {
//             Log::error("Webhook processing failed [ID: {$this->webhookId}]: " . $e->getMessage());
//             throw $e;
//         }
//     }
// }
