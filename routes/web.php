<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AdminAuth;

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

Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/create', [ProductController::class, 'create'])->middleware(AdminAuth::class);
Route::post('/product/create', [ProductController::class, 'store'])->middleware(AdminAuth::class);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
Route::post('/product/edit/{id}', [ProductController::class, 'update']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware(Authenticate::class);
