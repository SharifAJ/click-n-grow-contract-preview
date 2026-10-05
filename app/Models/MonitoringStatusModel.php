<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonitoringStatusModel extends Model
{
    use HasFactory;

    protected $table = 'monitoring_status'; // ✅ table name

    protected $fillable = [
        'user_id',
        'farm_id',
        'service_type',
        'api_status',
        'error_message'
    ];

    /**
     * Get the user that owns this monitoring status.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');  
    }

    /**
     * Get the farm associated with this monitoring status.
     */
    public function farm(): BelongsTo
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');  
    }
}
