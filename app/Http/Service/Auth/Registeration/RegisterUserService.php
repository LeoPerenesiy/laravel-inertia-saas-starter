<?php

namespace App\Http\Service\Auth\Registeration;

use App\Http\Service\Team\TeamService;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

readonly class RegisterUserService
{
    public function __construct(private EmailSenderInterface $emailSender, private TeamService $teamService) {}

    public function handle(array $data)
    {
        $user = DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $this->teamService->createTeam($data['name'], $user->id);

            return $user;
        });

        $this->emailSender->send($user);

        return $user;
    }
}
