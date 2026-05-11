<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authorisation\UserController;

Route::post('/auth', [UserController::class,'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cabinet', [UserController::class,'cabinet'])->name('user.cabinet');
    Route::post('/logout', [UserController::class,'logout'])->name('user.logout');
});
