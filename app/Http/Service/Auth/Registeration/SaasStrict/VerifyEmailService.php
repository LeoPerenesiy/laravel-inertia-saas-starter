<?php

namespace App\Http\Service\Auth\Registeration\SaasStrict;

use App\Models\User;

final class VerifyEmailService
{
    public function handle($data): void
    {
        $user = User::findOrFail($data['id']);

        $user->update([
            'email_verified_at' => now(),
        ]);
    }
}
