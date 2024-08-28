<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'color',
        'capacity',
        'sold_quantity',
        'remain_quantity',
        'product_id',
    ];

    protected $table = 'product_variants';

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function cartItem()
    {
        return $this->hasOne(CartItems::class);
    }
}
