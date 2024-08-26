<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'published_date',
        ];
    protected $table = 'news';

    public function scopeOrder($query) {
        return $query->orderBy('published_date', 'desc');
    }
}

