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
                    <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
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

                            <!-- Cover Buku -->
                            <div>
                                <x-input-label for="cover" :value="__('Cover Buku')" class="font-bold mb-2" />
                                <div class="mt-1 flex flex-col items-center p-4 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl hover:border-indigo-500 transition-colors group cursor-pointer relative">
                                    <input type="file" name="cover" id="cover" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                                    <div id="preview-container" class="hidden flex-col items-center w-full">
                                        <img id="preview-img" src="#" alt="Preview" class="max-h-48 rounded-lg shadow-md mb-2">
                                        <span class="text-xs text-indigo-500 font-bold uppercase">Ganti Gambar</span>
                                    </div>
                                    <div id="placeholder-container" class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 group-hover:text-indigo-500 transition-colors">Klik atau seret gambar ke sini</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">PNG, JPG, WEBP (Maks. 2MB)</p>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                            </div>

                            <!-- Sinopsis -->
                            <div class="md:col-span-2">
                                <x-input-label for="sinopsis" :value="__('Sinopsis')" class="font-bold mb-2" />
                                <textarea id="sinopsis" name="sinopsis" rows="4" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300 placeholder-gray-400" placeholder="Tuliskan ringkasan atau sinopsis buku di sini...">{{ old('sinopsis') }}</textarea>
                                <x-input-error :messages="$errors->get('sinopsis')" class="mt-2" />
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

    <script>
        function previewImage(input) {
            const previewContainer = document.getElementById('preview-container');
            const placeholderContainer = document.getElementById('placeholder-container');
            const previewImg = document.getElementById('preview-img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('flex');
                    placeholderContainer.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
