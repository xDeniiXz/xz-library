<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Peminjaman Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: "{{ session('success') }}",
                        background: '#1f2937',
                        color: '#ffffff',
                        iconColor: '#6366f1',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#6366f1',
                        allowOutsideClick: false,
                        allowEscapeKey: true
                    });
                });
            </script>
            @endif

            @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: "{{ session('error') }}",
                        background: '#1f2937',
                        color: '#ffffff',
                        iconColor: '#ef4444',
                        showConfirmButton: true,
                        confirmButtonColor: '#6366f1'
                    });
                });
            </script>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8 transition-all duration-300">
                <form action="{{ route('student.peminjaman.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                    <div class="w-full md:w-48">
                        <x-input-label for="criteria" :value="__('Cari Berdasarkan')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="criteria" id="criteria" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="semua" {{ request('criteria') == 'semua' ? 'selected' : '' }}>Semua</option>
                            <option value="judul" {{ request('criteria') == 'judul' ? 'selected' : '' }}>Judul</option>
                            <option value="penulis" {{ request('criteria') == 'penulis' ? 'selected' : '' }}>Penulis</option>
                            <option value="penerbit" {{ request('criteria') == 'penerbit' ? 'selected' : '' }}>Penerbit</option>
                            <option value="tahun_terbit" {{ request('criteria') == 'tahun_terbit' ? 'selected' : '' }}>Tahun Terbit</option>
                        </select>
                    </div>

                    <div class="flex-1 w-full group">
                        <x-input-label for="search" :value="__('Kata Kunci')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari riwayat peminjaman..." class="block w-full pl-10 pr-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                        </div>
                    </div>

                    <div class="w-full md:w-48">
                        <x-input-label for="status" :value="__('Status')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="status" id="status" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="">Semua Status</option>
                            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-indigo-500/30 flex items-center justify-center">
                            Cari
                        </button>

                        @if(request()->anyFilled(['search', 'status', 'criteria']))
                        <a href="{{ route('student.peminjaman.index') }}" class="px-3 py-2 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl transition-all duration-300 flex items-center justify-center shadow-lg shadow-rose-500/20" title="Reset Filter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                        <h3 class="text-xl font-extrabold tracking-tight text-indigo-600 dark:text-indigo-400 uppercase">
                            Daftar Peminjaman & Pengembalian
                        </h3>
                        <a href="{{ route('student.peminjaman.katalog') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Pinjam Buku Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border-2 border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700 w-16">No</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Buku</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Tgl Pinjam / Kembali</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Status</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Info Tambahan</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y-2 divide-gray-200 dark:divide-gray-700">
                                @forelse($peminjaman as $item)
                                <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-bold text-indigo-600 dark:text-indigo-400 border-r-2 border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-r-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-900 dark:text-white uppercase">{{ $item->buku->judul }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 italic">{{ $item->buku->penulis }} ({{ $item->buku->tahun_terbit }})</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs border-r-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-col gap-1 text-center">
                                            <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 px-2 py-1 rounded font-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                            </span>
                                            <span class="bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-300 px-2 py-1 rounded font-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-200 dark:border-gray-700">
                                        @if($item->status === 'dipinjam')
                                        <span class="px-3 py-1 bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-300 rounded-full text-xs font-bold uppercase tracking-wider">
                                            Dipinjam
                                        </span>
                                        @else
                                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-300 rounded-full text-xs font-bold uppercase tracking-wider">
                                            Dikembalikan
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-center border-r-2 border-gray-200 dark:border-gray-700">
                                        @if($item->status === 'dikembalikan' && $item->pengembalian)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-gray-500 dark:text-gray-400 italic">
                                                Tgl Kembali: {{ \Carbon\Carbon::parse($item->pengembalian->tanggal_pengembalian)->format('d M Y') }}
                                            </span>
                                            @if($item->pengembalian->denda > 0)
                                            <span class="text-rose-500 font-bold">
                                                Denda: Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                                            </span>
                                            @endif
                                        </div>
                                        @elseif($item->status === 'dipinjam')
                                        @php
                                        $dueDate = \Carbon\Carbon::parse($item->tanggal_kembali);
                                        $today = \Carbon\Carbon::today();
                                        $diff = $today->diffInDays($dueDate, false);
                                        @endphp
                                        @if($diff < 0)
                                            <span class="text-rose-500 font-bold animate-pulse">
                                            Terlambat {{ abs($diff) }} hari
                                            </span>
                                            @else
                                            <span class="text-indigo-500 font-medium italic">
                                                Sisa {{ $diff }} hari lagi
                                            </span>
                                            @endif
                                            @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($item->status === 'dipinjam')
                                        <form id="return-form-{{ $item->id }}" action="{{ route('student.peminjaman.kembalikan', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="button"
                                                onclick="confirmReturn('{{ $item->id }}', '{{ $item->buku->judul }}')"
                                                class="inline-flex items-center px-3 py-2 bg-emerald-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300 shadow-md shadow-emerald-500/20">
                                                Kembalikan
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-xs text-gray-400 italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                            <span class="text-xl font-medium italic">Anda belum memiliki riwayat peminjaman.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmReturn(id, judul) {
            Swal.fire({
                title: 'Konfirmasi Pengembalian',
                html: `Apakah Anda yakin ingin mengembalikan buku <b class="text-indigo-400">"${judul}"</b>?`,
                icon: 'question',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl border-2 border-emerald-500/30'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('return-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>
