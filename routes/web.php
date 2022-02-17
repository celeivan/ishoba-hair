<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'index'])->name("public.home");
Route::get('/shop', [ProductController::class, 'shop'])->name("public.shop");

Route::get('/contact-us', function () {
    return view('pages.contact');
})->name("public.contact");
