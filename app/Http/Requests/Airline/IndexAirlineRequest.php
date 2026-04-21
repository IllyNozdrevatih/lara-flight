<?php
namespace App\Http\Requests\Airline;

use App\Http\Resources\AirlineCollection;
use App\Models\Airline;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class IndexAirlineRequest
{
    public function __construct(private Request $request){ }

    public function index()
    {
        $airlines = Airline::query()
            ->when($this->request->has('full'), fn($q) => $q->with('flights'))
            ->when($this->request->has('desc'), fn($q) => $q->orderBy('id', 'desc'))
            ->get();

        return AirlineCollection::collection($airlines);
    }
}
