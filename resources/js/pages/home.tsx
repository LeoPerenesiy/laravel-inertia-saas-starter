import { Head, Link } from '@inertiajs/react';

export default function Home({ user }: { user: any }) {
    return (
        <>
            <Head title="Home" />

            <div className="flex min-h-screen items-center justify-center bg-gray-50">
                <div className="text-center">
                    <h1 className="text-2xl font-bold mb-4">
                        Welcome, {user.name} 👋
                    </h1>

                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        className="px-4 py-2 bg-red-500 text-white rounded"
                    >
                        Logout
                    </Link>
                </div>
            </div>
        </>
    );
}
