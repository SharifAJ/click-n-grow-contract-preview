<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLogModel extends Model
{
    protected $fillable = [
        'user_id',
        'error_type',
        'error_message',
        'request_data',
        'api_response',
        'farm_id'
    ];

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

}
