<?php

namespace App\Infrastructure\Providers;

use App\Events\EndpointHit;
use App\Listeners\IncrementEndpointCounter;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        EndpointHit::class => [
            IncrementEndpointCounter::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
