
import { Youtube, Instagram } from 'lucide-react';

// Custom TikTok icon since it might not be in the current lucide-react version or just to be safe
const TiktokIcon = ({ className }: { className?: string }) => (
    <svg 
        xmlns="http://www.w3.org/2000/svg" 
        width="24" 
        height="24" 
        viewBox="0 0 24 24" 
        fill="none" 
        stroke="currentColor" 
        strokeWidth="2" 
        strokeLinecap="round" 
        strokeLinejoin="round" 
        className={className}
    >
        <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" />
    </svg>
);

export default function Footer() {
    return (
        <footer className="bg-white py-12 md:py-16 border-t border-gray-100">
            <div className="container mx-auto px-4">
                <div className="flex flex-col md:flex-row justify-between items-start gap-8 md:gap-16 max-w-6xl mx-auto">
                    {/* Column 1: Map */}
                    <div className="w-full md:w-80 lg:w-100 shrink-0">
                        <div className="w-full h-40 bg-gray-200 rounded-lg overflow-hidden">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.4845588428875!2d109.6653235!3d-7.7383146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7ac957ece81a49%3A0xac0ae158b5751c0e!2sUKM%20Perpustakaan%20Digital%20%22Tunas%20Muda%22%20Tambakrejo!5e0!3m2!1sid!2sid!4v1772002485609!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style={{ border: 0 }} 
                                allowFullScreen 
                                loading="lazy" 
                                referrerPolicy="no-referrer-when-downgrade"
                                title="Location Map"
                            />
                        </div>
                    </div>

                    {/* Column 2: Address */}
                    <div className="w-full md:flex-1 space-y-3">
                        <h3 className="text-xl font-bold text-[#2D3E50]">Address</h3>
                        <p className="text-gray-600 leading-relaxed text-sm">
                            Rante Dua, Tambakrejo, Kec. Buluspesantren, Kabupaten Kebumen, Jawa Tengah 54391
                        </p>
                    </div>

                    {/* Column 3: Contact */}
                    <div className="w-full md:w-auto space-y-3">
                        <h3 className="text-xl font-bold text-[#2D3E50]">Contact</h3>
                        <div className="space-y-1 text-gray-600 text-sm">
                            <p>0812-2527-7635</p>
                            <p>aksakadigital@gmail.com</p>
                            <p>aksaka.com</p>
                        </div>
                        
                        <div className="flex items-center space-x-3 pt-2">
                             <a href="#" className="w-10 h-10 bg-[#C49A3B] rounded-full flex items-center justify-center text-white hover:bg-[#1E2D3D] transition-colors" aria-label="YouTube">
                                <Youtube className="w-5 h-5" />
                            </a>
                            <a href="#" className="w-10 h-10 bg-[#C49A3B] rounded-full flex items-center justify-center text-white hover:bg-[#1E2D3D] transition-colors" aria-label="TikTok">
                                <TiktokIcon className="w-5 h-5" />
                            </a>
                            <a href="#" className="w-10 h-10 bg-[#C49A3B] rounded-full flex items-center justify-center text-white hover:bg-[#B08A30] transition-colors" aria-label="Instagram">
                                <Instagram className="w-5 h-5" />
                            </a>
                        </div>
                    </div>
                </div>

                {/* Bottom Bar */}
                <div className="mt-12 md:mt-16 pt-8 border-t border-gray-100 text-center">
                    <p className="text-[#C49A3B] font-medium italic tracking-wide">
                        #Belajar Lebih Terarah, Berkembang Lebih Cepat
                    </p>
                </div>
            </div>
        </footer>
    );
}
