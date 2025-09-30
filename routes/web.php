<?php

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
