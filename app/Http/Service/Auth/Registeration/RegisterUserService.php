<?php

namespace App\Http\Service\Auth\Registeration;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class RegisterUserService
{
    public function __construct(private EmailSenderInterface $emailSender) {}

    public function handle(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->emailSender->send($user);

        return $user;
    }
}
