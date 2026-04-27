<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\InviteRequest;
use App\Http\Requests\Team\TeamEditRequest;
use App\Http\Service\Team\TeamService;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

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

    public function index(): Response
    {
        $user = auth()->user();

        $team = $user->ownedTeam;

        $members = $team->users()
            ->select('users.id', 'users.name')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('home', [
            'user' => $user->load('ownedTeam'),
            'members' => $members,
        ]);
    }
}
