<?php

use Illuminate\Http\Request;
require __DIR__.'/api-routes/airline.api.php';
require __DIR__.'/api-routes/flights.api.php';
require __DIR__.'/api-routes/geodb.api.php';
require __DIR__.'/api-routes/airportsapi.api.php';

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

