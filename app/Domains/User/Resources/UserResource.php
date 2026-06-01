<?php

namespace App\Domains\User\Resources;

use App\Domains\Order\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'email'  => $this->email,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
