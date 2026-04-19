<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[95rem] mx-auto sm:px-6 lg:px-8">
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
                        confirmButtonColor: '#6366f1'
                    });
                });
            </script>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8 transition-all duration-300">
                <form action="{{ route('admin.transaksi.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                    <div class="w-full md:w-48">
                        <x-input-label for="criteria" :value="__('Cari Berdasarkan')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="criteria" id="criteria" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="peminjam" {{ request('criteria', 'peminjam') == 'peminjam' ? 'selected' : '' }}>Nama Peminjam</option>
                            <option value="username" {{ request('criteria') == 'username' ? 'selected' : '' }}>Username</option>
                            <option value="buku" {{ request('criteria') == 'buku' ? 'selected' : '' }}>Judul Buku</option>
                            <option value="semua" {{ request('criteria') == 'semua' ? 'selected' : '' }}>Semua</option>
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
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari transaksi peminjaman..." class="block w-full pl-10 pr-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                        </div>
                    </div>

                    <div class="w-full md:w-48">
                        <x-input-label for="status" :value="__('Status')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="status" id="status" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="w-full md:w-40">
                        <x-input-label for="sort" :value="__('Urutan')" id="sort-label" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="sort" id="sort" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>Terkecil (ASC)</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbesar (DESC)</option>
                        </select>
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-indigo-500/30 flex items-center justify-center">
                            Cari
                        </button>

                        @if(request()->anyFilled(['search', 'status', 'criteria', 'sort']))
                        <a href="{{ route('admin.transaksi.index') }}" class="px-3 py-2 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl transition-all duration-300 flex items-center justify-center shadow-lg shadow-rose-500/20" title="Reset Filter">
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
                            Riwayat Peminjaman & Pengembalian
                        </h3>
                        <div class="flex flex-wrap items-center gap-3">
                            <button id="bulk-delete-btn" style="display: none;" onclick="bulkDelete()" class="inline-flex items-center px-4 py-2.5 bg-rose-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-rose-700 active:bg-rose-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-lg shadow-rose-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus Terpilih (<span id="selected-count">0</span>)
                            </button>

                            <!-- Export Button -->
                            <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                                <button onclick="exportExcel()" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase hover:bg-white dark:hover:bg-gray-600 rounded-md transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Export
                                </button>
                                <form id="export-form" action="{{ route('admin.transaksi.export') }}" method="GET" class="hidden">
                                    <input type="hidden" name="ids" id="export-ids">
                                </form>
                            </div>

                            <a href="{{ route('admin.transaksi.create') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Peminjaman
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-xl border-2 border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-4 py-4 text-center border-r-2 border-gray-200 dark:border-gray-700 w-12">
                                        <input type="checkbox" id="select-all" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer">
                                    </th>
                                    <th class="px-4 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700 w-16">No</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Peminjam</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Buku</th>
                                    <th class="px-4 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Tgl Pinjam / Kembali</th>
                                    <th class="px-4 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Status</th>
                                    <th class="px-4 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider w-48">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y-2 divide-gray-200 dark:divide-gray-700">
                                @forelse($transaksi as $item)
                                <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                                    <td class="px-4 py-4 whitespace-nowrap text-center border-r-2 border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">
                                        <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="transaction-checkbox rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-bold text-indigo-600 dark:text-indigo-400 border-r-2 border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">{{ ($transaksi->currentPage() - 1) * $transaksi->perPage() + $loop->iteration }}</td>
                                    <td class="px-4 py-4 border-r-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-900 dark:text-white uppercase">{{ $item->user->name }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 italic">@ {{ $item->user->username }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 border-r-2 border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white uppercase">{{ $item->buku->judul }}</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-xs border-r-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-col gap-1 text-center">
                                            <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 px-2 py-1 rounded font-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                            </span>
                                            <span class="bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-300 px-2 py-1 rounded font-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center border-r-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="px-3 py-1 bg-{{ $item->status->color() }}-100 dark:bg-{{ $item->status->color() }}-900/40 text-{{ $item->status->color() }}-600 dark:text-{{ $item->status->color() }}-300 rounded-full text-xs font-bold uppercase tracking-wider">
                                                {{ $item->status->label() }}
                                            </span>
                                            @if($item->status === \App\Enums\PeminjamanStatus::MENUNGGU_PENGEMBALIAN)
                                            <span class="text-indigo-600 dark:text-indigo-400 font-black text-[10px] uppercase tracking-tight">
                                                Konfirmasi Fisik
                                            </span>
                                            <div class="px-2 py-0.5 rounded-md {{ $item->estimasi_denda > 0 ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }} font-bold text-[10px] border border-current/20">
                                                Denda: Rp {{ number_format($item->estimasi_denda, 0, ',', '.') }}
                                            </div>
                                            @endif
                                            @if($item->status === \App\Enums\PeminjamanStatus::DIKEMBALIKAN && $item->pengembalian)
                                            <span class="text-[10px] text-gray-500 italic">
                                                Tgl: {{ \Carbon\Carbon::parse($item->pengembalian->tanggal_pengembalian)->format('d M Y') }}
                                            </span>
                                            @if($item->pengembalian->denda > 0)
                                            <span class="text-[10px] text-rose-500 font-bold">
                                                Denda: Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                                            </span>
                                            @endif
                                            @endif
                                            @if($item->status === \App\Enums\PeminjamanStatus::DITOLAK && $item->catatan)
                                            <span class="text-[10px] text-rose-500 italic font-medium">
                                                Alasan: {{ $item->catatan }}
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                        <div class="flex justify-center items-center gap-3">
                                            @if($item->status === \App\Enums\PeminjamanStatus::MENUNGGU || $item->status === \App\Enums\PeminjamanStatus::MENUNGGU_PENGEMBALIAN)
                                            <form action="{{ route('admin.transaksi.approve', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 shadow-md shadow-indigo-500/20">
                                                    {{ $item->status === \App\Enums\PeminjamanStatus::MENUNGGU_PENGEMBALIAN ? 'Konfirmasi' : 'Setujui' }}
                                                </button>
                                            </form>
                                            @if($item->status === \App\Enums\PeminjamanStatus::MENUNGGU)
                                            <form id="reject-form-{{ $item->id }}" action="{{ route('admin.transaksi.reject', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="catatan" id="catatan-{{ $item->id }}">
                                                <button type="button"
                                                    onclick="confirmReject('{{ $item->id }}', '{{ $item->user->name }}', '{{ $item->buku->judul }}')"
                                                    class="inline-flex items-center px-3 py-2 bg-amber-500 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all duration-300 shadow-md shadow-amber-500/20">
                                                    Tolak
                                                </button>
                                            </form>
                                            @endif
                                            @endif

                                            @if($item->status === \App\Enums\PeminjamanStatus::DIPINJAM)
                                            <form id="return-form-{{ $item->id }}" action="{{ route('admin.transaksi.kembalikan', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="tanggal_pengembalian" id="tanggal_pengembalian-{{ $item->id }}">
                                                <button type="button"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="{{ $item->buku->judul }}"
                                                    data-peminjam="{{ $item->user->name }}"
                                                    data-default="{{ date('Y-m-d') }}"
                                                    onclick="confirmReturn(this.dataset.id, this.dataset.nama, this.dataset.peminjam, this.dataset.default)"
                                                    class="inline-flex items-center px-3 py-2 bg-emerald-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-md shadow-emerald-500/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3 3L22 4m-2 1H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9" />
                                                    </svg>
                                                    Kembalikan
                                                </button>
                                            </form>
                                            @endif
                                            @if($item->status === \App\Enums\PeminjamanStatus::MENUNGGU || $item->status === \App\Enums\PeminjamanStatus::DIPINJAM || $item->status === \App\Enums\PeminjamanStatus::MENUNGGU_PENGEMBALIAN || $item->status === \App\Enums\PeminjamanStatus::DIKEMBALIKAN || $item->status === \App\Enums\PeminjamanStatus::DITOLAK)
                                            <a href="{{ route('admin.transaksi.edit', $item->id) }}" class="inline-flex items-center p-2 bg-amber-100 hover:bg-amber-200 text-amber-600 rounded-lg transition-all duration-300 shadow-sm" title="Edit Transaksi">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            @endif
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.transaksi.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="Transaksi {{ $item->user->name }} - {{ $item->buku->judul }}"
                                                    onclick="confirmDelete(this.dataset.id, this.dataset.nama)"
                                                    class="inline-flex items-center px-3 py-2 bg-rose-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-md shadow-rose-600/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                                </svg>
                                            </div>
                                            <span class="text-xl font-medium italic">Belum ada riwayat transaksi.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 px-2">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sort label dynamic logic
        const criteriaSelect = document.getElementById('criteria');
        const sortLabel = document.getElementById('sort-label');

        function updateSortLabel() {
            const selectedText = criteriaSelect.options[criteriaSelect.selectedIndex].text;
            sortLabel.textContent = `Urutan ${selectedText}`;
        }

        if (criteriaSelect && sortLabel) {
            criteriaSelect.addEventListener('change', updateSortLabel);
            updateSortLabel(); // Initial call
        }

        // Checkbox logic
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.transaction-checkbox');
        const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
        const selectedCountLabel = document.getElementById('selected-count');

        function updateBulkDeleteButton() {
            const selectedCount = document.querySelectorAll('.transaction-checkbox:checked').length;
            selectedCountLabel.textContent = selectedCount;
            bulkDeleteBtn.style.display = selectedCount > 0 ? 'inline-flex' : 'none';
        }

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                updateBulkDeleteButton();
            });
        }

        function exportExcel() {
            const selectedIds = Array.from(document.querySelectorAll('.transaction-checkbox:checked'))
                .map(cb => cb.value);

            if (selectedIds.length > 0) {
                document.getElementById('export-ids').value = selectedIds.join(',');
            } else {
                document.getElementById('export-ids').value = '';
            }
            document.getElementById('export-form').submit();
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAll.checked = false;
                } else if (document.querySelectorAll('.transaction-checkbox:checked').length === checkboxes.length) {
                    selectAll.checked = true;
                }
                updateBulkDeleteButton();
            });
        });

        function bulkDelete() {
            const selectedIds = Array.from(document.querySelectorAll('.transaction-checkbox:checked')).map(cb => cb.value);

            Swal.fire({
                title: 'Konfirmasi Hapus Massal',
                html: `Apakah Anda yakin ingin menghapus <b class="text-rose-500">${selectedIds.length}</b> transaksi terpilih?`,
                icon: 'warning',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true,
                customClass: {
                    title: 'font-bold text-2xl mb-4',
                    popup: 'rounded-2xl border-2 border-rose-500/30 shadow-2xl shadow-rose-500/20'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('admin.transaksi.bulkDelete') }}", {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                ids: selectedIds
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    background: '#1f2937',
                                    color: '#ffffff',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message,
                                    background: '#1f2937',
                                    color: '#ffffff'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat menghapus data.',
                                background: '#1f2937',
                                color: '#ffffff'
                            });
                        });
                }
            });
        }

        function confirmReturn(id, bookTitle, borrowerName, defaultDate) {
            Swal.fire({
                title: 'Konfirmasi Pengembalian',
                html: `
                    <div class="text-left space-y-3">
                        <p class="text-sm">Buku: <b class="text-indigo-400">${bookTitle}</b></p>
                        <p class="text-sm">Peminjam: <b class="text-indigo-400">${borrowerName}</b></p>
                        <hr class="border-gray-600 my-3">
                        <label for="swal-input-date" class="block text-sm font-medium text-gray-300 mb-1">Pilih Tanggal Pengembalian:</label>
                        <input type="date" id="swal-input-date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500" value="${defaultDate}">
                    </div>
                `,
                icon: 'info',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Proses Kembali',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl border-2 border-emerald-500/30 shadow-2xl shadow-emerald-500/20'
                },
                preConfirm: () => {
                    const date = document.getElementById('swal-input-date').value;
                    if (!date) {
                        Swal.showValidationMessage('Tanggal pengembalian harus diisi');
                    }
                    return date;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('tanggal_pengembalian-' + id).value = result.value;
                    document.getElementById('return-form-' + id).submit();
                }
            })
        }

        function confirmReject(id, borrowerName, bookTitle) {
            Swal.fire({
                title: 'Alasan Penolakan',
                html: `
                    <div class="text-left space-y-3">
                        <p class="text-sm">Peminjam: <b class="text-indigo-400">${borrowerName}</b></p>
                        <p class="text-sm">Buku: <b class="text-indigo-400">${bookTitle}</b></p>
                        <hr class="border-gray-600 my-3">
                        <label for="swal-input-reason" class="block text-sm font-medium text-gray-300 mb-1">Masukkan Alasan Penolakan:</label>
                        <textarea id="swal-input-reason" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 min-h-[100px]" placeholder="Contoh: Stok buku fisik rusak atau hilang..."></textarea>
                    </div>
                `,
                icon: 'warning',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Tolak Pinjaman',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl border-2 border-rose-500/30 shadow-2xl shadow-rose-500/20'
                },
                preConfirm: () => {
                    const reason = document.getElementById('swal-input-reason').value;
                    if (!reason) {
                        Swal.showValidationMessage('Alasan penolakan wajib diisi');
                    }
                    return reason;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('catatan-' + id).value = result.value;
                    document.getElementById('reject-form-' + id).submit();
                }
            })
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Apakah Anda yakin ingin menghapus data <b class="text-indigo-400">"${name}"</b>?`,
                icon: 'warning',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl border-2 border-indigo-500/30 shadow-2xl shadow-indigo-500/20'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>