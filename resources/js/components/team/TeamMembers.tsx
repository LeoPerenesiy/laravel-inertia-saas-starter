import { router } from '@inertiajs/react';

export default function TeamMembers({ team }: any) {

    const fakeTeam = {
        id: 1,
        members: [
            { id: 1, name: 'John Doe' },
            { id: 2, name: 'Jane Smith' },
            { id: 3, name: 'Alex Johnson' },
        ],
    };

    return (
        <div>
            <h3 className="font-semibold mb-2">Members</h3>

            <ul className="space-y-2">
                {fakeTeam.members.map((member: any) => (
                    <li key={member.id} className="flex justify-between">
                        <span>{member.name}</span>

                        <button
                            className="text-red-500"
                            onClick={() => {
                                router.delete(`/teams/${team.id}/members/${member.id}`);
                            }}
                        >
                            Remove
                        </button>
                    </li>
                ))}
            </ul>
        </div>
    );
}
