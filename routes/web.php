<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('login');
Route::get('/register', [UserController::class, 'register']);
Route::post('/register-proses', [UserController::class, 'register_proses']);
Route::post('/login-proses', [UserController::class, 'login_proses']);
Route::post('/logout', [UserController::class, 'logout']);


Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('/products', ProductController::class);