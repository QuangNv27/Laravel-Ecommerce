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
        // Tổng tiền ban đầu
        $totalPrice = $this->faker->randomFloat(2, 50, 5000);
    
        // Giảm giá (có thể là 0 nếu không dùng voucher)
        $discount = $this->faker->randomElement([0, 10000, 20000, 50000]);
    
        // Phí ship
        $shipping = $this->faker->randomElement([15000, 20000, 30000]);
    
        // Tổng tiền sau khi trừ giảm giá + cộng phí ship
        $finalTotal = $totalPrice - $discount + $shipping;
        $finalTotal = max(0, $finalTotal); // đảm bảo không âm
    
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'total_price' => $totalPrice,
            'voucher_id' => null, // có thể sửa thành Voucher::inRandomOrder()->value('id') nếu đã có bảng vouchers
            'discount_amount' => $discount,
            'shipping_fee' => $shipping,
            'final_total' => $finalTotal,
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
}
