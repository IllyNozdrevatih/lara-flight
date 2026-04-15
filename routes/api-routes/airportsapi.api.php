<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/airportapi', [LocationController::class,'searchAirports'])->name('geodb.searchCities');

