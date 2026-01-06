<?php

use Illuminate\Support\Facades\Route;

// Sab controllers ke sahi path (namespace) yahan define hain
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

// 1. LANDING PAGE
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// 2. STATIC AUTH ROUTES (No Controller Needed - Just Blade Views)
Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// 3. USER PANEL - Browse Foods
Route::get('/home', [HomeController::class, 'index'])->name('home');


// 4. CART SYSTEM
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});


// 5. CHECKOUT SYSTEM
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('place.order');


// 6. ADMIN PANEL (No Auth Required as per your request)
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // Foods CRUD
    Route::resource('foods', FoodController::class);

    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});