<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IrrigationDataModel extends Model
{
    use HasFactory;
    
    protected $table = 'irrigation_data';
    
    protected $fillable = [
        'farm_id',
        'irrigation_date',
        'type',
        'gross_irrig',
        'irrig_freq',
        'data_fetched_at'
    ];

    protected $casts = [
        'irrigation_date' => 'date:Y-m-d',
        'data_fetched_at' => 'datetime',
        'gross_irrig' => 'decimal:2',
    ];
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

}