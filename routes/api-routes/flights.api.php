<?php

use App\Http\Controllers\Flight\Api\FlightApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/flights/{id}', function (string $id) {
//    return Flight::where('id','=',$id)->get(['id','airline', 'email']);
//
//});

Route::put('/flights/{id}', [FlightApiController::class,'update'])->name('flights.update');
Route::get('/flights/{id}', [FlightApiController::class,'getOne'])->name('flights.getOne');
Route::post('/flights', [FlightApiController::class,'store'])->name('flights.store');
Route::delete('/flights/{id}', [FlightApiController::class,'destroy'])->name('flights.destroy');
Route::get('/flights', [FlightApiController::class,'index'])->name('flights.index');
