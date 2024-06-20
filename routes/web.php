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

Route::get('/cart' ,[OrdersController::class, 'show_cart'])->name('cart')->middleware('auth');

Route::post('/order' ,[OrdersController::class, 'store'])->name('store-order')->middleware('auth');

Route::get('/show-orders' ,[OrderDetailsController::class, 'index' ])->name('show-orders')->middleware('auth');

Route::get('/show-order/{order_id_details}' ,[OrderDetailsController::class, 'show' ])->name('show-order')->middleware('auth');

Route::post('/cart/checkout', [OrdersController::class, 'checkout'])->name('checkout')->middleware('auth');


Route::get('/login' ,[UserController::class, 'index' ])->name('login');

Route::get('/logout' ,[UserController::class, 'logout' ])->name('logout');

Route::get('/profile' ,[UserController::class, 'profile' ])->name('profile');

Route::get('/edit-profile' ,[UserController::class, 'edit_profile' ])->name('edit-profile');

Route::put('/update-profile' ,[UserController::class, 'update_profile' ])->name('update-profile');

Route::get('/signup' ,[UserController::class, 'signup' ])->name('signup');

Route::post('/create-account' ,[UserController::class, 'store_user' ])->name('create');

Route::post('/authenticate' ,[UserController::class, 'authenticate' ])->name('authenticate');