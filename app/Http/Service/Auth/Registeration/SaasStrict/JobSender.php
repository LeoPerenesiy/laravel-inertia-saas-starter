<?php

namespace App\Http\Service\Auth\Registeration\SaasStrict;

use App\Http\Service\Auth\Registeration\EmailSenderInterface;
use App\Jobs\SendRegistrationVerificationEmailJob;
use App\Models\User;

final class JobSender implements EmailSenderInterface
{
    public function send(User $user): void
    {
        SendRegistrationVerificationEmailJob::dispatch($user);
    }
}
