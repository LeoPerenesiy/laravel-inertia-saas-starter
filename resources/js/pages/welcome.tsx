import { Head, Link } from '@inertiajs/react';

export default function Welcome() {
    return (
        <>
            <Head title="Welcome" />

            <div className="flex min-h-screen flex-col items-center justify-center bg-gray-50 dark:bg-[#0a0a0a] p-6">

                {/* Logo */}
                <div className="mb-8 text-center">
                    <div className="text-4xl font-bold text-blue-600">
                        🚀 MyApp
                    </div>
                    <p className="text-gray-500 mt-2">
                        Welcome to your platform
                    </p>
                </div>

                {/* Links */}
                <div className="flex gap-4">
                    <Link
                        href="/login"
                        className="px-6 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 transition"
                    >
                        Login
                    </Link>

                    <Link
                        href="/register"
                        className="px-6 py-2 rounded border border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                    >
                        Register
                    </Link>
                </div>

                {/* Footer */}
                <div className="mt-10 text-sm text-gray-400">
                    Built with ❤️ using Laravel & Inertia
                </div>
            </div>
        </>
    );
}
