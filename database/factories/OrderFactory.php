<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'total_price' => $this->faker->randomFloat(2, 50, 5000), // Tổng tiền từ 50 đến 5000
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
