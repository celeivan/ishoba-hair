<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [ProductController::class, 'index'])->name("public.home");
Route::get('/shop', [ProductController::class, 'shop'])->name("public.shop");
Route::get('/distributor', [ProductController::class, 'distributor'])->name("public.distributor");
// Route::get('/customer-auth', [CustomerController::class, 'auth'])->name("public.customer.auth");
// Route::post('/customer-auth', [CustomerController::class, 'authCustomer'])->name("public.customer.authCustomer");
// Route::get('/customer-profile', [CustomerController::class, 'profile'])->name("secure.customer.customerProfile");
Route::get('/customer-profile/order/{order:order_reference}', [OrderController::class, 'customerOrder'])->name("secure.customer.customerOrder");

Route::get('/contact-us', [ContactController::class, 'index'])->name("public.contact");
Route::post('/contact-us', [ContactController::class, 'sendContact'])->name("public.send-contact");

Route::get('/shopping-cart', [CartController::class, 'index'])->name("public.shopping-cart");
Route::get('/checkout', [CartController::class, 'checkout'])->name('public.checkout');
Route::get('/clear-shopping-cart', [CartController::class, 'clear'])->name("public.clear-shopping-cart");

Route::post('/order', [OrderController::class, 'create'])->name('public.order-create');
Route::get('/order/{order:order_reference}', [OrderController::class, 'confirmOrder'])->name('public.confirm-order');
Route::get('/terms-and-conditions', function(){
    return view('pages.terms');
})->name('public.terms-and-conditions');

Route::get('/dashboard', [AdminController::class, 'home'])->middleware('auth')->name('admin.home');
Route::get('/dashboard/order/{order:order_reference}', [AdminController::class, 'viewOrder'])->middleware('auth')->name('admin.view-order');
Route::post('/dashboard/order-comments/{order}', [OrderController::class, 'saveComment'])->middleware('auth')->name('admin.order-comments');
include ('auth.php');