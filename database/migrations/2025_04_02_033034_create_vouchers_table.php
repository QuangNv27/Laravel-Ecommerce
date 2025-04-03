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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã giảm giá
            $table->enum('type', ['fixed', 'percentage']); // Loại giảm giá (cố định hoặc theo %)
            $table->decimal('value', 10, 2); // Giá trị giảm
            $table->dateTime('expires_at')->nullable(); // Thời hạn sử dụng
            $table->integer('usage_limit')->nullable(); // Số lần có thể sử dụng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
