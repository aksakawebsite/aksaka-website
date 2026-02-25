import { Head, usePage } from '@inertiajs/react';
import Footer from '@/components/Footer';
import Navbar from '@/components/Navbar';
import { login } from '@/routes';
import { dashboard } from '@/routes/filament/member/pages';
import type { SharedData } from '@/types';

interface ProgramCard {
    id: number;
    title: string;
    icon: string;
    description: string;
    items: string[];
    layout: 'grid' | 'list';
}

const programCards: ProgramCard[] = [
    {
        id: 1,
        title: 'Digital Literacy',
        icon: '/image/landing-page/icon-digital-literacy.png',
        description: 'Koleksi materi yang membahas dasar-dasar literasi digital, penggunaan teknologi, serta pemahaman internet yang aman dan produktif.',
        items: [
            'Pengenalan Dunia Digital',
            'Keamanan Digital',
            'Etika Berinternet',
            'Manajemen Informasi Digital'
        ],
        layout: 'list',
    },
    {
        id: 2,
        title: 'Productivity & Tools',
        icon: '/image/landing-page/icon-productivity.png',
        description: 'Materi mengenai berbagai tools digital yang dapat meningkatkan produktivitas kerja, kolaborasi tim, dan pengelolaan tugas secara efektif.',
        items: [
            'Google Workspace',
            'Manajemen Tugas',
            'Kolaborasi Tim Digital',
            'Workflow Produktif'
        ],
        layout: 'list',
    },
    {
        id: 3,
        title: 'Learning Resources',
        icon: '/image/landing-page/icon-learning.png',
        description: 'Koleksi sumber pembelajaran tambahan seperti e-book, modul pembelajaran, serta referensi digital yang dapat digunakan untuk memperdalam pengetahuan.',
        items: [
            'E-Book Pembelajaran',
            'Modul Materi',
            'Referensi Digital',
            'Ringkasan Materi'
        ],
        layout: 'list',
    },
];

export default function LandingPage() {
    const { auth } = usePage<SharedData>().props;
    const isAuthenticated = auth?.user !== null && auth?.user !== undefined;

    const scrollToSection = (sectionId: string) => {
        const element = document.getElementById(sectionId);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    };

    return (
        <div className="min-h-screen bg-[#E7F1F2]">
            <Head title="Welcome" />
            <Navbar />

            {/* Section 1: Hero */}
            <section className="pt-28" style={{ background: 'linear-gradient(to right, #D2B165,  #C49A3B)' }}>
                <div className="container mx-auto">
                    <div className="flex flex-col lg:flex-row items-center gap-10 max-w-6xl mx-auto px-4">
                        {/* Left: Content */}
                        <div className="w-full lg:w-1/2 space-y-6 text-center lg:text-left">
                            <div className='flex flex-row'>
                                <img
                                    src="/image/landing-page/section-1-stars.png"
                                    alt="Hero Illustration"
                                    className="w-8 mr-2 h-auto object-contain"
                                />
                                <p className="text-lg md:text-xl text-white max-w-2xl mx-auto lg:mx-0">
                                Belajar Lebih Terarah, Berkembang Lebih Cepat
                                </p>
                            </div>
                            <h1 className="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight text-white">
                                Platform Pembelajaran <br/>AKSAKA Digital
                            </h1>
                            <p className="text-lg md:text-xl text-white max-w-2xl mx-auto lg:mx-0">
                                Akses materi, kerjakan kuis, dan pantau progres belajar dalam satu platform.
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <button
                                    onClick={() => scrollToSection('program')}
                                    className="px-6 py-2.5 bg-white text-[#2D2A26] rounded-lg font-medium hover:bg-gray-100 transition duration-300 shadow-sm"
                                >
                                    Lihat Program
                                </button>
                                <a
                                    href={isAuthenticated ? dashboard.url() : login.url()}
                                    className="px-6 py-2.5 bg-[#C49A3B] text-white rounded-lg font-medium hover:bg-[#B08A30] transition duration-300 text-center"
                                >
                                    {isAuthenticated ? 'Dashboard' : 'Masuk Sekarang'}
                                </a>
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
                </div>
            </section>

            {/* Section 2: Tentang Aksaka Digital */}
            <section id="about" className="bg-white py-16 md:py-20">
                <div className="container mx-auto px-4 text-center max-w-4xl">
                    <h2 className="text-3xl md:text-4xl font-bold text-[#8B6914] mb-6 decoration-[#C49A3B] underline-offset-8">
                        Tentang Aksaka Digital
                    </h2>
                    <p className="text-base md:text-lg text-gray-700 leading-relaxed mb-12">
                        Website ini digunakan sebagai media pembelajaran internal AKSAKA Digital yang menyediakan materi
                        berbasis video, modul, serta evaluasi pembelajaran untuk mendukung peningkatan kompetensi
                        anggota secara terstruktur dan terpantau.
                    </p>
                    <div className="flex flex-wrap justify-center items-center gap-12 md:gap-20">
                        <img
                            src="/image/landing-page/section-2-logo-1.png"
                            alt="Perpustakaan Tunas Muda Tambakrejo"
                            className="h-20 md:h-24 object-contain"
                        />
                        <img
                            src="/image/landing-page/section-2-logo-2.png"
                            alt="AKSAKA Digital"
                            className="h-20 md:h-24 object-contain"
                        />
                    </div>
                </div>
            </section>

            {/* Section 3: Pilihan Program Pembelajaran */}
            <section id="program" className="py-16 md:py-20" style={{ background: 'linear-gradient(to bottom, #D2B165, #C49A3B)' }}>
                <div className="container mx-auto px-4">
                    <div className="text-center max-w-4xl mx-auto mb-12">
                        <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
                            Pilihan Program Pembelajaran
                        </h2>
                        <p className="text-base md:text-lg text-white/90 leading-relaxed">
                            Temukan berbagai program pembelajaran yang dirancang untuk mendukung peningkatan
                            kompetensi anggota AKSAKA Digital. Setiap program disusun secara terstruktur, dilengkapi
                            dengan materi video, modul pendukung, dan evaluasi pembelajaran agar proses belajar
                            menjadi lebih terarah, efektif, dan mudah dipantau.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                        {programCards.map((card) => (
                            <div key={card.id} className="bg-white rounded-2xl p-6 shadow-lg flex flex-col h-full">
                                <div className="flex items-start gap-4 mb-4">
                                    <img
                                        src={card.icon}
                                        alt={card.title}
                                        className="w-12 h-12 object-contain"
                                    />
                                    <div>
                                        <h3 className="text-xl font-bold text-[#8B6914] mb-2">{card.title}</h3>
                                        <p className="text-sm text-gray-600 leading-relaxed">
                                            {card.description}
                                        </p>
                                    </div>
                                </div>
                                <div className={`${card.layout === 'grid' ? 'grid grid-cols-2 gap-2' : 'space-y-2'} mt-auto mb-6`}>
                                    {card.items.map((item, index) => (
                                        <div key={index} className="flex items-center gap-2 text-sm text-gray-700">
                                            <span className="text-[#C49A3B]">»</span> {item}
                                        </div>
                                    ))}
                                </div>
                                <a
                                    href={isAuthenticated ? dashboard.url() : login.url()}
                                    className="block w-full py-3 bg-[#C49A3B] text-white rounded-lg font-medium hover:bg-[#B08A30] transition duration-300 text-center"
                                >
                                    Lihat Detail
                                </a>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Section 4: Call to Action */}
            <section className="bg-white py-16 md:py-20">
                <div className="container mx-auto px-4">
                    <div className="flex flex-col-reverse lg:flex-row items-center gap-12 max-w-6xl mx-auto">
                        {/* Left: Content */}
                        <div className="w-full lg:w-1/2 space-y-6 text-center lg:text-left">
                            <h2 className="text-3xl md:text-4xl font-bold text-[#8B6914] leading-tight">
                                Mulai Pembelajaran Saat<br/>Ini Juga
                            </h2>
                            <p className="text-base md:text-lg text-gray-600 italic">
                                Masuk sekarang dan mulai pembelajaranmu<br/>Bersama Aksaka Digital!
                            </p>
                            <div>
                                <a
                                    href={isAuthenticated ? dashboard.url() : login.url()}
                                    className="inline-block px-8 py-3 bg-[#C49A3B] text-white rounded-lg font-medium hover:bg-[#B08A30] transition duration-300"
                                >
                                    {isAuthenticated ? 'Ke Dashboard' : 'Mulai Sekarang'}
                                </a>
                            </div>
                        </div>

                        {/* Right: Image */}
                        <div className="w-full lg:w-1/2 flex justify-center">
                            <img
                                src="/image/landing-page/section-4-right.png"
                                alt="Team Illustration"
                                className="max-w-full h-auto object-contain"
                            />
                        </div>
                    </div>
                </div>
            </section>
            <Footer />
        </div>
    );
}
