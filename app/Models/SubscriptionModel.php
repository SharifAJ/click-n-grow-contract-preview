<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionModel extends Model
{
    protected $table = 'subscriptions';
    protected $fillable = [
        'subscription_code',
        'farm_id',
        'subscribable_id', // e.g. 1, 2, 3
        'subscribable_type', // e.g., 'App\Models\ServiceMasterModel' or 'App\Models\PackageMasterModel'
        'duration',
        'starts_at',
        'expires_at',
        'subscription_date',
        'amount',
        'status',
        'created_by',
        'remark',
        'included_services',
        'payment_status', // pending, completed, cancelled, failed
    ];

    protected $casts = [
        'included_services' => 'array'
    ];

    // // Add this relationship to PackageMasterModel
    // public function package()
    // {
    //     return $this->belongsTo(PackageMasterModel::class, 'subscribable_id');
    // }

    // public function service()
    // {
    //     return $this->belongsTo(ServiceMasterModel::class, 'service_id');
    // }

    public function farms()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'farm_id');
    }

    public function scopeForService($query, $serviceId)
    {
        $query->where(function ($q) use ($serviceId) {
            $q->where([
                ['subscribable_type', ServiceMasterModel::class],
                ['subscribable_id', $serviceId]
            ])->orWhereJsonContains('included_services', $serviceId);
        });
    }

    /**
     * Get the parent subscribable model (either ServiceMaster or PackageMaster).
     */
    public function subscribable()
    {
        return $this->morphTo();
    }

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
            : (is_string($this->duration) ? json_decode($this->duration, true) : []);


        return array_map(function ($duration) use ($labels) {
            return $labels[$duration] ?? "{$duration} Days";
        }, $durations);
    }


    // ✅ Get the user through the farm
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            FarmModel::class,
            'id',    // Primary key in farms
            'id',    // Primary key in users
            'farm_id', // Foreign key in subscriptions table
            'user_id' // Foreign key in farms table
        );
    }

    // public function user()
    // {
    //     return $this->hasOneThrough(User::class, FarmModel::class, 'id', 'id', 'farm_id', 'user_id');

    //     // return $this->hasOneThrough(
    //     //     User::class,          // Final model (User)
    //     //     FarmModel::class,     // Intermediate model (Farm)
    //     //     'id',                 // Foreign key in FarmModel (Primary key of farms table)
    //     //     'id',                 // Foreign key in User (Primary key of users table)
    //     //     'farm_id',            // Foreign key in SubscriptionModel (farm_id)
    //     //     'user_id'             // Foreign key in FarmModel (user_id)
    //     // );

    // }

}


/** DOCS
 * ! Get Package or Service details easily
 * $subscription = SubscriptionModel::find($id);
 * Get package details (if applicable)
 * if ($subscription->subscribable_type === PackageMasterModel::class) {
 *     $package = $subscription->subscribable;
 * }
 *
 */
