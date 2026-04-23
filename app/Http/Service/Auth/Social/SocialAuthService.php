<?php

namespace App\Http\Service\Auth\Social;

use App\Http\Service\Team\TeamService;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Socialite;
use Throwable;

final readonly class SocialAuthService
{
    public function __construct(private TeamService $teamService) {}

    public function loginOrRegister(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = DB::transaction(function () use ($provider, $socialUser) {

                $account = SocialAccount::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

                if ($account) {
                    return $account->user;
                }

                $email = $socialUser->getEmail();

                $user = $email
                    ? User::where('email', $email)->lockForUpdate()->first()
                    : null;

                // 🔹 create user if not created
                if (! $user) {
                    $user = User::create([
                        'name' => $socialUser->getName() ?? 'User',
                        'email' => $email,
                        'password' => null,
                        'email_verified_at' => $email ? now() : null,
                    ]);

                    $this->teamService->createTeam($user->name, $user->id);
                }

                // 🔹 Create social account
                SocialAccount::create([
                    'user_id' => $user->id,
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);

                return $user;
            });

            // 🔹 login outside transaction
            Auth::login($user);

            return redirect('/home');

        } catch (Throwable $e) {
            report($e);

            return redirect('/login')->withErrors([
                'oauth' => 'Authentication failed. Please try again.',
            ]);
        }
    }
}
