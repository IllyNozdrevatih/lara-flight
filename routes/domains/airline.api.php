<?php

use App\Domains\Airline\Controllers\AirlineController;
use Illuminate\Support\Facades\Route;

Route::prefix('airlines')
    ->name('airlines.')
    ->group(function () {
        // Публичные маршруты
        Route::get('/', [AirlineController::class, 'index'])->name('index');
        Route::get('/{airline}', [AirlineController::class, 'show'])->name('show');

        // Защищенные маршруты (для администраторов)
        Route::middleware(['auth:sanctum', 'can:manage-airlines'])->group(function () {
            Route::post('/', [AirlineController::class, 'store'])->name('store');
            Route::put('/{airline}', [AirlineController::class, 'update'])->name('update');
            Route::delete('/{airline}', [AirlineController::class, 'destroy'])->name('destroy');
        });
    });
