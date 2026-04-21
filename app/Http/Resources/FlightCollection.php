<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'airline_id' => $this->airline_id,
            'flight_number' => $this->flight_number,
            'departure_date' => $this->departure_date,
            'arrival_date' => $this->arrival_date,
            'gate' => $this->gate,
            'seating' => $this->seating,
            'flight_time' => $this->flight_time,
        ];
    }
}
