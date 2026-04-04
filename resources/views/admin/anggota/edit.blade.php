<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center sm:text-left">
            {{ __('Edit Data Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-500/20">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.anggota.update', $anggota->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <!-- Nama Lengkap -->
                            <div>
                                <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold mb-2" />
                                <x-text-input id="name" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="name" :value="old('name', $anggota->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Username -->
                            <div>
                                <x-input-label for="username" :value="__('Username')" class="font-bold mb-2" />
                                <x-text-input id="username" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="username" :value="old('username', $anggota->username)" required />
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" class="font-bold mb-2" />
                                <x-text-input id="email" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="email" name="email" :value="old('email', $anggota->email)" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <x-input-label for="phone_number" :value="__('Nomor Telepon')" class="font-bold mb-2" />
                                <x-text-input id="phone_number" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="text" name="phone_number" :value="old('phone_number', $anggota->phone_number)" />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <x-input-label for="address" :value="__('Alamat Lengkap')" class="font-bold mb-2" />
                                <textarea id="address" name="address" rows="3" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all text-gray-700 dark:text-gray-300">{{ old('address', $anggota->address) }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2 border-t border-gray-100 dark:border-gray-700 pt-6">
                                <h4 class="text-sm font-bold text-rose-500 uppercase tracking-widest mb-4">Ganti Password (Opsional)</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Password -->
                                    <div>
                                        <x-input-label for="password" :value="__('Password Baru')" class="font-bold mb-2" />
                                        <x-text-input id="password" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="password" name="password" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-bold mb-2" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 focus:border-indigo-500 rounded-xl transition-all" type="password" name="password_confirmation" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 italic">* Kosongkan jika tidak ingin mengganti password.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-gray-100 dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.anggota.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-bold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                                Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 px-6 py-2 rounded-lg">
                                Perbarui Anggota
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
