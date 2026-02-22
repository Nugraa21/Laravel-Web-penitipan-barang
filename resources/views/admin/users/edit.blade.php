<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 lg:py-16 my-8">
        <div class="glass-card p-8">

            <div class="flex items-center justify-between mb-6 pb-4"
                style="border-bottom: 2px solid var(--c-gray-100);">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline"
                        style="padding: 0.5rem; border-radius: 50%;">
                        <svg style="width: 20px; height: 20px; color: var(--c-gray-600);" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h2 style="font-size: 1.5rem; font-weight: 900; color: var(--c-gray-900);">Edit Data Pengguna
                        </h2>
                        <p style="color: var(--c-gray-500); font-size: 0.875rem;">Perbarui profil atau kata sandi
                            pengguna terpilih.</p>
                    </div>
                </div>

                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="zoomable-image"
                        style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: var(--shadow-md); cursor: zoom-in;">
                @endif
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data"
                style="display: flex; flex-direction: column; gap: 1.5rem;">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <!-- LEFT COLUMN -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">

                        <div class="form-group">
                            <label for="role" class="form-label"
                                style="display: flex; gap: 0.5rem; justify-content: flex-start;">
                                <svg style="width: 16px; height: 16px; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                Hak Akses (Role)
                            </label>
                            <select id="role" name="role" class="form-input" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User
                                    (Pelanggan)</option>
                                @if(Auth::user()->role === 'super_admin')
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                        (Pengelola)</option>
                                @endif
                            </select>
                            @error('role')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </p>@enderror
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label"
                                style="display: flex; gap: 0.5rem; justify-content: flex-start;">
                                <svg style="width: 16px; height: 16px; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name" class="form-input"
                                value="{{ old('name', $user->name) }}" required placeholder="Contoh: John Doe">
                            @error('name')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </p>@enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label"
                                style="display: flex; gap: 0.5rem; justify-content: flex-start;">
                                <svg style="width: 16px; height: 16px; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Alamat Email
                            </label>
                            <input type="email" id="email" name="email" class="form-input"
                                value="{{ old('email', $user->email) }}" required placeholder="contoh@email.com">
                            @error('email')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </p>@enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label"
                                style="display: flex; gap: 0.5rem; justify-content: flex-start;">
                                <svg style="width: 16px; height: 16px; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                No WhatsApp / Telepon
                            </label>
                            <input type="text" id="phone" name="phone" class="form-input"
                                value="{{ old('phone', $user->phone) }}" placeholder="Opsional">
                            @error('phone')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </p>@enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label"
                                style="display: flex; gap: 0.5rem; justify-content: flex-start;">
                                <svg style="width: 16px; height: 16px; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Alamat Lengkap
                            </label>
                            <textarea id="address" name="address" class="form-input" rows="3"
                                placeholder="Opsional, masukkan alamat lengkap user">{{ old('address', $user->address) }}</textarea>
                            @error('address')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </p>@enderror
                        </div>

                    </div>

                    <!-- RIGHT COLUMN -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <div
                            style="background: var(--c-warning-bg); padding: 1.5rem; border: 1px solid var(--c-warning-light); border-radius: var(--radius-2xl);">
                            <p
                                style="font-size: 0.75rem; color: var(--c-warning-text); font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ganti Kata Sandi
                            </p>
                            <p style="font-size: 0.875rem; color: var(--c-gray-600); margin-bottom: 1rem;">Biarkan
                                kosong jika tidak ingin mengubah kata sandi.</p>

                            <div class="form-group" style="margin-bottom: 1rem;">
                                <div style="position: relative;">
                                    <div
                                        style="position: absolute; top: 0; bottom: 0; left: 0; padding-left: 1rem; display: flex; align-items: center; pointer-events: none;">
                                        <svg style="width: 20px; height: 20px; color: var(--c-gray-400);" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password" name="password" autocomplete="new-password"
                                        class="form-input" style="padding-left: 2.75rem; background: white;"
                                        placeholder="Sandi Baru (Opsional)">
                                </div>
                                @error('password')<p
                                    style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                    {{ $message }}
                                </p>@enderror
                            </div>

                            <div class="form-group">
                                <div style="position: relative;">
                                    <div
                                        style="position: absolute; top: 0; bottom: 0; left: 0; padding-left: 1rem; display: flex; align-items: center; pointer-events: none;">
                                        <svg style="width: 20px; height: 20px; color: var(--c-gray-400);" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-input" style="padding-left: 2.75rem; background: white;"
                                        placeholder="Ulangi Sandi Baru">
                                </div>
                                @error('password_confirmation')<p
                                    style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                    {{ $message }}
                                </p>@enderror
                            </div>
                        </div>

                        <div class="form-group" style="height: 100%;">
                            <label class="form-label" style="display: flex; gap: 0.5rem; justify-content: flex-start;">
                                <svg style="width: 16px; height: 16px; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Perbarui Foto Profil (Avatar Opsional)
                            </label>
                            <div
                                style="position: relative; border: 2px dashed var(--c-primary-light); background: var(--c-gray-50); border-radius: var(--radius-2xl); padding: 2rem; text-align: center; transition: var(--transition); height: 100%; display: flex; flex-direction: column; justify-content: center;">
                                <svg style="width: 48px; height: 48px; margin: 0 auto; color: var(--c-primary);"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p style="margin-top: 1rem; font-weight: 700; color: var(--c-gray-900);">Pilih Gambar
                                    Baru</p>
                                <p style="font-size: 0.75rem; color: var(--c-gray-500); margin-top: 0.25rem;">Maksimal
                                    2MB (JPG, PNG)</p>
                                <input type="file" name="avatar" id="avatar"
                                    style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                            </div>
                            @error('avatar')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                                {{ $message }}
                            </p>@enderror
                        </div>
                    </div>

                </div>

                <div
                    style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--c-gray-100);">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline"
                        style="color: var(--c-gray-600); border-color: transparent;">Batal</a>
                    <button type="submit" class="btn btn-primary"
                        style="padding-left: 2rem; padding-right: 2rem; display: flex; align-items: center; gap: 0.5rem;">
                        Perbarui Data Pengguna
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>