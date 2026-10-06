<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpertVisitRegistration extends Model
{
    protected $connection = 'expert_visits';

    protected $fillable = [
        'reference',
        'name',
        'father_name',
        'surname',
        'mobile',
        'residential_village',
        'residential_taluka',
        'residential_district',
        'residential_state',
        'residential_pincode',
        'nearest_railway_station',
        'preferred_visit_date',
        'visit_days',
        'fee_per_day',
        'total_fee',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'terms_accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'preferred_visit_date' => 'date',
            'terms_accepted_at' => 'datetime',
            'fee_per_day' => 'integer',
            'total_fee' => 'integer',
            'visit_days' => 'integer',
        ];
    }

    public function farms(): HasMany
    {
        return $this->hasMany(ExpertVisitFarm::class, 'registration_id');
    }
}
