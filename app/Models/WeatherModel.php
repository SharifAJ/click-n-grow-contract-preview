<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherModel extends Model
{
    use HasFactory;
    protected $table = 'weather';
    protected $fillable = [
        'farm_id',
        'wind_speed',
        'cloud_cover',
        'narrative',
        'precip_chance',
        'precip_type',
        'qpf',
        'relative_humidity',
        'sunrise_time_local',
        'temperature',
        'thunder_category',
        'valid_time_utc',
        'wind_direction',
    ];

    protected $casts = [
        'temperature' => 'array',
        'sunrise_time_local' => 'datetime:Y-m-d H:i:s',
        'valid_time_utc' => 'datetime:Y-m-d H:i:s',
    ];

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }
}
