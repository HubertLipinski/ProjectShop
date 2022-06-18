<?php

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {
    Route::apiResource('products', ProductController::class)
        ->only(['index', 'show'])
        ->name('index', 'api.products.index')
        ->name('show', 'api.products.show');
    Route::apiResource('categories', CategoryController::class)
        ->only(['index'])
        ->name('index', 'api.categories.index');
});

Route::post('payu/notify', function (Request $request) {
    \Log::debug('received request from payment provider');
});
