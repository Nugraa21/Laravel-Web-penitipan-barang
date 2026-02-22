<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900">
            {{ __('Perbarui Kata Sandi') }}
        </h2>
        <p class="mt-1 text-sm font-medium text-gray-500">
            {{ __('Pastikan akun Anda menggunakan kata sandi panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="{{ __('Kata Sandi Saat Ini') }}"
                class="text-gray-700 font-bold mb-2" />
            <input id="current_password" name="current_password" type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')"
                class="mt-2 text-sm text-red-500 font-medium" />
        </div>

        <div>
            <x-input-label for="password" value="{{ __('Kata Sandi Baru') }}" class="text-gray-700 font-bold mb-2" />
            <input id="password" name="password" type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')"
                class="mt-2 text-sm text-red-500 font-medium" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Kata Sandi Baru') }}"
                class="text-gray-700 font-bold mb-2" />
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2 text-sm text-red-500 font-medium" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn btn-primary">{{ __('Simpan Sandi') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>