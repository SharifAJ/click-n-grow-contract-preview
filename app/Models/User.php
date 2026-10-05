<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; //for Sanctum API tokens

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'farmer_id',
        'name',
        'last_name',
        'email',
        'mobile',
        'reg_date',
        'password',
        'user_status',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function farms()
    {
        return $this->hasMany(FarmModel::class, 'user_id', 'id');
    }
    // ✅ A user has many subscriptions through their farms
    public function subscriptions()
    {
        return $this->hasManyThrough(
            SubscriptionModel::class,
            FarmModel::class,
            'user_id',  // Foreign key on farms table
            'farm_id',  // Foreign key on subscriptions table
            'id',       // Local user ID
            'farm_id'        // Foreign key in FarmModel
        );
    }




    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class, 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
}
