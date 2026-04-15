<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;
use App\Models\Airline;

class AirlineController extends Controller
{
    public function index()
    {
       $collection = Airline::all();

       return response()->json($collection, 200);
    }
}
