<?php

namespace App\Listeners;

use App\Events\EndpointHit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementEndpointCounter
{
    public function handle(EndpointHit $event): void
    {
        $key = "endpoint_count:{$event->endpoint}";

        cache()->increment($key, 1) ?: cache()->put($key, 1);
    }
}
