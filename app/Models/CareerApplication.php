<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    protected $fillable = [
        'full_name', 'mobile_number', 'email', 'city_state', 'position',
        'highest_qualification', 'specialization', 'work_experience',
        'resume_path', 'privacy_consent',
    ];

    protected $casts = [
        'privacy_consent' => 'boolean',
    ];
}
