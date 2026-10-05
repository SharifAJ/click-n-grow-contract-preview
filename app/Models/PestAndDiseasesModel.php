<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PestAndDiseasesModel extends Model
{
    use HasFactory;

    protected $table = 'pest_and_diseases';

    protected $fillable = [
        'farm_id',
        'language', 
        'crop_name',
        'date',
        'start_date',
        'end_date',
        'affected_part',
        'disease',
        'disease_img_urls',
        'pest',
        'pest_img_urls',
        'mode_of_spread',
        'pathogen',
        'solution',
        'stage_of_infection',
        'symptoms',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'disease_img_urls' => 'array',
        'pest_img_urls' => 'array',
        'symptoms' => 'array',
        'language' => 'string',
    ];

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

    // Parse and set the date range
    public function setDateRangeAttribute($value)
    {
        [$startDate, $endDate] = explode(' to ', $value);

        $this->attributes['start_date'] = Carbon::createFromFormat('d-M-Y', trim($startDate))->format('Y-m-d');
        $this->attributes['end_date'] = Carbon::createFromFormat('d-M-Y', trim($endDate))->format('Y-m-d');
    }
}
