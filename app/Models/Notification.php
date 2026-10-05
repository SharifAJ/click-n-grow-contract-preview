<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',          // Keep as primary category
        'farm_id',       // Maintain farm reference
        'user_id',       // Target user
        'data',          // Firebase payload + custom data
        'read_at',       // Track user visibility
        'processed_at'   // Track backend processing
    ];

    protected $casts = [
        'data' => 'array',         // Store JSON payload
        'read_at' => 'datetime',   // Track when user reads
        'processed_at' => 'datetime' // Track backend handling
    ];


    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'farm_id');
    }

    public function getImgIdAttribute()
    {
        return $this->data['img_id'] ?? null; // use: $notification->img_id
    }
    

    // Scopes
    public function scopeUnprocessed($query)
    {
        return $query->whereNull('processed_at');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
