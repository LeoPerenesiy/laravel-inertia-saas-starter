<?php

namespace App\Http\Service\Team;

use App\Http\Contracts\Team\TeamInviteSenderInterface;
use App\Http\Service\Team\Rules\CanInviteUserToTeam;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

readonly class TeamService
{
    public function __construct(private CanInviteUserToTeam $rule, private TeamInviteSenderInterface $inviteSender) {}

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

    public function inviteTeamMember(array $data): void
    {
        /** @var User $user */
        $user = auth()->user();
        $team = $user->ownedTeam;

        abort_if(! $team, 403);

        $invitedUser = $this->rule->check($user, $team, $data['email']);

        $token = Str::random(64);

        $exists = TeamInvitation::where('team_id', $team->id)
            ->where('email', $data['email'])
            ->exists();

        abort_if($exists, 422, 'Invitation already sent.');

        TeamInvitation::create([
            'team_id' => $team->id,
            'email' => $data['email'],
            'invited_by' => $user->id,
            'token_hash' => hash('sha256', $token),
            'expires_at' => now()->addDays(2),
        ]);

        $this->inviteSender->send($data['email'], $invitedUser, $team, $token);
    }

    public function accept(string $tokenHash): void
    {
        Log::info('Start');

        DB::transaction(function () use ($tokenHash) {

            $invite = TeamInvitation::where('token_hash', $tokenHash)
                ->lockForUpdate()
                ->firstOrFail();

            if (! hash_equals($invite->token, hash('sha256', $tokenHash))) {
                abort(403);
            }

            if ($invite->expires_at->isPast()) {
                abort(403);
            }

            $user = User::firstOrCreate([
                'email' => $invite->email,
            ]);

            $team = $invite->team;

            Log::info('Atached');

            $team->members()->syncWithoutDetaching($user->id);

            $invite->delete();
        });
    }

    public function removeTeamMember(Team $team, int $user_id): void {}
}
