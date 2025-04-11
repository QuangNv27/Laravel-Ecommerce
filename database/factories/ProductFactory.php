<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'name' => $this->faker->words(3, true), // Tạo tên sản phẩm ngẫu nhiên
            'description' => $this->faker->optional()->sentence(),
            'base_price' => $this->faker->randomFloat(2, 10, 1000), // Giá từ 10 đến 1000
            'image' => 'products/product_default.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
