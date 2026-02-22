<x-guest-layout>
    <div class="text-center mb-10 border-b-4 border-black pb-6">
        <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-widest"
            style="text-shadow: 2px 2px 0px var(--c-primary);">Selamat Datang!</h2>
        <p class="text-black font-bold uppercase text-sm">Masuk ke akun PenitipanApp Anda untuk melanjutkan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 font-bold text-green-600 bg-green-50 p-4 rounded-xl"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" class="font-bold text-gray-700 mb-2" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                        </path>
                    </svg>
                </div>
                <x-text-input id="email" class="pl-10 block w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" placeholder="contoh@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-medium text-xs" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" value="Kata Sandi" class="font-bold text-gray-700" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-blue-600 hover:text-blue-800 transition rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <x-text-input id="password" class="pl-10 block w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-medium text-xs" />
        </div>

        <!-- Remember Me & Submit -->
        <div class="pt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="border-2 border-black text-black shadow-none focus:ring-0 cursor-pointer w-6 h-6 transition-none"
                    name="remember">
                <span class="ml-3 text-sm font-black uppercase text-black">Ingat Saya</span>
            </label>
        </div>

        <div class="pt-4">
            <x-primary-button>
                Masuk Sekarang
                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </x-primary-button>
        </div>

        <div class="mt-8 text-center text-sm text-black font-bold border-t-4 border-black pt-6 uppercase">
            Belum punya akun?
            <a href="{{ route('register') }}"
                class="font-black text-black hover:bg-[var(--c-primary)] px-2 py-1 border-2 border-transparent hover:border-black transition-colors">Daftar
                Gratis</a>
        </div>
    </form>
</x-guest-layout>