<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAssociate extends Model
{
    protected $table = 'business_associates';
    
    protected $fillable = [
        'full_name',
        'company_name',
        'mobile',
        'email',
        'state_district',
        'experience',
        'operating_area',
        'network_type',
        'reason',
        'resume',
        'preferred_contact',
    ];
}
