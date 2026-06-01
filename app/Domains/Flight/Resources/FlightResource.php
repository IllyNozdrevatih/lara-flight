<?php

namespace App\Domains\Flight\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'from'           => $this->from,
            'to'             => $this->to,
            'airline_id'     => $this->airline_id,
            'flight_number'  => $this->flight_number,
            'departure_date' => $this->departure_date,
            'arrival_date'   => $this->arrival_date,
            'gate'           => $this->gate,
            'seating'        => $this->seating,
            'flight_time'    => $this->flight_time,
        ];
    }
}
