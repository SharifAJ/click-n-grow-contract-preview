<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'farm_id',
        'user_id',
        'subscription_id', // not a foreign key
        'transaction_id',  // internal order id we sent to gateway razorpay
        'gateway_transaction_id', // external id recieved from razorpay
        'gateway_name',
        'amount', 
        'currency', // Nullable
        'payment_method', // Nullable
        'payment_method_details', // Nullable
        'discount',
        'status',
        // 'item_type', // Nullable
        // 'item_id', // Nullable
        'receipt', // Nullable, added for Razorpay receipt
        'items',   // Nullable, added to store cart items with farm_id
        'gateway_response', // Nullable
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'payment_method_details' => 'json',
        // 'gateway_response' => 'json',
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'items' => 'array', // Store cart items as JSON
        'payment_method_details' => 'array',
        'gateway_response' => 'array',
    ];

    /**
     * Get the user associated with the payment transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the subscription associated with the payment transaction.
     */
    public function subscription()
    {
        return $this->belongsTo(SubscriptionModel::class);
    }

    /**
     * Get the associated item (service or package).
     */
    public function item()
    {
        return $this->morphTo();
    }
}

/* DOCS:
? Creating a Payment Transaction
$payment = PaymentTransaction::create([
    'user_id' => 1,
    'subscription_id' => 123,
    'transaction_id' => 'txn_123456',
    'gateway_transaction_id' => 'gateway_txn_789',
    'gateway_name' => 'Razorpay',
    'amount' => 100.50,
    'currency' => 'INR',
    'payment_method' => 'upi',
    'payment_method_details' => ['upi_id' => 'john@upi'],
    'status' => 'success',
    'discount' => 10.50,
    'item_type' => 'App\Models\Service', // or 'App\Models\Package'
    'item_id' => 1,
    'gateway_response' => ['response' => 'success', 'code' => '200'],
]);

? UPDATE: Updating a Payment Transaction
$payment = PaymentTransaction::find(1);
$payment->update(['status' => 'refunded']);

? Retrieving Payment Details with Relationships
$payment = PaymentTransaction::with(['user', 'subscription', 'item'])->find(1);

Accessing details
echo $payment->user->name; // User who made the payment
echo $payment->subscription->discount; // Discount from subscription
echo $payment->item->name; // Name of the service or package
*/