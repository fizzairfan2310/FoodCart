<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// LANDING PAGE
// =========================
Route::get('/', function () {
    return view('welcome');
})->name('landing');


// =========================
// AUTH (USER + ADMIN)
// =========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================
// USER SIDE (HOME)
// =========================
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');


// =========================
// CART
// =========================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// =========================
// CHECKOUT
// =========================
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('place.order');


// =========================
// ADMIN PANEL (PROTECTED)
// =========================
Route::prefix('admin')
    ->name('admin.')
    ->middleware('simple.admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Categories
        Route::resource('categories', CategoryController::class);

        // Foods
        Route::resource('foods', FoodController::class);

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders');

        Route::get('/orders/{id}', [OrderController::class, 'show'])
            ->name('orders.show');

        // ✅ FIXED (THIS WAS MISSING)
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.status');

        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])
            ->name('orders.destroy');
});
