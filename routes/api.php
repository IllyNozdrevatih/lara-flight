<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/api-routes/airline.api.php';
require __DIR__.'/api-routes/flights.api.php';
require __DIR__.'/api-routes/geodb.api.php';
require __DIR__.'/api-routes/airportsapi.api.php';
require __DIR__.'/api-routes/user.api.php';
require __DIR__.'/api-routes/order.api.php';
require __DIR__ . '/api-routes/sqlite.api.php';


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


