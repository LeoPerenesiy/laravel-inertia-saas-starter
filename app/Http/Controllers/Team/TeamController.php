<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Request\Team\TeamEditRequest;
use App\Http\Service\Team\TeamService;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;

class TeamController extends Controller
{
    public function __construct(public readonly TeamService $teamService) {}

    public function edit(TeamEditRequest $request, Team $team): RedirectResponse
    {
        $this->teamService->editTeam($request->validated(), $team);

        return redirect('/home')->with('success', 'Team updated');
    }
}
