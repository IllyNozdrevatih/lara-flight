<?php

namespace App\Domains\Location\Services;

use App\Shared\DTOs\GeoDb\CityDto;
use App\Shared\DTOs\GeoDb\CountryDto;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoDbService
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('geodb.base_url'))
            ->timeout(config('geodb.timeout'))
            ->withoutVerifying()
            ->withHeaders([
                'X-RapidAPI-Key'  => config('geodb.api_key'),
                'X-RapidAPI-Host' => config('geodb.host'),
            ]);
    }

    public function searchCities(string $query, int $limit = 5, ?string $languageCode = null): Collection
    {
        $languageCode = $languageCode ?? config('geodb.language_code', 'en');
        $cacheKey = "geodb:cities:{$query}:{$limit}:{$languageCode}";

        return Cache::remember($cacheKey, config('geodb.cache_ttl'), function () use ($query, $limit, $languageCode) {
            $response = $this->client->get('/cities', [
                'namePrefix'   => $query,
                'limit'        => $limit,
                'languageCode' => $languageCode,
                'sort'         => '-population',
            ]);

            if ($response->failed()) {
                Log::error('GeoDB cities request failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return collect();
            }

            return collect($response->json('data', []))
                ->map(fn(array $city) => CityDto::fromArray($city));
        });
    }

    public function getCountries(int $limit = 100, string $languageCode = 'ru'): Collection
    {
        $cacheKey = "geodb:countries:{$limit}:{$languageCode}";

        return Cache::remember($cacheKey, config('geodb.cache_ttl'), function () use ($limit, $languageCode) {
            $response = $this->client->get('/countries', [
                'limit'        => $limit,
                'languageCode' => $languageCode,
            ]);

            if ($response->failed()) {
                Log::error('GeoDB countries request failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return collect();
            }

            return collect($response->json('data', []))
                ->map(fn(array $country) => CountryDto::fromArray($country));
        });
    }

    public function getCitiesByCountry(string $countryCode, int $limit = 50): Collection
    {
        $cacheKey = "geodb:cities:country:{$countryCode}:{$limit}";

        return Cache::remember($cacheKey, config('geodb.cache_ttl'), function () use ($countryCode, $limit) {
            $response = $this->client->get('/cities', [
                'countryIds' => $countryCode,
                'limit'      => $limit,
                'sort'       => '-population',
            ]);

            if ($response->failed()) {
                return collect();
            }

            return collect($response->json('data', []))
                ->map(fn(array $city) => CityDto::fromArray($city));
        });
    }
}
