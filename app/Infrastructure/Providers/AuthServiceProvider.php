<?php

namespace App\Infrastructure\Providers;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Policies\OrderPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Order::class => OrderPolicy::class,
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
