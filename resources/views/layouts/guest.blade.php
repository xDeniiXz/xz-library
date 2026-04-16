<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
                <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-rose-500/10 rounded-full blur-3xl"></div>
            </div>

            <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                <a href="/" class="flex flex-col items-center gap-2">
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border-2 border-indigo-500/20">
                        <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-gray-900 dark:text-white uppercase">
                        XZ <span class="text-indigo-600 dark:text-indigo-400">Library</span>
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white dark:bg-gray-800 shadow-2xl shadow-indigo-500/10 border border-gray-100 dark:border-gray-700 overflow-hidden sm:rounded-3xl transition-all duration-300">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
