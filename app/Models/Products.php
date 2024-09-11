<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariants::class,'product_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'product_id');
    }
}
