<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/')->group((function (){

    Route::get('carts', [CartController::class, 'index']);
    Route::get('add-cart', [CartController::class, 'addCart']);
    Route::get('remove-cart/{id}', [CartController::class, 'removeCart']);
    Route::get('checkout/{id}', [CartController::class, 'checkout']);

    Route::get('cartItems/{id}', [CartItemController::class, 'index']);
    Route::get('add-cartItem', [CartItemController::class, 'addCartItem']);
    Route::get('remove-cartItem/{id}/{sku}', [CartItemController::class, 'removeItem']);

    Route::get('products', [ProductController::class, 'index']);

}));
