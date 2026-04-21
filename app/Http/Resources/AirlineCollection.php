<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirlineCollection extends JsonResource
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
            'address' => $this->address,
            'country' => $this->country,
            'email' => $this->email,
            'phone' => $this->phone,
            'flights' => FlightCollection::collection($this->whenLoaded('flights')),
        ];
    }
}
