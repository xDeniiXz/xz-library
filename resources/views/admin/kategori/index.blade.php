<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Kelola Kategori') }}
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
                        timer: 2000
                    });
                });
            </script>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8 transition-all duration-300">
                <form action="{{ route('admin.kategori.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                    <div class="w-full md:w-48">
                        <x-input-label for="criteria" :value="__('Cari Berdasarkan')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="criteria" id="criteria" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="nama_kategori" {{ request('criteria', 'nama_kategori') == 'nama_kategori' ? 'selected' : '' }}>Nama Kategori</option>
                            <option value="id" {{ request('criteria') == 'id' ? 'selected' : '' }}>ID</option>
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
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik kata kunci pencarian..." class="block w-full pl-10 pr-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                        </div>
                    </div>

                    <div class="w-full md:w-56">
                        <x-input-label for="filter_buku" :value="__('Status Buku')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1" />
                        <select name="filter_buku" id="filter_buku" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <option value="">Semua Kategori</option>
                            <option value="memiliki_buku" {{ request('filter_buku') == 'memiliki_buku' ? 'selected' : '' }}>Sudah Ada Buku</option>
                            <option value="tanpa_buku" {{ request('filter_buku') == 'tanpa_buku' ? 'selected' : '' }}>Belum Ada Buku</option>
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

                        @if(request()->anyFilled(['search', 'filter_buku', 'sort', 'criteria']))
                        <a href="{{ route('admin.kategori.index') }}" class="px-3 py-2 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl transition-all duration-300 flex items-center justify-center shadow-lg shadow-rose-500/20" title="Reset Filter">
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
                            Daftar Kategori
                        </h3>
                        <div class="flex items-center gap-3">
                            <button id="bulk-delete-btn" style="display: none;" onclick="bulkDelete()" class="inline-flex items-center px-4 py-2.5 bg-rose-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-rose-700 active:bg-rose-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-lg shadow-rose-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus Terpilih (<span id="selected-count">0</span>)
                            </button>
                            <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Kategori
                            </a>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-xl border-2 border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-center border-r-2 border-gray-200 dark:border-gray-700 w-12">
                                        <input type="checkbox" id="select-all" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer">
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700 w-20">No</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-r-2 border-gray-200 dark:border-gray-700">Nama Kategori</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Total Buku</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-l-2 border-gray-200 dark:border-gray-700 w-64">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y-2 divide-gray-200 dark:divide-gray-700">
                                @forelse($kategori as $item)
                                <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">
                                        <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="category-checkbox rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 cursor-pointer">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-bold text-indigo-600 dark:text-indigo-400 border-r-2 border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-r-2 border-gray-200 dark:border-gray-700">{{ $item->nama_kategori }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-300 rounded-full text-xs font-bold uppercase tracking-wider">
                                            {{ $item->buku_count }} Buku
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center border-l-2 border-gray-200 dark:border-gray-700">
                                        <div class="flex justify-center items-center gap-4">
                                            <a href="{{ route('admin.kategori.edit', $item->id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-md shadow-amber-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="{{ $item->nama_kategori }}"
                                                    onclick="confirmDelete(this.dataset.id, this.dataset.nama)"
                                                    class="inline-flex items-center px-4 py-2 bg-rose-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-md shadow-rose-600/20">
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
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                            </div>
                                            <span class="text-xl font-medium text-gray-500 dark:text-gray-400 italic">Belum ada data kategori yang terdaftar.</span>
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
        const checkboxes = document.querySelectorAll('.category-checkbox');
        const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
        const selectedCountLabel = document.getElementById('selected-count');

        function updateBulkDeleteButton() {
            const selectedCount = document.querySelectorAll('.category-checkbox:checked').length;
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

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAll.checked = false;
                } else if (document.querySelectorAll('.category-checkbox:checked').length === checkboxes.length) {
                    selectAll.checked = true;
                }
                updateBulkDeleteButton();
            });
        });

        function bulkDelete() {
            const selectedIds = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb.value);

            Swal.fire({
                title: 'Konfirmasi Hapus Massal',
                html: `Apakah Anda yakin ingin menghapus <b class="text-rose-500">${selectedIds.length}</b> kategori terpilih?`,
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
                    fetch("{{ route('admin.kategori.bulkDelete') }}", {
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

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Apakah Anda yakin ingin menghapus kategori <b class="text-indigo-400">"${name}"</b>?`,
                icon: 'warning',
                background: '#1f2937',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Hapus Sekarang!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true,
                customClass: {
                    title: 'font-bold text-2xl mb-4',
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
