<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal Akses - AKSAKA Digital</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css'])
    <style>
        .portal-card {
            transition: all 0.3s ease;
        }
        .portal-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .portal-card:hover .icon-container {
            transform: scale(1.1);
        }
        .icon-container {
            transition: transform 0.3s ease;
        }
        .btn-action {
            transition: all 0.2s ease;
        }
        .btn-action:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center" style="background: linear-gradient(135deg, #D2B165 0%, #C49A3B 50%, #8B6914 100%)">
    <div class="w-full max-w-5xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <a href="{{ url('/') }}" class="inline-block transition-transform hover:scale-105 mb-4">
                <img
                    src="{{ asset('image/navbar/logo-aksaka.png') }}"
                    alt="Aksaka Logo"
                    class="mx-auto h-16 md:h-20 w-auto"
                />
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-white">Portal Akses</h1>
            <p class="mt-2 text-base md:text-lg text-white/90">
                Pilih jenis akun untuk melanjutkan
            </p>
        </div>

        <!-- Selection Cards -->
        <div class="grid gap-6 md:grid-cols-2">
            <!-- Member Card -->
            <div class="portal-card rounded-2xl bg-white p-6 md:p-8 shadow-2xl">
                <div class="flex flex-col items-center text-center">
                    <div 
                        class="icon-container flex h-20 w-20 items-center justify-center rounded-full text-white shadow-lg"
                        style="background: linear-gradient(to bottom right, #C49A3B, #D2B165)"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    
                    <h2 class="mt-5 text-2xl font-bold" style="color: #8B6914">Member</h2>
                    <p class="mt-2 text-gray-600 text-sm md:text-base">
                        Akses materi pembelajaran dan kuis interaktif
                    </p>

                    <ul class="mt-4 space-y-1.5 text-left text-gray-600 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Akses materi video & modul
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Kerjakan kuis & evaluasi
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Pantau progres belajar
                        </li>
                    </ul>

                    <div class="mt-6 flex w-full flex-col gap-2">
                        <a 
                            href="{{ url('/member/login') }}"
                            class="btn-action block w-full rounded-lg py-3 text-center font-semibold text-white shadow-lg"
                            style="background: linear-gradient(to right, #C49A3B, #D2B165)"
                        >
                            Masuk sebagai Member
                        </a>
                        <a 
                            href="{{ url('/register') }}"
                            class="btn-action block w-full rounded-lg border-2 py-3 text-center font-semibold transition-colors hover:bg-amber-50"
                            style="border-color: #C49A3B; color: #8B6914"
                        >
                            Daftar Akun Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Admin Card -->
            <div class="portal-card rounded-2xl bg-white p-6 md:p-8 shadow-2xl">
                <div class="flex flex-col items-center text-center">
                    <div 
                        class="icon-container flex h-20 w-20 items-center justify-center rounded-full text-white shadow-lg"
                        style="background: linear-gradient(to bottom right, #8B6914, #2D2A26)"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>
                        </svg>
                    </div>
                    
                    <h2 class="mt-5 text-2xl font-bold" style="color: #8B6914">Administrator</h2>
                    <p class="mt-2 text-gray-600 text-sm md:text-base">
                        Kelola konten dan konfigurasi platform
                    </p>

                    <ul class="mt-4 space-y-1.5 text-left text-gray-600 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-amber-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Kelola program & materi
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-amber-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Manajemen pengguna
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-amber-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Laporan & statistik
                        </li>
                    </ul>

                    <div class="mt-6 flex w-full flex-col gap-2">
                        <a 
                            href="{{ url('/admin/login') }}"
                            class="btn-action block w-full rounded-lg py-3 text-center font-semibold text-white shadow-lg"
                            style="background: linear-gradient(to right, #8B6914, #2D2A26)"
                        >
                            Masuk sebagai Admin
                        </a>
                        <div class="py-3 text-center text-gray-400 text-sm">
                            Akun administrator dibuat oleh sistem
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Home Link -->
        <div class="mt-8 text-center">
            <a
                href="{{ url('/') }}"
                class="inline-flex items-center gap-2 text-white/90 font-medium transition-colors hover:text-white"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"/>
                    <path d="M19 12H5"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
