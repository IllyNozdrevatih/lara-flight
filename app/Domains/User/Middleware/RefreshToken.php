<?php

namespace App\Domains\User\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RefreshToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->currentAccessToken()->can('refresh')) {
            return response()->json(['message' => 'Refresh token required'], 403);
        }
        return $next($request);
    }
}
