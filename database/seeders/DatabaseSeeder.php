<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Voucher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
                // ✅ Tạo tài khoản admin + user
                User::factory(5)->create(); // 5 tài khoản ngẫu nhiên
        
                // ✅ Tạo danh mục sản phẩm
                Category::factory(3)->create(); // 3 danh mục sản phẩm
                
                // ✅ Tạo sản phẩm
                Product::factory(10)->create(); // 10 sản phẩm
        
                // ✅ Tạo biến thể sản phẩm
                ProductVariant::factory(30)->create(); // 30 biến thể sản phẩm (color, size, price)
        
                // ✅ Tạo giỏ hàng
                Cart::factory(5)->create(); // 5 giỏ hàng
                
                // ✅ Thêm sản phẩm vào giỏ hàng
                CartItem::factory(15)->create(); // 15 sản phẩm trong giỏ
        
                // ✅ Tạo voucher
                Voucher::factory(5)->create();
                // ✅ Tạo đơn hàng
                Order::factory(10)->create(); // 10 đơn hàng
                
                // ✅ Thêm sản phẩm vào đơn hàng
                OrderItem::factory(30)->create(); // 30 sản phẩm trong các đơn hàng
    }
}
