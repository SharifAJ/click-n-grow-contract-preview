<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// Data cleanup has been set up but not implemented. 
// To implement, go to bootstrap/app.php and add the following schedule there, adjusting the days count as required:
// $schedule->call(function () {
// Notification::where('created_at', '<', now()->subDays(30))->delete();
// $this->info('Successfully pruned old notifications.');
// })->daily();


// class NotificationController extends Controller
// {
//     public function index(Request $request)
//     {
//         return $request->user()->notifications()
//             ->whereNull('read_at')
//             ->orderBy('created_at', 'desc')
//             ->paginate(10);
//     }

//     public function markAsRead(Notification $notification)
//     {
//         abort_unless($notification->user_id === auth()->id(), 403);

//         $notification->update(['read_at' => now()]);

//         return response()->json(['success' => true]);
//     }
    
//     public function getLatestNotification(Request $request)
//     {
//         try {
//             // Validate farm_id is provided
//             $validated = $request->validate([
//                 'farm_id' => 'required|integer|exists:farms,farm_id'
//             ]);

//             // Get latest unprocessed notification for this farm
//             $notification = Notification::where('farm_id', $validated['farm_id'])
//                 ->unprocessed()
//                 ->latest()
//                 ->first();

//             if ($notification) {
//                 $notification->update(['processed_at' => now()]);
//             }

//             return response()->json([
//                 'success' => true,
//                 'data' => $notification
//             ]);
//         } catch (\Exception $e) {
//             Log::error('Notification fetch failed: ' . $e->getMessage(), [
//                 'request' => $request->all()
//             ]);

//             return response()->json([
//                 'success' => false,
//                 'error' => 'Failed to retrieve notifications'
//             ], 500);
//         }
//     }
// }
