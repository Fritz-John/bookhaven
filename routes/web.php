<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' ,[BooksController::class, 'index'])->name('homepage');

Route::get('/shop' ,[BooksController::class, 'show_all'])->name('shop');

Route::get('/book/{book_id}' ,[BooksController::class, 'show'])->name('show');

Route::get('/cart' ,[OrdersController::class, 'show_cart'])->name('cart');

Route::post('/order' ,[OrdersController::class, 'store'])->name('store-order');

Route::get('/show-orders' ,[OrderDetailsController::class, 'index' ])->name('show-orders');

Route::get('/show-order/{order_id_details}' ,[OrderDetailsController::class, 'show' ])->name('show-order');

Route::get('/login' ,[UserController::class, 'index' ])->name('login');


Route::post('/cart/checkout', [OrdersController::class, 'checkout'])->name('checkout');