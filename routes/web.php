<?php

use App\Http\Controllers\Front\CartsController;
use App\Http\Controllers\Front\ContactsController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontController::class)
    ->group(function () {
        Route::get('/', 'index');
    });

Route::controller(ProductsController::class)
    ->group(function () {
        Route::get('/products', 'index');

        Route::get('/products/{product}', 'single');
    });

Route::controller(CartsController::class)
    ->group(function () {
        Route::get('/carts', 'index');

        Route::get('/carts/order', 'order');
        Route::post('/carts/order', 'sendOrder');

        Route::get('/carts/{product}/add', 'add');

        Route::get('/carts/{product}/delete', 'delete');
    });

Route::controller(ContactsController::class)
    ->group(function () {
        Route::get('/contacts/{product?}', 'index');

        Route::post('/contacts/sendmail', 'sendmail');
    });
