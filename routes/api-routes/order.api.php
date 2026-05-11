<?php

use App\Http\Controllers\Order\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('order')
    ->group(function () {
        Route::post('/store', [OrderController::class, 'store']);
    });
