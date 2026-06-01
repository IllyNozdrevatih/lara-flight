<?php

namespace App\Domains\Airline\Events;

use App\Domains\Airline\Models\Airline;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AirlineUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Airline $airline)
    {
    }
}
