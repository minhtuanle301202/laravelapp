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
    Route::post('/login', [UserController::class, 'handleLoginUser']);
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'handleRegisterUser']);
});

Route::post('/logout',[UserController::class, 'handleLogout'])->name('logout');


Route::get('/product/{id}',[ProductController::class,'show'])->name('product.detail')->where('id', '[0-9]+');
Route::get('/products/category/{id}',[ProductController::class,'handleGetProductsByCategoryId']);
Route::get('/new-products/category/{id}',[ProductController::class,'handleGetNewProductsByCategoryId']);

Route::get('/news/{page}',[NewsController::class,'index']);

Route::get('/product/get-price', [ProductVariantsController::class,'handleGetPrice'])->name('product.get-price');

Route::get('/cart',function() {
    return view('pages.cart');
});

Route::prefix('user')->middleware(['auth'])->group( function() {
    Route::prefix('cart')->group( function() {
        Route::get('', [CartController::class, 'show'])->name('cart.show');
        Route::post('add', [CartController::class, 'createOrUpdateCart'])->name('cart.add');
        Route::get('update', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
        Route::delete('delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
        Route::delete('delete-all', [CartController::class, 'deleteAllCartItems'])->name('cart.deleteAll');
        Route::get('check', [CartController::class, 'checkCart'])->name('cart.check');
        Route::get('count', [CartController::class, 'getCartItemCount'])->name('cart.count');
    });
});
