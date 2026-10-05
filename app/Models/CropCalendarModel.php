<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropCalendarModel extends Model
{

    use HasFactory;
    protected $table = 'crop_calendar';

    protected $fillable = [
        'farm_id',
        'crop',
        'range',
        'recommended',
        'status',
        'language'
    ];

    protected $attributes = [
        'language' => 'en'
    ];

    
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

}
