<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilReportModel extends Model
{
    protected $table = 'soil_report';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'farm_id',
        'csv',
        'pdf',
        'recommendation',
        'remark',
        'more_Info',
        // PNG fields
        'png_K', 'png_N', 'png_OC', 'png_P', 'png_pH',
        // Statistics fields
        'statistics_K', 'statistics_N', 'statistics_OC', 'statistics_P', 'statistics_pH',
        // XYZ fields
        'xyz_K', 'xyz_N', 'xyz_OC', 'xyz_P', 'xyz_pH'
    ];

    protected $casts = [
        'csv' => 'array',
        'pdf' => 'array',
        'recommendation' => 'array',
        'more_Info' => 'array',
    ];
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

}
