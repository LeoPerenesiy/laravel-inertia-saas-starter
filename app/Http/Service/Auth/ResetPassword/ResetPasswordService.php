<?php

namespace App\Http\Service\Auth\ResetPassword;

use Illuminate\Support\Facades\Password;

final class ResetPasswordService
{
    public function reset(array $data)
    {
        return Password::reset(
            $data,
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );
    }
}
