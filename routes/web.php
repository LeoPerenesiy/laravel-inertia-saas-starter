<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Team\TeamController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'welcome')->middleware('guest');

/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::inertia('/login', 'login')->name('login');
    Route::inertia('/register', 'register')->name('register');
    Route::inertia('/forgot-password', 'forgot-password')->name('forgot-password');
    Route::get('/reset-password/{token}', function (Request $request, $token) {
        return inertia('reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    })->name('password.reset');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::get('/team/invite/accept', [TeamController::class, 'accept'])
    ->name('team.invite.accept')->middleware('signed');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/home', function () {

        $user = auth()->user();

        return Inertia::render('home', [
            'user' => $user->load('ownedTeam'),
        ]);
    })->name('home');

    Route::post('/logout', [AuthController::class, 'logout']);

    /** TEAM **/
    Route::patch('/team/{team}', [TeamController::class, 'edit']);
    Route::post('/team/invite', [TeamController::class, 'invite']);
});

/*
|--------------------------------------------------------------------------
| SOCIAL AUTH (without middleware)
|--------------------------------------------------------------------------
*/
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION (STRICT)
|--------------------------------------------------------------------------
*/
Route::get('/verification', [AuthController::class, 'verification'])
    ->middleware('signed')
    ->name('verification.strict');

/*
|--------------------------------------------------------------------------
| LARAVEL DEFAULT EMAIL VERIFICATION (if use)
|--------------------------------------------------------------------------
*/
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['signed'])->name('verification.verify');
