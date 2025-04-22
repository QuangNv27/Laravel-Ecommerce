<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Voucher::create([
            'code' => 'SUMMER2025',
            'type' => 'percentage', // hoặc 'fixed'
            'value' => 2, // 10% giảm giá
            'min_order_amount' => 100000, // đơn hàng tối thiểu 2tr
            'expires_at' => Carbon::now()->addMonths(2), // hết hạn sau 2 tháng
            'usage_limit' => 100, // tối đa 100 lượt dùng
            'per_user_limit' => 1, // mỗi người dùng 1 lần
            'is_active' => true,
        ]);
    }
}
