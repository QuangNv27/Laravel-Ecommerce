<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Địa chỉ
            $table->text('shipping_address');
    
            // Tổng tiền trước giảm
            $table->decimal('total_price', 10, 2);
    
            // Mã giảm giá (voucher)
            $table->foreignId('voucher_id')->nullable()->constrained()->onDelete('set null');
    
            // Số tiền được giảm từ voucher
            $table->decimal('discount_amount', 10, 2)->default(0);
    
            // Phí vận chuyển
            $table->decimal('shipping_fee', 10, 2)->default(0);
    
            // Tổng tiền cuối cùng sau giảm + phí ship
            $table->decimal('final_total', 10, 2);
    
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'canceled'])->default('pending');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
