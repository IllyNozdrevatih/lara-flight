<?php

namespace App\Services\AirportsApi;

use App\DTOs\AirportApi\AirportDTO;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirportsApiService {

    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('airportsapi.base_url'))
            ->withoutVerifying()
            ->withHeaders([
                'X-RapidAPI-Key'  => config('airportsapi.api_key'),
                'X-RapidAPI-Host' => config('airportsapi.host'),
            ]);
    }

    public function searchAirports(string $query)
    {
        $response = $this->client->post('/airports', [
            'search' => $query,
        ]);

        if ($response->failed()) {
            Log::error('Airports search request failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return collect();
        }


        return collect($response->json())
            ->map(fn(array $airport) => AirportDTO::fromArray($airport));
    }
}
