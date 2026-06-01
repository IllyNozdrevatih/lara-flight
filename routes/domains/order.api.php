<?php

use App\Domains\Order\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('orders')
    ->name('orders.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');

        // Дополнительные маршруты для заказов
        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::patch('/{order}/confirm', [OrderController::class, 'confirm'])->name('confirm');
    });
