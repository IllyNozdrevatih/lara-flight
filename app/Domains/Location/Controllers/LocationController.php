<?php

namespace App\Domains\Location\Controllers;

use App\Domains\Location\Services\GeoDbService;
use App\Domains\Location\Services\AirportsApiService;
use App\Shared\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(private GeoDbService $geoDb, private AirportsApiService $airportsApi)
    {
    }

    public function searchCities(Request $request): JsonResponse
    {
        $cities = $this->geoDb->searchCities(
            query: $request->string('q'),
            limit: 5,
        );

        return response()->json($cities);
    }

    public function searchAirports(Request $request): JsonResponse
    {
        $airports = $this->airportsApi->searchAirports(
            query: $request->string('q')
        );

        return response()->json($airports);
    }
}
