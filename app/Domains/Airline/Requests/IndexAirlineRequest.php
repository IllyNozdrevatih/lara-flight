<?php

namespace App\Domains\Airline\Requests;

use App\Domains\Airline\Resources\AirlineResource;
use App\Domains\Airline\Models\Airline;
use Illuminate\Http\Request;

class IndexAirlineRequest
{
    public function __construct(private Request $request)
    {
    }

    public function index()
    {
        $airlines = Airline::query()
            ->when($this->request->has('full'), fn($q) => $q->with('flights'))
            ->when($this->request->has('desc'), fn($q) => $q->orderBy('id', 'desc'))
            ->get();

        return AirlineResource::collection($airlines);
    }
}
