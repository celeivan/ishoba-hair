<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayFastController;
use App\Http\Controllers\CustomerController;

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

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('api.addToCart');
Route::post('/set-shipping-method/{shippingMethod}', [CartController::class, 'setShippingMethod'])->name('api.setShippingMethod');
Route::post('/client-check', [CustomerController::class, 'clientCheck'])->name('api.clientCheck');
Route::post('/order/{order:order_reference}/change-status', [OrderController::class, 'updateOrderStatus']);
Route::any('/payfast', [PayFastController::class, 'webhook']);