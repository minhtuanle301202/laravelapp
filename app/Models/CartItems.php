<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_variant_id', 'quantity','price'];
    protected $table = 'cart_items';
    public function cart()
    {
        return $this->belongsTo(Carts::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariants::class,'variants_product_id');
    }
}
