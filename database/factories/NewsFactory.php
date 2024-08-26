<?php

namespace Database\Factories;

use App\Models\News; // Thay đổi thành model News của bạn
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'image' => 'https://bizweb.dktcdn.net/100/047/633/articles/ip6s.png?v=1469340252480',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
