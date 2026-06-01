<?php

use App\Domains\Location\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')
    ->name('locations.')
    ->group(function () {
        Route::get('/airports', [LocationController::class, 'airports'])->name('airports');
        Route::get('/cities', [LocationController::class, 'cities'])->name('cities');
        Route::get('/countries', [LocationController::class, 'countries'])->name('countries');
        Route::get('/search', [LocationController::class, 'search'])->name('search');
    });
