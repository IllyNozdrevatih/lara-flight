<?php

namespace App\Providers;

use App\Services\GeoDb\GeoDbService;
use Illuminate\Support\ServiceProvider;

class GeoDbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GeoDbService::class);
    }
}
