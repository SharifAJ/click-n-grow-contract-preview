<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FPO extends Model
{
    protected $table = 'fpos';
    
    protected $fillable = [
        'group_name',
        'registration_number',
        'contact_person',
        'mobile',
        'email',
        'state_district_taluka',
        'number_of_farmers',
        'total_land',
        'current_crops',
        'interested_crops',
        'expected_start',
        'support',
        'group_profile',
        'remarks',
    ];

    protected $casts = [
        'support' => 'array',
        'interested_crops' => 'array',
    ];
}
