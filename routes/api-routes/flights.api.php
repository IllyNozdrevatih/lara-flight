<?php

use App\Http\Controllers\Flight\Api\FlightApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/flights/{id}', function (string $id) {
//    return Flight::where('id','=',$id)->get(['id','airline', 'email']);
//
//});

Route::put('/flights/{id}', [FlightApiController::class,'update'])->name('flightsApi.update');
Route::get('/flights/{id}', [FlightApiController::class,'getOne'])->name('flightsApi.getOne');
Route::post('/flights', [FlightApiController::class,'store'])->name('flightsApi.store');
Route::delete('/flights/{id}', [FlightApiController::class,'destroy'])->name('flightsApi.destroy');
Route::get('/flights', [FlightApiController::class,'index'])->name('flightsApi.index');
