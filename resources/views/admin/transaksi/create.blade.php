<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Tambah Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.transaksi.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <!-- Pilih Anggota -->
                            <div>
                                <x-input-label for="user_id" :value="__('Pilih Anggota (Siswa)')" class="font-bold mb-2" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300">
                                    <option value="" disabled selected>Cari Nama Anggota...</option>
                                    @foreach($anggota as $item)
                                        <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : '' }}>
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
                                    <option value="" disabled selected>Cari Judul Buku...</option>
                                    @foreach($buku as $item)
                                        <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->judul }} (Stok: {{ $item->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('buku_id')" class="mt-2" />
                            </div>

                            <!-- Tanggal Pinjam -->
                            <div>
                                <x-input-label for="tanggal_pinjam" :value="__('Tanggal Pinjam')" class="font-bold mb-2" />
                                <x-text-input id="tanggal_pinjam" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="date" name="tanggal_pinjam" :value="old('tanggal_pinjam', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('tanggal_pinjam')" class="mt-2" />
                            </div>

                            <!-- Tanggal Kembali -->
                            <div>
                                <x-input-label for="tanggal_kembali" :value="__('Batas Waktu Kembali')" class="font-bold mb-2" />
                                <x-text-input id="tanggal_kembali" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="date" name="tanggal_kembali" :value="old('tanggal_kembali', date('Y-m-d', strtotime('+7 days')))" required />
                                <x-input-error :messages="$errors->get('tanggal_kembali')" class="mt-2" />
                                <p class="mt-2 text-xs text-gray-500 italic">* Default durasi peminjaman adalah 7 hari.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-gray-100 dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-bold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                                Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 px-6 py-2 rounded-lg">
                                Simpan Transaksi
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
