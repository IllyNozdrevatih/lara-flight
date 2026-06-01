<?php

use App\Domains\Airline\Models\Airline;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/airline/{id}', function (string $id) {
    $airline = Airline::findOrFail($id)->load('flights');
    return Inertia::render('airline/SingleAirline', ['airline' => $airline]);
});
