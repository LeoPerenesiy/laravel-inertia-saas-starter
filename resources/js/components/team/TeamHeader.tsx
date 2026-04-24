import { router } from '@inertiajs/react';

export default function TeamHeader({ team }: any) {
    return (
        <div className="flex items-center justify-between">
            <h1 className="text-2xl font-bold">
                {team.name}
            </h1>

            <button
                className="text-blue-500"
                onClick={() => {
                    const name = prompt('New team name', team.name);

                    if (!name) {
return;
}

                    router.patch(`/team/${team.id}`, {
                        name,
                    });
                }}
            >
                Edit
            </button>
        </div>
    );
}
