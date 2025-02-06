<?php

use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cartController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\stripeWebhookController;

Route::get('/', function () {
    return view('welcome');
});


//get all products
Route::get('/product', [ProductController::class, 'index'])->name('products');
//get all shirt product
Route::get('/product/{slug}', [ProductController::class, 'getSlug'])->name('type');
//delete a product
Route::delete('/product/{id}/delete', [ProductController::class, 'destroy']);
//calculate cart price
Route::post('/product/cart/prices', [cartController::class, 'calculatePrices']);
//cart number
Route::post('/count-cart', [cartController::class, 'getNumberOfAddedCart']);
//update quantity column in cart database
Route::patch('/product/cart/quantity/update', [cartController::class, 'updateQuantity']);
// stripe webhook 
// Route::post('/stripe/webhook', [stripeWebhookController::class, 'handleWebhook']);

Route::get('/success', [ProductController::class, 'success'])->name('success');
Route::get('/order', [ProductController::class, 'orderHistory'])->name('order');

Route::get('/cancel', [ProductController::class, 'cancel'])->name('cancel');

Route::post('/product-checkout', [paymentController::class, 'stripeCheckout'])->name('checkout');
Route::post('/cart/checkout', [paymentController::class, 'cartStripeCheckout']);
Route::post('/product/cart/create', [cartController::class, 'create'])->name('cart.create');
Route::delete('/product/cart/{id}/delete', [cartController::class, 'destroy']);
Route::get('/cart', [cartController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
