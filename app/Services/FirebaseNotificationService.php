<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Factory;

// class FirebaseNotificationService
// {
//     public function sendToUser($user, $notificationData, $data = [])
//     {
//         if (!$user->fcm_token) {
//             \Log::warning("No FCM token for user {$user->id}");
//             return false;
//         }

//         try {
//             $messaging = app('firebase.messaging');

//             $message = CloudMessage::withTarget('token', $user->fcm_token)
//                 ->withNotification(FirebaseNotification::create(
//                     $notificationData['title'],
//                     $notificationData['body']
//                 ))
//                 ->withData(array_merge($data, [
//                     'notification_id' => (string) $notificationData['id'],
//                     'type' => $notificationData['type']
//                 ]));

//             $messaging->send($message);
//             return true;

//         } catch (\Throwable $e) {
//             \Log::error("FCM Error: {$e->getMessage()}");
//             return false;
//         }
//     }
// }

// class FirebaseNotificationService
// {
//     const MAX_RETRIES = 3;
//     const RETRY_DELAY = 100; // Milliseconds between retries

//     public function sendToUser(User $user, array $notificationData, array $payload = [])
//     {
//         // Error: Missing FCM Token
//         if (empty($user->fcm_token)) {
//             Log::warning("No FCM token for user {$user->id}");
//             return false;
//         }

//         $messaging = app('firebase.messaging');
//         $message = $this->buildMessage($user->fcm_token, $notificationData, $payload);

//         return $this->sendWithRetry($messaging, $message, $user);
//     }

//     private function buildMessage(string $token, array $notification, array $payload)
//     {
//         return CloudMessage::new()
//             ->toToken($token)
//             ->withNotification(FirebaseNotification::create(
//                 $notification['title'],
//                 $notification['body']
//             ))
//             ->withData($payload);
//         // Uncomment below for notification priorities
//         // ->withAndroidConfig(['priority' => 'high'])
//         // ->withApnsConfig(['headers' => ['apns-priority' => '10']]);
//     }


//     private function sendWithRetry($messaging, $message, User $user, $attempt = 1)
//     {
//         try {
//             $messaging->send($message);
//             return true;
//         } catch (MessagingException $e) {

//             // Handle invalid token errors
//             if (str_contains($e->getMessage(), 'registration-token-not-registered')) {
//                 $user->update(['fcm_token' => null]);
//                 Log::error("Invalid FCM token removed for user {$user->id}");
//                 return false;
//             }

//             // Retry logic
//             if ($attempt < self::MAX_RETRIES) {
//                 usleep(self::RETRY_DELAY * 1000);
//                 return $this->sendWithRetry($messaging, $message, $user, $attempt + 1);
//             }

//             Log::error("FCM send failed after {$attempt} attempts: " . $e->getMessage());
//             return false;
//         }
//     }
// }

// app/Services/FirebaseNotificationService.php

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        $credentialsPath = config('firebase.projects.app.credentials');
        $factory = (new Factory)->withServiceAccount($credentialsPath);
        $this->messaging = $factory->createMessaging();
    }

    public function sendToUser($user, array $data)
    {
        if (!$user->fcm_token) return false;

        $message = CloudMessage::new()
            ->withData($data)
            ->withNotification([
                'title' => $data['title'],
                'body' => $data['body']
            ])
            ->toToken($user->fcm_token);

        try {
            $this->messaging->send($message);
            return true;
        } catch (\Exception $e) {
            Log::error("FCM Error: " . $e->getMessage());
            return false;
        }
    }
}