<?php

namespace App\Http\Controllers;

use App\Services\GeoDb\GeoDbService;
use App\Services\AirportsApi\AirportsApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(private GeoDbService $geoDb, private AirportsApiService $airportsApi) {}

    public function searchCities(Request $request): JsonResponse
    {
        $cities = $this->geoDb->searchCities(
            query: $request->string('q'),
            limit: 5,
        );

        return response()->json($cities);
    }

    public function searchAirports(Request $request): JsonResponse {
        $airports = $this->airportsApi->searchAirports(
            query: $request->string('q')
        );
//            return    dd([
//                'status' => $response->status(),
//                'body'   => $response->json(),
//                'url'    => $response->effectiveUri()?->__toString(),
//            ]);

        return response()->json($airports);
    }
}
