<?php

namespace App\Providers;

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
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
