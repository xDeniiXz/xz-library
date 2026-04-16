<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Lupa Password?</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Jangan khawatir, kami akan membantu Anda mengatur ulang password Anda.</p>
    </div>

    <div class="mb-6 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl border border-indigo-100 dark:border-indigo-800 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
        {{ __('Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password yang memungkinkan Anda memilih password baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="group">
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-gray-400 uppercase mb-1 ml-1 group-focus-within:text-indigo-500 transition-colors" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 00-2 2z" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus placeholder="Email Terdaftar" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 ml-1" />
        </div>

        <div class="space-y-4">
            <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all duration-300 shadow-xl shadow-indigo-500/25 flex items-center justify-center gap-2 transform active:scale-95 text-xs uppercase tracking-widest">
                <span>KIRIM TAUTAN RESET PASSWORD</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>

            <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center gap-2 py-3 text-xs font-bold text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 uppercase tracking-widest transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
