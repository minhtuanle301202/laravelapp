<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone'
    ];

    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $dates = ['deleted_at'];

    public function cart()
    {
        return $this->hasOne(Carts::class,'user_id');
    }

    public function order()
    {
        return $this->hasOne(Orders::class,'user_id');
    }

    public function scopeActive($query)
    {
        return $query->orderBy('id','desc');
    }
}

