<?php
namespace Database\Factories;
use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantsFactory extends Factory
{
    protected $model = ProductVariants::class;

    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 10, 1000), // Giá từ 10 đến 1000
            'color' => $this->faker->randomElement(['Red', 'Green']), // Màu sắc sẽ được đặt ở seeder
            'capacity' => $this->faker->randomElement([100, 200]), // Sức chứa
            'sold_quantity' => $this->faker->numberBetween(0, 50), // Số lượng đã bán
            'remain_quantity' => $this->faker->numberBetween(0, 50), // Số lượng còn lại
            'product_id' => $this->faker->numberBetween(1, 10), // ID sản phẩm giả
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
?>