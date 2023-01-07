<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('auth');
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders')->middleware('auth');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products')->middleware('auth');
Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventory')->middleware('auth');
