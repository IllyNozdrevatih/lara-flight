<?php

namespace App\Domains\Airline\Resources;

use App\Domains\Flight\Resources\FlightResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirlineResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'address' => $this->address,
            'country' => $this->country,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'flights' => FlightResource::collection($this->whenLoaded('flights')),
        ];
    }
}
