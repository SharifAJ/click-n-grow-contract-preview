<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmModel extends Model
{
    use HasFactory, SoftDeletes;  //Add the SoftDeletes trait and ensure the deleted_at column is included in the $dates or $casts array

    protected $table = 'farms';

    protected $fillable = [
        'user_id',
        'name',
        'croptype',
        'category',
        'sowingdate',
        'crop_variety',
        'area',
        'center',
        'district',
        'state',
        'geo_json',
        'geometry_type',
        'geo_json_properties',
        'geo_json_type',
        'type',
        'status',
        'last_satellite_api_check',
        'farm_id',
        'image'
        // 'expired_at'
    ];

    protected $casts = [
        'center' => 'array',
        'geo_json' => 'array',
        'geo_json_properties' => 'array',
        // 'expired_at' => 'datetime',
    ];

    // Mutator: Convert d-m-Y to Y-m-d for database storage
    protected function setSowingdateAttribute($value)
    {
        // If the date is already in Y-m-d format, use it directly
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            $this->attributes['sowingdate'] = $value;
            return;
        }

        $this->attributes['sowingdate'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/farm_images/' . $value) : null;
    }

    // Accessor: Convert Y-m-d to d-m-Y for API requests
    protected function getSowingdateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); //fk, refkey/pk
    }

    public function satelliteData()
    {
        return $this->hasMany(SatelliteDataModel::class, 'farm_id');
    }
    public function subscriptions()
    {
        return $this->hasMany(SubscriptionModel::class, 'farm_id', 'farm_id');
    }
}
