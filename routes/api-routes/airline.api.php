<?php

use App\Http\Controllers\Airline\AirlineController;
use Illuminate\Support\Facades\Route;

Route::get('/airlines', [AirlineController::class,'index'])->name('airlines.index');
Route::get('/airlines/{id}', [AirlineController::class,'getOne'])->name('airlines.getOne');
Route::post('/airlines', [AirlineController::class,'store'])->name('airlines.store');
Route::post('/airlines/{id}', [AirlineController::class,'update'])->name('airlines.update');
Route::delete('/airlines/{id}', [AirlineController::class,'delete'])->name('airlines.delete');
