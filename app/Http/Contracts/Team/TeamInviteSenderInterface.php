<?php

namespace App\Http\Contracts\Team;

use App\Models\Team;
use App\Models\User;

interface TeamInviteSenderInterface
{
    public function send(string $email, User $inviter, Team $team, string $token): void;
}
