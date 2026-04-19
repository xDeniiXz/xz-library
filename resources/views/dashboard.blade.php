<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 dark:border-gray-700 mb-8">
                <div class="p-8 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-gray-500 dark:text-gray-400">Selamat datang kembali. Sudah baca buku apa hari ini?</p>
                    </div>
                    <div class="hidden md:flex items-center gap-4">
                        <div class="text-right pr-4 border-r border-gray-200 dark:border-gray-700">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Status Keanggotaan</span>
                            <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg font-bold text-[10px] border border-emerald-100 dark:border-emerald-800/50 uppercase">
                                Siswa Aktif
                            </span>
                        </div>
                        <span class="px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl font-bold text-sm">
                            {{ date('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Buku Sedang Dipinjam -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Pinjaman Aktif</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['buku_dipinjam'] }} <span class="text-sm font-medium text-gray-400 ml-1">Buku</span></h4>
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
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['permintaan_menunggu'] }} <span class="text-sm font-medium text-gray-400 ml-1">Buku</span></h4>
                    </div>
                </div>

                <!-- Total Riwayat -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Pinjam</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_pinjam'] }} <span class="text-sm font-medium text-gray-400 ml-1">Kali</span></h4>
                    </div>
                </div>

                <!-- Total Denda -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex items-center gap-5">
                    <div class="p-4 bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Denda</p>
                        <h4 class="text-2xl font-black text-gray-900 dark:text-white">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Active/Recent Loans -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Riwayat Pinjam Terakhir
                            </h3>
                            <a href="{{ route('student.peminjaman.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 uppercase tracking-wider">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Buku</th>
                                        <th class="px-6 py-4">Tgl Pinjam</th>
                                        <th class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                                    @forelse($riwayat_terbaru as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-900 dark:text-white">{{ $item->buku->judul }}</span>
                                                <span class="text-xs text-gray-500">{{ $item->buku->penulis }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-medium">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-{{ $item->status->color() }}-100 dark:bg-{{ $item->status->color() }}-900/40 text-{{ $item->status->color() }}-600 dark:text-{{ $item->status->color() }}-300 rounded-full text-[10px] font-bold uppercase">
                                                {{ $item->status->label() }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">Kamu belum pernah meminjam buku.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <!-- Deadline Alert -->
                    @if($stats['jatuh_tempo'])
                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/50 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-amber-900 dark:text-amber-400">Jatuh Tempo Terdekat</h3>
                        </div>
                        <p class="text-sm text-amber-800 dark:text-amber-500/80 mb-4 leading-relaxed">
                            Buku <span class="font-bold">"{{ $stats['jatuh_tempo']->buku->judul }}"</span> harus dikembalikan pada:
                            <span class="block mt-1 font-black text-lg">{{ \Carbon\Carbon::parse($stats['jatuh_tempo']->tanggal_kembali)->format('d M Y') }}</span>
                        </p>
                        <a href="{{ route('student.peminjaman.index') }}" class="block w-full text-center py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-bold transition-colors">
                            Lihat Detail Pinjaman
                        </a>
                    </div>
                    @else
                    <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800/50 rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-indigo-900 dark:text-indigo-400 mb-1">Semua Aman!</h3>
                        <p class="text-xs text-indigo-800 dark:text-indigo-500/80">Kamu tidak memiliki pinjaman aktif saat ini.</p>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('student.peminjaman.katalog') }}" class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all group">
                                <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm text-gray-400 group-hover:text-indigo-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Cari Buku</span>
                            </a>
                            <a href="{{ route('student.peminjaman.index') }}" class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all group">
                                <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm text-gray-400 group-hover:text-rose-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Riwayat Pinjam</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>