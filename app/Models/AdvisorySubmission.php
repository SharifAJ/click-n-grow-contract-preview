<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdvisoryResponse;
use DateTimeInterface;

class AdvisorySubmission extends Model
{
    protected $fillable = [
        'farm_id',
        'img_id',
        'image_file_name',
        'audio_file_name',
        'croptype',
        'comment',
        'status'
    ];

    protected $attributes = ['status' => 'pending'];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    // Relationship
    public function response()
    {
        return $this->hasOne(AdvisoryResponse::class, 'submission_id');
    }

    public static function canUpload($farmId)
    {
        return self::where('farm_id', $farmId)->count() < 5;
    }

    // public function response()
    // {
    //     return $this->hasOne(AdvisoryResponse::class, 'farm_id', 'farm_id')
    //                 ->where('img_id', $this->img_id);
    // }

    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'farm_id');
    }
}
