<?php

namespace App\Infrastructure\Providers;

use App\Domains\Location\Services\AirportsApiService;
use Illuminate\Support\ServiceProvider;

class AirportsApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AirportsApiService::class);
    }
}
