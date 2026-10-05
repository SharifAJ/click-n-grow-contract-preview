<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FarmModel;
use App\Models\PackageMasterModel;
use App\Models\PaymentTransaction;
use App\Models\ServiceMasterModel;
use App\Models\SubscriptionModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class FarmerSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $subscriptionsData = User::whereHas('farms.subscriptions')
        //     ->with([
        //         'farms' => function ($query) {
        //             $query->whereHas('subscriptions')
        //                 ->with('subscriptions.subscribable'); // Eager load the polymorphic relation
        //         }
        //     ])
        //     ->withCount([
        //         'farms as subscribed_farms_count' => function ($query) {
        //             $query->whereHas('subscriptions');
        //         }
        //     ])
        //     ->orderByDesc('id')
        //     ->get();

        $subscriptionsData = User::whereHas('farms.subscriptions', function ($query) {
            $query->where('created_by', 'Admin'); // ✅ Filter only Admin-created subscriptions
        })
            ->with([
                'farms' => function ($query) {
                    $query->whereHas('subscriptions', function ($query) {
                        $query->where('created_by', 'Admin'); // ✅ Filter only Admin subscriptions
                    })->with([
                        'subscriptions' => function ($query) {
                            $query->where('created_by', 'Admin') // ✅ Ensure only Admin subscriptions are loaded
                                ->with('subscribable');
                        }
                    ]);
                }
            ])
            ->withCount(['farms as subscribed_farms_count']) // ✅ Count farms
            ->withMax('subscriptions', 'id') // ✅ Latest subscription ID per user
            ->orderByDesc('subscriptions_max_id') // ✅ Correct way to order
            ->get();

        // 🔹 Corrected counting for Admin-created subscriptions only
        $subscriptionsData->each(function ($user) {
            $user->total_subscriptions_count = $user->farms->sum(function ($farm) {
                return $farm->subscriptions->where('created_by', 'Admin')->count(); // ✅ Count only Admin subscriptions
            });
        });



        $totalSubscriptions = $subscriptionsData->sum(function ($user) {
            return $user->farms->sum(fn($farm) => $farm->subscriptions->count());
        });

        $users_subscriptionsData = User::whereHas('farms.subscriptions', function ($query) {
            $query->whereNull('created_by'); // ✅ Filter subscriptions where created_by is NULL
        })
            ->with([
                'farms' => function ($query) {
                    $query->whereHas('subscriptions', function ($query) {
                        $query->whereNull('created_by'); // ✅ Ensure only NULL created_by subscriptions
                    })->with([
                        'subscriptions' => function ($query) {
                            $query->whereNull('created_by') // ✅ Load only NULL created_by subscriptions
                                ->with('subscribable');
                        }
                    ]);
                }
            ])
            ->withCount('farms as subscribed_farms_count') // ✅ Count farms
            ->withmax('subscriptions', 'id') // ✅ Latest subscription ID per user
            ->orderByDesc('subscriptions_max_id')
            ->get();

        // 🔹 Corrected counting for NULL created_by subscriptions only
        $users_subscriptionsData->each(function ($user) {
            $user->total_subscriptions_count = $user->farms->sum(function ($farm) {
                return $farm->subscriptions->whereNull('created_by')->count(); // ✅ Count only NULL created_by subscriptions
            });
        });


        // dd($users_subscriptionsData);


        return view('dashboard.farmer_subscription.index', compact('subscriptionsData', 'totalSubscriptions', 'users_subscriptionsData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farmers = User::where('user_status', 'active')->orderByDesc('id')->get();
        return view('dashboard.farmer_subscription.create', compact('farmers'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // dd($request);
        try {
            Log::info('Store method called', ['request' => $request->all()]);
            DB::beginTransaction(); // ✅ Transaction Start

            $subscriptions = [];
            $items = []; // Initialize items array

            // 🔹 Fetch User
            $user = User::find($request->user_id);
            $firstName = strtoupper(substr($user->name, 0, 1)); // Keeping first letter in ID
            // dd($firstName);
            // 🔹 Generate Financial Year (e.g., "25-26")
            $currentYear = now()->format('y');
            $nextYear = now()->addYear()->format('y');
            $financialYear = "{$currentYear}/{$nextYear}";
            // $financialYear = "26-27";

            // 🔹 Fetch last existing subscription **for the current financial year**
            $lastSubscription = SubscriptionModel::where('subscription_code', 'LIKE', "KS/%/{$financialYear}/%")
                ->orderByRaw("CAST(SUBSTRING_INDEX(subscription_code, '/', -1) AS UNSIGNED) DESC")
                ->first();

            if ($lastSubscription) {
                // Extract and increment the last serial number
                $last_serial_number = (int) substr($lastSubscription->subscription_code, -4);
            } else {
                // Reset serial number to 0001 if no record exists for the new financial year
                $last_serial_number = 0;
            }

            // dd($next_serial_number);




            foreach ($request->farm_id as $index => $farmId) {
                $farmId = (int) $farmId;
                // Increment serial number for each subscription entry
                $next_serial_number = str_pad($last_serial_number + 1, 4, '0', STR_PAD_LEFT);
                $last_serial_number++;

                // Generate unique subscription code for each farm
                $subscriptionCode = "KS/{$firstName}/{$financialYear}/{$next_serial_number}";


                // $startsAt = \Carbon\Carbon::parse($request->subscription_date)->format('Y-m-d H:i:s');
                $startsAt = Carbon::parse($request->subscription_date)
                    ->setTime(now()->hour, now()->minute, now()->second) // Current server time set karega
                    ->format('Y-m-d H:i:s');

                $subscribableType = $request->subscribable_type[$index];
                $subscribableId = $request->subscription_id[$index];

                // dd($startsAt);

                // 🔹 Determine Model Class and Fetch Item Name
                if ($subscribableType === 'package') {
                    $modelClass = PackageMasterModel::class;
                    $item = PackageMasterModel::find($subscribableId);
                } elseif ($subscribableType === 'premium service') {
                    $modelClass = ServiceMasterModel::class;
                    $item = ServiceMasterModel::find($subscribableId);
                } else {
                    $modelClass = null;
                    $item = null;
                }


                // dd($modelClass);
                $item_name = $item ? $item->name : 'Unknown Name';
                // =======================note OLD code=========================

                // if ($request->subscription_status[$index] === 'active') {
                //     $api_key = env('SATYUKT_API_KEY');
                //     $Farm_paid_url = "https://micro.satyukt.com/unlock_farmid_app?farm_id={$farmId}&lockstatus=Unlock&key={$api_key}";
                //     $farm_paid_response = Http::get($Farm_paid_url);

                //     // ✅ Single condition check
                //     if ($farm_paid_response->successful() && ($farm_paid_response->json()['status'] ?? '') === 'success') {
                //         FarmModel::where('farm_id', $farmId)->update(['status' => 'Paid']);
                //     } else {
                //         throw new \Exception("API request failed for farm $farmId: " . json_encode($farm_paid_response->json()));
                //     }
                // }

                if ($request->subscription_status[$index] === 'active') {
                    $api_key = env('SATYUKT_API_KEY');
                    $Farm_paid_url = "https://micro.satyukt.com/unlock_farmid_app?farm_id={$farmId}&lockstatus=Unlock&key={$api_key}";

                    Log::info("Calling Satyukt API for farm {$farmId}", ['url' => $Farm_paid_url]);

                    $farm_paid_response = Http::get($Farm_paid_url);

                    Log::info("Satyukt API response for farm {$farmId}", [
                        'status_code' => $farm_paid_response->status(),
                        'body' => $farm_paid_response->json()
                    ]);

                    $responseBody = $farm_paid_response->json();
                    $status = $responseBody['status'] ?? '';
                    $message = strtolower($responseBody['mesage'] ?? '');

                    // ✅ Success if status is "success" OR message says "already unlock"
                    if (
                        $farm_paid_response->successful() &&
                        ($status === 'success' || str_contains($message, 'already unlock'))
                    ) {
                        FarmModel::where('farm_id', $farmId)->update(['status' => 'Paid']);
                        Log::info("Farm {$farmId} marked as Paid");
                    } else {
                        Log::error("Satyukt API failed for farm {$farmId}", [
                            'response' => $responseBody
                        ]);

                        throw new \Exception("API request failed for farm {$farmId}: " . json_encode($responseBody));
                    }
                }



                // 🔹 Fetch Duration Correctly
                // $durationColumn = ($subscribableType === 'package') ? 'duration' : 'allowed_durations';
                $duration = $modelClass ? (int) $modelClass::where('id', $subscribableId)->value('duration') : 0;


                // 🔹 Fetch Package/Service Data
                $item = $modelClass ? $modelClass::find($subscribableId) : null;

                // 🔹 Get Duration Labels
                $duration = $item ? $item->duration_labels : [];

                $duration_val = is_array($duration) ? reset($duration) : $duration;
                // dd($duration_val);
                // 🔹 Calculate `expires_at`
                $expiresAt = ($duration > 0) ? \Carbon\Carbon::parse($startsAt)->addMonths((int) $duration_val)
                    ->setTime(now()->hour, now()->minute, now()->second) // Current server time set karega
                    ->format('Y-m-d H:i:s') : null;

                Log::info('Generated Subscription Code', [
                    'subscription_code' => $subscriptionCode,
                    'farm_id' => $farmId,
                    'subscribable_type' => $subscribableType,
                    'subscribable_id' => $subscribableId,
                    'starts_at' => $startsAt,
                    'duration' => $duration,
                    'expires_at' => $expiresAt
                ]);

                // 🔹 Fetch Farm Name
                $farm_data = FarmModel::where('farm_id', $farmId)->first();
                // dd($startsAt, $expiresAt);

                $farm_name = $farm_data ? $farm_data->name : 'Unknown Farm';

                // 🔹 Store Subscription Data
                $subscriptions[] = [
                    'subscription_code' => $subscriptionCode,
                    'subscription_date' => $startsAt,
                    'farm_id' => $farmId,
                    'subscribable_type' => $modelClass,
                    'subscribable_id' => $subscribableId,
                    'amount' => $request->amount[$index],
                    'duration' => 0,
                    'starts_at' => $startsAt,
                    'expires_at' => $expiresAt,
                    'created_by' => 'Admin',
                    'status' => $request->subscription_status[$index],
                    'payment_status' => $request->payment_status[$index],
                    'remark' => $request->remark,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // 🔹 Prepare Items Data
                $items[] = [
                    'farm_id' => $farmId,
                    'farm_name' => $farm_name,
                    'item_type' => $modelClass,
                    'item_id' => $subscribableId,
                    'quantity' => 1,
                    'amount' => $request->amount[$index],
                    'item_name' => $item_name
                ];
            }

            // dd($subscriptions);

            Log::info("Final Subscription Data Before Saving", $subscriptions);
            // dd($subscriptions);
            // 🔹 Save all subscriptions in one go & Get Inserted IDs
            SubscriptionModel::insert($subscriptions);
            $sub_ids = SubscriptionModel::whereIn('subscription_code', collect($subscriptions)->pluck('subscription_code'))->pluck('id')->toArray();


            // ✅ Calculate Sum of Subscription IDs
            $subscription_sum = array_sum($sub_ids);
            $unique_subscription_id = 'sub' . $subscription_sum; // "sub33" if sum is 33

            // dd($unique_subscription_id); // Debugging to check value
            // 🔹 Store Payment Data
            $payment = PaymentTransaction::where('user_id', $request->user_id)
                ->where('gateway_name', 'Admin')
                ->first();
            // dd($payment);

            if ($payment) {
                $total_ = $request->total_amount + $payment->amount;
                $payment->update([
                    'subscription_id' => $unique_subscription_id, // ✅ Updating subscription_id
                    'amount' => $total_,
                    'transaction_id' => $request->transaction_id,
                    'currency' => 'INR',
                    'payment_method' => $request->payment_mode,
                    'gateway_name' => 'Admin',
                    'receipt' => null,
                    'status' => $request->status,
                    'items' => $items,
                ]);
            } else {
                PaymentTransaction::create([
                    'subscription_id' => $unique_subscription_id,
                    'user_id' => $request->user_id,
                    'amount' => $request->total_amount,
                    'transaction_id' => $request->transaction_id,
                    'currency' => 'INR',
                    'payment_method' => $request->payment_mode,
                    'gateway_name' => 'Admin',
                    'receipt' => null,
                    'status' => $request->status,
                    'items' => $items,
                ]);
            }

            DB::commit();

            return redirect()->route('subscription.index')->with('success', 'Subscription saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // ✅ Rollback all changes if any farm fails

            $errorMessages = []; // Store error messages grouped by farm IDs

            // 🔹 Extract the error message
            $errorMessage = $e->getMessage();

            // ✅ Check if JSON error message exists
            preg_match('/{.*}/', $errorMessage, $matches);

            if (!empty($matches)) {
                $decodedMessage = json_decode($matches[0], true);
                if (isset($decodedMessage['message'])) {
                    $messageText = $decodedMessage['message']; // Extract the relevant error text

                    // Group farm IDs with the same error message
                    $errorMessages[$messageText][] = $farmId;
                }
            } else {
                // ✅ If no structured error is found, store raw error message
                $errorMessages["General Error"][] = $farmId;
            }

            // 🔹 Format error messages correctly
            $formattedErrors = [];
            foreach ($errorMessages as $message => $farms) {
                $formattedErrors[] = "Farm " . implode(',', $farms) . ": " . $message;
            }

            // 🔹 Final error message string
            $finalErrorMessage = "Failed to save subscription: " . implode(" | ", $formattedErrors);

            Log::error('Subscription Save Error', [
                'message' => $finalErrorMessage,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('subscription.index')->with('error', $finalErrorMessage);
        }
    }







    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            // Subscription Data
            $userId = $id;

            $subscription_data = SubscriptionModel::with(['farms.user', 'farms', 'farms.user.paymentTransactions'])
                ->whereHas('farms', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->latest()
                ->first();


            // dd($subscription_data);
            $payments = PaymentTransaction::where('user_id', $id)->get();
            $payment_total_amt = PaymentTransaction::where('user_id', $id)->sum('amount');

            $subscriptions = SubscriptionModel::with('farms') // Eager load farms
                ->whereHas('farms', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->where('created_by', "Admin")
                ->get();

            // dd($payments);


            // Determine Subscription Type and Duration
            foreach ($subscriptions as $subscription) {
                if ($subscription->subscribable_type == 'App\Models\PackageMasterModel') {
                    $sub_type = PackageMasterModel::where('id', $subscription->subscribable_id)->first();
                    // dd($subscription->subscribable_id);
                    $type_datas = PackageMasterModel::where('status', 'inactive')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                } elseif ($subscription->subscribable_type == 'App\Models\ServiceMasterModel') {
                    $sub_type = ServiceMasterModel::where('id', $subscription->subscribable_id)->first();
                    $type_datas = ServiceMasterModel::where('status', 'active')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                } else {
                    $sub_type = ServiceMasterModel::where('id', $subscription->subscribable_id)->first();
                    $type_datas = ServiceMasterModel::where('status', 'active')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                }

                // Merge id & name directly into the subscription object
                $subscription->subscribable_id = $sub_type->id ?? null;
                $subscription->subscribable_name = $sub_type->name ?? null;
                // $subscription->sub_duration = $service_duration ?? null;
                $subscription->sub_duration = $sub_type ? ($sub_type->duration_labels[0] ?? null) : null;
            }
            // No need to use `array_merge()` here


            // dd($subscription_data);

            return view('dashboard.farmer_subscription.view', compact(
                'subscription_data',
                'payment_total_amt',
                'payments',
                'subscriptions',
            ));
        } catch (\Exception $e) {
            Log::error('Subscription show Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()->route('subscription.index')
                ->with('error', 'Failed to load subscription show page.');
        }
    }
    public function user_show(string $id)
    {
        try {

            // Subscription Data
            $userId = $id;

            $subscription_data = SubscriptionModel::with(['farms.user', 'farms', 'farms.user.paymentTransactions'])
                ->whereHas('farms', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->latest()
                ->first();


            // dd($subscription_data);
            $payments = PaymentTransaction::where('user_id', $id)->get();
            $payment_total_amt = PaymentTransaction::where('user_id', $id)->sum('amount');

            $subscriptions = SubscriptionModel::with('farms') // Eager load farms
                ->whereHas('farms', function ($query) use ($userId) {
                    $query->where('user_id', $userId)
                        ->whereHas('user.paymentTransactions', function ($q) {
                            $q->where('gateway_name', 'razorpay');
                        });
                })
                ->where('created_by', null)
                ->get();


            // dd($payments);


            // Determine Subscription Type and Duration
            foreach ($subscriptions as $subscription) {
                if ($subscription->subscribable_type == 'App\Models\PackageMasterModel') {
                    $sub_type = PackageMasterModel::where('id', $subscription->subscribable_id)->first();
                    // dd($subscription->subscribable_id);
                    $type_datas = PackageMasterModel::where('status', 'inactive')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                } elseif ($subscription->subscribable_type == 'App\Models\ServiceMasterModel') {
                    $sub_type = ServiceMasterModel::where('id', $subscription->subscribable_id)->first();
                    $type_datas = ServiceMasterModel::where('status', 'active')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                } else {
                    $sub_type = ServiceMasterModel::where('id', $subscription->subscribable_id)->first();
                    $type_datas = ServiceMasterModel::where('status', 'active')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                }

                // Merge id & name directly into the subscription object
                $subscription->subscribable_id = $sub_type->id ?? null;
                $subscription->subscribable_name = $sub_type->name ?? null;
                // $subscription->sub_duration = $service_duration ?? null;
                $subscription->sub_duration = $sub_type ? ($sub_type->duration_labels[0] ?? null) : null;
            }
            // No need to use `array_merge()` here


            // dd($subscription_data);

            return view('dashboard.farmer_subscription.mobile_view', compact(
                'subscription_data',
                'payment_total_amt',
                'payments',
                'subscriptions',
            ));
        } catch (\Exception $e) {
            Log::error('Subscription show Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()->route('subscription.index')
                ->with('error', 'Failed to load subscription show page.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit($id)
    {
        try {
            $farmers = User::where('user_status', 'active')->get();
            $user = User::where('id', $id)->orderByDesc('id')->first();
            // $subscription = SubscriptionModel::with(['farms.user'])->findOrFail($id);
            $userId = $id;
            $subscription_data = SubscriptionModel::whereHas('farms', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->first();

            // dd($payment);
            $subscriptions = SubscriptionModel::with('farms') // Eager load farms
                ->whereHas('farms', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->where('created_by', "Admin")
                ->orderByDesc('updated_at')
                ->get();

            // dd($subscriptions);

            $sum_id = $subscriptions->sum('id');
            $uniq_id = 'sub' . $sum_id;
            $payment = PaymentTransaction::where('user_id', $id)
                // ->where('subscription_id', $uniq_id)
                ->first();
            // dd($payment);

            // Determine Subscription Type
            $old_farIds = [];
            $sub_type = [];
            $type_datas = [];
            $service_duration = [];
            foreach ($subscriptions as $subscription) {
                if ($subscription->subscribable_type == 'App\Models\PackageMasterModel') {
                    $sub_type = PackageMasterModel::where('id', $subscription->subscribable_id)->first();
                    // dd($subscription->subscribable_id);
                    $type_datas = PackageMasterModel::where('status', 'inactive')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                } elseif ($subscription->subscribable_type == 'App\Models\ServiceMasterModel') {
                    $sub_type = ServiceMasterModel::where('id', $subscription->subscribable_id)->first();
                    $type_datas = ServiceMasterModel::where('status', 'active')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                } else {
                    $sub_type = ServiceMasterModel::where('id', $subscription->subscribable_id)->first();
                    $type_datas = ServiceMasterModel::where('status', 'active')->get();
                    $service_duration = $sub_type->getDurationLabelsAttribute();
                }

                // Merge id & name directly into the subscription object
                $subscription->subscribable_id = $sub_type->id ?? null;
                $subscription->subscribable_name = $sub_type->name ?? null;
                // $subscription->sub_duration = $service_duration ?? null;
                $subscription->sub_duration = $sub_type ? ($sub_type->duration_labels[0] ?? null) : null;
                $old_farIds[] = $subscription->farm_id;
            }
            // dd($old_farIds);
            // dd($subscriptions ); 

            // dd($sub_type, $subscription->subscribable_type);
            // Fetch Farm Data with Relationship
            // dd($farm);
            return view('dashboard.farmer_subscription.edit', [
                'user' => $user,
                'old_farIds' => $old_farIds,
                'uniq_id' => $uniq_id,
                'userId' => $userId,
                'payment' => $payment,
                'subscription_data' => $subscription_data,
                'subscriptions' => $subscriptions,
                'farmers' => $farmers,
                'sub_type' => $sub_type,
                'type_datas' => $type_datas,
                'service_duration' => $service_duration,
            ]);
        } catch (\Exception $e) {
            Log::error('Subscription Edit Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()->route('subscription.index')
                ->with('error', 'Failed to load subscription edit page.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */


    public function update(Request $request, $id)
    {
        // dd($request);

        try {
            Log::info('Update method called', ['request' => $request->all()]);
            DB::beginTransaction();




            // 🔹 Fetch existing farm IDs from database
            $existingFarms = SubscriptionModel::whereIn('farm_id', $request->farm_id)
                ->pluck('farm_id')
                ->toArray();

            $oldFarms = $request->old_farm_id;
            // dd($oldFarms);

            // 🔹 Check if any existing farms are found before deleting
            if (!empty($oldFarms)) {
                SubscriptionModel::whereIn('farm_id', $oldFarms)->delete();
            }
            // dd($existingFarms);


            $subscriptions = [];
            $items = [];
            $user = User::find($request->user_id);
            $firstName = strtoupper(substr($user->name, 0, 1));
            $currentYear = now()->format('y');
            $nextYear = now()->addYear()->format('y');
            $financialYear = "{$currentYear}/{$nextYear}";

            $lastSubscription = SubscriptionModel::where('subscription_code', 'LIKE', "KS/%/{$financialYear}/%")
                ->orderByRaw("CAST(SUBSTRING_INDEX(subscription_code, '/', -1) AS UNSIGNED) DESC")
                ->first();

            $last_serial_number = $lastSubscription ? (int) substr($lastSubscription->subscription_code, -4) : 0;

            foreach ($request->farm_id as $index => $farmId) {
                $farmId = (int) $farmId;
                // Increment serial number for each subscription entry
                $next_serial_number = str_pad($last_serial_number + 1, 4, '0', STR_PAD_LEFT);
                $last_serial_number++;

                // Generate unique subscription code for each farm
                $subscriptionCode = "KS/{$firstName}/{$financialYear}/{$next_serial_number}";


                // $startsAt = \Carbon\Carbon::parse($request->subscription_date)->format('Y-m-d');
                $startsAt = Carbon::parse($request->subscription_date)
                    ->setTime(now()->hour, now()->minute, now()->second) // Current server time set karega
                    ->format('Y-m-d H:i:s');


                $subscribableType = $request->subscribable_type[$index];
                $subscribableId = $request->subscription_id[$index];

                // dd($subscriptionCode);

                // 🔹 Determine Model Class and Fetch Item Name
                if ($subscribableType === 'package') {
                    $modelClass = PackageMasterModel::class;
                    $item = PackageMasterModel::find($subscribableId);
                } elseif ($subscribableType === 'premium service') {
                    $modelClass = ServiceMasterModel::class;
                    $item = ServiceMasterModel::find($subscribableId);
                } else {
                    $modelClass = null;
                    $item = null;
                }


                // dd($modelClass);
                $item_name = $item ? $item->name : 'Unknown Name';

                $farm_data_status = FarmModel::where('farm_id', $farmId)->select('status')->first();

                // dd($farm_data_status);
                // if ($farm_data_status->status != 'Paid') {
                //     if ($request->subscription_status[$index] === 'active') {
                //         $api_key = env('SATYUKT_API_KEY');
                //         $Farm_paid_url = "https://micro.satyukt.com/unlock_farmid_app?farm_id={$farmId}&lockstatus=Unlock&key={$api_key}";
                //         $farm_paid_response = Http::get($Farm_paid_url);

                //         // ✅ Single condition check
                //         if ($farm_paid_response->successful() && ($farm_paid_response->json()['status'] ?? '') === 'success') {
                //             FarmModel::where('farm_id', $farmId)->update(['status' => 'Paid']);
                //         } else {
                //             throw new \Exception("API request failed for farm $farmId: " . json_encode($farm_paid_response->json()));
                //         }
                //     }
                // }
                if ($farm_data_status->status != 'Paid') {
                    if ($request->subscription_status[$index] === 'active') {
                        $api_key = env('SATYUKT_API_KEY');
                        $Farm_paid_url = "https://micro.satyukt.com/unlock_farmid_app?farm_id={$farmId}&lockstatus=Unlock&key={$api_key}";

                        Log::info("Calling Satyukt API for farm {$farmId}", ['url' => $Farm_paid_url]);

                        $farm_paid_response = Http::get($Farm_paid_url);

                        Log::info("Satyukt API response for farm {$farmId}", [
                            'status_code' => $farm_paid_response->status(),
                            'body' => $farm_paid_response->json()
                        ]);

                        $responseBody = $farm_paid_response->json();
                        $status = $responseBody['status'] ?? '';
                        $message = strtolower($responseBody['mesage'] ?? '');

                        // ✅ Success if status is "success" OR message says "already unlock"
                        if (
                            $farm_paid_response->successful() &&
                            ($status === 'success' || str_contains($message, 'already unlock'))
                        ) {
                            FarmModel::where('farm_id', $farmId)->update(['status' => 'Paid']);
                            Log::info("Farm {$farmId} marked as Paid");
                        } else {
                            Log::error("Satyukt API failed for farm {$farmId}", [
                                'response' => $responseBody
                            ]);

                            throw new \Exception("API request failed for farm {$farmId}: " . json_encode($responseBody));
                        }
                    }
                }

                $duration = $modelClass ? (int) $modelClass::where('id', $subscribableId)->value('duration') : 0;


                // 🔹 Fetch Package/Service Data
                $item = $modelClass ? $modelClass::find($subscribableId) : null;

                // 🔹 Get Duration Labels
                $duration = $item ? $item->duration_labels : [];

                $duration_val = is_array($duration) ? reset($duration) : $duration;
                // dd($duration_val);
                // 🔹 Calculate `expires_at`
                $expiresAt = ($duration > 0) ? \Carbon\Carbon::parse($startsAt)->addMonths((int) $duration_val)->setTime(now()->hour, now()->minute, now()->second) // Current server time set karega
                    ->format('Y-m-d H:i:s') : null;

                Log::info('Generated Subscription Code', [
                    'subscription_code' => $subscriptionCode,
                    'farm_id' => $farmId,
                    'subscribable_type' => $subscribableType,
                    'subscribable_id' => $subscribableId,
                    'starts_at' => $startsAt,
                    'duration' => $duration,
                    'expires_at' => $expiresAt
                ]);

                // 🔹 Fetch Farm Name
                $farm_data = FarmModel::where('farm_id', $farmId)->first();
                // dd($startsAt, $expiresAt);

                $farm_name = $farm_data ? $farm_data->name : 'Unknown Farm';

                // 🔹 Store Subscription Data
                $subscriptions[] = [
                    'subscription_code' => $subscriptionCode,
                    'subscription_date' => $startsAt,
                    'farm_id' => $farmId,
                    'subscribable_type' => $modelClass,
                    'subscribable_id' => $subscribableId,
                    'amount' => $request->amount[$index],
                    'duration' => 0,
                    'starts_at' => $startsAt,
                    'expires_at' => $expiresAt,
                    'created_by' => 'Admin',
                    'status' => $request->subscription_status[$index],
                    'payment_status' => $request->payment_status[$index],
                    'remark' => $request->remark,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // 🔹 Prepare Items Data
                $items[] = [
                    'farm_id' => $farmId,
                    'farm_name' => $farm_name,
                    'item_type' => $modelClass,
                    'item_id' => $subscribableId,
                    'quantity' => 1,
                    'amount' => $request->amount[$index],
                    'item_name' => $item_name
                ];
            }
            // dd($request);
            // dd($existingFarms);

            // dd($subscriptions);

            SubscriptionModel::insert($subscriptions);
            $sub_ids = SubscriptionModel::whereIn('subscription_code', collect($subscriptions)->pluck('subscription_code'))->pluck('id')->toArray();

            // dd($sub_ids);
            // ✅ Calculate Sum of Subscription IDs
            $subscription_sum = array_sum($sub_ids);
            $unique_subscription_id = 'sub' . $subscription_sum; // "sub33" if sum is 33
            // dd($unique_subscription_id);


            // 🔹 Store & U_pdate Payment Data

            $payment = PaymentTransaction::where('user_id', $request->user_id)
                ->where('gateway_name', 'Admin')
                ->first();
            // dd($payment);

            if ($payment) {
                $payment->update([
                    'subscription_id' => $unique_subscription_id, // ✅ Updating subscription_id
                    'amount' => $request->total_amount,
                    'transaction_id' => $request->transaction_id,
                    'currency' => 'INR',
                    'payment_method' => $request->payment_mode,
                    'gateway_name' => 'Admin',
                    'receipt' => null,
                    'status' => $request->status,
                    'items' => $items,
                ]);
            }




            DB::commit();

            return redirect()->route('subscription.index')->with('success', 'Subscription update successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // ✅ Rollback all changes if any farm fails

            // 🔹 Maintain an array for all errors
            $errorMessages = [];

            // ✅ Extract error message
            $errorMessage = $e->getMessage();

            // ✅ Use regex to extract farm ID and JSON message
            preg_match_all('/farm (\d+): (\{.*?\})/', $errorMessage, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                foreach ($matches as $match) {
                    $farmId = $match[1]; // Extract farm ID
                    $jsonPart = $match[2]; // Extract JSON error message

                    $decodedMessage = json_decode($jsonPart, true);
                    if (isset($decodedMessage['message'])) {
                        $errorMessages[] = "Farm $farmId: " . $decodedMessage['message'];
                    }
                }
            } else {
                // ✅ If no structured error is found, store raw error message
                $errorMessages[] = "General Error: " . $errorMessage;
            }

            // ✅ Debugging: Check if errors are captured

            Log::error('Subscription update Errors', [
                'errors' => $errorMessages,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            // 🔹 Convert errors into a readable format
            $finalErrorMessage = "Failed to update subscription:" . implode($errorMessages);

            // dd($finalErrorMessage);
            return redirect()->route('subscription.index')->with('error', $finalErrorMessage);
        }
    }



    public function destroy(string $id)
    {
        //
    }

    public function farmer_subscription_get_data(Request $request)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        // Fetch farms based on farmer_id
        $farmer_data = User::where('id', $request->user_id)->first(['email', 'mobile']);
        $farms = FarmModel::where('user_id', $request->user_id)
            // ->where('status', 'Paid')
            ->get(['id', 'farm_id', 'name']);
        // Return JSON response
        return response()->json([
            'farmer_data' => $farmer_data,
            'farms' => $farms,
        ]);
    }
    public function get_farm_area(Request $request)
    {
        // Validate input
        $request->validate([
            'farm_id' => 'required|integer',
        ]);

        // Fetch farms based on farmer_id
        $farms = FarmModel::where('farm_id', $request->farm_id)->first(['area']);

        // dd($farms);
        // Return JSON response
        return response()->json([
            'farms' => $farms,
        ]);
    }
    public function get_package_data()
    {
        // Fetch farms based on farmer_id
        $packages = PackageMasterModel::where('status', 'active')
            ->whereNot('name', ['Free Services']) // Filter for only two services
            ->whereNot('name', ['Free Package']) // Filter for only two services
            ->orderByDesc('id')
            ->get(['id', 'name']);

        // Return JSON response
        return response()->json([
            'packages' => $packages,
        ]);
    }
    // public function get_service_data()
    // {
    //     // Fetch farms based on farmer_id
    //     $services = ServiceMasterModel::where('status', 'active')->
    //         where('service_type', 'premium')->
    //         get(['id', 'name']);

    //     // Return JSON response
    //     return response()->json([
    //         'services' => $services,
    //     ]);
    // }

    public function get_service_data()
    {
        // Fetch only the two specific services
        $services = ServiceMasterModel::where('status', 'active')
            ->where('service_type', 'premium')
            ->whereIn('name', ['Soil Nutrient Analysis', 'Image-Based Diagnosis']) // Filter for only two services
            ->orderByDesc('id')
            ->get(['id', 'name']);

        // Return JSON response
        return response()->json([
            'services' => $services,
        ]);
    }


    public function get_freeservice_data()
    {
        // Fetch farms based on farmer_id
        $freeservices = ServiceMasterModel::where('status', 'active')->where('service_type', 'free')->get(['id', 'name']);

        // Return JSON response
        return response()->json([
            'freeservices' => $freeservices,
        ]);
    }
    public function get_packageduration_data(Request $request)
    {
        // Fetch package based on package_id
        $package = PackageMasterModel::where('status', 'active')
            ->where('id', $request->package_id)
            ->first(['duration', 'status', 'amount']);

        // Check if package exists
        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

        // Return JSON response with `packagesduration` key
        return response()->json([
            'packagesduration' => [
                'duration' => $package->duration, // Raw JSON array
                'duration_labels' => $package->duration_labels, // ✅ Readable format
                'amount' => $package->amount,
                'status' => $package->status,
            ],
        ]);
    }

    public function get_serviceduration_data(Request $request)
    {
        // Fetch farms based on services_id
        $serviceduration = ServiceMasterModel::where('status', 'active')
            ->where('id', $request->services_id)
            ->first(['duration', 'status', 'amount']);
        // Return JSON response
        // dd($serviceduration);
        return response()->json([
            'serviceduration' => $serviceduration->getDurationLabelsAttribute(),
            'status' => $serviceduration->status,
            'amount' => $serviceduration->amount,
        ]);
    }
    public function get_freeduration_data(Request $request)
    {
        // Fetch farms based on services_id
        $freeserviceduration = ServiceMasterModel::where('status', 'active')
            ->where('service_type', 'free')
            ->where('id', $request->services_id)
            ->first(['duration', 'status', 'amount']);

        // Return JSON response
        // dd($serviceduration);
        return response()->json([
            'freeserviceduration' => $freeserviceduration->getDurationLabels(),
            'status' => $freeserviceduration->status,
            'amount' => $freeserviceduration->amount,

        ]);
    }

    public function farm_subscriptions(Request $request)
    {
        $sub_id = $request->sub_id;
        $status = $request->status;

        // dd($status);
        // Fetch the subscription data
        $SubscriptionModel_data = SubscriptionModel::where('id', $sub_id)->first();

        // Check if subscription exists
        if (!$SubscriptionModel_data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Subscription data not found.',
            ]);
        }

        // Ensure status is a valid string
        $allowedStatuses = ['active', 'inactive'];
        if (!in_array($status, $allowedStatuses)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid status value.',
            ]);
        }

        // Update the subscription status
        SubscriptionModel::where('id', $sub_id)->update(['status' => (string) $status]);

        // Set message based on status
        $message = ($status === 'active') ? 'Subscription activated successfully.' : 'Subscription deactivated successfully.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    public function package_dupplicate(Request $request)
    {

        // Fetch the farm details along with the user_id
        $subscriptions = SubscriptionModel::with(['farms.user'])
            ->where('farm_id', $request->farm_id)
            ->where('subscribable_id', $request->subscribable_id)
            // ->where('status', 'active')
            ->first();


        // dd($subscriptions);
        // Get user_id associated with the farm
        $user_id = $subscriptions->farms->user_id ?? null;

        // Return the data
        return response()->json([
            'user_id' => $user_id,
            'subscriptions' => $subscriptions,
        ]);
    }
    public function existing_subscription(Request $request)
    {

        // Fetch the farm details along with the user_id
        $subscriptions = SubscriptionModel::with(['farms.user'])
            ->where('farm_id', $request->farm_id)
            ->where('status', 'active')
            ->first();
        if ($subscriptions) {

            if ($subscriptions->subscribable_type === 'App\Models\ServiceMasterModel') {
                $package_name = ServiceMasterModel::where('id', $subscriptions->subscribable_id)->first();
            } else {
                $package_name = PackageMasterModel::where('id', $subscriptions->subscribable_id)->first();
            }
        } else {

            $package_name = null;
        }
        // dd($package_name);


        // Return the data
        return response()->json([
            'subscriptions' => $subscriptions,
            'package_name' => $package_name,
        ]);
    }
    public function checkpackage_service_name(Request $request)
    {
        // dd($request);
        if ($request->type === 'package') {
            $subscription_name = PackageMasterModel::where('id', $request->subscribable_id)->first();
        } else {
            $subscription_name = ServiceMasterModel::where('id', $request->subscribable_id)->first();
        }

        // dd($subscription_name);

        // Return the data
        return response()->json([
            'subscription_name' => $subscription_name,
        ]);
    }
    public function premiumvalue(Request $request)
    {
        $pack_name = PackageMasterModel::where('id', $request->subscribable_id)->first();
        if ($pack_name) {
            $pack_data = $pack_name;
        } else {
            $pack_data = null;
        }

        // dd($pack_data);

        // Return the data
        return response()->json([
            'pack_data' => $pack_data,
        ]);
    }
}
