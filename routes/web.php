<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminProductVariantsController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminStatisticsController;
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
    Route::get('',[NewsController::class,'show'])->name('news.show');
    Route::get('prev-news',[NewsController::class,'handleGetPreviousNews'])->name('news.prev-news');
    Route::get('next-news',[NewsController::class,'handleGetNextNews'])->name('news.next-news');
    Route::get('news-details/{id}',[NewsController::class,'showNewsDetails'])->name('news.news-details');
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
        Route::get('payment',[CartController::class, 'showPayMentPage'])->name('cart.payment');
        Route::post('place-an-order',[CartController::class, 'placeAnOrder'])->name('cart.placeAnOrder');
    });
});

Route::get('admin/login',[AdminController::class,'showLoginForm'])->name('admin.login');
Route::post('admin/login-process',[AdminController::class,'handleLoginAdmin'])->name('admin.login.process');
Route::post('admin/logout',[AdminController::class,'handleLogoutAdmin'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth:admin'])->group( function() {
    Route::prefix('manage')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('', [AdminController::class, 'showManageUsersPage'])->name('admin.manage.users');
            Route::get('prev-users', [AdminController::class, 'handleGetPreviousUsers'])->name('admin.manage.users.prev');
            Route::get('next-users', [AdminController::class, 'handleGetNextUsers'])->name('admin.manage.users.next');
            Route::post('create', [AdminController::class, 'handleCreateUser'])->name('admin.manage.users.create');
            Route::get('get-info', [AdminController::class, 'showUserDetails'])->name('admin.manage.users.get-info');
            Route::post('update', [AdminController::class, 'updateUserDetails'])->name('admin.manage.users.update');
            Route::delete('delete', [AdminController::class, 'deleteUser'])->name('admin.manage.users.delete');
        });

        Route::prefix('news')->group(function () {
            Route::get('', [AdminNewsController::class, 'showManageNewsPage'])->name('admin.manage.news');
            Route::get('prev-news', [AdminNewsController::class, 'handleGetPreviousNews'])->name('admin.manage.news.prev');
            Route::get('next-news', [AdminNewsController::class, 'handleGetNextNews'])->name('admin.manage.news.next');
            Route::post('create', [AdminNewsController::class, 'handleCreateNews'])->name('admin.manage.news.create');
            Route::get('get-info', [AdminNewsController::class, 'showNewsDetails'])->name('admin.manage.news.get-info');
            Route::post('update', [AdminNewsController::class, 'updateNewsDetails'])->name('admin.manage.news.update');
            Route::delete('delete', [AdminNewsController::class, 'deleteNews'])->name('admin.manage.news.delete');
        });

        Route::prefix('products')->group(function () {
            Route::get('', [AdminProductController::class, 'showManageProductsPage'])->name('admin.manage.products');
            Route::get('prev-products', [AdminProductController::class, 'handleGetPreviousProducts'])->name('admin.manage.products.prev');
            Route::get('next-products', [AdminProductController::class, 'handleGetNextProducts'])->name('admin.manage.products.next');
            Route::get('search-product',[AdminProductController::class, 'handleSearchProduct'])->name('admin.manage.products.search');
            Route::post('update',[AdminProductController::class, 'updateProductDetails'])->name('admin.manage.products.update');
            Route::get('get-info',[AdminProductController::class, 'showProductDetails'])->name('admin.manage.products.get-info');
            Route::delete('delete',[AdminProductController::class, 'deleteProduct'])->name('admin.manage.products.delete');
            Route::post('create',[AdminProductController::class, 'handleCreateProduct'])->name('admin.manage.products.create');

            Route::prefix('{product_id}/variants')->group(function() {
                Route::get('',[AdminProductVariantsController::class, 'showManageVariants'])->name('admin.manage.product_variants');
                Route::get('next-variants',[AdminProductVariantsController::class, 'handleGetNextVariants'])->name('admin.manage.product_variants.next');
                Route::get('prev-variants',[AdminProductVariantsController::class, 'handleGetPreviousVariants'])->name('admin.manage.product_variants.prev');
                Route::post('create',[AdminProductVariantsController::class, 'handleCreateVariant'])->name('admin.manage.product_variants.create');
                Route::get('get-info',[AdminProductVariantsController::class, 'showVariantDetails'])->name('admin.manage.product_variants.get-info');
                Route::post('update',[AdminProductVariantsController::class, 'updateVariantDetails'])->name('admin.manage.product_variants.update');
                Route::delete('delete',[AdminProductVariantsController::class, 'deleteVariant'])->name('admin.manage.product_variants.delete');
            });

        });

        Route::prefix('orders')->group(function() {
            Route::get('',[AdminOrderController::class,'showManageOrdersPage'])->name('admin.manage.orders');
            Route::get('prev-orders',[AdminOrderController::class,'handleGetPreviousOrders'])->name('admin.manage.orders.prev');
            Route::get('next-orders',[AdminOrderController::class,'handleGetNextOrders'])->name('admin.manage.orders.next');
            Route::get('search',[AdminOrderController::class,'handleSearchOrders'])->name('admin.manage.orders.search');
            Route::get('get-info',[AdminOrderController::class,'handleGetOrderInfo'])->name('admin.manage.orders.get-info');
            Route::post('update',[AdminOrderController::class,'handleUpdateOrder'])->name('admin.manage.orders.update');
            Route::get('show-order-details/{id}',[AdminOrderController::class,'handleShowOrderDetail'])->name('admin.manage.orders.show-order-details');
        });

        Route::prefix('statistics')->group(function () {
            Route::get('chart',[AdminStatisticsController::class,'showChart'])->name('admin.manage.show-chart');
        });
    });
});

