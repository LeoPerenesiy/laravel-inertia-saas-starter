
export default function TeamMembers({ members }: any) {

    return (
        <div>
            <h3 className="font-semibold mb-2">Members</h3>

            <ul className="space-y-2">
                {members.data.map((member: any) => (
                    <li key={member.id} className="flex justify-between">
                        <span>{member.name}</span>

                        <button
                            className="text-red-500"
                            onClick={() => {
                                // router.delete(`/teams/members/${member.id}`);
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
