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
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    public function syncCart(Request $request)
    {
        // Validate new cart structure
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

    public function createOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('cartable')->get();

        // Calculate total amount
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->cartable->amount * $item->quantity;
        });

        if ($totalAmount <= 0) {
            return response()->json(['error' => 'Cart is empty.'], 400);
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

            Log::info('Razorpay Order created', ['order' => $razorpayOrder]);
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
                    'farm_name'  => $item->farm->name ?? 'Unknown Farm',
                    'item_type'  => $item->cartable_type,
                    'item_id'    => $item->cartable_id,
                    'quantity'   => $item->quantity,
                    'amount'     => $item->cartable->amount,
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
                    'cart_items' => $cartItems->pluck('id')->toArray(),
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

            // Additional success logic (e.g., send email, clear cart)
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
                'amount' => $item->cartable->amount ?? 0,
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
    public function payment_webhook_style_1(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++++
        try {
            $webhookSecret    = config('services.razorpay.webhook_secret');
            $webhookSignature = $request->header('X-Razorpay-Signature');
            //++++++++++++++++++++++++++++++++++++++++++++++++
            $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
            $api->utility->verifyWebhookSignature($request->all(), $webhookSignature, $webhookSecret);
            //++++++++++++++++++++++++++++++++++++++++++++++++
            if (!empty($request['event'])) {
                $payment_ev = $request['event'];
                $payment_ba = $request['payload']['payment']['entity'];
                //++++++++++++++++++++++++++++++++++++++++++++++++
                if ($payment_ev == 'payment.captured') {
                    $payment_id = $payment_ba['id'];
                    $order_id   = $payment_ba['order_id'];
                }
                //++++++++++++++++++++++++++++++++++++++++++++++++
                //++++++++++++++++++++++++++++++++++++++++++++++++
                if ($payment_ev == 'payment.failed') {
                    $payment_id = $payment_ba['id'];
                    $order_id   = $payment_ba['order_id'];
                }
                //++++++++++++++++++++++++++++++++++++++++++++++++
                if ($payment_ev && $payment_ba) {

                    DB::table('table_name')->insert([
                        'order_id'         => $id,
                        'payment_id'       => $payment_id,
                        'payment_order_id' => $order_id,
                        'amount'           => $payment_ba['amount'],
                        'currency'         => $payment_ba['currency'],
                        'email'            => $payment_ba['email'],
                        'contact'          => $payment_ba['contact'],
                        'event'            => $payment_ev,
                        'status'           => $payment_ba['status'],
                        'created_at'       => $request['created_at'],
                    ]);
                }
                //++++++++++++++++++++++++++++++++++++++++++++++++
            }
            //++++++++++++++++++++++++++++++++++++++++++++++++
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }
        return Response::json(true);
    }
    // public function handlePaymentSuccessWebhook(Request $request)
    // {
    //     try {
    //         Log::info('Razorpay Webhook Data: ', $request->all());
    //         // Get RAW payload
    //         $payload = $request->getContent();
    //         $receivedSignature = $request->header('X-Razorpay-Signature');
    //         $webhookSecret = config('services.razorpay.webhook_secret');

    //         $generatedSignature = hash_hmac(
    //             'sha256',
    //             $payload,
    //             $webhookSecret
    //         );

    //         if (!hash_equals($generatedSignature, $receivedSignature)) {
    //             Log::error('Signature mismatch', [
    //                 'received' => $receivedSignature,
    //                 'generated' => $generatedSignature,
    //             ]);
    //             return response()->json([
    //                 'status' => 'false',
    //                 'error' => 'Invalid signature'
    //             ], 403);
    //         }

    //         // Decode payload
    //         $payload = json_decode($payload, true);
    //         $payloadEntity = $payload['payload']['payment']['entity'];

    //         // Fetch order to get farm_id
    //         $razorpay = new Api(
    //             config('services.razorpay.key_id'),
    //             config('services.razorpay.key_secret')
    //         );
    //         $orderId = $payload['payload']['payment']['entity']['order_id'];
    //         $order = $razorpay->order->fetch($orderId);
    //         $farmId = $order->notes['farm_id']; // Correct farm_id source
    //         $razorpayOrderId = $payloadEntity['order_id'];

    //         $paymentTransaction = PaymentTransaction::where('gateway_transaction_id', $razorpayOrderId)->firstOrFail();

    //         // $user = Auth::user();
    //         // $cartItems = $user->cartItems()->with('cartable')->get();

    //         // Update payment transaction
    //         $paymentTransaction->update([
    //             'gateway_transaction_id' => $payloadEntity['id'],
    //             'status' => 'paid',
    //             'payment_method' => $payloadEntity['method'],
    //             'gateway_response' => $payloadEntity
    //         ]);

    //         // Get user from transaction
    //         $user =  $paymentTransaction->user;

    //         // Process subscriptions
    //         foreach (json_decode($paymentTransaction->items, true) as $item) {
    //             SubscriptionModel::create([
    //                 'farm_id' => $item['farm_id'],
    //                 'subscribable_id' => $item['item_id'],
    //                 'subscribable_type' => $item['item_type'],
    //                 'duration' => 0, //TODO: this needs to be calculated
    //                 'starts_at' => now(),
    //                 'expires_at' => now()->addMonths(6), // Example duration
    //                 'amount' => $item['amount'],
    //                 'status' => 'active',
    //                 'payment_status' => 'completed',
    //                 'user_id' => $user->id
    //             ]);
    //         }

    //         // Clear cart using stored cart items from transaction
    //         if (isset($paymentTransaction->gateway_response['notes']['cart_items'])) {
    //             Cart::whereIn('id', $paymentTransaction->gateway_response['notes']['cart_items'])
    //                 ->delete();
    //         }

    //         return response()->json(['status' => 'success']);
    //     } catch (\Exception $e) {
    //         Log::error('Webhook Processing Failed: ' . $e->getMessage(), [
    //             'trace' => $e->getTraceAsString()
    //         ]);
    //         return response()->json(['error' => 'Processing failed'], 500);
    //     }
    // }

    //this verifies the signature
    // public function handlePaymentSuccessWebhook(Request $request)
    // {
    //     try {
        //     $webhookSecret = config('services.razorpay.webhook_secret');
        //     $receivedSignature = $request->header('X-Razorpay-Signature');
    //         Log::info('Razorpay Webhook Data: ', $request->all());

    //         // Get RAW payload
    //         $payload = $request->getContent();
    //         Log::info('Raw Payload: ' . $payload);

    //         // Verify webhook signature
    //         // $generatedSignature = hash_hmac('sha256', $payload, $webhookSecret);
    //         $generatedSignature = hash_hmac('sha256', $payload, $webhookSecret);

    //         if (!hash_equals($generatedSignature, $receivedSignature)) {
    //             Log::error('Signature mismatch', [
    //                 'received'  => $receivedSignature,
    //                 'generated' => $generatedSignature,
    //             ]);
    //             return response()->json(['error' => 'Invalid signature'], 403);
    //         }
    //         // Log::info('Raw Payload: ' . $payload);
    //         // Log::info('Generated Signature: ' . $generatedSignature);
    //         // Log::info('Received Signature: ' . $receivedSignature);

    //         // Decode payload
    //         $payload = json_decode($payload, true);
    //         $event = $payload['event'] ?? null;

    //         // Check if event is related to a payment
    //         if ($event === 'payment.captured') {
    //             $payloadEntity = $payload['payload']['payment']['entity'] ?? null;

    //             if (!$payloadEntity) {
    //                 Log::error('Missing payment entity in webhook payload.');
    //                 return response()->json(['error' => 'Invalid payload'], 400);
    //             }

    //             $razorpayOrderId = $payloadEntity['order_id'] ?? null;
    //             if (!$razorpayOrderId) {
    //                 Log::error('Missing order_id in webhook payload.');
    //                 return response()->json(['error' => 'Invalid order ID'], 400);
    //             }

    //             // Fetch order from Razorpay
    //             $razorpay = new Api(
    //                 config('services.razorpay.key_id'),
    //                 config('services.razorpay.key_secret')
    //             );
    //             $order = $razorpay->order->fetch($razorpayOrderId);
    //             $farmId = $order->notes['farm_id'] ?? null; // Ensure `farm_id` exists

    //             // Get the payment transaction
    //             $paymentTransaction = PaymentTransaction::where('gateway_transaction_id', $razorpayOrderId)->first();
    //             if (!$paymentTransaction) {
    //                 Log::error("Payment transaction not found for order_id: {$razorpayOrderId}");
    //                 return response()->json(['error' => 'Transaction not found'], 404);
    //             }

    //             // Update payment transaction
    //             $paymentTransaction->update([
    //                 'gateway_transaction_id' => $payloadEntity['id'],
    //                 'status' => 'paid',
    //                 'payment_method' => $payloadEntity['method'],
    //                 'gateway_response' => $payloadEntity
    //             ]);

    //             // Get user from transaction
    //             $user = $paymentTransaction->user;

    //             // Process subscriptions
    //             foreach ($paymentTransaction->items as $item) {
    //                 SubscriptionModel::create([
    //                     'farm_id'           => $item['farm_id'],
    //                     'subscribable_id'   => $item['item_id'],
    //                     'subscribable_type' => $item['item_type'],
    //                     'duration'          => 30,
    //                     'starts_at'         => now(),
    //                     'expires_at'        => now()->addDays(30),
    //                     'amount'            => $item['amount'],
    //                     'status'            => 'active',
    //                     'payment_status'    => 'completed',
    //                     'user_id'           => $user->id
    //                 ]);
    //             }

    //             // Clear cart
    //             $cartItemIds = $paymentTransaction->gateway_response['notes']['cart_items'] ?? [];
    //             if (!empty($cartItemIds)) {
    //                 Cart::whereIn('id', $cartItemIds)->delete();
    //             }

    //             return response()->json(['status' => 'success']);
    //         }

    //         Log::warning("Unhandled webhook event: {$event}");
    //         return response()->json(['message' => 'Event ignored'], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Webhook Processing Failed: ' . $e->getMessage(), [
    //             'trace' => $e->getTraceAsString()
    //         ]);
    //         return response()->json(['error' => 'Processing failed'], 500);
    //     }
    // }

    
    // public function handlePaymentSuccessWebhook(Request $request)
    // {
    //     try {
    //         $payload = trim($request->getContent());
    //         $receivedSignature = $request->header('X-Razorpay-Signature');
    //         $webhookSecret = config('services.razorpay.webhook_secret');

    //         // Signature verification
    //         $generatedSignature = hash_hmac('sha256', $payload, $webhookSecret);
    //         if (!hash_equals($generatedSignature, $receivedSignature)) {
    //             Log::error('Signature mismatch', [
    //                 'received'  => $receivedSignature,
    //                 'generated' => $generatedSignature,
    //             ]);
    //             return response()->json(['error' => 'Invalid signature'], 403);
    //         }

    //         $data = json_decode($payload, true);
    //         $event = $data['event'] ?? null;

    //         // Handle only payment-related events
    //         if (str_starts_with($event, 'payment.')) {
    //             return $this->handlePaymentEvent($data);
    //         }

    //         // Explicitly ignore non-payment events
    //         Log::debug("Ignoring non-payment event: {$event}");
    //         return response()->json(['status' => 'ignored']);
    //     } catch (\Exception $e) {
    //         Log::error('Webhook Processing Failed: ' . $e->getMessage(), [
    //             'trace' => $e->getTraceAsString()
    //         ]);
    //         return response()->json(['error' => 'Processing failed'], 500);
    //     }
    // }

    // private function handlePaymentEvent(array $data)
    // {
    //     $event = $data['event'];
    //     $paymentEntity = $data['payload']['payment']['entity'] ?? null;

    //     if (!$paymentEntity) {
    //         Log::error('Invalid payment event structure', ['data' => $data]);
    //         return response()->json(['error' => 'Invalid event data'], 400);
    //     }

    //     // Handle different payment statuses
    //     switch ($event) {
    //         case 'payment.captured':
    //             return $this->processSuccessfulPayment($paymentEntity);
    //         case 'payment.failed':
    //             return $this->processFailedPayment($paymentEntity);
    //         default:
    //             Log::warning("Unhandled payment event: {$event}");
    //             return response()->json(['status' => 'unprocessed']);
    //     }
    // }


    // private function processSuccessfulPayment(array $paymentEntity)
    // {
    //     // Use transaction_id (Razorpay order ID) for lookup
    //     $transaction = PaymentTransaction::where('transaction_id', $paymentEntity['order_id'])
    //         ->firstOrFail();

    //     // Update transaction details
    //     $transaction->update([
    //         'gateway_transaction_id' => $paymentEntity['id'],
    //         'status' => 'paid',
    //         'payment_method' => $paymentEntity['method'],
    //         'gateway_response' => $paymentEntity
    //     ]);

    //     // Process subscriptions
    //     $this->createSubscriptions($transaction);

    //     // Clear cart
    //     $this->clearCartItems($transaction);

    //     return response()->json(['status' => 'success']);
    // }

    // private function processFailedPayment(array $paymentEntity)
    // {
    //     try {
    //         // Find transaction using Razorpay order ID
    //         $transaction = PaymentTransaction::where('transaction_id', $paymentEntity['order_id'])
    //             ->firstOrFail();

    //         // Update transaction status and details
    //         $transaction->update([
    //             'status' => 'failed',
    //             'payment_method' => $paymentEntity['method'] ?? null,
    //             'gateway_response' => array_merge(
    //                 $transaction->gateway_response ?? [],
    //                 [
    //                     'failure' => [
    //                         'code' => $paymentEntity['error_code'] ?? null,
    //                         'description' => $paymentEntity['error_description'] ?? null,
    //                         'reason' => $paymentEntity['error_reason'] ?? null
    //                     ]
    //                 ]
    //             )
    //         ]);

    //         // Log failure details
    //         Log::warning('Payment failed', [
    //             'transaction_id' => $transaction->id,
    //             'payment_id' => $paymentEntity['id'],
    //             'error' => $paymentEntity['error_description'] ?? 'Unknown error'
    //         ]);

    //         // Notify user about failed payment
    //         // $transaction->user->notify(new PaymentFailedNotification(
    //         //     $transaction->amount,
    //         //     $paymentEntity['error_description'] ?? 'Payment processing failed'
    //         // ));

    //         // Send email notification to the user about the failed payment
    //         // Mail::to($transaction->user->email)->send(new \App\Mail\PaymentFailedMail(
    //         //     $transaction->user->name,
    //         //     $transaction->amount,
    //         //     $paymentEntity['error_description'] ?? 'Payment processing failed'
    //         // ));

    //         return response()->json(['status' => 'failure_processed']);
    //     } catch (ModelNotFoundException $e) {
    //         Log::error('Failed payment transaction not found', [
    //             'order_id' => $paymentEntity['order_id'] ?? null,
    //             'payment_id' => $paymentEntity['id'] ?? null
    //         ]);
    //         return response()->json(['error' => 'Transaction not found'], 404);
    //     } catch (\Exception $e) {
    //         Log::error('Failed payment processing error', [
    //             'error' => $e->getMessage(),
    //             'payment_id' => $paymentEntity['id'] ?? null
    //         ]);
    //         return response()->json(['error' => 'Failed to process payment failure'], 500);
    //     }
    // }

    // private function createSubscriptions(PaymentTransaction $transaction)
    // {
    //     $items = json_decode($transaction->items, true) ?? [];

    //     foreach ($items as $item) {
    //         // Calculate duration from cart details
    //         $durationDays = $this->calculateSubscriptionDuration(
    //             $item['details']['duration'] ?? 30 // Default to 30 days
    //         );

    //         SubscriptionModel::updateOrCreate(
    //             [
    //                 'subscribable_id' => $item['item_id'],
    //                 'subscribable_type' => $item['item_type'],
    //                 'farm_id' => $item['farm_id']
    //             ],
    //             [
    //                 'duration' => $durationDays,
    //                 'expires_at' => now()->addDays($durationDays),
    //                 'amount' => $item['amount'],
    //                 'status' => 'active',
    //                 'payment_status' => 'completed',
    //                 'user_id' => $transaction->user_id
    //             ]
    //         );
    //     }
    // }

    // private function calculateSubscriptionDuration($durationConfig): int
    // {
    //     // Implement your duration calculation logic
    //     return is_array($durationConfig) ?
    //         ($durationConfig['days'] ?? 30) :
    //         (int)$durationConfig;
    // }

    // private function clearCartItems(PaymentTransaction $transaction)
    // {
    //     try {
    //         $cartItemIds = $transaction->gateway_response['notes']['cart_items'] ?? [];

    //         if (!empty($cartItemIds)) {
    //             Cart::whereIn('id', $cartItemIds)->delete();
    //             Log::info("Cleared cart items", ['count' => count($cartItemIds)]);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Cart clearance failed', [
    //             'error' => $e->getMessage(),
    //             'transaction_id' => $transaction->id
    //         ]);
    //     }
    // }
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


*/