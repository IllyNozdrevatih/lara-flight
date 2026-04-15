<?php

namespace App\Http\Controllers\Flight\Web;

use App\Filters\FlightFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\StoreFlightRequest;
use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FlightWebController extends Controller
{
    //

    public function index(Request $request){
        $filter = new FlightFilter($request);

        $flights = Flight::with('airline')
            ->tap(fn($q) => $filter->apply($q))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $airlines = Airline::all();

        return Inertia::render('flight/IndexFlight', [
            'flights'  => $flights,
            'airlines' => $airlines,
            'filters'  => $request->only(['from', 'to', 'airline_id', 'date', 'gate']), // 👈 возвращаем активные фильтры на фронт
        ]);
    }

//    public function create(){
//        $airlines = Airline::all('id', 'name');
//        return Inertia::render('flight/CreateFlight', [
//            'airlines'=>$airlines
//        ]);
//    }

    public function detail(string $id){
        $flight = Flight::findOrFail($id);
        $flight->load('airline');
        return Inertia::render('flight/SingleFlight',['flight'=>$flight]);
    }

    public function store(StoreFlightRequest $request)
    {
//        return dd($request->all());
        Flight::create($request->validated());
        return to_route('flights.index');
//        return response()->json($flight, 201)
    }


    public function createApi(){
        $airlines = Airline::all('id', 'name');
        return Inertia::render('flight/CreateApiFlight', [
            'airlines'=>$airlines
        ]);
    }
}
