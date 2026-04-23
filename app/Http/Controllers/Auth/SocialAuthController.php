<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Service\Auth\Social\SocialAuthService;
use Laravel\Socialite\Facades\Socialite;

final class SocialAuthController extends Controller
{
    public function __construct(private readonly SocialAuthService $socialAuthService) {}

    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        return $this->socialAuthService->loginOrRegister($provider);
    }
}
