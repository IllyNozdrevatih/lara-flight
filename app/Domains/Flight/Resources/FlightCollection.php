<?php

namespace App\Domains\Flight\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FlightCollection extends ResourceCollection
{
    public $collects = FlightResource::class;
}
