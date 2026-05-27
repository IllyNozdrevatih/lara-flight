<?php

namespace App\Services\User;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class UserService
{
    private const MAX_ATTEMPTS = 3;
    private const DECAY_SECONDS = 60;

    public function login(LoginRequest $request)
    {
        $rateLimitKey = 'login:' . str($request->input('email'))->lower() . ':' . $request->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            throw new ThrottleRequestsException(
                "Too many attempts. Try again in {$seconds} sek."
            );
        }

        RateLimiter::hit($rateLimitKey, self::DECAY_SECONDS);

        // RateLimiter::clear($rateLimitKey);

        $request->authenticate();
        $user = Auth::user();

        $user->tokens()->delete();

        $expiresAt = now()->addMinutes(60);
        $token = $this->generateToken($expiresAt);
        $refresh_token = $this->generateRefreshToken();

        SendWelcomeEmail::dispatch($user);

        return [
            'token' => $token,
            'expires_at' => $expiresAt->toIso8601String(),
            'refresh_token' => $refresh_token
        ];
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));
        $token = $user->createToken('api-token', ['*'], now()->addMinutes(60))->plainTextToken;

        SendWelcomeEmail::dispatch($user);

        return ['token' => $token, 'user' => $user];
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        // Delete all tokens (from all devices) $user->tokens()->delete()
    }

    public function refresh()
    {
        $user = Auth::user();

        $expiresAt = now()->addMinutes(60);

        $user->tokens()->delete();
        $token = $this->generateToken($expiresAt);
        $refresh_token = $this->generateRefreshToken();

        return [
            'token' => $token,
            'expires_at' => $expiresAt->toIso8601String(),
            'refresh_token' => $refresh_token
        ];
    }

    public function cabinet()
    {
        $user = Auth::user();
        $user->load('orders')->load('orders.flight');

        return $user;
    }

    private function generateToken($expiresAt){
        $user = Auth::user();

        return $user->createToken(
            'api-token',
            ['access'],
            $expiresAt
        )->plainTextToken;
    }


    private function generateRefreshToken(){
        $user = Auth::user();

        return $user->createToken(
            'api-refresh-token',
            ['refresh'],
        )->plainTextToken;

    }
}
