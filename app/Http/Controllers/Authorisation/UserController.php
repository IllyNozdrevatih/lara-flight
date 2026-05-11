<?php

namespace App\Http\Controllers\Authorisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Auth;

class  UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();

        $user->tokens()->delete();

        $expiresAt = now()->addMinutes(60);

        $token = $user->createToken(
            'api-token',
            ['*'],
            $expiresAt
        )->plainTextToken;

        return response()->json([
            'token' => $token,
            'expires_at' => $expiresAt->toIso8601String(),
        ]);
    }

    public function cabinet()
    {
        $user = Auth::user();
        $user->load('orders')->load('orders.flight');

        return response()->json(['user' => new UserCollection($user)]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        // Delete all tokens (from all devices) $user->tokens()->delete()

        return response()->json(['message' => 'Successfully logged out']);
    }
}
