<?php

namespace App\Http\Controllers\Authorisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Services\User\UserService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class  UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->userService->login($request);
            Log::info('User logged in', ['user_id' => Auth::id()]);
            return response()->json($data);
        } catch (\Throwable $e) {
            Log::error($e);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function cabinet()
    {
        $user = $this->userService->cabinet();
        return response()->json(['user' => new UserCollection($user)]);
    }

    public function logout()
    {
        try {
            $this->userService->logout();

            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $this->userService->store($request);
            $user = $data['user'];
            $token = $data['token'];

            Log::info('User registered successfully',
                Arr::only($user, ['email', 'user_id']));

            return response()->json([
                'user' => new UserCollection($user),
                'token' => $token,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('User registration failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Registration failed'], 500);
        }
    }
}
