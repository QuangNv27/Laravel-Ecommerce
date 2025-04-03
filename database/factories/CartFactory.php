<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'total_amount' => $this->faker->randomFloat(2, 0, 5000), // Tổng giá trị giỏ hàng từ 0 đến 5000
            'created_at' => now(),
            'updated_at' => now(),        ];
    }
}
