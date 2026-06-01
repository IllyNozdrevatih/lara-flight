<?php

namespace App\Domains\Airline\Controllers;

use App\Domains\Airline\Models\Airline;
use App\Domains\Airline\Requests\IndexAirlineRequest;
use App\Domains\Airline\Requests\StoreAirlineRequest;
use App\Domains\Airline\Requests\UpdateAirlineRequest;
use App\Domains\Airline\Services\AirlineService;
use App\Shared\Http\Controllers\Controller;

class AirlineController extends Controller
{
    public function __construct(private AirlineService $airlineService)
    {
    }

    public function index(IndexAirlineRequest $request)
    {
        $collection = $request->index();

        return response()->json($collection, 200);
    }

    public function getOne($id)
    {
        $airline = Airline::with('flights')->findOrFail($id);

        return response()->json($airline, 200);
    }

    public function store(StoreAirlineRequest $request)
    {
        $airline = Airline::create($request->validated());

        return response()->json($airline, 200);
    }

    public function update(int $id, UpdateAirlineRequest $request)
    {
        $airline = $this->airlineService->update($id, $request->validated());
        return response()->json($airline, 200);
    }

    public function delete(int $id)
    {
        try {
            $this->airlineService->delete($id);
            return response()->json(['message' => 'Airline deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 409);
        }
    }
}
