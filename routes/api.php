<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/apiProduk', [ProductController::class, 'index']);
Route::get('/detailProduk/{id}', [ProductController::class, 'show']);
Route::post('/createProduk', [ProductController::class, 'store']);
Route::put('/updateProduk/{id}', [ProductController::class, 'update']);
Route::delete('/deleteProduk/{id}', [ProductController::class, 'destroy']);

Route::get('/dataUser', [UserController::class, 'index']);
Route::get('/totalUser', [UserController::class, 'hitung_user']);