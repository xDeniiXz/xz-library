<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtering & Search -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8 transition-all duration-300">
                <form action="{{ route('student.peminjaman.katalog') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                    <!-- Kriteria Dropdown -->
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

                    <!-- Search Input -->
                    <div class="flex-1 w-full group">
                        <x-input-label for="search" :value="__('Kata Kunci')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik kata kunci pencarian..." class="block w-full pl-10 pr-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                        </div>
                    </div>

                    <!-- Kategori Dropdown -->
                    <div class="w-full md:w-56">
                        <x-input-label for="kategori_id" :value="__('Kategori')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="kategori_id" id="kategori_id" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="">Semua Kategori</option>
                            @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-indigo-500/30 flex items-center justify-center">
                            Cari
                        </button>
                        
                        @if(request()->anyFilled(['search', 'kategori_id', 'criteria']))
                            <a href="{{ route('student.peminjaman.katalog') }}" class="px-3 py-2 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl transition-all duration-300 flex items-center justify-center shadow-lg shadow-rose-500/20" title="Reset Filter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

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

            @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($buku as $item)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-indigo-500 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-300 rounded-full text-xs font-bold uppercase">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                            <span class="text-xs font-bold {{ $item->stok > 0 ? 'text-emerald-500' : 'text-rose-500' }}">
                                Stok: {{ $item->stok }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 uppercase group-hover:text-indigo-500 transition-colors">
                            {{ $item->judul }}
                        </h3>

                        <div class="space-y-1 mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-semibold text-gray-500">Penulis:</span> {{ $item->penulis }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-semibold text-gray-500">Penerbit:</span> {{ $item->penerbit }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-semibold text-gray-500">Tahun:</span> {{ $item->tahun_terbit }}
                            </p>
                        </div>

                        @if($item->stok > 0)
                        <button type="button"
                            onclick="openPinjamModal('{{ $item->id }}', '{{ $item->judul }}')"
                            class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Pinjam Buku
                        </button>
                        @else
                        <button disabled class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-gray-400 dark:bg-gray-700 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest cursor-not-allowed opacity-50">
                            Stok Habis
                        </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <div class="bg-gray-100 dark:bg-gray-800 p-8 rounded-3xl inline-block mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 dark:text-gray-400 italic">Belum ada koleksi buku.</h3>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <form id="pinjam-form" action="{{ route('student.peminjaman.store') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="buku_id" id="modal_buku_id">
        <input type="hidden" name="tanggal_kembali" id="modal_tanggal_kembali">
    </form>

    <script>
        function openPinjamModal(id, judul) {
            Swal.fire({
                title: 'Pinjam Buku',
                html: `
                    <div class="text-left space-y-4">
                        <p class="text-sm">Anda akan meminjam buku: <b class="text-indigo-400">${judul}</b></p>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Pilih Tanggal Kembali:</label>
                            <input type="date" id="swal-input-date"
                                class="w-full bg-gray-700 border-gray-600 text-white rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                        </div>
                        <p class="text-[10px] text-gray-500 italic">* Batas maksimal peminjaman biasanya 7 hari.</p>
                    </div>
                `,
                icon: 'question',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Pinjam!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl border-2 border-indigo-500/30'
                },
                preConfirm: () => {
                    const date = document.getElementById('swal-input-date').value;
                    if (!date) {
                        Swal.showValidationMessage('Tanggal kembali harus diisi');
                    }
                    return date;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('modal_buku_id').value = id;
                    document.getElementById('modal_tanggal_kembali').value = result.value;
                    document.getElementById('pinjam-form').submit();
                }
            })
        }
    </script>
</x-app-layout>