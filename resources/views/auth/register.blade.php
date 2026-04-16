<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Daftar Anggota</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Buatlah akun agar dapat login ke perpustakaan kami.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Name -->
            <div class="group">
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input id="name" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="text" name="name" :value="old('name')" required autofocus placeholder="Nama Anda" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1 ml-1" />
            </div>

            <!-- Username -->
            <div class="group">
                <x-input-label for="username" :value="__('Username')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                    </div>
                    <x-text-input id="username" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="text" name="username" :value="old('username')" required placeholder="Username" />
                </div>
                <x-input-error :messages="$errors->get('username')" class="mt-1 ml-1" />
            </div>
        </div>

        <!-- Email & Phone Number -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="group">
                <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    <x-text-input id="email" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="email" name="email" :value="old('email')" required placeholder="Email Aktif" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 ml-1" />
            </div>

            <div class="group">
                <x-input-label for="phone_number" :value="__('Nomor Telepon')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <x-text-input id="phone_number" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="text" name="phone_number" :value="old('phone_number')" placeholder="08xxxxxxxxxx" />
                </div>
                <x-input-error :messages="$errors->get('phone_number')" class="mt-1 ml-1" />
            </div>
        </div>

        <!-- Address -->
        <div class="group">
            <x-input-label for="address" :value="__('Alamat')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <x-text-input id="address" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="text" name="address" :value="old('address')" placeholder="Alamat Lengkap Anda" />
            </div>
            <x-input-error :messages="$errors->get('address')" class="mt-1 ml-1" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Password -->
            <div class="group">
                <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                        type="password"
                        name="password"
                        required placeholder="Password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 ml-1" />
            </div>

            <!-- Confirm Password -->
            <div class="group">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                        type="password"
                        name="password_confirmation" required placeholder="Ulangi password" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ml-1" />
            </div>
        </div>

        <div class="space-y-4 pt-4">
            <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all duration-300 shadow-xl shadow-indigo-500/25 flex items-center justify-center gap-2 transform active:scale-95 text-sm uppercase tracking-wider">
                <span>DAFTAR SEKARANG</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </button>

            <div class="flex flex-col items-center gap-4">
                <div class="flex items-center w-full gap-4">
                    <div class="h-px bg-gray-200 dark:bg-gray-700 flex-1"></div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sudah Punya Akun?</span>
                    <div class="h-px bg-gray-200 dark:bg-gray-700 flex-1"></div>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 transition-colors">
                        Login Di Sini
                    </a>
                </p>

                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 uppercase tracking-widest transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
