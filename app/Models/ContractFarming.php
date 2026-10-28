<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractFarming extends Model
{
    use HasFactory;

    protected $table = 'contract_farmings';
    protected $fillable = [
        'name', 'email', 'mobile', 'reg_date', 'password'
    ];
}
