<?php

use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\banner\BannerController;
use App\Http\Controllers\admin\bill\BillController;
use App\Http\Controllers\admin\customer\CustomerController;
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\admin\product\ProductController;
use App\Http\Controllers\admin\user\LoginController;
use App\Http\Controllers\public\cart\CartController;
use App\Http\Controllers\public\MainController as PublicMain;
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

Route::view('/', 'welcome')->name('index.welcome');
Route::view('/contact', 'public.pages.contact')->name('Contact');
Route::prefix('products')->group(
    function () {
        Route::get(
            '/product-detail/{id}',
            [ProductController::class, 'show']
        )->name('Product Detail');
        Route::get(
            '/category/{id}',
            [ProductController::class, 'showProductByCategory']
        )->name('Product Shop');
        Route::get(
            '/search-product',
            [PublicMain::class, 'searchProduct']
        )->name('Search Shop');
        Route::get(
            '/filter-price',
            [PublicMain::class, 'filterByPrice']
        )->name('Filter Price');
        Route::get(
            '/product/store-like/{id}',
            [PublicMain::class, 'storeLike']
        )->name('Store Like');
        Route::get(
            '/product/store-cart',
            [PublicMain::class, 'storeToCart']
        )->name('Store Cart');
        Route::get(
            '/product/remove-like/{id}',
            [PublicMain::class, 'removeFromList']
        )->name('Remove Like');
        Route::view('/like-list', 'public.pages.product.love_list_product')->name('Love List');
    }
);

Route::prefix('cart')->group(function () {
    Route::get(
        '/check-item',
        [CartController::class, 'index']
    )->name('Shoping Cart');
    Route::get(
        '/change-quantity/{id}',
        [CartController::class, 'changeQuantity']
    )->name('Change Cart');
    Route::get(
        '/remove-quantity/{id}',
        [CartController::class, 'removeCart']
    )->name('Remove Cart');
    Route::get(
        '/fill-customer',
        [CartController::class, 'create']
    )->name('Check Out');
    Route::post(
        '/store-customer',
        [CartController::class, 'store']
    )->name("Store Bill");
    Route::get(
        '/districts/{id}',
        [CartController::class, 'getDistricts']
    );
    Route::get(
        '/wards/{id}',
        [CartController::class, 'getWards']
    );
});

Route::get(
    'admin/login',
    [LoginController::class, 'index']
)->name('admin.login');

Route::post(
    'admin/login',
    [LoginController::class, 'store']
);

Route::middleware('auth')
    ->group(function () {
        Route::prefix('admin')
            ->group(function () {
                Route::get(
                    'main',
                    [MainController::class, 'index']
                )->name('admin.main');
                Route::get(
                    'login-out',
                    [MainController::class, 'logout']
                )->name('admin.logout');
                Route::prefix('category')
                    ->group(function () {
                        Route::get(
                            'add',
                            [CategoryController::class, 'create']
                        )->name('Add Category');
                        Route::post(
                            'add',
                            [CategoryController::class, 'store']
                        );
                        Route::get(
                            'update/{category}/edit',
                            [CategoryController::class, 'edit']
                        )->name('Update Category');
                        Route::put(
                            'update/{category}/edit',
                            [CategoryController::class, 'update']
                        );
                        Route::get(
                            '/',
                            [CategoryController::class, 'index']
                        )->name('List Category');
                    });
                Route::prefix('banner')
                    ->group(function () {
                        Route::get(
                            'add',
                            [BannerController::class, 'create']
                        )->name('Add Banner');
                        Route::post(
                            'add',
                            [BannerController::class, 'store']
                        );
                        Route::get(
                            'update/{banner}/edit',
                            [BannerController::class, 'edit']
                        )->name('Update Banner');
                        Route::put(
                            'update/{banner}/edit',
                            [BannerController::class, 'update']
                        );
                        Route::delete(
                            '/{id}',
                            [BannerController::class, 'destroy']
                        )->name('Delete Banner');
                        Route::get(
                            '/',
                            [BannerController::class, 'index']
                        )->name('List Banner');
                    });
                Route::prefix('product')
                    ->group(function () {
                        Route::get(
                            'add',
                            [ProductController::class, 'create']
                        )->name('Add Product');
                        Route::post(
                            'add',
                            [ProductController::class, 'store']
                        );
                        Route::get(
                            'update/{id}/edit',
                            [ProductController::class, 'edit']
                        )->name('Update Product');
                        Route::post(
                            'update/{id}/edit',
                            [ProductController::class, 'update']
                        );
                        Route::delete(
                            '/{id}',
                            [ProductController::class, 'destroy']
                        )->name('Delete Product');
                        Route::get(
                            '/',
                            [ProductController::class, 'index']
                        )->name('List Product');
                    });
                Route::prefix('customer')->group(function () {
                    Route::get(
                        '/',
                        [CustomerController::class, 'index']
                    )->name('List Customer');
                });
                Route::prefix('bill')->group(function () {          
                    Route::post(
                        '/{id}',
                        [BillController::class, 'edit']
                    )->name('Edit Bill');
                    Route::get(
                        '/',
                        [BillController::class, 'index']
                    )->name('List Bill');
                });
                Route::post(
                    '/mail/{id}',
                    [BillController::class, 'sendMail']
                )->name('Send Mail');
            });
    });
