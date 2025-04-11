<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(10, true),
            'product_id' => Product::inRandomOrder()->value('id') ?? Product::factory(),
            'color' => $this->faker->randomElement(['Red', 'Blue', 'Black', 'White', 'Green']),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Giá từ 10 đến 1000
            'stock' => $this->faker->numberBetween(0, 100), // Số lượng tồn kho ngẫu nhiên
            'created_at' => now(),
            'updated_at' => now(),        ];
    }
}
