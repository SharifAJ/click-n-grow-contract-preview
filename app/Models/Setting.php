<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_name',
        'company_address',
        'company_email',
        'phone_number',
        'about_us',
        'application_logo',
    ];

    /** 
     * These will automatically be set on a fresh model
     * and used whenever the column is null in the DB.
     */
    protected $attributes = [
        'application_name' => 'Kisan Sat',
        'company_address'  => 'eKisanZone, C/17-18, Dakshata Nagar Complex…',
        'company_email'    => 'kisansatapp@gmail.com',
        'phone_number'     => '9096248660',
        'about_us'         => 'Satellite-based farm monitoring helps…',
        'application_logo' => 'settings/kisansat-main-logo.webp',
    ];
}
