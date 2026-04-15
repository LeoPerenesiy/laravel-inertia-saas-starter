import { router } from '@inertiajs/react';
import React, { useState } from 'react';

type Props = {
    token: string;
    email: string;
};

export default function ResetPassword({ token, email }: Props) {
    const [form, setForm] = useState({
        token,
        email,
        password: '',
        password_confirmation: '',
    });

    const submit = (e: React.SyntheticEvent<HTMLFormElement>) => {
        e.preventDefault();

        router.post('/reset-password', form);
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50 px-4">
            <div className="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

                <h1 className="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Reset password
                </h1>

                <form onSubmit={submit} className="space-y-4">

                    {/* Email */}
                    <div>
                        <input
                            value={form.email}
                            type="hidden"
                            className="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed"
                        />
                    </div>

                    {/* Password */}
                    <div>
                        <label className="text-sm text-gray-600">
                            New password
                        </label>
                        <input
                            type="password"
                            onChange={(e) =>
                                setForm({
                                    ...form,
                                    password: e.target.value,
                                })
                            }
                            className="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    {/* Confirm */}
                    <div>
                        <label className="text-sm text-gray-600">
                            Confirm password
                        </label>
                        <input
                            type="password"
                            onChange={(e) =>
                                setForm({
                                    ...form,
                                    password_confirmation: e.target.value,
                                })
                            }
                            className="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <button
                        type="submit"
                        className="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium"
                    >
                        Reset password
                    </button>
                </form>
            </div>
        </div>
    );
}
