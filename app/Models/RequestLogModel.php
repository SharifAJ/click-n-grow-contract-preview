<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLogModel extends Model
{
    protected $table = 'request_logs';
    protected $fillable = [
        'user_id',
        'service_name', 
        'request_method', 
        'request_url',
        'request_data',
        'response_status',
        'response_data',
        'is_successful',
        'error_message',
        'farm_id',
        'execution_time'
    ];

    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array'
    ];
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

}
