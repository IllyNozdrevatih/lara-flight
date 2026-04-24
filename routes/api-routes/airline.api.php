<?php

use App\Http\Controllers\Airline\AirlineController;
use Illuminate\Support\Facades\Route;

Route::get('/airlines', [AirlineController::class,'index'])->name('airlinesApi.index');
Route::get('/airlines/{id}', [AirlineController::class,'getOne'])->name('airlinesApi.getOne');
Route::post('/airlines', [AirlineController::class,'store'])->name('airlinesApi.store');
Route::post('/airlines/{id}', [AirlineController::class,'update'])->name('airlinesApi.update');
Route::delete('/airlines/{id}', [AirlineController::class,'delete'])->name('airlinesApi.delete');
