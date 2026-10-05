<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PackageMasterModel;
use App\Models\SubscriptionModel;

class ServiceMasterModel extends Model
{
    protected $table = 'service_masters';
    protected $appends = ['duration_labels'];

    protected $fillable = [
        'name', // text
        'duration', // JSON array, stored in days (e.g., [30, 90, 180, 365, 0, -1])
        'is_once', // boolean
        'description', // text
        'service_type', // premium/free
        'amount', // numbers
        'status' // active/inactive
    ];

    protected $casts = [
        'duration' => 'array', // Auto-convert JSON ↔ Array
        'is_once' => 'boolean',
        'amount' => 'float', 
    ];

    /**
     * Get all subscriptions for this service.
     */
    public function subscriptions()
    {
        return $this->morphMany(SubscriptionModel::class, 'subscribable');
    }

    public function packages()
    {
        return $this->belongsToMany(PackageMasterModel::class, 'package_service', 'service_id', 'package_id');
    }

    public function payments()
    {
        return $this->morphMany(PaymentTransaction::class, 'item');
    }

    public function getDurationLabelsAttribute()
    {
        $labels = [
            '30' => '1 Month',
            '90' => '3 Months',
            '180' => '6 Months',
            '365' => '12 Months',
            '-1' => 'Lifetime',
            '0' => 'Free',
        ];

        $durations = is_array($this->duration)
            ? $this->duration
            : json_decode($this->duration, true);

        return array_map(function ($duration) use ($labels) {
            return $labels[$duration] ?? "{$duration} Days";
        }, $durations ?? []);
    }
}


/* DOCS:
? To get all subscriptions for a service:
$service = ServiceMaster::find(1);
$subscriptions = $service->subscriptions;

? To create a subscription for a service
$service = ServiceMaster::find(1);
$subscription = new SubscriptionModel([
    'duration' => '1',
    'starts_at' => now(),
    'expires_at' => now()->addMonth(),
    'status' => 'active',
    'payment_status' => 'paid',
]);
$service->subscriptions()->save($subscription);
*/