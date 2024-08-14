<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
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


Route::get('/home', function () {
    return view('layouts.users.master');
})->name('home');

Route::get('/',[HomeController::class,'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'handleLoginUser']);
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'handleRegisterUser']);
});

Route::post('/logout',[UserController::class, 'handleLogout'])->name('logout');

Route::get('/product/{id}',[ProductController::class,'show'])->name('product.detail');

Route::get('/products/category/{id}',[ProductController::class,'handleGetProductsByCategoryId']);

Route::get('/news/{page}',[NewsController::class,'index']);