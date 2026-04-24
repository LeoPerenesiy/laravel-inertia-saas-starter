
import { Link } from '@inertiajs/react';

export default function Sidebar({ team }: { team: any }) {
    return (
        <div className="h-full w-64 bg-gray-900 text-white flex flex-col">
            <div className="p-4 text-lg font-semibold border-b border-gray-700">
                {team?.name ?? 'Team'}
            </div>

            <nav className="flex-1 p-4 space-y-2">
                <Link href="/home" className="block px-3 py-2 rounded hover:bg-gray-800">
                    Dashboard
                </Link>
                <Link href="/projects" className="block px-3 py-2 rounded hover:bg-gray-800">
                    Projects
                </Link>
                <Link href="/projects" className="block px-3 py-2 rounded hover:bg-gray-800">
                    Info inside project/team
                </Link>
                <Link href="/projects" className="block px-3 py-2 rounded hover:bg-gray-800">
                    Subscription
                </Link>
                <Link href="/projects" className="block px-3 py-2 rounded hover:bg-gray-800">
                    Settings
                </Link>
            </nav>
        </div>
    );
}
