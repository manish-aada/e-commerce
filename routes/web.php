<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoleController;


Route::get('/', [ShopController::class, 'index'])->name('home');

// Authentication
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile
Route::middleware('auth')->group(function () {
	Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
	Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

	// Cart
	Route::get('/products', [ShopController::class, 'list'])->name('products');
	Route::get('/products/{id}', [ShopController::class, 'details'])->name('product.details');
	Route::post('/cart', [ShopController::class, 'addToCart'])->name('cart.add');
	Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
	Route::post('/checkout', [ShopController::class, 'checkout'])->name('checkout');
	Route::get('/checkout', [ShopController::class, 'showCheckoutForm'])->name('checkout.form');

	Route::put('/cart/{id}', [ShopController::class, 'update'])->name('cart.update');
	Route::delete('/cart/{id}', [ShopController::class, 'remove'])->name('cart.remove');

});






// Admin Panel
Route::prefix('admin')->name('admin.')->middleware('auth', 'role:admin')->group(function () {
	Route::get('/', [AdminController::class, 'index'])->name('dashboard');
	Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
	Route::resource('roles', RoleController::class);

	// Customers & Vendors
	Route::get('customers', [AdminController::class, 'listCustomers'])->name('customers');
	Route::get('vendors', [AdminController::class, 'listVendors'])->name('vendors');

	// Products
	Route::get('products', [AdminController::class, 'listProducts'])->name('products');
	Route::get('products/add', [AdminController::class, 'addEditProduct'])->name('products.add');
	Route::get('products/edit/{id}', [AdminController::class, 'addEditProduct'])->name('products.edit');
	Route::post('products/save/{id?}', [AdminController::class, 'saveProduct'])->name('products.save');
	Route::delete('products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');

	// Orders
	Route::get('orders', [AdminController::class, 'listOrders'])->name('orders');

	// Transactions
	Route::get('transactions', [AdminController::class, 'listTransactions'])->name('transactions');
});
