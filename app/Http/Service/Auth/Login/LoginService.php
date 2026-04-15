<?php

namespace App\Http\Service\Auth\Login;

use Illuminate\Support\Facades\Auth;

final class LoginService
{
    public function login(array $data): bool
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return true;
        }

        return false;
    }
}
