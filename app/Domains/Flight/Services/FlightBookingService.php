<?php

namespace App\Domains\Flight\Services;

use App\Domains\Flight\Models\Flight;

class FlightBookingService
{
    public function book(array $data): Flight
    {
        return Flight::create($data);
    }
}
