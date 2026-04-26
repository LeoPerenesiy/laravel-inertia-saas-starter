<?php

namespace App\Http\Service\Mail;

use App\Http\Contracts\Team\TeamInviteSenderInterface;
use App\Mail\TeamInvitationEmail;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TeamInviteSender implements TeamInviteSenderInterface
{
    public function send(string $email, User $inviter, Team $team, string $token): void
    {
        Mail::to($email)->send(
            new TeamInvitationEmail($inviter, $team, $email, $token)
        );
    }
}
