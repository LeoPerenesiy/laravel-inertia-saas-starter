<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

final class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
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
                }

                // 🔹 создаём social account
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
