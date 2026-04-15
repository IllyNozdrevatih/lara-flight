<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Flight\Web\FlightWebController;

Route::get('/flights',[FlightWebController::class,'index'])->name('flights.index');
//Route::get('/flights/create',[FlightWebController::class,'create'])->name('flights.create');
Route::get('/flights/{id}', [FlightWebController::class,'detail'])->name('flights.detail');
Route::post('/flights', [FlightWebController::class,'store'])->name('flights.store');
Route::get('/flights-api/create',[FlightWebController::class,'createApi'])->name('flights.create');
