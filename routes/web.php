<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route Admin
Route::middleware('auth','role:admin')->prefix('admin')->group(function () {
    Route::get('dashboard', function () {return view('admin.dashboard');})->name('dashboard');
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('variants', ProductVariantController::class);
    Route::resource('carts', CartController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('cart-items', CartItemController::class);
    Route::resource('order-items', OrderItemController::class);
});
// Route Client
Route::prefix('/')->group(function () {
    // Route page
    Route::get('/', function () {return view('client.home');});
    Route::get('product-list', [ProductController::class,'getProductList'])->name('product-list');
    Route::get('contact', function () {return view('client.pages.contact');})->name('contact');
    // Route cart
});
// Auth
Auth::routes();
// Route account
Route::middleware(['auth','role:client,admin'])->group(function () {
    Route::get('/profile', [ClientController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ClientController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password', [ClientController::class, 'changePassword'])->name('profile.change-password');
});
// Others
Route::get('/temp-page', [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home')
;
Route::get('error', function () {
    return view('error');
})->name('error');

