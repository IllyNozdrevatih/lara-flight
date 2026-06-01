<?php

namespace App\Domains\Flight\Controllers;

use App\Domains\Airline\Models\Airline;
use App\Domains\Flight\Filters\FlightFilter;
use App\Domains\Flight\Models\Flight;
use App\Domains\Flight\Requests\SearchFlightRequest;
use App\Domains\Flight\Requests\BookFlightRequest;
use App\Domains\Flight\Services\FlightService;
use App\Shared\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FlightController extends Controller
{
    public function __construct(private FlightService $flightService)
    {
    }

    public function index(Request $request)
    {
        $filter = new FlightFilter($request);

        $flights = Flight::with('airline')
            ->tap(fn($q) => $filter->apply($q))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $airlines = Airline::all();

        return Inertia::render('flight/IndexFlight', [
            'flights'  => $flights,
            'airlines' => $airlines,
            'filters'  => $request->only(['from', 'to', 'airline_id', 'date', 'gate']),
        ]);
    }

    public function detail(string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->load('airline');
        return Inertia::render('flight/SingleFlight', ['flight' => $flight]);
    }

    public function store(BookFlightRequest $request)
    {
        Flight::create($request->validated());
        return to_route('flights.index');
    }

    public function apiIndex()
    {
        $flights = Flight::all();
        return response()->json($flights, 200);
    }

    public function apiStore(BookFlightRequest $request)
    {
        Flight::create($request->validated());
        return to_route('flights.index');
    }

    public function apiUpdate(BookFlightRequest $request, int $id)
    {
        $flight = $this->flightService->update($request->validated(), $id);
        return response()->json($flight, 200);
    }

    public function apiGetOne($id)
    {
        $flight = Flight::find($id)->airline;
        return $flight;
    }

    public function apiDestroy(int $id)
    {
        $this->flightService->delete($id);
        return response()->json(null, 204);
    }

    public function createApi()
    {
        $airlines = Airline::all('id', 'name');
        return Inertia::render('flight/CreateApiFlight', [
            'airlines' => $airlines
        ]);
    }
}
