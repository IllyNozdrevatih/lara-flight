<?php

namespace App\Domains\User\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function check(): bool
    {
        return Auth::check();
    }

    public function user()
    {
        return Auth::user();
    }
}
