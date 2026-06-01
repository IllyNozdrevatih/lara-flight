<?php

namespace App\Domains\User\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->currentAccessToken()->can('access')) {
            return response()->json(['message' => 'Access token required'], 403);
        }
        return $next($request);
    }
}
