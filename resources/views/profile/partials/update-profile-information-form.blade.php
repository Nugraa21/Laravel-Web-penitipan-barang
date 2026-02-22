<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm font-medium text-gray-500">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Upload -->
        <div>
            <x-input-label for="avatar" value="Foto Profil (Opsional)" class="text-gray-700 font-bold mb-2" />

            @if ($user->avatar)
                <div class="mt-2 mb-4">
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar"
                        class="w-24 h-24 object-cover rounded-full shadow-sm border-4 border-white">
                </div>
            @endif

            <input id="avatar" name="avatar" type="file"
                class="mt-2 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors cursor-pointer"
                accept="image/*" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('avatar')" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-bold mb-2" />
            <input id="name" name="name" type="text"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('name')" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone" value="Nomor WhatsApp / HP" class="text-gray-700 font-bold mb-2" />
            <input id="phone" name="phone" type="text"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                value="{{ old('phone', $user->phone) }}" autocomplete="tel" placeholder="Contoh: 081234567890" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('phone')" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" value="Alamat Lengkap" class="text-gray-700 font-bold mb-2" />
            <textarea id="address" name="address"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200 px-4 py-3"
                rows="3"
                placeholder="Opsional, masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="email" value="Alamat Email" class="text-gray-700 font-bold mb-2" />
            <input id="email" name="email" type="email"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 font-medium text-gray-800">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-blue-600 rounded-md focus:outline-none transition-colors">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn btn-primary">Simpan Profil</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>