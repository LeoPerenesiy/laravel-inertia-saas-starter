<?php

namespace App\Http\Service\Auth\Registeration\LaravelBasicNonStrict;

use App\Http\Service\Auth\Registeration\EmailSenderInterface;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

final class EventSender implements EmailSenderInterface
{
    public function send(User $user): void
    {
        Auth::login($user);
        event(new Registered($user));
    }
}
