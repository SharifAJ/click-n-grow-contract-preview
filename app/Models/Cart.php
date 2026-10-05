<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'farm_id',
        'user_id',
        'cartable_id',
        'cartable_type',
        'quantity',
        'details'
    ];
    protected $casts = [
        'details' => 'array' // Add this for JSON storage
    ];

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

    public function cartable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
