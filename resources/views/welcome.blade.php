<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>XZ Library</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex flex-col items-center justify-center">
                    <x-application-logo class="h-24 w-auto" />
                    
                    <h1 class="mt-8 text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                        XZ Library
                    </h1>
                    <p class="mt-4 text-xl text-gray-600 dark:text-gray-400 text-center max-w-2xl">
                        Sistem Informasi Perpustakaan Modern untuk kemudahan peminjaman dan pengelolaan buku.
                    </p>

                    <div class="mt-12 flex gap-4">
                        @auth
                             <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Mulai Sekarang
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Fitur 1 -->
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <div class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center rounded-lg mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Koleksi Lengkap</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Ribuan koleksi buku dari berbagai kategori siap untuk dipinjam.</p>
                    </div>

                    <!-- Fitur 2 -->
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <div class="h-12 w-12 bg-green-100 dark:bg-green-900 flex items-center justify-center rounded-lg mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Proses Cepat</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Peminjaman dan pengembalian buku yang praktis dan efisien.</p>
                    </div>

                    <!-- Fitur 3 -->
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <div class="h-12 w-12 bg-purple-100 dark:bg-purple-900 flex items-center justify-center rounded-lg mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Terpercaya</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Keamanan data dan transparansi riwayat peminjaman terjamin.</p>
                    </div>
                </div>

                <div class="flex justify-center mt-24 px-0 sm:items-center sm:justify-between border-t border-gray-200 dark:border-gray-700 pt-8">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        &copy; {{ date('Y') }} XZ Library. All rights reserved.
                    </div>

                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        XZ Library v1.0 (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
