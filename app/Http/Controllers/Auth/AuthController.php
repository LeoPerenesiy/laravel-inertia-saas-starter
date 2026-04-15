<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegisterRequest;
use App\Http\Request\ResetPasswordRequest;
use App\Http\Request\VerificationRequest;
use App\Http\Service\Auth\Login\LoginService;
use App\Http\Service\Auth\Registeration\RegisterUserService;
use App\Http\Service\Auth\Registeration\SaasStrict\VerifyEmailService;
use App\Http\Service\Auth\ResetPassword\ResetPasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

final class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterUserService $registerUserService): RedirectResponse
    {
        $registerUserService->handle($request->validated());

        return redirect('/login');
    }

    public function verification(VerificationRequest $request, VerifyEmailService $verifyEmailService): RedirectResponse
    {
        $verifyEmailService->handle($request->validated());

        return redirect('/login');
    }

    public function login(LoginRequest $request, LoginService $loginService): RedirectResponse
    {
        $success = $loginService->login($request->validated());

        if ($success) {
            return redirect('/home');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordService $resetPasswordService): RedirectResponse
    {
        $result = $resetPasswordService->reset($request->validated());

        return $result === Password::PASSWORD_RESET
            ? redirect('/login')
            : back()->withErrors(['email' => __($result)]);
    }
}
