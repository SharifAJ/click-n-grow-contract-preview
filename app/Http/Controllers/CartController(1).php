<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\FarmModel;
use App\Models\ServiceMasterModel;
use App\Models\PackageMasterModel;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentFailedMail;
use App\Mail\PaymentSuccessMail;
use App\Services\SatelliteService;
use Illuminate\Support\Facades\Response;

// ! WARNING: DO NOT CHANGE THESE FUNCTIONS AS THESE ARE USED IN PAYMENT APIs
class CartController extends Controller
{
    // ! WARNING: DO NOT CHANGE THIS FUNCTION AS THIS IS USED IN PAYMENT APIs
    public function syncCart(Request $request)
    {
        // Validate new cart structure
        $validator = Validator::make($request->all(), [
            'cart_items' => 'nullable|array',
            'cart_items.*.farm_id' => 'required|exists:farms,farm_id',
            'cart_items.*.cartServices' => 'required|array',
            'cart_items.*.cartServices.*.id' => 'required|integer',
            'cart_items.*.cartServices.*.quantity' => 'required|integer|min:1',
            'cart_items.*.cartServices.*.type' => 'required|in:service,package'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();

        try {
            // Clear existing cart
            $user->cartItems()->delete();

            foreach ($request->cart_items as $farmCart) {
                foreach ($farmCart['cartServices'] as $service) {
                    // Determine model based on type
                    $cartableType = $service['type'] === 'service' ? ServiceMasterModel::class : PackageMasterModel::class;
                    $cartableItem = $cartableType::find($service['id']); // ✅ Fetch model once

                    if (!$cartableItem) {
                        continue; // Skip if item not found
                    }

                    $farm = FarmModel::where('farm_id', $farmCart['farm_id'])->first();

                    Cart::create([
                        'farm_id' => $farmCart['farm_id'],
                        'user_id' => $user->id,
                        'cartable_id' => $service['id'],
                        'cartable_type' => $cartableType,
                        'quantity' => $service['quantity'],
                        'details' => [
                            'farm_name' => $farm->name ?? null,
                            'item_name' => $cartableItem->name ?? null,
                            'type' => $service['type'] ?? null,
                            'duration' => $cartableItem->duration ?? [] // ✅ Always an array
                        ]
                    ]);
                }
            }


            return response()->json([
                'status' => true,
                'message' => 'Cart updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ! WARNING: DO NOT CHANGE THIS FUNCTION AS THIS IS USED IN PAYMENT APIs
    public function createOrder(Request $request)
    {
        $user = Auth::user();

        // Check if it's a "Pay Now" request
        if ($request->has('cart_items')) {
            // Validate request parameters for Pay Now
            $validator = Validator::make($request->all(), [
                'cart_items' => 'required|array',
                'cart_items.*.farm_id' => 'required|exists:farms,farm_id',
                'cart_items.*.cartServices' => 'required|array',
                'cart_items.*.cartServices.*.id' => 'required|integer',
                'cart_items.*.cartServices.*.quantity' => 'required|integer|min:1',
                'cart_items.*.cartServices.*.type' => 'required|in:service,package'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $cartItems = collect();

            foreach ($request->input('cart_items') as $farmCart) {
                $farm = FarmModel::where('farm_id', $farmCart['farm_id'])->where('user_id', $user->id)->first();

                if (!$farm) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Farm not found or access denied.'
                    ], 404);
                }

                foreach ($farmCart['cartServices'] as $service) {
                    // Determine model based on type
                    $cartableType = $service['type'] === 'service' ? ServiceMasterModel::class : PackageMasterModel::class;
                    $cartableItem = $cartableType::find($service['id']); // ✅ Fetch model once

                    if (!$cartableItem) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Invalid product type.'
                        ], 400);
                    }

                    // Create a temporary cart item
                    $tempCartItem = new \stdClass();

                    $tempCartItem->farm_id = $farm->farm_id;
                    $tempCartItem->user_id = $user->id;
                    $tempCartItem->cartable_id = $cartableItem->id; //or $service['id']
                    $tempCartItem->cartable_type = $cartableType;
                    $tempCartItem->quantity = $service['quantity'] ?? 1;
                    $tempCartItem->cartable = $cartableItem;
                    $tempCartItem->details = [
                        'farm_name' => $farm->name ?? null,
                        'item_name' => $cartableItem->name ?? null,
                        'type' => $service['type'] ?? null,
                        'duration' => $cartableItem->duration ?? [] // ✅ Always an array
                    ];

                    $cartItems->push($tempCartItem);
                }
            }

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No valid items to process.'
                ], 400);
            }

            // Calculate total amount
            $totalAmount = $cartItems->sum(function ($item) {
                //sum will loop through all the items and sums the amount
                return $this->calculateFarmAmount($item);
            });
        } else {
            // Fetch cart items from the user's cart
            $cartItems = $user->cartItems()->with('cartable')->get();
            // Calculate total amount
            $totalAmount = $cartItems->sum(function ($item) {
                //sum will loop through all the items and sums the amount
                return $this->calculateFarmAmount($item);
            });
        }


        // $cartItems = $user->cartItems()->with('cartable')->get();
        Log::info('Cart Items', ["cartItems" => $cartItems]);

        $totalAmount = $cartItems->sum(function ($item) {
            //sum will loop through all the items and sums the amount
            return $this->calculateFarmAmount($item);
        });

        Log::info('Total Amount', ['total_amount' => $totalAmount]);
        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty.'
            ], 400);
        }

        if ($totalAmount <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Total amount must be greater than zero.'
            ], 400);
        }

        // Generate a unique receipt ID
        $receiptId = 'rcpt_' . time() . rand(1000, 9999);

        try {
            // Initialize Razorpay
            $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
            // Create Razorpay Order
            $razorpayOrder = $api->order->create([
                'receipt'         => $receiptId,
                'amount' => $totalAmount * 100, // in paise, razorpay requirement to pass amount in paise
                'currency'        => 'INR',
                'notes'           => [
                    'user_id'    => $user->id,
                    'cart_items' => $cartItems->pluck('id')->toArray(),
                    'farm_ids' => $cartItems->pluck('farm_id')->unique()->toArray()
                ]
            ]);

            Log::info('Cart Items Details', $cartItems->map(fn($item) => [
                'farm_id'      => $item->farm_id,
                'farm_name'    => $item->details['farm_name'] ?? 'Unknown Farm',
                'item_type'    => $item->cartable_type,
                'item_id'      => $item->cartable_id,
                'item_duration' => $item->details['duration'] ?? null,
                'quantity'     => $item->quantity,
                'amount'       => $this->calculateFarmAmount($item),
                'item_name'    => $item->cartable->name,
            ])->toArray());

            // Store transaction in database
            PaymentTransaction::create([
                'user_id'               => $user->id,
                'transaction_id'        => $razorpayOrder->id, //internal id which is razorpay order_id
                'amount'               => $totalAmount,
                'currency'              => 'INR',
                'status'                => 'created',
                'gateway_name'          => 'razorpay',
                'receipt'               => $receiptId,
                'items'           => $cartItems->map(fn($item) => [
                    'farm_id'    => $item->farm_id,
                    'farm_name'  => $item->details['farm_name'] ?? 'Unknown Farm',
                    'item_type'  => $item->cartable_type,
                    'item_id'    => $item->cartable_id,
                    'item_duration' => $item->details['duration'] ?? null,
                    'quantity'   => $item->quantity,
                    'amount'     => $this->calculateFarmAmount($item),
                    'item_name'  => $item->cartable->name,
                ])->toArray(),
            ]);

            return response()->json([
                'id' => $razorpayOrder->id,
                'entity' => 'order',
                'amount' => $razorpayOrder->amount,
                'amount_paid' => 0,
                'amount_due' => $razorpayOrder->amount,
                'currency' => 'INR',
                'receipt' => $receiptId,
                'offer_id' => null,
                'status' => 'created',
                'attempts' => 0,
                'notes' => [
                    'user_id' => $user->id,
                    'cart_items' => $cartItems->pluck('id')->toArray() ?? "No cart items in pay now button",
                    'farm_ids' => $cartItems->pluck('farm_id')->unique()->toArray()
                ],
                'created_at' => now()->timestamp,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'contact' => $user->mobile
                ]
            ]);

            // Return data for frontend checkout
            // return response()->json([
            //     'order_id'  => $razorpayOrder->id,
            //     'amount' => $razorpayOrder->amount,
            //     'currency'  => 'INR',
            //     'key'       => config('services.razorpay.key_id'),
            //     'receipt'   => $receiptId,
            //     'user'      => [
            //         'name'  => $user->name,
            //         'email' => $user->email,
            //         'contact' => $user->mobile
            //     ]
            // ]);
        } catch (\Razorpay\Api\Errors\BadRequestError $e) {
            Log::error('Razorpay BadRequestError', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Failed to create order',
                'error' => [
                    'code' => 'BAD_REQUEST_ERROR',
                    'description' => $e->getMessage(),
                    'source' => 'business',
                    'step' => 'payment_initiation',
                    'reason' => 'input_validation_failed'
                ]
            ], 400);
        } catch (\Razorpay\Api\Errors\ServerError $e) {
            Log::error('Razorpay ServerError', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Failed to create order due to server error',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            Log::error('Unexpected error during Razorpay order creation', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ! WARNING: DO NOT CHANGE THIS FUNCTION AS THIS IS USED IN PAYMENT APIs
    public function verifyPayment(Request $request)
    {
        $user = Auth::user();

        // Validate incoming request
        $validated = $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string'
        ]);

        try {
            // Initialize Razorpay
            $api = new Api(
                config('services.razorpay.key_id'),
                config('services.razorpay.key_secret')
            );

            // Verify signature
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature' => $validated['razorpay_signature']
            ]);

            // Find the transaction
            $transaction = PaymentTransaction::where('transaction_id', $validated['razorpay_order_id'])
                ->firstOrFail();

            // Update transaction record
            $transaction->update([
                'gateway_transaction_id' => $validated['razorpay_payment_id'],
                'status' => 'paid',
                'payment_method' => 'razorpay',
                'gateway_response' => $request->all()
            ]);
            Log::info("Transaction details", ["transaction" => $transaction]);

            // Additional success logic (e.g. clear cart)
            $user->cartItems()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment verified and processed successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }

    // ! WARNING: DO NOT CHANGE THIS FUNCTION AS THIS IS USED IN PAYMENT APIs
    //this verifies the signature
    public function handlePaymentSuccessWebhook(Request $request)
    {
        try {
            $webhookSecret = config('services.razorpay.webhook_secret');
            $receivedSignature = $request->header('X-Razorpay-Signature');
            Log::info('Razorpay Webhook Data Received', ['data' => $request->all()]);
            $payload = $request->getContent();

            /* ------------------------------------------------------ Method 1 - Verify webhook signature ----------------------------------------------------- */
            // Log::info('Raw Payload: ' . $payload);
            Log::info('Verifying webhook signature...');

            // Verify webhook signature
            // $generatedSignature = hash_hmac('sha256', $payload, $webhookSecret);
            $generatedSignature = hash_hmac('sha256', $payload, $webhookSecret);

            if (!hash_equals($generatedSignature, $receivedSignature)) {
                Log::error('Signature mismatch', [
                    'received'  => $receivedSignature,
                    'generated' => $generatedSignature,
                ]);
                return response()->json(['error' => 'Invalid signature'], 403);
            }

            Log::info('Webhook signature verified successfully.');

            // Log::info('Raw Payload: ' . $payload);
            // Log::info('Generated Signature: ' . $generatedSignature);
            // Log::info('Received Signature: ' . $receivedSignature);

            /* ---------------------------------------------------- // Method 2 - Verify webhook signature ---------------------------------------------------- */
            // Log::info('Verifying webhook signature...');
            // $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
            // $api->utility->verifyWebhookSignature(
            //     $request->all(),
            //     $receivedSignature,
            //     $webhookSecret
            // );
            // Log::info('Webhook signature verified successfully.');
            /* ---------------------------------------------------------------------- .. ---------------------------------------------------------------------- */
            // Decode payload
            $payload = json_decode($payload, true);
            $event = $payload['event'] ?? null;
            Log::info('Webhook event detected', ['event' => $event]);

            // Check if event is related to a payment
            if ($event === 'payment.captured') {
                Log::info('Processing payment.captured event...');
                $payloadEntity = $payload['payload']['payment']['entity'] ?? null;

                if (!$payloadEntity) {
                    Log::error('Missing payment entity in webhook payload.');
                    return response()->json(['error' => 'Invalid payload'], 400);
                }

                $razorpayOrderId = $payloadEntity['order_id'] ?? null;
                if (!$razorpayOrderId) {
                    Log::error('Missing order_id in webhook payload.');
                    return response()->json(['error' => 'Invalid order ID'], 400);
                }

                Log::info('Fetching Razorpay order...', ['order_id' => $razorpayOrderId]);

                $razorpay = new Api(
                    config('services.razorpay.key_id'),
                    config('services.razorpay.key_secret')
                );
                $order = $razorpay->order->fetch($razorpayOrderId);
                Log::info('Razorpay order fetched successfully.', ['order' => $order]);
                $farmId = $order->notes['farm_id'] ?? null;

                // Get the payment transaction
                Log::info('Fetching payment transaction...', ['order_id' => $razorpayOrderId]);

                $paymentTransaction = PaymentTransaction::where('transaction_id', $razorpayOrderId)->first();
                if (!$paymentTransaction) {
                    Log::error("Payment transaction not found for order_id: {$razorpayOrderId}");
                    return response()->json(['error' => 'Transaction not found'], 404);
                }
                Log::info('Payment transaction found.', ['transaction' => $paymentTransaction]);

                // Update payment transaction
                Log::info('Updating payment transaction...');

                $paymentTransaction->update([
                    'gateway_transaction_id' => $payloadEntity['id'],
                    'status' => 'paid',
                    'payment_method' => $payloadEntity['method'],
                    'gateway_response' => $payloadEntity
                ]);
                Log::info('Payment transaction updated successfully.');

                // Get user from transaction
                $user = $paymentTransaction->user;
                Log::info('User associated with transaction', ['user' => $user]);

                // Process subscriptions with error handling
                try {
                    $subscription = $this->processSubscriptions($paymentTransaction, $user);
                } catch (\Exception $e) {
                    Log::error('Subscription processing failed', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);

                    Mail::raw(
                        "Subscription processing failed for farm {$paymentTransaction->farm_id} and user {$user->email}. Payment received but subscription is not enabled yet.",
                        function ($message) {
                            $message->to(env('ADMIN_EMAIL'))
                                ->subject('Subscription Processing Alert');
                        }
                    );
                }

                // Handle post-subscription actions
                if ($subscription) {
                    try {
                        $this->handlePostSubscriptionActions($subscription);
                    } catch (\Exception $e) {
                        Log::info("Handle post subscription error");
                        Mail::raw(
                            "Subscription processed successfully for farm ID: {$subscription->farm_id}, but Sat2Farm API failed to unlock it. 
                                \nSubscription ID: {$subscription->id} 
                                \nUser ID: {$subscription->user_id} 
                                \nError: " . $e->getMessage(),
                            function ($message) {
                                $message->to(env('ADMIN_EMAIL'))
                                    ->subject('Subscription Processing Alert: API Unlock Failed');
                            }
                        );
                    }

                    // Clear cart with error handling
                    try {
                        $this->clearCartItems($paymentTransaction);
                    } catch (\Exception $e) {
                        Log::error('Cart clearing failed', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                    }

                    try {
                        // Send a payment success email to the user
                        Mail::to($user->email)->send(new PaymentSuccessMail($paymentTransaction));
                    } catch (\Exception $e) {
                        Mail::raw(
                            "Email delivery failed for user {$user->email} regarding Farm ID: {$paymentTransaction->farm_id}. The payment transaction (Transaction ID: {$paymentTransaction->transaction_id}) was successful, but the confirmation email could not be sent due to an error.",
                            function ($message) {
                                $message->to(env('ADMIN_EMAIL'))
                                    ->subject('Email Delivery Failure Alert');
                            }
                        );
                    }
                }

                return response()->json(['status' => 'success']);
            }

            Log::warning("Unhandled webhook event: {$event}");
            return response()->json(['message' => 'Event ignored'], 200);
        } catch (\Exception $e) {
            Log::error('Webhook Processing Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Processing failed'], 500);
        }
    }

    private function processSubscriptions($paymentTransaction, $user)
    {
        Log::info('Processing subscriptions...');

        foreach ($paymentTransaction->items as $item) {
            // Get included services
            $includedServices = [];
            $duration = (int) (is_array($item['item_duration']) ? $item['item_duration'][0] : $item['item_duration']);

            if ($item['item_type'] === PackageMasterModel::class) {
                $package = PackageMasterModel::with('services')->find($item['item_id']);
                $includedServices = $package->services->pluck('id')->toArray();
                $duration = is_array($package->duration) ? $package->duration[0] : (int) $package->duration;
            } else {
                $includedServices = [$item['item_id']]; // Single service
            }

            // Create subscription
            $subscription = SubscriptionModel::create([
                'subscription_code' => null,
                'farm_id' => $item['farm_id'],
                'subscribable_id' => $item['item_id'],
                'subscribable_type' => $item['item_type'],
                'included_services' => $includedServices,
                'duration' => $duration,  // Now correctly formatted as an integer
                'starts_at' => now(),
                'expires_at' => now()->addDays($duration),
                'amount' => $item['amount'],
                'status' => 'active',
                'payment_status' => 'completed',
                'user_id' => $user->id
            ]);

            Log::info('Subscription created successfully', ['subscription_id' => $subscription->id]);
            return $subscription;
        }
    }

    // Handles post-subscription actions like unlocking the farm and triggering specific service-related processes.
    private function handlePostSubscriptionActions($subscription)
    {
        $APIController = new APIController();
        $farm_id = $subscription->farm_id;

        Log::info('Handling post-subscription actions', ['subscription_id' => $subscription->id, 'farm_id' => $farm_id]);

        $response = $APIController->unlock_farm(new Request([
            'farm_id' => $farm_id,
            'lockstatus' => 'Unlock'
        ]));

        // Convert JsonResponse to an array
        $responseData = $response->getData(true); // Decodes JSON into an associative array

        if (!$responseData['status']) {
            Log::error('Failed to unlock farm', ['farm_id' => $farm_id]);
            return;
        }

        Log::info('Farm unlocked successfully', ['farm_id' => $farm_id]);

        // Determine whether the subscription is for a package or a single service
        $serviceIds = [];

        if ($subscription->subscribable_type === PackageMasterModel::class) {
            Log::info('Processing package subscription', ['package_id' => $subscription->subscribable_id]);

            // Get all services included in the package
            $package = PackageMasterModel::with('services')->find($subscription->subscribable_id);
            if (!$package) {
                Log::error('Package not found', ['package_id' => $subscription->subscribable_id]);
                return;
            }

            $serviceIds = $package->services->pluck('id')->toArray();
        } elseif ($subscription->subscribable_type === ServiceMasterModel::class) {
            Log::info('Processing individual service subscription', ['service_id' => $subscription->subscribable_id]);
            $serviceIds = [$subscription->subscribable_id];
        }

        // Trigger actions for all services
        $hasFetchedSatelliteData = false;

        foreach ($serviceIds as $serviceId) {
            Log::info('Triggering service action', ['service_id' => $serviceId, 'farm_id' => $farm_id]);

            // serviceId 1 = Land area mapping and  3 = Mandi rates
            if ($serviceId == 2) {
                $APIController->weather_data($farm_id);
            }

            if (in_array($serviceId, [4, 6, 8]) && !$hasFetchedSatelliteData) {
                // Resolve the SatelliteService from the container.
                $satelliteService = app(SatelliteService::class);
                // Call fetchSatelliteData with both the Request and the SatelliteService.
                $APIController->fetchSatelliteData(new Request(['farm_id' => $farm_id]), $satelliteService);
                $hasFetchedSatelliteData = true;
            }

            if ($serviceId == 5) {
                $APIController->pest_and_disease(new Request(['farm_id' => $farm_id]));
            }

            if ($serviceId == 7) {
                $APIController->image_advisory(new Request(['farm_id' => $farm_id]));
            }

            if ($serviceId == 10) {
                $APIController->fetchIrrigationData(new Request(['farm_id' => $farm_id]));
            }

            if (!in_array($serviceId, [2, 4, 5, 6, 7, 8, 10])) {
                Log::warning('No action found for service', ['service_id' => $serviceId]);
            }
        }
    }

    public function isServiceActive($farmId, $serviceId)
    {
        return SubscriptionModel::where('farm_id', $farmId)
            ->forService($serviceId)
            ->where('expires_at', '>', now())
            ->exists();

        // DOCS: you can use the below code to Check access to service ID e.g. id=7 (Image-Based Diagnosis)
        // $hasAccess = $this->isServiceActive(123, 7); // Should return true
    }

    private function clearCartItems($paymentTransaction)
    {
        $cartItemIds = $paymentTransaction->gateway_response['notes']['cart_items'] ?? [];
        if (!empty($cartItemIds)) {
            Log::info('Clearing cart items...', ['cart_item_ids' => $cartItemIds]);
            Cart::whereIn('id', $cartItemIds)->delete();
            Log::info('Cart items cleared successfully.');
        }
    }

    private function calculateFarmAmount($item)
    {
        $farmArea = FarmModel::where('farm_id', $item->farm_id)->select('area')->first();
        $area = $farmArea ? $farmArea->area : null;

        if (!$farmArea) {
            return 0;
        }

        $adjustedArea = $area < 1 ? 1 : round($area, 2);

        return $item->cartable->amount * $adjustedArea * $item->quantity;
    }

    public function getCart()
    {
        $cartItems = Auth::user()->cartItems()->with('cartable')->get();
        Log::info('Cart items', ['items' => $cartItems]);
        // Format the response
        $formattedItems = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'farm_id' => $item->farm_id,
                'user_id' => $item->user_id,
                'farm_name' => $item->details['farm_name'] ?? 'Unknown Farm',
                'item_id' => $item->cartable_id,
                'item_type' => $item->details['type'] ?? 'unknown',
                'item_name' => $item->details['item_name'] ?? ($item->cartable->name ?? 'Unknown Item'),
                'item_duration' => $item->details['duration'] ?? ($item->cartable->name ?? 'Unknown Item'),
                'amount' => $this->calculateFarmAmount($item) ?? 0,
                'quantity' => $item->quantity,
            ];
        });

        // Calculate totals
        $totalItems = $formattedItems->count();
        $totalAmount = $formattedItems->sum(fn($item) => $item['amount'] * $item['quantity']);

        return response()->json([
            'status' => true,
            'message' => 'Cart retrieved successfully',
            'total_items' => $totalItems,
            'total_amount' => $totalAmount,
            'data' => $formattedItems
        ]);
    }
}

/*
POST cart/sync request example
{
  "cart_items": [
    {
      "farm_id": 110008,
      "cartServices": [
        {
          "id": 1,
          "quantity": 2,
          "type": "service"
        },
        {
          "id": 2,
          "quantity": 1,
          "type": "package"
        }
      ]
    },
    {
      "farm_id": 101415,
      "cartServices": [
        {
          "id": 3,
          "quantity": 3,
          "type": "service"
        }
      ]
    }
  ]
}


POST /api/verify-payment
{
  "razorpay_payment_id": "pay_29QQoUBi66xm2f",
  "razorpay_order_id": "order_Q8Dsu0v3Cn5Yzh",
  "razorpay_signature": "dcfea993c2e2994e663693cb9a6a3db4639008da1597bc81245ad1812db2fa9a"
}

How to test Sucess Payment Email verification without making acual payment:
comment any simple api code and add this (e.g. getCart()), and just run that function.

        $user = \App\Models\User::find(5);

        // Retrieve the payment transaction model instance
        $paymentTransaction = PaymentTransaction::with('item')->find(67);
    
        if (!$paymentTransaction) {
            return response()->json(['error' => 'Payment transaction not found'], 404);
        }
    
        Mail::to($user->email)->send(new PaymentSuccessMail($paymentTransaction));


*/