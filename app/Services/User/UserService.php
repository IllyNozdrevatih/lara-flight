<?php

namespace App\Services\User;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
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

        return [
            'token' => $token,
            'expires_at' => $expiresAt->toIso8601String(),
        ];
    }

    public function store(StoreUserRequest $request)
    {

        $user = User::create($request->only('name', 'email', 'password'));
        $token = $user->createToken('api-token', ['*'], now()->addMinutes(60))->plainTextToken;

        return ['token' => $token, 'user' => $user];
    }

    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        // Delete all tokens (from all devices) $user->tokens()->delete()
    }

    public function cabinet()
    {

        $user = Auth::user();
        $user->load('orders')->load('orders.flight');

        return $user;
    }
}
