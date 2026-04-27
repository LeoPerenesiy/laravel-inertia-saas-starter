<h2>You’ve been invited to join a team</h2>

<p>
    <strong>{{ $inviter->name }}</strong> invited you to join the team
    <strong>{{ $team->name }}</strong>.
</p>

<p>Click the button below to accept the invitation:</p>

<p>
    <a href="{{ $inviteUrl }}"
       style="display:inline-block;padding:10px 15px;background:#4F46E5;color:#fff;text-decoration:none;border-radius:6px;">
        Accept Invitation
    </a>
</p>

<p style="color:#888;font-size:12px;">
    This link will expire in 24 hours.
</p>
