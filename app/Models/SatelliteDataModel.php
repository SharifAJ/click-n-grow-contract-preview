<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class SatelliteDataModel extends Model
{
    protected $table = 'satellite_data';
    protected $primaryKey = 'id';

    protected $fillable = [
        'farm_id',
        'date',
        'png_data',
        'tif_data',
        'zonal_stats'
    ];

    protected $casts = [
        'date' => 'timestamp', // Auto-convert UNIX timestamp to Carbon
        'png_data' => 'array',
        'tif_data' => 'array',
        'zonal_stats' => 'array',
        'file_paths' => 'array',
    ];


    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id');
    }

    protected static function booted()
    {
        static::updating(function ($model) {
            // Clean up old files when updating
            if ($model->isDirty('file_paths')) {
            $originalPaths = Arr::flatten($model->getOriginal('file_paths'));
            $newPaths = Arr::flatten($model->file_paths);

            $pathsToDelete = array_diff($originalPaths, $newPaths);

            foreach ($pathsToDelete as $path) {
                Storage::delete("satellite_data/{$path}");
            }
            }
        });

        static::deleting(function ($model) {
            // Delete all associated files
            $paths = Arr::flatten($model->file_paths);
            foreach ($paths as $path) {
                Storage::delete("satellite_data/{$path}");
            }
        });
    }
}