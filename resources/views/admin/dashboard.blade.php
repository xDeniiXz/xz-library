<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat Datang di Dashboard Admin!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <!-- Kelola Kategori -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-lg mb-2">Kelola Kategori</h3>
                        <p class="text-sm mb-4 italic">Kategori buku perpustakaan.</p>
                        <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Buka Menu
                        </a>
                    </div>
                </div>

                <!-- Kelola Buku -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500 shadow-blue-500/10 hover:shadow-blue-500/20 transition-all duration-300">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-lg mb-2">Kelola Buku</h3>
                        <p class="text-sm mb-4 italic">Tambah, edit, dan hapus data buku.</p>
                        <a href="{{ route('admin.buku.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md shadow-blue-500/30">
                            Buka Menu
                        </a>
                    </div>
                </div>

                <!-- Kelola Anggota -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-lg mb-2">Kelola Anggota</h3>
                        <p class="text-sm mb-4">Kelola data siswa dan pendaftaran anggota baru.</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Buka Menu
                        </a>
                    </div>
                </div>

                <!-- Transaksi -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-lg mb-2">Transaksi</h3>
                        <p class="text-sm mb-4">Pantau aktivitas peminjaman dan pengembalian.</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Buka Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>