<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','order_date', 'status','total_price','address','payment_method','username','phone'];
    protected $table = 'orders';

    public function user() {
        return $this->belongsTo(Users::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

    protected static function booted()
    {
        static::creating(function ($orders) {
            $orders->order_code = self::generateOrderCode();
        });
    }

    public static function generateOrderCode()
    {
        $orderCode = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        while (self::where('order_code', $orderCode)->exists()) {
            $orderCode = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        }

        return $orderCode;
    }

}
