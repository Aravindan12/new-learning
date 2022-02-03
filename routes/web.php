<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CheckoutController;

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

Route::get('/livewire', function () {
    return view('welcome');
});

Route::get('/auth/redirect/{provider}',[App\Http\Controllers\GoogleLoginController::class, 'redirect']);
Route::get('/callback/{provider}', [App\Http\Controllers\GoogleLoginController::class,'callback']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show-books', [App\Http\Controllers\HomeController::class, 'ShowBooks'])->name('show-books');
Route::get('/go-to-cart', [App\Http\Controllers\HomeController::class, 'goToCart'])->name('show-books');
Route::get('/add-cart/{id}', [App\Http\Controllers\HomeController::class, 'addCart'])->name('add-cart');
Route::get('/return-back', [App\Http\Controllers\HomeController::class, 'returnBack'])->name('return-back');


Route::get('stripe', [StripePaymentController::class, 'index']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');




Route::post('checkout',[CheckoutController::class, 'checkout']);
Route::post('after-checkout',[CheckoutController::class, 'afterpayment'])->name('checkout.credit-card');


?>