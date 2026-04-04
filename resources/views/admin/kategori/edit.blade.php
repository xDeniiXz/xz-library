<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-8">
                            <x-input-label for="nama_kategori" :value="__('Nama Kategori')" class="text-lg font-bold mb-2" />
                            <x-text-input id="nama_kategori" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="nama_kategori" :value="old('nama_kategori', $kategori->nama_kategori)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-gray-100 dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-bold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                                Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 px-4 py-2 rounded-lg">
                                Perbarui Kategori
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>