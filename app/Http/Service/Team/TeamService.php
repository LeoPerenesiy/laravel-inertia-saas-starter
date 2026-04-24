<?php

namespace App\Http\Service\Team;

use App\Models\Team;

class TeamService
{
    public function createTeam($name, $user_id): void
    {
        $team = Team::create([
            'name' => $name."'s Team",
            'owner_id' => $user_id,
        ]);

        $team->users()->attach($user_id, [
            'role' => 'owner',
        ]);
    }

    public function editTeam(array $data, Team $team): Team
    {
        $team->update([
            'name' => $data['name'],
        ]);

        return $team;
    }

    public function inviteTeamMembers(Team $team, array $members): void {}

    public function removeTeamMember(Team $team, int $user_id): void {}
}
