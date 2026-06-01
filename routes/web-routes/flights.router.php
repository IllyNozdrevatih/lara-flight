<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Flight\Controllers\FlightController;

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/{id}', [FlightController::class, 'detail'])->name('flights.detail');
Route::post('/flights', [FlightController::class, 'store'])->name('flights.store');
Route::get('/flights-api/create', [FlightController::class, 'createApi'])->name('flights.create');
