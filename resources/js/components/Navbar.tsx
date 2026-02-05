import { Link } from '@inertiajs/react';
import { Menu, X, LogOut, User as UserIcon, Settings } from 'lucide-react';
import { useState } from 'react';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

export default function Navbar() {
    const [isOpen, setIsOpen] = useState(false);
    
    // Dummy user data for demonstration
    // Toggle this to false to see the guest view
    const [isLoggedIn] = useState(true);
    const user = {
        name: "Rizky Hasanuddin",
        email: "rizky@example.com",
        avatar: "https://github.com/shadcn.png" 
    };

    return (
        <nav className="fixed top-0 z-50 w-full border-b border-gray-100 bg-white/90 font-league backdrop-blur-md">
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div className="flex h-20 items-center justify-between">
                    {/* Logo */}
                    <div className="flex shrink-0 items-center">
                        <Link href="/">
                            <img
                                className="h-10 w-auto"
                                src="/image/navbar/logo-aksaka.png"
                                alt="Aksaka Logo"
                            />
                        </Link>
                    </div>

                    {/* Desktop Menu */}
                    <div className="hidden md:flex md:items-center md:space-x-8">
                        <Link
                            href="#"
                            className="text-lg font-medium text-gray-800 transition duration-150 ease-in-out hover:text-primary"
                        >
                            Beranda
                        </Link>
                        <Link
                            href="#"
                            className="text-lg font-medium text-gray-600 transition duration-150 ease-in-out hover:text-primary"
                        >
                            Program
                        </Link>

                        <div className="ml-4 flex items-center space-x-4">
                            {isLoggedIn ? (
                                <DropdownMenu>
                                    <DropdownMenuTrigger asChild>
                                        <Button variant="ghost" className="relative h-10 w-auto gap-3 rounded-full hover:bg-gray-100 flex items-center px-3">
                                            <span className="text-sm font-semibold text-gray-700 hidden lg:block">
                                                {user.name}
                                            </span>
                                            <Avatar className="h-8 w-8">
                                                <AvatarImage src={user.avatar} alt={user.name} />
                                                <AvatarFallback>{user.name.charAt(0)}</AvatarFallback>
                                            </Avatar>
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent className="w-56" align="end" forceMount>
                                        <DropdownMenuLabel className="font-normal">
                                            <div className="flex flex-col space-y-1">
                                                <p className="text-sm font-medium leading-none">{user.name}</p>
                                                <p className="text-xs leading-none text-muted-foreground">
                                                    {user.email}
                                                </p>
                                            </div>
                                        </DropdownMenuLabel>
                                        <DropdownMenuSeparator />
                                        <DropdownMenuItem>
                                            <UserIcon className="mr-2 h-4 w-4" />
                                            <span>Profile</span>
                                        </DropdownMenuItem>
                                        <DropdownMenuItem>
                                            <Settings className="mr-2 h-4 w-4" />
                                            <span>Settings</span>
                                        </DropdownMenuItem>
                                        <DropdownMenuSeparator />
                                        <DropdownMenuItem className="text-red-600 focus:text-red-600">
                                            <LogOut className="mr-2 h-4 w-4" />
                                            <span>Log out</span>
                                        </DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            ) : null}
                        </div>
                    </div>

                    {/* Mobile menu button */}
                    <div className="flex items-center md:hidden">
                        <button
                            type="button"
                            onClick={() => setIsOpen(!isOpen)}
                            className="inline-flex items-center justify-center rounded-md p-2 text-gray-700 transition duration-150 hover:bg-gray-100 hover:text-primary focus:ring-2 focus:ring-primary focus:ring-inset focus:outline-none"
                            aria-expanded={isOpen}
                        >
                            <span className="sr-only">Open main menu</span>
                            {isOpen ? (
                                <X className="block h-7 w-7" aria-hidden="true" />
                            ) : (
                                <Menu className="block h-7 w-7" aria-hidden="true" />
                            )}
                        </button>
                    </div>
                </div>
            </div>

            {/* Mobile Menu */}
            <div className={`${isOpen ? 'block' : 'hidden'} absolute w-full md:hidden`}>
                 <div className="space-y-2 bg-white px-4 pt-2 pb-6 shadow-xl border-t border-gray-100">
                    {isLoggedIn && (
                        <div className="mb-4 flex items-center space-x-3 px-3 py-3 border-b border-gray-100">
                            <Avatar className="h-10 w-10">
                                <AvatarImage src={user.avatar} alt={user.name} />
                                <AvatarFallback>{user.name.charAt(0)}</AvatarFallback>
                            </Avatar>
                            <div>
                                <p className="text-base font-semibold text-gray-800">{user.name}</p>
                                <p className="text-sm text-gray-500">{user.email}</p>
                            </div>
                        </div>
                    )}

                    <Link
                        href="#"
                        className="block rounded-md px-3 py-3 text-base font-semibold text-gray-800 transition duration-150 hover:bg-gray-50 hover:text-primary"
                    >
                        Beranda
                    </Link>
                    <Link
                        href="#"
                        className="block rounded-md px-3 py-3 text-base font-semibold text-gray-600 transition duration-150 hover:bg-gray-50 hover:text-primary"
                    >
                        Program
                    </Link>
                    
                    <div className="mt-4 flex flex-col space-y-3 border-t border-gray-100 pt-4">
                        {isLoggedIn ? (
                             <>
                                <Link
                                    href="#"
                                    className="flex items-center rounded-md px-3 py-3 text-base font-semibold text-gray-600 hover:bg-gray-50 hover:text-primary"
                                >
                                    <UserIcon className="mr-2 h-5 w-5" />
                                    Profile
                                </Link>
                                <Link
                                    href="#"
                                    className="flex items-center rounded-md px-3 py-3 text-base font-semibold text-red-600 hover:bg-red-50"
                                >
                                    <LogOut className="mr-2 h-5 w-5" />
                                    Log out
                                </Link>
                             </>
                        ) : null}
                    </div>
                </div>
            </div>
        </nav>
    );
}
