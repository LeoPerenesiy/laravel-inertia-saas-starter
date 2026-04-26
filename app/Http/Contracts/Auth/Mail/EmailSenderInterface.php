<?php

namespace App\Http\Contracts\Auth\Mail;

use App\Models\User;

interface EmailSenderInterface
{
    public function send(User $user);
}
