<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvisoryResponse extends Model
{
    protected $fillable = [
        'submission_id', 
        'farm_id',
        'img_id',
        'SKU',
        'crop_name',
        'description',
        'disease_name',
        'disease_solution',
        'img_name',
        'nutrient_deficiency',
        'nutrient_management',
        'pest_name',
        'pest_solution',
        'status',
        'responded_at',  
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function submission()
    {
        return $this->belongsTo(AdvisorySubmission::class, 'submission_id');
    }

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'farm_id');
    }
}
