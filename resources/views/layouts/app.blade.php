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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <div class="flex min-w-0 flex-1 flex-col">
            <!-- Page Heading -->
            @if (isset($header))
            <header class="border-b border-gray-200 bg-white/95 shadow-sm backdrop-blur dark:border-gray-700 dark:bg-gray-800/95">
                <div class="px-6 py-6 lg:px-10">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        // CSRF Heartbeat: Keeps the session alive and refreshes CSRF token every 15 minutes
        setInterval(function() {
            fetch('/' + '?' + new Date().getTime(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                console.log('Session keep-alive');
            }).catch(error => {
                console.error('Heartbeat failed', error);
            });
        }, 15 * 60 * 1000); // 15 minutes
    </script>
</body>

</html>