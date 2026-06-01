<?php

namespace App\Domains\Airline\Services;

use App\Domains\Airline\Models\Airline;
use Illuminate\Support\Collection;

class AirlineSearchService
{
    public function search(string $query): Collection
    {
        return Airline::query()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('country', 'like', "%{$query}%")
            ->get();
    }
}
