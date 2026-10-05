<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Kreait\Firebase\Factory;

class FirebaseConnectionController extends Controller
{

    // This function will be used to test the connection to Firebase Realtime Database.
    //endpoint to run /api/firebase-connection
    // then go to firebase - realtime database - users - you should see connection: true
    // public function index()
    // {
    //     // Retrieve values from .env
    //     $firebaseDatabaseUrl = env('FIREBASE_DATABASE_URL');
    //     $credentialsPath = env('FIREBASE_CREDENTIALS'); 

    //     if (!file_exists($credentialsPath)) {
    //         die("This file path {$credentialsPath} does not exist.");
    //     }

    //     try {
    //         $factory = (new Factory)
    //             ->withServiceAccount($credentialsPath)
    //             ->withDatabaseUri($firebaseDatabaseUrl);

    //         $database = $factory->createDatabase();
    //         $reference = $database->getReference('users');
    //         $reference->set(['connection' => true]);
    //         $snapshot = $reference->getSnapshot();
    //         $value = $snapshot->getValue();

    //         return response()->json([
    //             'status' => true,
    //             'data' => $value,
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // working simple store token function
    // public function storeToken(Request $request)
    // {
    //     $request->validate([
    //         'fcm_token' => 'required|string|max:255'
    //     ]);

    //     try {
    //         $user = auth()->user();
    //         $user->fcm_token = $request->fcm_token;
    //         $user->save();

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'FCM token stored successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('FCM Token Storage Failed: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Failed to store FCM token'
    //         ], 500);
    //     }
    // }

    // store token function with throttle rate limiting security
    public function storeToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        $key = 'fcm_token_update:' . $user->id; // Unique key per user

        $executed = RateLimiter::attempt(
            $key,
            $perMinute = 5, // Allow 5 requests per minute
            function () use ($request, $user) {
                try {
                    $user->fcm_token = $request->fcm_token;
                    $user->save();

                    Log::info('FCM Token Stored Successfully', ['user_id' => $user->id]);

                    // ✅ Must explicitly return response from inside the RateLimiter
                    return response()->json([
                        'status' => true,
                        'message' => 'FCM token stored successfully'
                    ]);
                } catch (\Exception $e) {
                    Log::error('FCM Token Storage Failed: ' . $e->getMessage());
                    return response()->json([
                        'status' => false,
                        'message' => 'Failed to store FCM token'
                    ], 500);
                }
            }
        );

        // ✅ If RateLimiter executed the function, return its response
        if ($executed) {
            return response()->json([
                'status' => true,
                'message' => 'FCM token stored successfully'
            ]);
        }

        // ✅ If rate limit exceeded, return error response
        return response()->json([
            'status' => false,
            'message' => 'Too many requests. Please try again later.'
        ], 429); // HTTP 429 Too Many Requests
    }
}
