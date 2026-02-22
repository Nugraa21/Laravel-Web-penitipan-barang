<x-guest-layout>
    <div class="text-center mb-10 border-b-4 border-black pb-6">
        <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-widest"
            style="text-shadow: 2px 2px 0px var(--c-primary);">Daftar Akun Baru</h2>
        <p class="text-black font-bold uppercase text-sm">Buat akun untuk mulai menitipkan barang dengan aman.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="font-bold text-gray-700 mb-2" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <x-text-input id="name" class="pl-10 block w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 font-medium text-xs" />
        </div>

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
                    required autocomplete="username" placeholder="contoh@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-medium text-xs" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Password -->
            <div>
                <x-input-label for="password" value="Kata Sandi" class="font-bold text-gray-700 mb-2" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <x-text-input id="password" class="pl-10 block w-full" type="password" name="password" required
                        autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-medium text-xs" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Konfirmasi Sandi"
                    class="font-bold text-gray-700 mb-2" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation" class="pl-10 block w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')"
                    class="mt-2 text-red-500 font-medium text-xs" />
            </div>
        </div>

        <div class="pt-4">
            <x-primary-button>
                Buat Akun
                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </x-primary-button>
        </div>

        <div class="mt-8 text-center text-sm text-black font-bold border-t-4 border-black pt-6 uppercase">
            Sudah punya akun?
            <a href="{{ route('login') }}"
                class="font-black text-black hover:bg-[var(--c-primary)] px-2 py-1 border-2 border-transparent hover:border-black transition-colors">Masuk
                di
                sini</a>
        </div>
    </form>
</x-guest-layout>