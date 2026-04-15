<?php

use App\Http\Controllers\Airline\AirlineController;
use Illuminate\Support\Facades\Route;

Route::get('/airlines', [AirlineController::class,'index'])->name('airlines.getOne');
