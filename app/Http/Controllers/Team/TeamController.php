<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\AcceptTeamInviteRequest;
use App\Http\Requests\Team\InviteRequest;
use App\Http\Requests\Team\TeamEditRequest;
use App\Http\Service\Team\TeamService;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(public readonly TeamService $teamService) {}

    public function edit(TeamEditRequest $request, Team $team): RedirectResponse
    {
        $this->teamService->editTeam($request->validated(), $team);

        return redirect('/home')->with('success', 'Team updated');
    }

    public function invite(InviteRequest $request): void
    {
        $this->teamService->inviteTeamMember($request->validated());
    }
    public function accept(Request $request): RedirectResponse
    {
        $this->teamService->accept($request['token']);

        return redirect('/home')->with('success', 'Team updated');
    }
}
