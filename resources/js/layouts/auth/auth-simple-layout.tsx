import { Link } from '@inertiajs/react';
import { home } from '@/routes';
import type { AuthLayoutProps } from '@/types';

export default function AuthSimpleLayout({
    children,
    title,
    description,
}: AuthLayoutProps) {
    return (
        <div 
            className="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10"
            style={{ background: 'linear-gradient(135deg, #D2B165 0%, #C49A3B 50%, #8B6914 100%)' }}
        >
            <div className="w-full max-w-md">
                <div className="rounded-2xl bg-white p-8 shadow-xl">
                    <div className="flex flex-col gap-6">
                        <div className="flex flex-col items-center gap-4">
                            <Link
                                href={home()}
                                className="flex flex-col items-center gap-2 font-medium"
                            >
                                <img
                                    src="/image/navbar/logo-aksaka.png"
                                    alt="Aksaka Logo"
                                    className="h-12 w-auto"
                                />
                            </Link>

                            <div className="space-y-2 text-center">
                                <h1 className="text-2xl font-bold text-[#8B6914]">{title}</h1>
                                <p className="text-center text-sm text-gray-600">
                                    {description}
                                </p>
                            </div>
                        </div>
                        {children}
                    </div>
                </div>
            </div>
        </div>
    );
}
