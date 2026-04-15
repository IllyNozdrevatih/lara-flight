<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/geodb', [LocationController::class,'searchCities'])->name('geodb.searchCities');

