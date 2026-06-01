<?php

namespace App\Domains\Flight\Services;

use App\Domains\Flight\Models\Flight;
use Illuminate\Http\Request;
use App\Domains\Flight\Filters\FlightFilter;

class FlightSearchService
{
    public function search(Request $request)
    {
        $filter = new FlightFilter($request);

        return Flight::with('airline')
            ->tap(fn($q) => $filter->apply($q))
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
}
