<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Airline;


Route::get('/airline/{id}', function (string $id) {
//    $flight = Flight::with('airline')->findOrFail($id);

    $airline = Airline::findOrFail($id)->load('flights');
//    $flight->load('airline');
    return Inertia::render('airline/SingleAirline',['airline'=>$airline]);
});
