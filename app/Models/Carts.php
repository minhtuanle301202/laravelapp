<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','price','quantity'];
    protected $table = 'carts';

    public function cartItems()
    {
        return $this->hasMany(CartItems::class,'cart_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
