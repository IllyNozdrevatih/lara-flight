<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authorisation\UserController;

Route::prefix('user')->group(function () {
    Route::post('/auth', [UserController::class,'login'])->name('user.login');
    Route::post('/store', [UserController::class,'store'])->name('user.store');

    Route::middleware(['auth:sanctum','refresh.token'])->group(function () {
        Route::post('/refresh', [UserController::class,'refresh'])->name('user.refresh');
    });

    Route::middleware(['auth:sanctum','access.token'])->group(function () {
        Route::get('/cabinet', [UserController::class,'cabinet'])->name('user.cabinet');
        Route::post('/logout', [UserController::class,'logout'])->name('user.logout');
    });
});

