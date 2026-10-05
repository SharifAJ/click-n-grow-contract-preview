<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSetteliteModel extends Model
{   
    protected $table = 'test_settelite';
    protected $fillable = [
        'farm_id',
        'date',
        'png',
        'tif',
        'zonalStats',
    ];

    protected $casts = [
        'png' => 'array',
        'tif' => 'array',
        'zonalStats' => 'array',
    ];
}
