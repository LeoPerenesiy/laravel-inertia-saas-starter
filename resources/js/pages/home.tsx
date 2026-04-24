import { Head } from '@inertiajs/react';
import AppLayout from '@/components/layout/AppLayout';
import TeamDashboard from '@/components/team/TeamDashboard';

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
                <TeamDashboard team={user.owned_team} />
            </AppLayout>
        </>
    );
}
