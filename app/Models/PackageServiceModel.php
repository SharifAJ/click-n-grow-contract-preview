<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageServiceModel extends Model
{
    protected $table = 'package_service'; // Pivot table name

    protected $fillable = [
        'package_id',
        'service_id',
    ];

    // Relationship with PackageMasterModel
    public function package()
    {
        return $this->belongsTo(PackageMasterModel::class, 'package_id');
    }

    // Relationship with ServiceMasterModel
    public function service()
    {
        return $this->belongsTo(ServiceMasterModel::class, 'service_id');
    }
}