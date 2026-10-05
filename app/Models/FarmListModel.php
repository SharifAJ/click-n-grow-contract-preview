<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmListModel extends Model
{
    use HasFactory;
    protected $table = 'farm_list';
    protected $fillable = [
        'farm_id',
    ];
}
