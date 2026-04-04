<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Daftar Transaksi') }}
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
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            </script>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                        <h3 class="text-xl font-extrabold tracking-tight text-indigo-600 dark:text-indigo-400 uppercase">
                            Riwayat Peminjaman & Pengembalian
                        </h3>
                        <a href="{{ route('admin.transaksi.create') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Peminjaman
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border-2 border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700 w-16">No</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Peminjam</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Buku</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Tgl Pinjam / Kembali</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Status</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider w-48">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y-2 divide-gray-200 dark:divide-gray-700">
                                @forelse($transaksi as $item)
                                <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-bold text-indigo-600 dark:text-indigo-400 border-r-2 border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-r-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-900 dark:text-white uppercase">{{ $item->user->name }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 italic">@ {{ $item->user->username }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-r-2 border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white uppercase">{{ $item->buku->judul }}</span>
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
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-300 rounded-full text-xs font-bold uppercase tracking-wider">
                                                Dikembalikan
                                            </span>
                                            <span class="text-[10px] text-gray-500 italic">
                                                Tgl: {{ \Carbon\Carbon::parse($item->pengembalian->tanggal_pengembalian)->format('d M Y') }}
                                            </span>
                                            @if($item->pengembalian->denda > 0)
                                            <span class="text-[10px] text-rose-500 font-bold">
                                                Denda: Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <div class="flex justify-center items-center gap-3">
                                            @if($item->status === 'dipinjam')
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
                                    <td colspan="6" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">
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
                </div>
            </div>
        </div>
    </div>

    <script>
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