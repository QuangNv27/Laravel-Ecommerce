<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/home', function () {
    return view('admin.dashboard');
});
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('products-variants', ProductVariantController::class);
    Route::resource('carts', CartController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('cart-items', CartItemController::class);
    Route::resource('order-items', OrderItemController::class);
});
