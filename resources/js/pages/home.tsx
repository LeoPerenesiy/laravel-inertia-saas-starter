import { Head } from '@inertiajs/react';
import AppLayout from '@/components/layout/AppLayout';

export default function Home({
                                 user,
                                 team,
                             }: {
    user: any;
    team: any;
}) {
    return (
        <>
            <Head title="Home" />

            <AppLayout user={user} team={user.team}>
                <h1 className="text-2xl font-bold">
                    Welcome, {user.name} 👋
                </h1>
            </AppLayout>
        </>
    );
}
