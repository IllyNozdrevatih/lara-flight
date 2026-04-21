<?php

namespace App\Http\Controllers\Flight\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\StoreFlightRequest;
use App\Http\Requests\Flight\UpdateFlightRequest;
use App\Models\Flight;
use App\Services\Flight\FlightService;
use Illuminate\Http\Request;

class FlightApiController extends Controller
{
    public function __construct(private FlightService $flightService)
    {
    }

    public function index()
    {
        $flights = Flight::all();
        return response()->json($flights, 200);
    }
    public function store(StoreFlightRequest $request)
    {
//        return dd($request->all());
        Flight::create($request->validated());
        return to_route('flights.index');
//        return response()->json($flight, 201)
    }

    public function update(UpdateFlightRequest $request, int $id){
        return [];
//        return response()->json($flight, 200);
    }

    public function getOne($id){
        $flight = Flight::find($id)->airline;
        return $flight;
    }

    public function destroy(int $id)
    {
        $this->flightService->delete($id);

        return response()->json(null, 204);
    }
}
