<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Users;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    protected $model = Users::class;
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'password' => bcrypt('password'), // Bạn có thể đặt mật khẩu mặc định hoặc sử dụng faker cho mật khẩu ngẫu nhiên
            'email' => $this->faker->unique()->safeEmail,
            'role' => 'user', // Ví dụ chọn ngẫu nhiên vai trò
            'phone' => $this->faker->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
