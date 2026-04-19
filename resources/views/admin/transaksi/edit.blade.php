<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Edit Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.transaksi.update', $peminjaman) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <!-- Pilih Siswa -->
                            <div>
                                <x-input-label for="user_id" :value="__('Pilih Siswa')" class="font-bold mb-2" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300">
                                    @foreach($anggota as $item)
                                    <option value="{{ $item->id }}" {{ old('user_id', $peminjaman->user_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} (@ {{ $item->username }})
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Pilih Buku -->
                            <div>
                                <x-input-label for="buku_id" :value="__('Pilih Buku')" class="font-bold mb-2" />
                                <select id="buku_id" name="buku_id" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300">
                                    @foreach($buku as $item)
                                    <option value="{{ $item->id }}" {{ old('buku_id', $peminjaman->buku_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul }} (Stok: {{ $item->stok }})
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('buku_id')" class="mt-2" />
                            </div>

                            <!-- Tanggal Pinjam -->
                            <div>
                                <x-input-label for="tanggal_pinjam" :value="__('Tanggal Pinjam')" class="font-bold mb-2" />
                                <x-text-input id="tanggal_pinjam" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="date" name="tanggal_pinjam" :value="old('tanggal_pinjam', $peminjaman->tanggal_pinjam)" required />
                                <x-input-error :messages="$errors->get('tanggal_pinjam')" class="mt-2" />
                            </div>

                            <!-- Tanggal Kembali -->
                            <div>
                                <x-input-label for="tanggal_kembali" :value="__('Batas Waktu Kembali')" class="font-bold mb-2" />
                                <x-text-input id="tanggal_kembali" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="date" name="tanggal_kembali" :value="old('tanggal_kembali', $peminjaman->tanggal_kembali)" required />
                                <x-input-error :messages="$errors->get('tanggal_kembali')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status')" class="font-bold mb-2" />
                                <select id="status" name="status" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300">
                                    @foreach(\App\Enums\PeminjamanStatus::cases() as $status)
                                    <option value="{{ $status->value }}" {{ old('status', $peminjaman->status->value) == $status->value ? 'selected' : '' }}>
                                        {{ $status->label() }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                <p class="mt-2 text-xs text-gray-500 italic">* Mengubah status ke/dari 'Dipinjam' akan mempengaruhi stok buku.</p>
                            </div>

                            <!-- Tanggal Pengembalian (Hanya muncul jika status dikembalikan) -->
                            <div id="tanggal_pengembalian_container" class="{{ old('status', $peminjaman->status->value) == \App\Enums\PeminjamanStatus::DIKEMBALIKAN->value ? '' : 'hidden' }}">
                                <x-input-label for="tanggal_pengembalian" :value="__('Tanggal Pengembalian Real')" class="font-bold mb-2" />
                                <x-text-input id="tanggal_pengembalian" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="date" name="tanggal_pengembalian" :value="old('tanggal_pengembalian', $peminjaman->pengembalian?->tanggal_pengembalian)" />
                                <x-input-error :messages="$errors->get('tanggal_pengembalian')" class="mt-2" />
                                <p class="mt-2 text-xs text-gray-500 italic">* Denda akan dihitung otomatis jika tanggal pengembalian melewati batas waktu.</p>
                            </div>

                            <!-- Catatan Penolakan -->
                            <div id="catatan_container" class="{{ old('status', $peminjaman->status->value) == \App\Enums\PeminjamanStatus::DITOLAK->value ? '' : 'hidden' }}">
                                <x-input-label for="catatan" :value="__('Alasan Penolakan')" class="font-bold mb-2" />
                                <textarea id="catatan" name="catatan" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300" rows="3">{{ old('catatan', $peminjaman->catatan) }}</textarea>
                                <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-gray-100 dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-bold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                                Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 px-6 py-2 rounded-lg">
                                Perbarui Transaksi
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const catatanContainer = document.getElementById('catatan_container');
            const catatanTextarea = document.getElementById('catatan');
            const tanggalPengembalianContainer = document.getElementById('tanggal_pengembalian_container');
            const tanggalPengembalianInput = document.getElementById('tanggal_pengembalian');

            function toggleFields() {
                // Toggle Catatan
                if (statusSelect.value === '{{ \App\Enums\PeminjamanStatus::DITOLAK->value }}') {
                    catatanContainer.classList.remove('hidden');
                    catatanTextarea.setAttribute('required', 'required');
                } else {
                    catatanContainer.classList.add('hidden');
                    catatanTextarea.removeAttribute('required');
                }

                // Toggle Tanggal Pengembalian
                if (statusSelect.value === '{{ \App\Enums\PeminjamanStatus::DIKEMBALIKAN->value }}') {
                    tanggalPengembalianContainer.classList.remove('hidden');
                    tanggalPengembalianInput.setAttribute('required', 'required');
                } else {
                    tanggalPengembalianContainer.classList.add('hidden');
                    tanggalPengembalianInput.removeAttribute('required');
                }
            }

            statusSelect.addEventListener('change', toggleFields);
            toggleFields(); // Initial check
        });
    </script>
</x-app-layout>