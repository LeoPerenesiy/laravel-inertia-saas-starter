import { Head, Link, router } from '@inertiajs/react';
import React, { useState } from 'react';

type FormData = {
    email: string;
    password: string;
};

type Errors = Partial<FormData>;

export default function Login() {
    const [form, setForm] = useState<FormData>({
        email: '',
        password: '',
    });

    const [errors, setErrors] = useState<Errors>({});

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;

        setForm((prev) => ({
            ...prev,
            [name]: value,
        }));

        setErrors((prev) => ({
            ...prev,
            [name]: '',
        }));
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        router.post('/login', form, {
            onError: (serverErrors) => {
                setErrors(serverErrors as Errors);
            },
        });
    };

    return (
        <>
            <Head title="Login" />

            <div className="flex min-h-screen items-center justify-center bg-[#FDFDFC] dark:bg-[#0a0a0a] p-6">
                <div className="w-full max-w-md bg-white dark:bg-[#111] p-6 rounded-2xl shadow">

                    <h1 className="text-2xl font-bold mb-6 text-center">
                        Welcome back
                    </h1>

                    <form onSubmit={handleSubmit} className="flex flex-col gap-4">

                        <div>
                            <input
                                type="email"
                                name="email"
                                placeholder="Email"
                                value={form.email}
                                onChange={handleChange}
                                className={`w-full border p-2 rounded ${
                                    errors.email ? 'border-red-500' : ''
                                }`}
                            />
                            {errors.email && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.email}
                                </p>
                            )}
                        </div>

                        <div>
                            <input
                                type="password"
                                name="password"
                                placeholder="Password"
                                value={form.password}
                                onChange={handleChange}
                                className={`w-full border p-2 rounded ${
                                    errors.password ? 'border-red-500' : ''
                                }`}
                            />
                            {errors.password && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.password}
                                </p>
                            )}
                        </div>

                        <button
                            type="submit"
                            className="bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200 font-medium"
                        >
                            Login
                        </button>
                    </form>

                    <div className="flex gap-3 justify-center mt-3">
                        <a
                            href="/auth/google"
                            className="border px-4 py-2 rounded hover:bg-gray-100 inline-block"
                        >
                            🔵 Google
                        </a>
                        <a
                            href="/auth/github"
                            className="border px-4 py-2 rounded hover:bg-gray-100 flex items-center gap-2"
                        >
                            ⚫ GitHub
                        </a>
                        <button className="border px-4 py-2 rounded hover:bg-gray-100">
                            🔵 Facebook
                        </button>
                        <button className="border px-4 py-2 rounded hover:bg-gray-100">
                            ⚫ Apple
                        </button>
                        <button className="border px-4 py-2 rounded hover:bg-gray-100">
                            ⚫ Linkedin
                        </button>
                    </div>

                    <p className="text-center text-sm text-gray-500 mt-4">
                        Don’t have an account?{' '}
                        <Link
                            href="/register"
                            className="text-blue-500 hover:underline"
                        >
                            Sign up
                        </Link>
                    </p>

                    <p className="text-center">
                        <Link
                            href="/forgot-password"
                            className="text-sm text-blue-500 hover:underline"
                        >
                            Forgot password?
                        </Link>
                    </p>
                </div>
            </div>
        </>
    );
}
