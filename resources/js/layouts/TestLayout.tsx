import type { PropsWithChildren } from 'react';
import Navbar from '@/components/Navbar';

export default function TestLayout({ children }: PropsWithChildren) {
    return (
        <div className="min-h-screen bg-gray-50">
            <Navbar />
            <main className="pt-20">
                {children}
            </main>
        </div>
    );
}
