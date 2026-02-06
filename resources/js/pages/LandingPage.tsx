import { Head } from '@inertiajs/react';
import Footer from '@/components/Footer';
import Navbar from '@/components/Navbar';

export default function LandingPage() {
    return (
        <div className="min-h-screen bg-white">
            <Head title="Welcome" />
            <Navbar />

            {/* Section 1: Hero */}
            <section className="container mx-auto px-4 pt-28 pb-12 md:pt-32 md:pb-20 lg:pt-40 lg:pb-28">
                <div className="flex flex-col-reverse lg:flex-row items-center gap-10">
                    {/* Left: Content */}
                    <div className="w-full lg:w-1/2 space-y-6 text-center lg:text-left">
                        <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-gray-900">
                            Transforming Ideas into <span className="text-blue-600">Digital Reality</span>
                        </h1>
                        <p className="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto lg:mx-0">
                            We help businesses grow by providing top-notch digital solutions. From web development to digital marketing, we have got you covered.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <button className="px-8 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition duration-300">
                                Get Started
                            </button>
                            <button className="px-8 py-3 bg-white text-blue-600 border-2 border-blue-600 rounded-full font-semibold hover:bg-blue-50 transition duration-300">
                                Learn More
                            </button>
                        </div>
                    </div>

                    {/* Right: Image */}
                    <div className="w-full lg:w-1/2 flex justify-center">
                        <img
                            src="/image/landing-page/section-1-right.png"
                            alt="Hero Illustration"
                            className="max-w-full h-auto object-contain"
                        />
                    </div>
                </div>
            </section>

            {/* Section 2: Partners */}
            <section className="bg-gray-50 py-12">
                <div className="container mx-auto px-4 text-center">
                    <p className="text-gray-500 font-medium mb-8">TRUSTED BY INNOVATIVE COMPANIES</p>
                    <div className="flex flex-wrap justify-center items-center gap-8 md:gap-16 grayscale opacity-70">
                        <img
                            src="/image/landing-page/section-2-logo-1.png"
                            alt="Partner 1"
                            className="h-10 md:h-12 object-contain"
                        />
                        <img
                            src="/image/landing-page/section-2-logo-2.png"
                            alt="Partner 2"
                            className="h-10 md:h-12 object-contain"
                        />
                    </div>
                </div>
            </section>

             {/* Section 4: Features */}
             <section className="container mx-auto px-4 py-16 md:py-24">
                <div className="flex flex-col lg:flex-row items-center gap-12">
                     {/* Left: Content */}
                    <div className="w-full lg:w-1/2 space-y-8 order-2 lg:order-1">
                         <div className="space-y-4">
                            <h2 className="text-3xl md:text-4xl font-bold text-gray-900">
                                Seamless Integration for Your Workflow
                            </h2>
                            <p className="text-lg text-gray-600">
                                Our platform is designed to fit perfectly into your existing ecosystem, providing powerful tools without the complexity.
                            </p>
                        </div>

                        <div className="space-y-6">
                            <div className="flex gap-4">
                                <div className="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h3 className="text-xl font-bold text-gray-900 mb-2">High Performance</h3>
                                    <p className="text-gray-600">Optimized for speed and efficiency, ensuring your operations never slow down.</p>
                                </div>
                            </div>

                            <div className="flex gap-4">
                                <div className="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                                   <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <div>
                                    <h3 className="text-xl font-bold text-gray-900 mb-2">Secure & Reliable</h3>
                                    <p className="text-gray-600">Bank-grade security protocols to keep your data safe and accessible 24/7.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Right: Image */}
                    <div className="w-full lg:w-1/2 flex justify-center order-1 lg:order-2">
                        <img
                            src="/image/landing-page/section-4-right.png"
                            alt="Features Illustration"
                            className="max-w-full h-auto object-contain rounded-2xl shadow-xl"
                        />
                    </div>
                </div>
            </section>
            
            <Footer />
        </div>
    );
}
