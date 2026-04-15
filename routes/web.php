<?php

use App\Models\Flight;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');
//Route::get('/', function () {
//    return false;
//});
Route::get('/test', function () {
    return view('home');
});
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__ . '/web-routes/flights.router.php';
require __DIR__ . '/web-routes/airline.router.php';
