<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApiUsageLog extends Model
{
    protected $table = 'api_usage_logs';

    public $timestamps = false; // Disable both timestamps

    protected $fillable = [
        'endpoint',
    ];
}
