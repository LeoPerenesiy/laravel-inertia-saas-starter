<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail($email): ?User
    {
        return User::query()->where('email', $email)->first();
    }
}
