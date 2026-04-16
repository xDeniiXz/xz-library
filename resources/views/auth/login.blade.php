<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Selamat Datang</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan login untuk mengakses koleksi perpustakaan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username -->
        <div class="group">
            <x-input-label for="username" :value="__('Username')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input id="username" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="text" name="username" :value="old('username')" required autofocus placeholder="Masukkan username" />
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-1 ml-1" />
        </div>

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
                    required placeholder="Masukkan password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 ml-1" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 transition-all duration-300" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-indigo-500 transition-colors">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="space-y-4 pt-2">
            <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all duration-300 shadow-xl shadow-indigo-500/25 flex items-center justify-center gap-2 transform active:scale-95">
                <span>MASUK KE PERPUSTAKAAN</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>

            <div class="flex flex-col items-center gap-4">
                <div class="flex items-center w-full gap-4">
                    <div class="h-px bg-gray-200 dark:bg-gray-700 flex-1"></div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Atau</span>
                    <div class="h-px bg-gray-200 dark:bg-gray-700 flex-1"></div>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 transition-colors">
                        Daftar Sekarang
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