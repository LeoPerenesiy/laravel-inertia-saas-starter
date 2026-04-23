<?php

namespace App\Http\Service\Auth\Social;

use App\Http\Service\Team\TeamService;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Socialite;

class SocialAuthService
{
    public function __construct(private readonly TeamService $teamService) {}

    public function handle(string $provider)
    {

    }
}
