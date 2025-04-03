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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');         // Liên kết với bảng carts
            $table->unsignedBigInteger('variant_id');     // Liên kết với bảng product_variants
            $table->integer('quantity')->default(1);       // Số lượng sản phẩm trong giỏ
            $table->timestamps();
        
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade'); // Liên kết với bảng carts
            $table->foreign('variant_id')->references('id')->on('product_variants')->onDelete('cascade');  // Liên kết với bảng product_variants
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
