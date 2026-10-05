<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWebhookNotification;
use App\Models\FarmModel;
use App\Models\Notification;
use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {

        // Basic validation
        $validated = $request->validate([
            'type' => 'required|string|in:soil_health,image_advisory',
            'farm_id' => 'required|integer|exists:farms,farm_id',
            'date' => 'required|numeric',
            'img_id' => 'sometimes|required_if:type,image_advisory|integer', 
        ]);

        try {
            // Generate unique ID
            $webhookId = Str::uuid();

            // Immediately dispatch job
            ProcessWebhookNotification::dispatch($validated, $request->all(), $webhookId);

            return response()->json([
                'status' => true,
                'message' => 'Webhook received'
            ]);
        } catch (\Exception $e) {
            Log::error("Webhook processing failed: " . $e->getMessage());
            return response()->json(['status' => false], 500);
        }
    }
}

// class WebhookController extends Controller
// {
//     public function handleWebhook(Request $request)
//     {
//         // Validate common fields
//         $validated = $request->validate([
//             'type' => 'required|string|in:soil_health,image_advisory',
//             'farm_id' => 'required|integer|exists:farms,farm_id',
//             'date' => 'required|numeric'
//         ]);


//         if (!$validated) {
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation failed',
//                 'errors' => $request->errors()
//             ], 422);
//         }


//         try {
//             // Get associated user
//             $farm = FarmModel::with('user')->where('farm_id', $validated['farm_id'])->firstOrFail();
//             $user = $farm->user;

//             // Create notification
//             $notification = Notification::create([
//                 'user_id' => $user->id,
//                 'type' => $validated['type'],
//                 'farm_id' => $validated['farm_id'],
//                 'data' => $request->all(),
//                 'processed_at' => now()
//             ]);

//             // Send push notification
//             $notificationService = new FirebaseNotificationService();
//             $success = $notificationService->sendToUser($user, [
//                 'id' => $notification->id,
//                 'title' => ucfirst($validated['type']) . ' Report Ready',
//                 'body' => "Your {$validated['type']} analysis is available",
//                 'type' => $validated['type']
//             ], $request->all());

//             if (!$success) {
//                 $notification->update(['processed_at' => null]);
//                 Log::warning("Notification processing failed for user {$user->id}");
//             }

//             return response()->json(['status' => (bool)$success]);
//         } catch (\Exception $e) {
//             Log::error("Webhook processing failed: " . $e->getMessage());

//             return response()->json([
//                 'status' => false,
//                 'error' => 'Processing failed'
//             ], 500);
//         }
//     }

//     private function handleSoilReport(Request $request)
//     {
//         $result =  app()->call('App\Http\Controllers\APIController@soil_report', [
//             'farm_id' => $this->notification->farm_id
//         ]);

//         return response()->json([
//             'status' => (bool)$result,
//             'farm_id' => $request->farm_id
//         ]);
//     }

//     private function handleImageAdvisory(Request $request)
//     {
//         try {
//             // Custom validation for image advisory
//             $request->validate([
//                 'image_id' => 'required|url',
//             ]);

//             // Add your image processing logic here

//             return response()->json(['success' => true]);
//         } catch (\Exception $e) {
//             Log::error('Image advisory failed: ' . $e->getMessage());
//             return response()->json(['success' => false], 500);
//         }
//     }
// }


