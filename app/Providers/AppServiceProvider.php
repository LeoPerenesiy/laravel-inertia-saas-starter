<?php

namespace App\Providers;

use App\Http\Contracts\Auth\Mail\EmailSenderInterface;
use App\Http\Contracts\Team\TeamInviteSenderInterface;
use App\Http\Service\Auth\Registeration\SaasStrict\JobSender;
use App\Http\Service\Mail\TeamInviteSender;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            EmailSenderInterface::class,
            JobSender::class
        );

        $this->app->bind(
            TeamInviteSenderInterface::class,
            TeamInviteSender::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
