<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\RequireRefreshToken;
use App\Http\Middleware\RequireAccessToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Auth\Access\AuthorizationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->alias([
            'refresh.token' => RequireRefreshToken::class,
            'access.token'  => RequireAccessToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthorizationException $e,
                                   $request
        ) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Access denied',
            ], 403);
        });
    })->create();
