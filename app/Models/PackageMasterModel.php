<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageMasterModel extends Model
{
    protected $table = 'package_masters';
    protected $appends = ['duration_labels'];

    protected $fillable = [
        'name',
        'description',
        'duration', // JSON array, stored in days (e.g., [30, 90, 180, 365, 0, -1])
        'amount',
        'status',
    ];

    protected $casts = [
        'duration' => 'array', // ✅ Ensure duration is always an array
        'amount' => 'float',
    ];

    /**
     * Get duration labels.
     *
     * @return array
     */
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
            : json_decode($this->duration, true) ?? [];

        return array_map(function ($duration) use ($labels) {
            return $labels[$duration] ?? "{$duration} Days";
        }, $durations);
    }

    /**
     * Get all services included in this package.
     */
    public function services()
    {
        return $this->belongsToMany(ServiceMasterModel::class, 'package_service', 'package_id', 'service_id');
    }

    /**
     * Get all subscriptions for this package (polymorphic relationship).
     */
    public function subscriptions()
    {
        return $this->morphMany(SubscriptionModel::class, 'subscribable');
    }

    public function payments()
    {
        return $this->morphMany(PaymentTransaction::class, 'item');
    }
}

/* DOCS:
? To get all subscriptions for a package
$package = PackageMasterModel::find(1);
$subscriptions = $package->subscriptions;

? To create a subscription for a package:
$package = PackageMasterModel::find(1);
$subscription = new SubscriptionModel([
    'duration' => '6',
    'starts_at' => now(),
    'expires_at' => now()->addMonths(6),
    'status' => 'active',
    'payment_status' => 'paid',
]);
$package->subscriptions()->save($subscription);

*/