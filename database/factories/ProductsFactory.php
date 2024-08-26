<?php
namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    protected $model = Products::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => 'https://bizweb.dktcdn.net/100/047/633/products/may-tinh-xach-tay-asus-zenbook-ux305f-fc089h-01.jpg?v=1451965438913',
            'category_id' => 3, // Thiết lập category_id cố định là 1
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

?>