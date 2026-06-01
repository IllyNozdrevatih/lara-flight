<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Подключаем маршруты доменов
//Route::prefix('api/v1')->group(function () {
    require __DIR__ . '/domains/airline.api.php';
    require __DIR__ . '/domains/order.api.php';
    require __DIR__ . '/domains/flight.api.php';
    require __DIR__ . '/domains/user.api.php';
    require __DIR__ . '/domains/location.api.php';
//});
