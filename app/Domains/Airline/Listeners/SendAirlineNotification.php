<?php

namespace App\Domains\Airline\Listeners;

use App\Domains\Airline\Events\AirlineCreated;

class SendAirlineNotification
{
    public function handle(AirlineCreated $event): void
    {
        // Handle airline notification
    }
}
