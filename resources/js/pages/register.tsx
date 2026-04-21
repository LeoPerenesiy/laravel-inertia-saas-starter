import { Head, Link, router } from '@inertiajs/react';
import React, { useState } from 'react';

type FormData = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

type Errors = Partial<FormData>;

export default function Register() {
    const [form, setForm] = useState<FormData>({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
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

    const validate = (): boolean => {
        const newErrors: Errors = {};

        if (!form.name) {
            newErrors.name = 'Name is required';
        }

        if (!form.email) {
            newErrors.email = 'Email is required';
        }

        if (!form.password) {
            newErrors.password = 'Password is required';
        }

        if (!form.password_confirmation) {
            newErrors.password_confirmation = 'Confirm your password';
        }

        if (
            form.password &&
            form.password_confirmation &&
            form.password !== form.password_confirmation
        ) {
            newErrors.password_confirmation = 'Passwords do not match';
        }

        setErrors(newErrors);

        return Object.keys(newErrors).length === 0;
    };

    const handleSubmit = (e: React.SyntheticEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (!validate()) {
            return;
        }

        router.post('/register', form, {
            onSuccess: () => {
                console.log('Registration successful!');
            },
            onError: (serverErrors) => {
                setErrors(serverErrors as Partial<typeof form>);
            },
        });
    };

    return (
        <>
            <Head title="Register" />

            <div className="flex min-h-screen items-center justify-center bg-[#FDFDFC] dark:bg-[#0a0a0a] p-6">
                <div className="w-full max-w-md bg-white dark:bg-[#111] p-6 rounded-2xl shadow">

                    <h1 className="text-2xl font-bold mb-6 text-center">
                        Register
                    </h1>

                    <form onSubmit={handleSubmit} className="flex flex-col gap-4">

                        <div>
                            <input
                                type="text"
                                name="name"
                                placeholder="Name"
                                value={form.name}
                                onChange={handleChange}
                                className={`w-full border p-2 rounded ${
                                    errors.name ? 'border-red-500' : ''
                                }`}
                            />
                            {errors.name && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.name}
                                </p>
                            )}
                        </div>

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

                        <div>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Confirm Password"
                                value={form.password_confirmation}
                                onChange={handleChange}
                                className={`w-full border p-2 rounded ${
                                    errors.password_confirmation ? 'border-red-500' : ''
                                }`}
                            />
                            {errors.password_confirmation && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.password_confirmation}
                                </p>
                            )}
                        </div>

                        <button
                            type="submit"
                            className="bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
                        >
                            Register
                        </button>
                    </form>

                    <div className="my-6 text-center text-sm text-gray-500">
                        or continue with
                    </div>

                    <div className="flex gap-3 justify-center">
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
                        <a
                            href="/auth/facebook"
                            className="border px-4 py-2 rounded hover:bg-gray-100 flex items-center gap-2"
                        >
                            🔵 Facebook
                        </a>
                        <a
                            href="/auth/linkedin-openid"
                            className="border px-4 py-2 rounded hover:bg-gray-100 flex items-center gap-2"
                        >
                            ⚫ Linkedin
                        </a>
                    </div>

                    <Link
                        href="/login"
                        className="block text-center mt-3 bg-white border border-blue-500 text-blue-500 py-2 rounded-lg hover:bg-blue-50 transition duration-200 font-medium"
                    >
                        Already have an account? Login
                    </Link>
                </div>
            </div>
        </>
    );
}
