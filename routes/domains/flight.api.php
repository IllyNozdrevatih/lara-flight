<?php

use App\Domains\Flight\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::prefix('flights')
    ->name('flights.')
    ->group(function () {
        // Публичные маршруты
        Route::get('/', [FlightController::class, 'index'])->name('index');
        Route::get('/search', [FlightController::class, 'search'])->name('search');
        Route::get('/{flight}', [FlightController::class, 'show'])->name('show');

        // Защищенные маршруты
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/{flight}/book', [FlightController::class, 'book'])->name('book');
        });

        // Административные маршруты
        Route::middleware(['auth:sanctum', 'can:manage-flights'])->group(function () {
            Route::post('/', [FlightController::class, 'store'])->name('store');
            Route::put('/{flight}', [FlightController::class, 'update'])->name('update');
            Route::delete('/{flight}', [FlightController::class, 'destroy'])->name('destroy');
        });
    });
