<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\RegisterController;

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

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::post('/products/search', [ProductController::class, 'search']);

Route::get('/products/{productId}', [ShowController::class, 'index']);
Route::patch('/products/{productId}/update', [ShowController::class, 'update']);


Route::get('/products/register', [RegisterController::class, 'index']);
Route::post('/products', [RegisterController::class,'store']);

