import { Head, router } from '@inertiajs/react';
import React, { useState } from 'react';

export default function ForgotPassword() {
    const [email, setEmail] = useState('');
    const [sent, setSent] = useState(false);
    const [error, setError] = useState('');

    const submit = (e: React.FormEvent) => {
        e.preventDefault();

        router.post('/forgot-password', { email }, {
            onSuccess: () => setSent(true),
            onError: (errors) => {
                setError(errors.email);
            }
        });
    };

    return (
        <>
            <Head title="Forgot password" />

            <div className="min-h-screen flex items-center justify-center">
                <form onSubmit={submit} className="w-96 p-6 border rounded">
                    <h1 className="text-xl mb-4">Reset password</h1>

                    <input
                        type="email"
                        className="w-full border p-2 rounded"
                        placeholder="Email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />

                    {error && <p className="text-red-500 text-sm">{error}</p>}

                    <button className="mt-4 w-full bg-blue-500 text-white p-2 rounded">
                        Send reset link
                    </button>

                    {sent && (
                        <p className="text-green-500 text-sm mt-3">
                            Check your email
                        </p>
                    )}
                </form>
            </div>
        </>
    );
}
