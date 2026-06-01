<?php

namespace App\Infrastructure\Providers;

use App\Domains\Location\Services\GeoDbService;
use Illuminate\Support\ServiceProvider;

class GeoDbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GeoDbService::class);
    }
}
