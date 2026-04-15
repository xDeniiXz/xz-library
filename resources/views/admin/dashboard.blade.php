<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 dark:border-gray-700 mb-8">
                <div class="p-8 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-gray-500 dark:text-gray-400">Pantau aktivitas perpustakaan hari ini dengan ringkasan di bawah ini.</p>
                    </div>
                    <div class="hidden md:block">
                        <span class="px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl font-bold text-sm">
                            {{ date('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Buku -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Buku</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_buku'] }}</h4>
                    </div>
                </div>

                <!-- Total Siswa -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Siswa</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_siswa'] }}</h4>
                    </div>
                </div>

                <!-- Sedang Dipinjam -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Dipinjam</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['sedang_dipinjam'] }}</h4>
                    </div>
                </div>

                <!-- Menunggu Persetujuan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Menunggu</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['permintaan_menunggu'] }}</h4>
                    </div>
                </div>

                <!-- Terlambat -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Terlambat</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['terlambat'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Activity -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Transaksi Terbaru
                            </h3>
                            <a href="{{ route('admin.transaksi.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 uppercase tracking-wider">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Siswa</th>
                                        <th class="px-6 py-4">Buku</th>
                                        <th class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                                    @forelse($transaksi_terbaru as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-900 dark:text-white">{{ $item->user->name }}</span>
                                                <span class="text-xs text-gray-500">{{ $item->user->username }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-medium">
                                            {{ $item->buku->judul }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($item->status === 'menunggu')
                                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300 rounded-full text-[10px] font-bold uppercase">Menunggu</span>
                                            @elseif($item->status === 'dipinjam')
                                            <span class="px-3 py-1 bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-300 rounded-full text-[10px] font-bold uppercase">Dipinjam</span>
                                            @elseif($item->status === 'ditolak')
                                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full text-[10px] font-bold uppercase">Ditolak</span>
                                            @else
                                            <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-300 rounded-full text-[10px] font-bold uppercase">Kembali</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">Belum ada transaksi terbaru.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar inside dashboard -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.buku.create') }}" class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition-colors text-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-2 text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Buku Baru</span>
                            </a>
                            <a href="{{ route('admin.transaksi.create') }}" class="p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition-colors text-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-2 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Peminjaman</span>
                            </a>
                        </div>
                    </div>

                    <!-- Fine Summary -->
                    <div class="bg-indigo-600 rounded-2xl p-6 shadow-lg shadow-indigo-500/30 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <p class="text-xs font-bold uppercase tracking-widest text-indigo-200 mb-1">Total Denda Terkumpul</p>
                            <h4 class="text-3xl font-black mb-4">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</h4>
                            <div class="flex items-center gap-2 text-xs font-medium text-indigo-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Akumulasi dari semua transaksi
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute -right-8 -bottom-8 text-indigo-500 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>