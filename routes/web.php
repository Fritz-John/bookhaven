<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//no need auth

Route::get('/', [BooksController::class, 'index'])->name('homepage');

Route::get('/shop', [BooksController::class, 'show_all'])->name('shop');

Route::get('/book/{book_id}', [BooksController::class, 'show'])->name('show');

Route::get('/login', [UserController::class, 'index'])->name('login');

Route::get('/signup', [UserController::class, 'signup'])->name('signup');

Route::post('/create-account', [UserController::class, 'store_user'])->name('create');

Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');


// Need auth

Route::group(['middleware' => 'auth'], function () {

    Route::get('/cart', [OrdersController::class, 'show_cart'])->name('cart');

    Route::post('/order', [OrdersController::class, 'store'])->name('store-order');

    Route::get('/show-orders', [OrderDetailsController::class, 'index'])->name('show-orders');

    Route::get('/show-order/{order_details}', [OrderDetailsController::class, 'show_order'])->name('show-order');

    Route::post('/cart/checkout', [OrdersController::class, 'checkout'])->name('checkout');

    Route::delete('/cart/remove/{cart_item}', [OrdersController::class, 'remove_item_cart'])->name('remove');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    Route::get('/edit-profile', [UserController::class, 'edit_profile'])->name('edit-profile');

    Route::put('/update-profile', [UserController::class, 'update_profile'])->name('update-profile');
});


//Auth and Admin
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/create-book', [BooksController::class, 'create'])->name('create-book');

    Route::post('/store-book', [BooksController::class, 'store'])->name('store-book');
    
    Route::delete('/remove-book/{book_id}', [BooksController::class, 'remove_book'])->name('remove-book');
    
    Route::get('/all-books', [BooksController::class, 'all_books'])->name('all-books');
    
    Route::get('/all-categories', [CategoriesController::class, 'index'])->name('all-categories');
    
    Route::get('/create-category', [CategoriesController::class, 'create_category'])->name('create-category');
    
    Route::post('/store-category', [CategoriesController::class, 'store'])->name('store-category');
    
    Route::delete('/remove-category/{category_id}', [CategoriesController::class, 'remove_category'])->name('remove-category');


});


