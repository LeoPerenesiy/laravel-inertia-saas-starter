
import { Link } from '@inertiajs/react';

export default function Header({ user }: { user: any }) {
    return (
        <div className="h-14 bg-white border-b flex items-center justify-end px-6">
            <div className="flex items-center gap-4">
                <span className="text-sm text-gray-600">{user.name}</span>

                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    className="px-3 py-1 bg-red-500 text-white rounded"
                >
                    Logout
                </Link>
            </div>
        </div>
    );
}
