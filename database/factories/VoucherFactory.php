<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'code' => $this->faker->unique()->word,   // Mã giảm giá duy nhất
            'type' => $this->faker->randomElement(['fixed', 'percentage']), // Loại giảm giá
            'value' => $this->faker->randomFloat(2, 1, 100),  // Giá trị giảm
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 year'), // Thời hạn sử dụng
            'usage_limit' => $this->faker->numberBetween(1, 100), // Số lần sử dụng
        ];
    }
}
