<?php

namespace App\Domains\Airline\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AirlineCollection extends ResourceCollection
{
    public $collects = AirlineResource::class;
}
