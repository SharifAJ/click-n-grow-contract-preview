<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'icon',
        'name',
        'description',
        'details',
        'sowing_months',
        'pdf_en',
        'pdf_hi',
        'images',
    ];

    // Cast JSON columns to array automatically
    protected $casts = [
        'sowing_months' => 'array',
        'images' => 'array',
    ];
}
