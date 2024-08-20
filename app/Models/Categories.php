<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $filltable = ['name'];

    public function products()
    {
        return $this->hasMany(Products::class,'category_id');;
    }

}
