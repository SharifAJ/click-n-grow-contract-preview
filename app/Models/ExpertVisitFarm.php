<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpertVisitFarm extends Model
{
    protected $connection = 'expert_visits';

    protected $fillable = [
        'village',
        'taluka',
        'district',
        'state',
        'pincode',
        'mobile',
        'area_acres',
    ];

    protected function casts(): array
    {
        return [
            'area_acres' => 'decimal:2',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(ExpertVisitRegistration::class, 'registration_id');
    }
}
