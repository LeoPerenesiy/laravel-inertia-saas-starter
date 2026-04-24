// resources/js/components/layout/AppLayout.tsx

import React, { useState } from 'react';
import Header from './Header';
import Sidebar from './Sidebar';

export default function AppLayout({
                                      children,
                                      user
}: {
    children: React.ReactNode;
    user: any;
    team: any;
}) {

    const [open, setOpen] = useState(false);

    return (
        <div className="flex h-screen bg-gray-100">

            {/* Mobile sidebar */}
            <div
                className={`fixed inset-0 z-40 bg-black/50 md:hidden ${
                    open ? 'block' : 'hidden'
                }`}
                onClick={() => setOpen(false)}
            />

            <div
                className={`fixed z-50 inset-y-0 left-0 transform md:relative md:translate-x-0 transition ${
                    open ? 'translate-x-0' : '-translate-x-full'
                }`}
            >
                <Sidebar team={user.owned_team} />
            </div>

            {/* Main */}
            <div className="flex-1 flex flex-col">

                {/* Header */}
                <div className="flex items-center justify-between md:hidden p-4 bg-white border-b">
                    <button onClick={() => setOpen(true)}>
                        ☰
                    </button>
                    <span className="font-semibold">{user.owned_team?.name}</span>
                </div>

                <Header user={user} />

                <main className="flex-1 p-6 overflow-y-auto">
                    {children}
                </main>
            </div>
        </div>
    );
}
