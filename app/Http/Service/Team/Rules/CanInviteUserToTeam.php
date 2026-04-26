<?php

namespace App\Http\Service\Team\Rules;

use App\Models\Team;
use App\Models\User;
use DomainException;

class CanInviteUserToTeam
{
    public function check(User $actor, Team $team, string $email): ?User
    {
        if ($actor->email === $email) {
            throw new DomainException('You cannot invite yourself.');
        }

        $invitedUser = User::where('email', $email)->first();

        if ($invitedUser && $team->hasUser($invitedUser)) {
            throw new DomainException('User already in team.');
        }

        return $invitedUser;
    }
}
