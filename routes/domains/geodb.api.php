<?php

use App\Domains\Location\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/geodb', [LocationController::class, 'searchCities'])->name('geodbApi.searchCities');
