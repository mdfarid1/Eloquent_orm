<?php

use App\Http\Controllers\PdroductController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes/web.php
Route::get('/', [ProductController::class, 'deshboard'])->name('deshboard');
Route::get('/storekeeper', [ProductController::class, 'welcome'])->name('welcome');
Route::get('/products', [ProductController::class, 'products'])->name('products');

Route::get('/products/sell', [ProductController::class, 'products_sell'])->name('products_sell');
Route::get('/update/price', [ProductController::class, 'update_price'])->name('update_price');

Route::get('/products/create', [ProductController::class, 'create'])->name('create');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('edit');
Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('update');
Route::post('/products', [ProductController::class, 'store'])->name('store');
Route::get('/products/sell/{id}', [ProductController::class, 'sell'])->name('sell');
Route::post('/products/sellUpdate/{id}', [ProductController::class, 'sellUpdate'])->name('sellUpdate');
Route::get('/sale/transaction', [ProductController::class, 'sale_transaction'])->name('sale_transaction');

Route::get('/delet/{id}', [ProductController::class, 'delet'])->name('delet');




