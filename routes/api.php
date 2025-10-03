<?php

use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductsController::class)
    ->group(function () {
        Route::get('/products', 'index');

        Route::get('/products/{product}', 'single');
    });
