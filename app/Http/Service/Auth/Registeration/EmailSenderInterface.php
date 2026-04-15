<?php

namespace App\Http\Service\Auth\Registeration;

use App\Models\User;

interface EmailSenderInterface
{
    public function send(User $user);
}
