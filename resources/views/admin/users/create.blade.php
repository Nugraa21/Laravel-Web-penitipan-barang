<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 lg:py-16 my-8">
        <div class="glass-card p-8">

            <div class="flex items-center gap-6 mb-8 pb-6 border-b border-gray-100">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline"
                    style="padding: 0.75rem; border-radius: 50%;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Tambah Akses Pengguna</h2>
                    <p class="text-gray-500 font-medium mt-1 text-sm">Mendaftarkan user atau administrator baru ke
                        dalam sistem.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data"
                class="flex flex-col gap-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- LEFT COLUMN -->
                    <div class="flex flex-col gap-6">

                        <div>
                            <label for="role" class="block font-bold text-gray-700 mb-2">Hak Akses (Role)</label>
                            <select id="role" name="role"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                required>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Pelanggan)
                                </option>
                                @if(Auth::user()->role === 'super_admin')
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pengelola)
                                    </option>
                                @endif
                            </select>
                            @error('role')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                value="{{ old('name') }}" required placeholder="Contoh: John Doe">
                            @error('name')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block font-bold text-gray-700 mb-2">Alamat Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                value="{{ old('email') }}" required placeholder="contoh@email.com">
                            @error('email')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block font-bold text-gray-700 mb-2">No WhatsApp / Telepon</label>
                            <input type="text" id="phone" name="phone"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                value="{{ old('phone') }}" placeholder="Opsional">
                            @error('phone')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="flex flex-col gap-6">
                        <div>
                            <label for="password" class="block font-bold text-gray-700 mb-2">Kata Sandi Awal</label>
                            <input type="password" id="password" name="password"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                required placeholder="••••••••">
                            @error('password')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block font-bold text-gray-700 mb-2">Konfirmasi
                                Sandi Awal</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                required placeholder="••••••••">
                        </div>

                        <div class="flex flex-col gap-2 h-full">
                            <label class="block font-bold text-gray-700 mb-2">Foto Profil (Avatar Opsional)</label>
                            <div
                                class="relative border-2 border-dashed border-gray-300 bg-gray-50 rounded-2xl p-8 text-center h-full flex flex-col justify-center hover:bg-gray-100 transition-colors cursor-pointer group">
                                <svg class="w-10 h-10 mx-auto text-gray-400 group-hover:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="mt-4 font-bold text-gray-700 text-sm">Pilih Gambar Avatar</p>
                                <p class="text-xs font-medium text-gray-500 mt-1">Maksimal 2MB (JPG, PNG)</p>
                                <input type="file" name="avatar" id="avatar"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            </div>
                            @error('avatar')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.users.index') }}"
                        class="btn btn-outline text-gray-600 border-transparent">Batal</a>
                    <button type="submit" class="btn btn-primary flex items-center gap-2 pl-6 pr-6">
                        Simpan Pengguna Baru
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>