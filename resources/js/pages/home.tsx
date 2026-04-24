import { Head } from '@inertiajs/react';
import AppLayout from '@/components/layout/AppLayout';

export default function Home({
                                 user,
                             }: {
    user: any;
    team: any;
}) {
    return (
        <>
            <Head title="Home" />

            <AppLayout user={user} team={user.team}>
                <h1>{user.owned_team.name}</h1>
                <h1 className="text-2xl font-bold">
                    Welcome, {user.name} 👋
                </h1>
                <h2>Invite member</h2>
                <h3>List of members</h3>
            </AppLayout>
        </>
    );
}
