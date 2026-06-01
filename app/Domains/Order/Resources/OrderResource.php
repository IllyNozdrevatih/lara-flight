<?php

namespace App\Domains\Order\Resources;

use App\Domains\Flight\Resources\FlightResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'flight_id' => $this->flight_id,
            'flight'    => new FlightResource($this->whenLoaded('flight')),
        ];
    }
}
