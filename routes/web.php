<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CartItemController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientOrderController;
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
// Route Public
Route::prefix('/')->group(function () {
    Route::get('/', [ProductController::class,'getProductList'])->name('product-list');
    Route::get('product/{id}', [ProductController::class,'clientShow'])->name('clientShowProduct');
    Route::get('contact', function () {return view('client.pages.contact');})->name('contact');
});
// Route Auth 
Auth::routes();
// Route Required Login
// Route::middleware(['auth','role:client,admin'])->group(function () {
//     Route::get('/profile', [ClientController::class, 'edit'])->name('profile.edit');
//     Route::put('/profile', [ClientController::class, 'update'])->name('profile.update');
//     Route::put('/profile/change-password', [ClientController::class, 'changePassword'])->name('profile.change-password');
//     Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
//     Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove');
//     Route::put('/cart/item/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
//     Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
//     Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
//     Route::post('/checkout/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('checkout.applyVoucher');
//     Route::post('/checkout/remove-voucher', [CheckoutController::class, 'removeVoucher'])->name('checkout.removeVoucher');
//     Route::post('/order/place-order', [OrderController::class, 'place'])->name('order.place');
//     Route::get('/order/orders', [OrderController::class, 'index'])->name('order.index');
// });

Route::middleware(['auth', 'role:client,admin'])->group(function () {

    // Profile
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', [ClientController::class, 'edit'])->name('edit');
        Route::put('/', [ClientController::class, 'update'])->name('update');
        Route::put('/change-password', [ClientController::class, 'changePassword'])->name('change-password');
    });

    // Giỏ hàng
    Route::prefix('cart')->as('cart.')->group(function () {
        Route::get('/', [CartController::class, 'show'])->name('show');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::delete('/item/{id}', [CartController::class, 'remove'])->name('remove');
        Route::put('/item/{id}', [CartController::class, 'updateQuantity'])->name('updateQuantity');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('clear');
    });

    // Checkout
    Route::prefix('checkout')->as('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'show'])->name('show');
        Route::post('/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('applyVoucher');
        Route::post('/remove-voucher', [CheckoutController::class, 'removeVoucher'])->name('removeVoucher');
    });

    // Order
    Route::prefix('order')->as('order.')->group(function () {
        Route::post('/place-order', [ClientOrderController::class, 'placeOrder'])->name('place');
        Route::get('/', [ClientOrderController::class, 'index'])->name('index');
        Route::post('/{id}/cancel', [ClientOrderController::class, 'cancelOrder'])->name('cancel');
    });
});

// Others
// Route::get('/temp-page', [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home')
// ;

// Route Log Errors
Route::get('error', function () {
    return view('error');
})->name('error');

