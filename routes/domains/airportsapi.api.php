<?php

use App\Domains\Location\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/airportapi', [LocationController::class, 'searchAirports'])->name('airportApi.searchAirports');
