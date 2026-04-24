import { router } from '@inertiajs/react';

export default function InviteMember({ team }: any) {
    const submit = () => {
        const email = prompt('Member email');

        if (!email) return;

        router.post(`/teams/${team.id}/invite`, {
            email,
        });
    };

    return (
        <div>
            <h3 className="font-semibold mb-2">Invite member</h3>

            <button
                className="bg-blue-500 text-white px-3 py-1 rounded"
                onClick={submit}
            >
                Invite
            </button>
        </div>
    );
}
