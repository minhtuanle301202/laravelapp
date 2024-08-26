<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_variants_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function productVariant()
    {
        return $this->hasMany(ProductVariants::class);
    }

    public function product()
    {
        return $this->hasMany(Products::class);
    }
}
