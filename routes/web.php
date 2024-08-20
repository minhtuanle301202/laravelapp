<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductVariantsController;
use App\Http\Controllers\CartController;

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

Route::get('/',[HomeController::class,'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login/process', [UserController::class, 'handleLoginUser'])->name('login.process');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register/process', [UserController::class, 'handleRegisterUser'])->name('register.process');
});

Route::post('/logout',[UserController::class, 'handleLogout'])->name('logout');

Route::get('/product/{id}',[ProductController::class,'show'])->name('product.detail')->where('id', '[0-9]+');
Route::get('/products/category',[ProductController::class,'handleGetProductsByCategoryId'])->name('products.category');
Route::get('/category/{id}',[ProductController::class,'getProductsByCategoryIdInCategoryPage'])->name('category')->where('id', '[0-9]+');

Route::get('/new-products/category/{id}',[ProductController::class,'handleGetNewProductsByCategoryId'])->name('new-products.category');

Route::prefix('news')->group(function() {
    Route::get('prev-small-news',[NewsController::class,'handleGetPreviousSmallNews'])->name('news.prev-small-news');
    Route::get('next-small-news',[NewsController::class,'handleGetNextSmallNews'])->name('news.next-small-news');
    Route::get('prev-big-news',[NewsController::class,'handleGetPreviousBigNews'])->name('news.prev-big-news');
    Route::get('next-big-news',[NewsController::class,'handleGetNextBigNews'])->name('news.next-big-news');
});


Route::get('/product/get-price', [ProductVariantsController::class,'handleGetPrice'])->name('product.get-price');

Route::prefix('user')->middleware(['auth'])->group( function() {
    Route::prefix('cart')->group( function() {
        Route::get('', [CartController::class, 'show'])->name('cart.show');
        Route::post('add', [CartController::class, 'createOrUpdateCart'])->name('cart.add');
        Route::post('update', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
        Route::delete('delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
        Route::delete('delete-all', [CartController::class, 'deleteAllCartItems'])->name('cart.deleteAll');
        Route::get('check', [CartController::class, 'checkCart'])->name('cart.check');
        Route::get('count', [CartController::class, 'getCartItemCount'])->name('cart.count');
    });
});
