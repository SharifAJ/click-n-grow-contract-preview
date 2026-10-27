<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    protected $fillable = ['title', 'caption', 'image_path', 'is_published', 'sort_order'];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    public function getImageUrlAttribute(): string
    {
        return str_starts_with($this->image_path, 'images/')
            ? asset($this->image_path)
            : Storage::disk('public')->url($this->image_path);
    }
}
