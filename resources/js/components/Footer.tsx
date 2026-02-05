
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
                <div className="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-8 lg:gap-12">
                    {/* Column 1: Map */}
                    <div className="space-y-4">
                        <div className="w-full h-48 md:h-56 bg-gray-200 rounded-lg overflow-hidden relative">
                             {/* Placeholder for Map - In a real scenario, this would be an image or iframe */}
                             <div className="absolute inset-0 flex items-center justify-center text-gray-400">
                                <span className="text-sm font-medium">Map Representation</span>
                             </div>
                             {/* If asset existed: <img src="/image/landing-page/map.png" alt="Location Map" className="w-full h-full object-cover" /> */}
                        </div>
                    </div>

                    {/* Column 2: Address */}
                    <div className="space-y-4">
                        <h3 className="text-xl font-bold text-gray-900">Address</h3>
                        <p className="text-gray-600 leading-relaxed">
                            Jalan Raya Kepung 250, Desa/Kelurahan Gadungan, Kec. Puncu, Kab. Kediri, Provinsi Jawa Timur, 64292 Indonesia
                        </p>
                    </div>

                    {/* Column 3: Contact */}
                    <div className="space-y-4">
                        <h3 className="text-xl font-bold text-gray-900">Contact</h3>
                        <div className="space-y-2 text-gray-600">
                            <p>0821 2398 2225</p>
                            <p>info@studyabroadcenterid.com</p>
                            <p>studyabroadcenterid.com</p>
                        </div>
                        
                        <div className="flex items-center space-x-4 pt-4">
                             <a href="#" className="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-white hover:bg-gray-700 transition-colors" aria-label="YouTube">
                                <Youtube className="w-5 h-5" />
                            </a>
                            <a href="#" className="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-white hover:bg-gray-700 transition-colors" aria-label="TikTok">
                                <TiktokIcon className="w-5 h-5" />
                            </a>
                            <a href="#" className="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-white hover:bg-gray-700 transition-colors" aria-label="Instagram">
                                <Instagram className="w-5 h-5" />
                            </a>
                        </div>
                    </div>
                </div>

                {/* Bottom Bar */}
                <div className="mt-12 md:mt-16 pt-8 border-t border-gray-100 text-center">
                    <p className="text-gray-500 font-medium tracking-wide">
                        #YourDreamEducationStartsHere
                    </p>
                </div>
            </div>
        </footer>
    );
}
