<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.buku.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <!-- Judul -->
                            <div>
                                <x-input-label for="judul" :value="__('Judul Buku')" class="font-bold mb-2" />
                                <x-text-input id="judul" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="judul" :value="old('judul')" required autofocus placeholder="Masukkan judul lengkap buku..." />
                                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                            </div>

                            <!-- Kategori -->
                            <div>
                                <x-input-label for="kategori_id" :value="__('Kategori')" class="font-bold mb-2" />
                                <select id="kategori_id" name="kategori_id" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300">
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    @foreach($kategori as $item)
                                        <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                            </div>

                            <!-- Penulis -->
                            <div>
                                <x-input-label for="penulis" :value="__('Penulis')" class="font-bold mb-2" />
                                <x-text-input id="penulis" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="penulis" :value="old('penulis')" required placeholder="Nama penulis buku..." />
                                <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <x-input-label for="penerbit" :value="__('Penerbit')" class="font-bold mb-2" />
                                <x-text-input id="penerbit" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="penerbit" :value="old('penerbit')" required placeholder="Nama penerbit..." />
                                <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <x-input-label for="tahun_terbit" :value="__('Tahun Terbit')" class="font-bold mb-2" />
                                <x-text-input id="tahun_terbit" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="number" name="tahun_terbit" :value="old('tahun_terbit', date('Y'))" required />
                                <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
                            </div>

                            <!-- ISBN -->
                            <div>
                                <x-input-label for="isbn" :value="__('ISBN')" class="font-bold mb-2" />
                                <x-text-input id="isbn" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="isbn" :value="old('isbn')" required placeholder="Nomor ISBN..." />
                                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                            </div>

                            <!-- Stok -->
                            <div>
                                <x-input-label for="stok" :value="__('Jumlah Stok')" class="font-bold mb-2" />
                                <x-text-input id="stok" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="number" name="stok" :value="old('stok', 0)" required min="0" />
                                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-gray-100 dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.buku.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-bold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                                Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 px-6 py-2 rounded-lg">
                                Simpan Buku
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
