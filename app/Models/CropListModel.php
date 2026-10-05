<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropListModel extends Model
{
    use HasFactory;
    protected $table = 'crop_list';
    protected $fillable = [
        'crop_name',
    ];
}
