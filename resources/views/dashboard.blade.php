<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat Datang di Perpustakaan XZ!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <!-- Peminjaman Buku -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-lg mb-2 text-indigo-500">Katalog Buku</h3>
                        <p class="text-sm mb-4">Cari buku favoritmu dan lakukan peminjaman online.</p>
                        <a href="{{ route('student.peminjaman.katalog') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 shadow-md shadow-indigo-500/20">
                            Cari Buku
                        </a>
                    </div>
                </div>

                <!-- Pengembalian Buku -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-lg mb-2 text-rose-500">Riwayat Peminjaman</h3>
                        <p class="text-sm mb-4">Lihat daftar buku yang kamu pinjam dan kembalikan tepat waktu.</p>
                        <a href="{{ route('student.peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-rose-700 active:bg-rose-900 focus:outline-none focus:ring-2 focus:ring-rose-500 transition-all duration-300 shadow-md shadow-rose-500/20">
                            Buku Dipinjam
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
