<?php

namespace App\Mail;

use App\Models\Team;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;

class TeamInvitationEmail extends Mailable
{
    public string $inviteUrl;

    public function __construct(
        public User $inviter,
        public Team $team,
        public string $email,
        public string $token
    ) {
        $this->inviteUrl = route('team.invite.accept', [
            'token' => $token,
        ]);
    }

    public function build(): TeamInvitationEmail
    {
        return $this->subject('You are invited to a team')
            ->view('emails.teamInvitation', [
                'inviter' => $this->inviter,
                'team' => $this->team,
                'inviteUrl' => $this->inviteUrl,
            ]);
    }
}
