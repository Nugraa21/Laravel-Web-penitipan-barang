<x-app-layout>
    <!-- Liquid Glass Custom Styles for this view -->
    <style>
        .liquid-bg {
            background: linear-gradient(135deg, #fdfbf7 0%, #faedce 100%);
            position: relative;
            overflow: hidden;
            min-height: calc(100vh - 4rem);
        }

        /* Floating colorful blobs for the macOS Sonoma / iOS 26 effect */
        .blob-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(251, 211, 141, 0.6) 0%, rgba(251, 211, 141, 0) 70%);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
            animation: float 15s ease-in-out infinite alternate;
        }

        .blob-2 {
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.3) 0%, rgba(52, 211, 153, 0) 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            animation: float 20s ease-in-out infinite alternate-reverse;
        }

        .blob-3 {
            position: absolute;
            top: 20%;
            left: 30%;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, rgba(248, 113, 113, 0.3) 0%, rgba(248, 113, 113, 0) 70%);
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            animation: float 18s ease-in-out infinite alternate;
        }

        @keyframes float {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-50px) scale(1.1);
            }
        }

        /* Glassmorphism Classes */
        .glass-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            border-radius: 24px;
            z-index: 10;
            position: relative;
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.8);
            border-color: rgba(251, 211, 141, 0.8);
            outline: none;
            box-shadow: 0 0 0 4px rgba(251, 211, 141, 0.3);
        }

        .glass-btn {
            background: rgba(251, 211, 141, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #1f2937;
            font-weight: 800;
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(251, 211, 141, 0.4);
        }

        .glass-btn:hover {
            transform: translateY(-2px);
            background: rgba(251, 211, 141, 1);
            box-shadow: 0 8px 20px rgba(251, 211, 141, 0.6);
        }

        .profile-glass {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>

    <div class="liquid-bg flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Blobs -->
        <div class="blob-1"></div>
        <div class="blob-2"></div>
        <div class="blob-3"></div>

        <!-- Search Container -->
        <div class="w-full max-w-2xl glass-card p-8 md:p-12 mb-8 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/60 shadow-sm border border-white mb-6">
                <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                    </path>
                </svg>
            </div>
            <h1 class="text-4xl font-black text-gray-900 mb-2 tracking-tight">{{ __('Scan Token Barang') }}</h1>
            <p class="text-gray-600 font-medium mb-8">
                {{ __('Masukkan kode struk/token penitipan untuk melihat detail dan foto barang secara instan.') }}</p>

            <form action="{{ route('admin.scan.process') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <input type="text" name="token" value="{{ request('token') }}" autocomplete="off"
                    placeholder="{{ __('Contoh: RCP-12345678') }}"
                    class="glass-input flex-grow text-xl text-center sm:text-left text-gray-900 font-bold px-6 py-4 placeholder-gray-500 uppercase"
                    required autofocus>
                <button type="submit" class="glass-btn px-8 py-4 text-lg flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
            </form>
        </div>

        <!-- Result Container -->
        @if(isset($item))
            <div
                class="w-full max-w-5xl glass-card p-6 sm:p-10 mb-12 transform transition-all duration-500 hover:scale-[1.01]">

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Item Info & Photo -->
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-black text-gray-900">{{ $item->name }}</h2>
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                                        {{ $item->status === 'pending' ? 'bg-amber-100 text-amber-800 border border-amber-200' :
            ($item->status === 'stored' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' :
                'bg-gray-200 text-gray-800 border border-gray-300') }}">
                                {{ $item->status }}
                            </span>
                        </div>

                        @if($item->photo_path)
                            <div class="rounded-2xl overflow-hidden shadow-lg border-2 border-white mb-6 relative group">
                                <img src="{{ Storage::url($item->photo_path) }}" alt="{{ $item->name }}"
                                    class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-700">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <p class="text-white font-bold text-sm">{{ __('Foto Utama Barang') }}</p>
                                </div>
                            </div>
                        @else
                            <div
                                class="rounded-2xl bg-gray-200 h-64 mb-6 flex items-center justify-center border-2 border-white">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <div class="profile-glass p-4">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">
                                    {{ __('Deskripsi & Jenis') }}
                                </p>
                                <p class="font-medium text-gray-900">{{ $item->description ?: __('Tidak ada deskripsi.') }}
                                </p>
                                @if($item->item_type)
                                    <p
                                        class="inline-block mt-2 px-3 py-1 bg-white/50 rounded-lg text-sm font-bold text-gray-700">
                                        {{ $item->item_type }}
                                    </p>
                                @endif
                            </div>

                            @if($item->notes)
                                <div class="profile-glass p-4 border-amber-200 bg-amber-50/50">
                                    <p class="text-xs font-bold text-amber-700 uppercase tracking-widest mb-1">Catatan Tambahan
                                    </p>
                                    <p class="font-medium text-amber-900">{{ $item->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- User Profile & Action -->
                    <div class="w-full lg:w-1/3 flex flex-col gap-6">

                        <div class="profile-glass p-6 text-center">
                            @if($item->user->avatar)
                                <img src="{{ Storage::url($item->user->avatar) }}" alt="Avatar"
                                    class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-white shadow-md mb-4 bg-white">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full mx-auto flex items-center justify-center text-4xl font-black text-white bg-gray-400 border-4 border-white shadow-md mb-4">
                                    {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                </div>
                            @endif

                            <h3 class="text-xl font-black text-gray-900 mb-1">{{ $item->user->name }}</h3>
                            <span
                                class="inline-block px-3 py-1 bg-white/60 rounded-full text-xs font-bold text-gray-600 mb-4 border border-white">{{ __('Profile Penitip') }}</span>

                            <div class="space-y-3 text-left border-t border-white/40 pt-4 mt-2">
                                <div class="flex items-center gap-3 text-sm text-gray-700 font-medium">
                                    <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="truncate">{{ $item->user->email }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-700 font-medium">
                                    <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <span>{{ $item->user->phone ?: __('Tidak ada nomor') }}</span>
                                </div>
                                <div class="flex items-start gap-3 text-sm text-gray-700 font-medium">
                                    <svg class="w-5 h-5 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="line-clamp-2">{{ $item->user->address ?: __('Tidak ada alamat') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <a href="{{ route('items.edit', $item) }}"
                                class="w-full flex items-center justify-center gap-2 py-4 bg-gray-900 hover:bg-black text-white rounded-2xl font-bold text-lg shadow-[0_8px_20px_rgba(0,0,0,0.2)] transition-all hover:-translate-y-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Eksekusi Barang') }}
                            </a>
                            <a href="{{ route('items.show', $item) }}"
                                class="w-full flex items-center justify-center gap-2 py-3 mt-3 bg-white/50 hover:bg-white text-gray-800 border border-white rounded-xl font-bold transition-all shadow-sm">
                                {{ __('Lihat Detail Lengkap') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>
</x-app-layout>