<?php

namespace App\Domains\Flight\Services;

use App\Domains\Flight\Models\Flight;
use Illuminate\Support\Arr;

class FlightService
{
    public function update(array $data, int $id): Flight
    {
        $flight = Flight::findOrFail($id);

        $flight->update(Arr::only($data, [
            'from',
            'to',
            'airline_id',
            'flight_number',
            'departure_date',
            'arrival_date',
            'gate',
            'seating',
            'flight_time',
        ]));

        return $flight->fresh('airline');
    }

    public function delete(int $id): void
    {
        Flight::findOrFail($id)->delete();
    }
}
