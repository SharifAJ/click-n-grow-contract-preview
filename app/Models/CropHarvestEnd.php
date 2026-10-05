<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropHarvestEnd extends Model
{
    protected $primaryKey = 'crop';
    public $incrementing = false;
    protected $fillable = ['crop', 'last_day'];
}