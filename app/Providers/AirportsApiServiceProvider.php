<?php

namespace App\Providers;

use App\Services\AirportsApi\AirportsApiService;
use Illuminate\Support\ServiceProvider;

class AirportsApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AirportsApiService::class);
    }
}
