@php
$linkBaseClasses = 'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition-all duration-200';
$activeClasses = 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30';
$inactiveClasses = 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 dark:text-gray-300 dark:hover:bg-gray-700/60 dark:hover:text-white';
@endphp

<aside class="sticky top-0 flex h-screen w-72 shrink-0 flex-col border-r border-gray-200 bg-white px-5 py-6 dark:border-gray-700 dark:bg-gray-800">
    <div class="mb-8">
        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="flex flex-col gap-2">
            <x-application-logo class="block h-10 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
            <p class="pl-14 text-xs font-bold uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400">
                {{ Auth::user()->isAdmin() ? 'Panel Admin' : 'Panel Siswa' }}
            </p>
        </a>
    </div>

    <div class="mb-6 rounded-2xl bg-gray-50 px-4 py-4 dark:bg-gray-700/40">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Akun Aktif</p>
        <p class="mt-2 text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto">
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('admin.dashboard') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-10l2 2m-2-2v10a1 1 0 01-1 1h-3m-10 0H4a1 1 0 01-1-1V10m2 10h10" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('admin.kategori.*') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.023.195 1.414.586l6 6a2 2 0 010 2.828l-4.172 4.172a2 2 0 01-2.828 0l-6-6A2 2 0 015 9V4a1 1 0 011-1h1z" />
            </svg>
            Kategori
        </a>
        <a href="{{ route('admin.buku.index') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('admin.buku.*') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Buku
        </a>
        <a href="{{ route('admin.anggota.index') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('admin.anggota.*') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V9H2v11h5m10 0v-2a4 4 0 00-4-4H11a4 4 0 00-4 4v2m10 0H7m8-13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Siswa
        </a>
        <a href="{{ route('admin.transaksi.index') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('admin.transaksi.*') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Transaksi
        </a>
        @else
        <a href="{{ route('dashboard') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-10l2 2m-2-2v10a1 1 0 01-1 1h-3m-10 0H4a1 1 0 01-1-1V10m2 10h10" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('student.peminjaman.katalog') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('student.peminjaman.katalog') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Katalog Buku
        </a>
        <a href="{{ route('student.peminjaman.index') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('student.peminjaman.index') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            Riwayat Pinjam
        </a>
        @endif
    </nav>

    <div class="mt-6 space-y-2 border-t border-gray-200 pt-6 dark:border-gray-700">
        <a href="{{ route('profile.edit') }}" class="{{ $linkBaseClasses }} {{ request()->routeIs('profile.edit') ? $activeClasses : $inactiveClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0zm-9 9a9 9 0 0112 0" />
            </svg>
            Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-rose-500 transition-all duration-200 hover:bg-rose-50 dark:hover:bg-rose-900/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
                </svg>
                Log Out
            </button>
        </form>
    </div>
</aside>
