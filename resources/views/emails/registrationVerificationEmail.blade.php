<h2>Подтверждение email</h2>

<p>Привет, {{ $user->name }}!</p>

<p>Нажми на кнопку ниже, чтобы подтвердить email:</p>

<a href="{{ $verificationUrl }}">
    Подтвердить email
</a>
