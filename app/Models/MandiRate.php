<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MandiRate extends Model
{
    use HasFactory;

    protected $table = 'mandi_rates';

    protected $fillable = [
        'state',
        'district',
        'market',
        'commodity',
        'variety',
        'grade',
        'arrival_date',
        'min_price',
        'max_price',
        'modal_price'
    ];

    protected $dates = ['arrival_date'];
}
