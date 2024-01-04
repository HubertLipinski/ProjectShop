<?php

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\CheckoutController;
use App\Http\Controllers\Product\ProductController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('store', [CartController::class, 'store'])->name('cart.store');
        Route::get('{product}/delete', [CartController::class, 'delete'])->name('cart.delete');
    });

    Route::group(['prefix' => 'payment'], function () {
        Route::get('checkout', [CheckoutController::class, 'checkout'])->name('payment.checkout');
        Route::get('orders', [CheckoutController::class, 'orders'])->name('payment.orders');
    });
});
