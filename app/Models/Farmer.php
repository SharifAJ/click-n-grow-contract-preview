<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = [
        'full_name',
        'mobile',
        'email',
        'state_district',
        'village',
        'land_area',
        'irrigation',
        'land_type',
        'previous_crops',
        'interested_crops',
        'start_month',
        'preferred_support',
        'additional_comments',
    ];

    protected $casts = [
        'preferred_support' => 'array', // automatically cast JSON to array
    ];
}
