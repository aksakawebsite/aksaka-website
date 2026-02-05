import { Head } from '@inertiajs/react';
import TestLayout from '@/layouts/TestLayout';

export default function TestNavbar() {
    return (
        <TestLayout>
            <Head title="Navbar Test" />
            
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
                <div className="text-center mb-12">
                     <h1 className="text-4xl font-bold font-league text-gray-900 mb-4">Navbar Verification Page</h1>
                     <p className="text-lg text-gray-600">Resize the browser to test the responsive mobile menu.</p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-64 flex items-center justify-center">
                        <span className="text-gray-400">Content Area 1</span>
                    </div>
                     <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-64 flex items-center justify-center">
                        <span className="text-gray-400">Content Area 2</span>
                    </div>
                </div>
                
                <div className="mt-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-96 flex items-center justify-center">
                     <span className="text-gray-400">Long Scrollable Area</span>
                </div>
            </div>
        </TestLayout>
    );
}
