<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\CheckoutController;

/*
|-------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(Authenticate::class);
Route::get('/user/edit/{id}', [HomeController::class, 'edit'])->middleware(AdminAuth::class);
Route::post('/user/edit/{id}', [HomeController::class, 'update'])->middleware(AdminAuth::class);

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/create', [ProductController::class, 'create'])->middleware(AdminAuth::class);
Route::post('/product/create', [ProductController::class, 'store'])->middleware(AdminAuth::class);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->middleware(AdminAuth::class);
Route::post('/product/edit/{id}', [ProductController::class, 'update'])->middleware(AdminAuth::class);
Route::post('/product/delete/{id}', [ProductController::class, 'destroy'])->middleware(AdminAuth::class);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware(Authenticate::class);

Route::get('/services', [ServiceController::class, 'index'])->middleware(AdminAuth::class);
Route::get('/service/create', [ServiceController::class, 'create'])->middleware(AdminAuth::class);
Route::post('/service/create', [ServiceController::class, 'store'])->middleware(AdminAuth::class);
Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->middleware(AdminAuth::class);
Route::post('/service/edit/{id}', [ServiceController::class, 'update'])->middleware(AdminAuth::class);
Route::post('/service/delete/{id}', [ServiceController::class, 'destroy'])->middleware(AdminAuth::class);

Route::post('/product/add', [CartController::class, 'addItem'])->middleware(Authenticate::class);
Route::get('/cart', [CartController::class, 'index'])->middleware(Authenticate::class);
Route::post('/cart/delete', [CartController::class, 'clearCart'])->middleware(Authenticate::class)->name('cart.delete');
Route::post('/cart/product/delete/{id}', [CartController::class, 'deleteCartItem'])->middleware(Authenticate::class)->name('cartItem.delete');
Route::post('/cart/product/{cart_item_id}/service/delete/{service_id}', [CartController::class, 'deleteService'])->middleware(Authenticate::class)->name('service.delete');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->middleware(Authenticate::class)->name('cart.checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->middleware(Authenticate::class)->name('checkout.success');
Route::get('/checkout/failure', [CheckoutController::class, 'failure'])->middleware(Authenticate::class)->name('checkout.failure');
