<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetrieveImagesModel extends Model
{
    use HasFactory;
    protected $table = 'retrieve_images';

    protected $fillable = [
        'comments',
        'farm_id',
        'image_id',
        'image_name',
        'image_url',
        'flag',
    ];
}
