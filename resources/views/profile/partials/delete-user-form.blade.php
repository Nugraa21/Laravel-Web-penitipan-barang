<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-red-600">
            {{ __('Hapus Akun Permanen') }}
        </h2>
        <p class="mt-1 text-sm font-medium text-gray-500">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button type="button"
        class="btn btn-outline border-red-200 text-red-600 hover:bg-red-50 hover:text-red-700 hover:border-red-300 transition-colors"
        x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Hapus Akun') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-gray-900">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-2 text-sm font-medium text-gray-500 leading-relaxed">
                {{ __('Setelah akun dihapus, seluruh data yang berkaitan akan hilang selamanya. Masukkan kata sandi Anda untuk mengonfirmasi proses penghapusan.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <input id="password" name="password" type="password"
                    class="mt-2 block w-full md:w-3/4 rounded-xl border-gray-200 bg-gray-50 focus:border-red-500 focus:bg-white focus:ring focus:ring-red-200 transition duration-200"
                    placeholder="{{ __('Kata Sandi Anda') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')"
                    class="mt-2 text-sm text-red-500 font-medium" />
            </div>

            <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" class="btn btn-outline text-gray-600 border-gray-200 hover:bg-gray-50 bg-white"
                    x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white shadow-md shadow-red-500/20">
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>