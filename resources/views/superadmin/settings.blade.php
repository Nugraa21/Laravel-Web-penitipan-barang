<x-superadmin-layout>
    <style>
        .edit-mode-bg {
            background-color: #f8fafc;
            background-image: linear-gradient(rgba(79, 70, 229, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(79, 70, 229, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .edit-badge {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: #4f46e5;
            color: white;
            padding: 4px 16px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            font-size: 0.75rem;
            font-weight: bold;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
            z-index: 10;
        }
    </style>
    <div class="edit-mode-bg min-h-screen p-6 relative">
        <div class="edit-badge">EDIT MODE : CORE SETTINGS</div>

        <x-slot name="header">
            <div
                class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
                <div>
                    <h2 class="font-black text-3xl text-gray-900 tracking-tight">{{ __('Pengaturan Core Sistem') }}</h2>
                    <p class="text-gray-500 font-medium text-sm mt-1">
                        {{ __('Kustomisasi identitas aplikasi (White-label), teks landing page, dan informasi kontak global.') }}
                    </p>
                </div>
            </div>
        </x-slot>

        <div class="py-8" x-data="{ activeSection: 'general' }">
            <div class="max-w-7xl mx-auto">

                @php
                    // Parse JSON settings centrally
                    $parsedSettings = [];
                    foreach ($settings as $k => $v) {
                        $decoded = json_decode($v, true);
                        $parsedSettings[$k] = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : $v;
                    }
                @endphp

                @if(session('success'))
                    <div
                        class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-emerald-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col lg:flex-row gap-8">

                    <!-- WordPress Style Left Sidebar for Settings Navigation -->
                    <div class="w-full lg:w-1/4">
                        <div class="glass-card p-2 sticky top-6">
                            <nav class="space-y-1">
                                <button @click="activeSection = 'general'"
                                    :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'general', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'general' }"
                                    class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-colors">
                                    <svg class="mr-3 h-5 w-5"
                                        :class="{ 'text-indigo-500': activeSection === 'general', 'text-gray-400': activeSection !== 'general' }"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <nav class="space-y-1" aria-label="Sidebar">
                                            <button @click="activeSection = 'general'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'general', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'general' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('Informasi Dasar') }}</span>
                                            </button>
                                            <button @click="activeSection = 'landing'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'landing', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'landing' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('Teks Beranda') }}</span>
                                            </button>
                                            <button @click="activeSection = 'promo_cards'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'promo_cards', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'promo_cards' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('Promo Cards') }}</span>
                                            </button>
                                            <button @click="activeSection = 'contact'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'contact', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'contact' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('Kontak & Footer') }}</span>
                                            </button>
                                            <button @click="activeSection = 'pricing'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'pricing', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'pricing' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('Tarif & Biaya') }}</span>
                                            </button>
                                            <button @click="activeSection = 'social'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'social', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'social' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('Sosial Media') }}</span>
                                            </button>
                                            <button @click="activeSection = 'faq'"
                                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'faq', 'text-gray-700 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'faq' }"
                                                class="w-full text-left group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                                <span class="truncate">{{ __('FAQ Data') }}</span>
                                            </button>
                                        </nav>
                        </div>
                    </div>

                    <!-- Right Content Area -->
                    <div class="w-full lg:w-3/4">
                        <form method="POST" action="{{ route('superadmin.settings.update') }}"
                            class="glass-card p-0 overflow-hidden">
                            @csrf

                            <!-- General Settings Section -->
                            <div x-show="activeSection === 'general'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">{{ __('Identitas Dasar Sistem') }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Ganti nama aplikasi yang akan tampil di seluruh header, email, dan struk PDF.') }}
                                    </p>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label for="app_name"
                                            class="block text-sm font-bold text-gray-700 mb-2">{{ __('Nama Aplikasi Utama') }}</label>
                                        <div class="relative rounded-xl shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                            </div>
                                            <input type="text" name="app_name" id="app_name"
                                                value="{{ old('app_name', $settings['app_name'] ?? '') }}"
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3"
                                                placeholder="Contoh: TitipBarang Pro">
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">
                                            {{ __('Nama ini akan menggantikan \'Laravel\' atau \'PenitipanApp\' secara global (White-label).') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Landing Page Section -->
                            <div x-show="activeSection === 'landing'" x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">{{ __('Kustomisasi Beranda') }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Atur pesan penyambutan yang dilihat tamu sebelum mereka login atau mendaftar.') }}
                                    </p>
                                </div>

                                <div class="space-y-6">
                                    <div x-data="{ langTab: 'id' }">
                                        <div class="flex border-b border-gray-200 mb-4">
                                            <button type="button" @click="langTab = 'id'"
                                                :class="{ 'border-indigo-500 text-indigo-600': langTab === 'id', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': langTab !== 'id' }"
                                                class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">Indonesia</button>
                                            <button type="button" @click="langTab = 'en'"
                                                :class="{ 'border-indigo-500 text-indigo-600': langTab === 'en', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': langTab !== 'en' }"
                                                class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">English</button>
                                            <button type="button" @click="langTab = 'ja'"
                                                :class="{ 'border-indigo-500 text-indigo-600': langTab === 'ja', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': langTab !== 'ja' }"
                                                class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">日本語</button>
                                        </div>

                                        <div x-show="langTab === 'id'">
                                            <div class="mb-4">
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-2">{{ __('Judul Utama (ID)') }}</label>
                                                <input type="text" name="hero_title[id]"
                                                    value="{{ old('hero_title.id', $parsedSettings['hero_title']['id'] ?? ($settings['hero_title'] ?? '')) }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 font-bold text-lg">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-2">{{ __('Sub-judul (ID)') }}</label>
                                                <textarea name="hero_description[id]" rows="4"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('hero_description.id', $parsedSettings['hero_description']['id'] ?? ($settings['hero_description'] ?? '')) }}</textarea>
                                            </div>
                                        </div>

                                        <div x-show="langTab === 'en'" style="display: none;">
                                            <div class="mb-4">
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-2">{{ __('Judul Utama (EN)') }}</label>
                                                <input type="text" name="hero_title[en]"
                                                    value="{{ old('hero_title.en', $parsedSettings['hero_title']['en'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 font-bold text-lg">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-2">{{ __('Sub-judul (EN)') }}</label>
                                                <textarea name="hero_description[en]" rows="4"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('hero_description.en', $parsedSettings['hero_description']['en'] ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div x-show="langTab === 'ja'" style="display: none;">
                                            <div class="mb-4">
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-2">{{ __('Judul Utama (JA)') }}</label>
                                                <input type="text" name="hero_title[ja]"
                                                    value="{{ old('hero_title.ja', $parsedSettings['hero_title']['ja'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 font-bold text-lg">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-2">{{ __('Sub-judul (JA)') }}</label>
                                                <textarea name="hero_description[ja]" rows="4"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('hero_description.ja', $parsedSettings['hero_description']['ja'] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">
                                            {{ __('Gunakan kalimat yang meyakinkan pelanggan dalam masing-masing bahasa.') }}
                                        </p>
                                    </div>

                                    <div class="pt-4 border-t border-gray-100 mt-6" x-data="{ promoLang: 'id' }">
                                        <h4 class="font-bold text-gray-900 mb-2">{{ __('Teks Promo Global') }}</h4>
                                        <div class="flex border-b border-gray-200 mb-4">
                                            <button type="button" @click="promoLang = 'id'"
                                                :class="{ 'border-amber-500 text-amber-600': promoLang === 'id', 'border-transparent text-gray-500 hover:text-gray-700': promoLang !== 'id' }"
                                                class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">Indonesia</button>
                                            <button type="button" @click="promoLang = 'en'"
                                                :class="{ 'border-amber-500 text-amber-600': promoLang === 'en', 'border-transparent text-gray-500 hover:text-gray-700': promoLang !== 'en' }"
                                                class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">English</button>
                                            <button type="button" @click="promoLang = 'ja'"
                                                :class="{ 'border-amber-500 text-amber-600': promoLang === 'ja', 'border-transparent text-gray-500 hover:text-gray-700': promoLang !== 'ja' }"
                                                class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">日本語</button>
                                        </div>

                                        <div x-show="promoLang === 'id'" class="relative rounded-xl shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" name="promo_text[id]"
                                                value="{{ old('promo_text.id', $parsedSettings['promo_text']['id'] ?? ($settings['promo_text'] ?? '')) }}"
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-amber-500 focus:ring-amber-500 bg-amber-50/50 py-3 font-bold text-gray-800"
                                                placeholder="Contoh: Promo Spesial: Diskon 20% Penitipan Mingguan!">
                                        </div>
                                        <div x-show="promoLang === 'en'" style="display: none;"
                                            class="relative rounded-xl shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" name="promo_text[en]"
                                                value="{{ old('promo_text.en', $parsedSettings['promo_text']['en'] ?? '') }}"
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-amber-500 focus:ring-amber-500 bg-amber-50/50 py-3 font-bold text-gray-800"
                                                placeholder="Example: Special Promo: 20% Off Weekly Storage!">
                                        </div>
                                        <div x-show="promoLang === 'ja'" style="display: none;"
                                            class="relative rounded-xl shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" name="promo_text[ja]"
                                                value="{{ old('promo_text.ja', $parsedSettings['promo_text']['ja'] ?? '') }}"
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-amber-500 focus:ring-amber-500 bg-amber-50/50 py-3 font-bold text-gray-800"
                                                placeholder="例: 特別プロモーション: 毎週の保管料が 20% オフ!">
                                        </div>

                                        <p class="mt-2 text-xs text-gray-500">
                                            {{ __('Teks ini akan muncul sebagai banner atau pengumuman di landing page.') }}
                                        </p>
                                    </div>

                                    <div class="pt-6 mt-6 border-t border-gray-100" x-data="{ priceLang: 'id' }">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="font-bold text-gray-900">{{ __('Teks Bagian Harga (Pricing)') }}
                                            </h4>
                                            <div
                                                class="flex border border-gray-200 rounded-lg overflow-hidden shrink-0">
                                                <button type="button" @click="priceLang = 'id'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': priceLang === 'id', 'bg-white text-gray-500': priceLang !== 'id' }"
                                                    class="px-3 py-1 text-xs font-bold">ID</button>
                                                <button type="button" @click="priceLang = 'en'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': priceLang === 'en', 'bg-white text-gray-500 border-l': priceLang !== 'en' }"
                                                    class="px-3 py-1 text-xs font-bold border-gray-200">EN</button>
                                                <button type="button" @click="priceLang = 'ja'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': priceLang === 'ja', 'bg-white text-gray-500 border-l': priceLang !== 'ja' }"
                                                    class="px-3 py-1 text-xs font-bold border-gray-200">JA</button>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Judul Bagian Harga') }}</label>
                                                <input x-show="priceLang === 'id'" type="text"
                                                    name="welcome_pricing_title[id]"
                                                    value="{{ old('welcome_pricing_title.id', $parsedSettings['welcome_pricing_title']['id'] ?? ($settings['welcome_pricing_title'] ?? '')) }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="priceLang === 'en'" style="display: none;" type="text"
                                                    name="welcome_pricing_title[en]"
                                                    value="{{ old('welcome_pricing_title.en', $parsedSettings['welcome_pricing_title']['en'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="priceLang === 'ja'" style="display: none;" type="text"
                                                    name="welcome_pricing_title[ja]"
                                                    value="{{ old('welcome_pricing_title.ja', $parsedSettings['welcome_pricing_title']['ja'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Sub-judul Bagian Harga') }}</label>
                                                <textarea x-show="priceLang === 'id'"
                                                    name="welcome_pricing_subtitle[id]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_pricing_subtitle.id', $parsedSettings['welcome_pricing_subtitle']['id'] ?? ($settings['welcome_pricing_subtitle'] ?? '')) }}</textarea>
                                                <textarea x-show="priceLang === 'en'" style="display: none;"
                                                    name="welcome_pricing_subtitle[en]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_pricing_subtitle.en', $parsedSettings['welcome_pricing_subtitle']['en'] ?? '') }}</textarea>
                                                <textarea x-show="priceLang === 'ja'" style="display: none;"
                                                    name="welcome_pricing_subtitle[ja]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_pricing_subtitle.ja', $parsedSettings['welcome_pricing_subtitle']['ja'] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-6 mt-6 border-t border-gray-100" x-data="{ locLang: 'id' }">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="font-bold text-gray-900">{{ __('Teks Bagian Lokasi') }}</h4>
                                            <div
                                                class="flex border border-gray-200 rounded-lg overflow-hidden shrink-0">
                                                <button type="button" @click="locLang = 'id'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': locLang === 'id', 'bg-white text-gray-500': locLang !== 'id' }"
                                                    class="px-3 py-1 text-xs font-bold">ID</button>
                                                <button type="button" @click="locLang = 'en'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': locLang === 'en', 'bg-white text-gray-500 border-l': locLang !== 'en' }"
                                                    class="px-3 py-1 text-xs font-bold border-gray-200">EN</button>
                                                <button type="button" @click="locLang = 'ja'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': locLang === 'ja', 'bg-white text-gray-500 border-l': locLang !== 'ja' }"
                                                    class="px-3 py-1 text-xs font-bold border-gray-200">JA</button>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Judul Lokasi') }}</label>
                                                <input x-show="locLang === 'id'" type="text"
                                                    name="welcome_location_title[id]"
                                                    value="{{ old('welcome_location_title.id', $parsedSettings['welcome_location_title']['id'] ?? ($settings['welcome_location_title'] ?? '')) }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="locLang === 'en'" style="display: none;" type="text"
                                                    name="welcome_location_title[en]"
                                                    value="{{ old('welcome_location_title.en', $parsedSettings['welcome_location_title']['en'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="locLang === 'ja'" style="display: none;" type="text"
                                                    name="welcome_location_title[ja]"
                                                    value="{{ old('welcome_location_title.ja', $parsedSettings['welcome_location_title']['ja'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Sub-judul Lokasi') }}</label>
                                                <textarea x-show="locLang === 'id'" name="welcome_location_subtitle[id]"
                                                    rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_location_subtitle.id', $parsedSettings['welcome_location_subtitle']['id'] ?? ($settings['welcome_location_subtitle'] ?? '')) }}</textarea>
                                                <textarea x-show="locLang === 'en'" style="display: none;"
                                                    name="welcome_location_subtitle[en]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_location_subtitle.en', $parsedSettings['welcome_location_subtitle']['en'] ?? '') }}</textarea>
                                                <textarea x-show="locLang === 'ja'" style="display: none;"
                                                    name="welcome_location_subtitle[ja]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_location_subtitle.ja', $parsedSettings['welcome_location_subtitle']['ja'] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-6 mt-6 border-t border-gray-100" x-data="{ faqLang: 'id' }">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="font-bold text-gray-900">{{ __('Teks Bagian FAQ & Footer') }}
                                            </h4>
                                            <div
                                                class="flex border border-gray-200 rounded-lg overflow-hidden shrink-0">
                                                <button type="button" @click="faqLang = 'id'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': faqLang === 'id', 'bg-white text-gray-500': faqLang !== 'id' }"
                                                    class="px-3 py-1 text-xs font-bold">ID</button>
                                                <button type="button" @click="faqLang = 'en'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': faqLang === 'en', 'bg-white text-gray-500 border-l': faqLang !== 'en' }"
                                                    class="px-3 py-1 text-xs font-bold border-gray-200">EN</button>
                                                <button type="button" @click="faqLang = 'ja'"
                                                    :class="{ 'bg-indigo-50 text-indigo-700': faqLang === 'ja', 'bg-white text-gray-500 border-l': faqLang !== 'ja' }"
                                                    class="px-3 py-1 text-xs font-bold border-gray-200">JA</button>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Judul FAQ') }}</label>
                                                <input x-show="faqLang === 'id'" type="text"
                                                    name="welcome_faq_title[id]"
                                                    value="{{ old('welcome_faq_title.id', $parsedSettings['welcome_faq_title']['id'] ?? ($settings['welcome_faq_title'] ?? '')) }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="faqLang === 'en'" style="display: none;" type="text"
                                                    name="welcome_faq_title[en]"
                                                    value="{{ old('welcome_faq_title.en', $parsedSettings['welcome_faq_title']['en'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="faqLang === 'ja'" style="display: none;" type="text"
                                                    name="welcome_faq_title[ja]"
                                                    value="{{ old('welcome_faq_title.ja', $parsedSettings['welcome_faq_title']['ja'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Sub-judul FAQ') }}</label>
                                                <textarea x-show="faqLang === 'id'" name="welcome_faq_subtitle[id]"
                                                    rows="2"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_faq_subtitle.id', $parsedSettings['welcome_faq_subtitle']['id'] ?? ($settings['welcome_faq_subtitle'] ?? '')) }}</textarea>
                                                <textarea x-show="faqLang === 'en'" style="display: none;"
                                                    name="welcome_faq_subtitle[en]" rows="2"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_faq_subtitle.en', $parsedSettings['welcome_faq_subtitle']['en'] ?? '') }}</textarea>
                                                <textarea x-show="faqLang === 'ja'" style="display: none;"
                                                    name="welcome_faq_subtitle[ja]" rows="2"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_faq_subtitle.ja', $parsedSettings['welcome_faq_subtitle']['ja'] ?? '') }}</textarea>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Judul Ajakan (Call to Action)') }}</label>
                                                <input x-show="faqLang === 'id'" type="text"
                                                    name="welcome_prefooter_title[id]"
                                                    value="{{ old('welcome_prefooter_title.id', $parsedSettings['welcome_prefooter_title']['id'] ?? ($settings['welcome_prefooter_title'] ?? '')) }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="faqLang === 'en'" style="display: none;" type="text"
                                                    name="welcome_prefooter_title[en]"
                                                    value="{{ old('welcome_prefooter_title.en', $parsedSettings['welcome_prefooter_title']['en'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                                <input x-show="faqLang === 'ja'" style="display: none;" type="text"
                                                    name="welcome_prefooter_title[ja]"
                                                    value="{{ old('welcome_prefooter_title.ja', $parsedSettings['welcome_prefooter_title']['ja'] ?? '') }}"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-bold text-gray-700 mb-1">{{ __('Sub-judul Ajakan') }}</label>
                                                <textarea x-show="faqLang === 'id'"
                                                    name="welcome_prefooter_subtitle[id]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_prefooter_subtitle.id', $parsedSettings['welcome_prefooter_subtitle']['id'] ?? ($settings['welcome_prefooter_subtitle'] ?? '')) }}</textarea>
                                                <textarea x-show="faqLang === 'en'" style="display: none;"
                                                    name="welcome_prefooter_subtitle[en]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_prefooter_subtitle.en', $parsedSettings['welcome_prefooter_subtitle']['en'] ?? '') }}</textarea>
                                                <textarea x-show="faqLang === 'ja'" style="display: none;"
                                                    name="welcome_prefooter_subtitle[ja]" rows="3"
                                                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('welcome_prefooter_subtitle.ja', $parsedSettings['welcome_prefooter_subtitle']['ja'] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Promo Cards Section -->
                            <div x-show="activeSection === 'promo_cards'" x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">
                                        {{ __('Pengaturan Promo Cards (Fitur Utama)') }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Sesuaikan 3 kartu fitur/promo yang tampil di bawah Hero Section.') }}
                                    </p>
                                </div>

                                @php
                                    $promoCards = $parsedSettings['promo_cards'] ?? [];
                                    if (!is_array($promoCards))
                                        $promoCards = [];
                                @endphp

                                <div class="space-y-8" x-data="{ cardLang: 'id' }">
                                    <div class="flex border-b border-gray-200 mb-4">
                                        <button type="button" @click="cardLang = 'id'"
                                            :class="{ 'border-indigo-500 text-indigo-600': cardLang === 'id', 'border-transparent text-gray-500 hover:text-gray-700': cardLang !== 'id' }"
                                            class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">Indonesia</button>
                                        <button type="button" @click="cardLang = 'en'"
                                            :class="{ 'border-indigo-500 text-indigo-600': cardLang === 'en', 'border-transparent text-gray-500 hover:text-gray-700': cardLang !== 'en' }"
                                            class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">English</button>
                                        <button type="button" @click="cardLang = 'ja'"
                                            :class="{ 'border-indigo-500 text-indigo-600': cardLang === 'ja', 'border-transparent text-gray-500 hover:text-gray-700': cardLang !== 'ja' }"
                                            class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">日本語</button>
                                    </div>

                                    @for($i = 0; $i < 3; $i++)
                                        @php
                                            $card = $promoCards[$i] ?? ['icon' => '', 'title' => [], 'description' => [], 'color_theme' => 'default', 'is_popular' => false];
                                        @endphp
                                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                            <h4 class="font-bold text-lg mb-4 text-gray-800">Card #{{ $i + 1 }}</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="col-span-1 md:col-span-2">
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">SVG Icon
                                                        (HTML)</label>
                                                    <input type="text" name="promo_cards[{{$i}}][icon]"
                                                        value="{{ old("promo_cards.$i.icon", $card['icon'] ?? '') }}"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2 text-sm font-mono text-gray-500 placeholder-gray-400">
                                                </div>

                                                <!-- Title & Description ID -->
                                                <div x-show="cardLang === 'id'" class="col-span-1 md:col-span-2 space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-700 mb-1">Judul
                                                            (ID)</label>
                                                        <input type="text" name="promo_cards[{{$i}}][title][id]"
                                                            value="{{ old("promo_cards.$i.title.id", $card['title']['id'] ?? ($card['title'] ?? '')) }}"
                                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi
                                                            (ID)</label>
                                                        <textarea name="promo_cards[{{$i}}][description][id]" rows="3"
                                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">{{ old("promo_cards.$i.description.id", $card['description']['id'] ?? ($card['description'] ?? '')) }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- Title & Description EN -->
                                                <div x-show="cardLang === 'en'" style="display: none;"
                                                    class="col-span-1 md:col-span-2 space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-700 mb-1">Judul
                                                            (EN)</label>
                                                        <input type="text" name="promo_cards[{{$i}}][title][en]"
                                                            value="{{ old("promo_cards.$i.title.en", $card['title']['en'] ?? '') }}"
                                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi
                                                            (EN)</label>
                                                        <textarea name="promo_cards[{{$i}}][description][en]" rows="3"
                                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">{{ old("promo_cards.$i.description.en", $card['description']['en'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                                <!-- Title & Description JA -->
                                                <div x-show="cardLang === 'ja'" style="display: none;"
                                                    class="col-span-1 md:col-span-2 space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-700 mb-1">Judul
                                                            (JA)</label>
                                                        <input type="text" name="promo_cards[{{$i}}][title][ja]"
                                                            value="{{ old("promo_cards.$i.title.ja", $card['title']['ja'] ?? '') }}"
                                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi
                                                            (JA)</label>
                                                        <textarea name="promo_cards[{{$i}}][description][ja]" rows="3"
                                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">{{ old("promo_cards.$i.description.ja", $card['description']['ja'] ?? '') }}</textarea>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Color
                                                        Theme</label>
                                                    <select name="promo_cards[{{$i}}][color_theme]"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                        <option value="default" {{ ($card['color_theme'] ?? '') == 'default' ? 'selected' : '' }}>Default (Gray/Indigo)</option>
                                                        <option value="emerald" {{ ($card['color_theme'] ?? '') == 'emerald' ? 'selected' : '' }}>Emerald (Green)</option>
                                                        <option value="blue" {{ ($card['color_theme'] ?? '') == 'blue' ? 'selected' : '' }}>Blue</option>
                                                        <option value="amber" {{ ($card['color_theme'] ?? '') == 'amber' ? 'selected' : '' }}>Amber (Orange/Yellow)</option>
                                                    </select>
                                                </div>
                                                <div class="flex items-end pb-2">
                                                    <label class="inline-flex items-center cursor-pointer">
                                                        <!-- Hidden input for un-checked state -->
                                                        <input type="hidden" name="promo_cards[{{$i}}][is_popular]"
                                                            value="false">
                                                        <input type="checkbox" name="promo_cards[{{$i}}][is_popular]"
                                                            value="true"
                                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                            {{ ($card['is_popular'] ?? false) == 'true' || ($card['is_popular'] ?? false) === true ? 'checked' : '' }}>
                                                        <span class="ml-2 text-sm text-gray-600 font-medium">Tandai sebagai
                                                            "Populer/Highlight"</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <!-- Contact & Footer Section -->
                            <div x-show="activeSection === 'contact'" x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">{{ __('Informasi Kontak & Footer') }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Kontak ini akan ditampilkan di halaman depan dan cetakan Struk PDF.') }}
                                    </p>
                                </div>

                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="md:col-span-2">
                                            <label for="contact_address"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Alamat Lengkap Kantor/Lokasi Penitipan') }}</label>
                                            <textarea name="contact_address" id="contact_address" rows="3"
                                                class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                                        </div>

                                        <div>
                                            <label for="contact_phone"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Nomor Telepon / WhatsApp') }}</label>
                                            <div class="relative rounded-xl shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <input type="text" name="contact_phone" id="contact_phone"
                                                    value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                                                    class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-gray-100 mt-6">
                                        <label for="store_map_url"
                                            class="block text-sm font-bold text-gray-700 mb-2">{{ __('URL Embed Google Maps (iframe URL)') }}</label>
                                        <input type="url" name="store_map_url" id="store_map_url"
                                            value="{{ old('store_map_url', $settings['store_map_url'] ?? '') }}"
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 text-sm"
                                            placeholder="https://www.google.com/maps/embed?pb=...">
                                        <p class="mt-2 text-xs text-gray-500">
                                            {{ __('URL src dari iframe Google Maps toko Anda untuk ditampilkan di halaman depan.') }}
                                        </p>
                                    </div>

                                    <div class="pt-4 border-t border-gray-100 mt-6">
                                        <label for="footer_text"
                                            class="block text-sm font-bold text-gray-700 mb-2">{{ __('Hak Cipta Footer') }}</label>
                                        <input type="text" name="footer_text" id="footer_text"
                                            value="{{ old('footer_text', $settings['footer_text'] ?? '') }}"
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 text-sm"
                                            placeholder="© 2026 Hak Cipta Dilindungi">
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div x-show="activeSection === 'pricing'" x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">{{ __('Pengaturan Tarif Penitipan') }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Tentukan biaya dasar untuk hitungan jam, hari, dan modifier untuk jenis barang tertentu.') }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <h4 class="font-bold text-gray-900 border-b pb-2">
                                            {{ __('Biaya Dasar (Base Rates)') }}
                                        </h4>

                                        <div>
                                            <label for="price_per_hour"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Tarif Per Jam (IDR)') }}</label>
                                            <div class="relative rounded-xl shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                                </div>
                                                <input type="number" name="price_per_hour" id="price_per_hour"
                                                    value="{{ old('price_per_hour', $settings['price_per_hour'] ?? '0') }}"
                                                    class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="price_per_day"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Tarif Per Hari (IDR)') }}</label>
                                            <div class="relative rounded-xl shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                                </div>
                                                <input type="number" name="price_per_day" id="price_per_day"
                                                    value="{{ old('price_per_day', $settings['price_per_day'] ?? '0') }}"
                                                    class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <h4 class="font-bold text-gray-900 border-b pb-2">
                                            {{ __('Pengali Jenis Barang (Multipliers)') }}
                                        </h4>

                                        <div>
                                            <label for="multiplier_electronics"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Pengali Elektronik') }}</label>
                                            <input type="number" step="0.1" name="multiplier_electronics"
                                                id="multiplier_electronics"
                                                value="{{ old('multiplier_electronics', $settings['multiplier_electronics'] ?? '1.0') }}"
                                                class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ __('Contoh: 1.5 berarti biaya total akan dikali 1.5 jika barang adalah Elektronik.') }}
                                            </p>
                                        </div>

                                        <div>
                                            <label for="multiplier_others"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Pengali Lainnya / Umum') }}</label>
                                            <input type="number" step="0.1" name="multiplier_others"
                                                id="multiplier_others"
                                                value="{{ old('multiplier_others', $settings['multiplier_others'] ?? '1.0') }}"
                                                class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-6 mt-8 border-t border-gray-100">
                                    <h4 class="font-bold text-gray-900 mb-4">
                                        {{ __('Tarif Paket (Ditampilkan di Landing Page)') }}
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <label for="price_daily"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Paket Harian (IDR)') }}</label>
                                            <input type="number" name="price_daily" id="price_daily"
                                                value="{{ old('price_daily', $settings['price_daily'] ?? '15000') }}"
                                                class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                        <div>
                                            <label for="price_weekly"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Paket Mingguan (IDR)') }}</label>
                                            <input type="number" name="price_weekly" id="price_weekly"
                                                value="{{ old('price_weekly', $settings['price_weekly'] ?? '50000') }}"
                                                class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                        <div>
                                            <label for="price_monthly"
                                                class="block text-sm font-bold text-gray-700 mb-2">{{ __('Paket Bulanan (IDR)') }}</label>
                                            <input type="number" name="price_monthly" id="price_monthly"
                                                value="{{ old('price_monthly', $settings['price_monthly'] ?? '150000') }}"
                                                class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media Section -->
                            <div x-show="activeSection === 'social'" x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">{{ __('Sosial Media') }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Tautan sosial media untuk ditampilkan di bagian footer landing page.') }}
                                    </p>
                                </div>
                                <div class="space-y-6">
                                    <div>
                                        <label for="social_facebook"
                                            class="block text-sm font-bold text-gray-700 mb-2">Facebook URL</label>
                                        <input type="url" name="social_facebook" id="social_facebook"
                                            value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                    </div>
                                    <div>
                                        <label for="social_instagram"
                                            class="block text-sm font-bold text-gray-700 mb-2">Instagram URL</label>
                                        <input type="url" name="social_instagram" id="social_instagram"
                                            value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                    </div>
                                    <div>
                                        <label for="social_twitter"
                                            class="block text-sm font-bold text-gray-700 mb-2">Twitter/X URL</label>
                                        <input type="url" name="social_twitter" id="social_twitter"
                                            value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Array Section -->
                            <div x-show="activeSection === 'faq'" x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-xl font-black text-gray-900">
                                        {{ __('Manajemen FAQ (Pertanyaan Umum)') }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ __('Kelola daftar pertanyaan yang sering diajukan di landing page. Mendukung 3 bahasa.') }}
                                    </p>
                                </div>

                                @php
                                    $faqItems = $parsedSettings['faq_data'] ?? [];
                                    if (!is_array($faqItems) || empty($faqItems)) {
                                        $faqItems = array_fill(0, 4, [
                                            'question' => ['id' => '', 'en' => '', 'ja' => ''],
                                            'answer' => ['id' => '', 'en' => '', 'ja' => '']
                                        ]);
                                    }
                                    while (count($faqItems) < 5) {
                                        $faqItems[] = [
                                            'question' => ['id' => '', 'en' => '', 'ja' => ''],
                                            'answer' => ['id' => '', 'en' => '', 'ja' => '']
                                        ];
                                    }
                                @endphp

                                <div class="space-y-8" x-data="{ faqLang: 'id' }">
                                    <div class="flex border-b border-gray-200 mb-4">
                                        <button type="button" @click="faqLang = 'id'"
                                            :class="{'border-indigo-500 text-indigo-600': faqLang === 'id', 'border-transparent text-gray-500 hover:text-gray-700': faqLang !== 'id'}"
                                            class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">Indonesia</button>
                                        <button type="button" @click="faqLang = 'en'"
                                            :class="{'border-indigo-500 text-indigo-600': faqLang === 'en', 'border-transparent text-gray-500 hover:text-gray-700': faqLang !== 'en'}"
                                            class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">English</button>
                                        <button type="button" @click="faqLang = 'ja'"
                                            :class="{'border-indigo-500 text-indigo-600': faqLang === 'ja', 'border-transparent text-gray-500 hover:text-gray-700': faqLang !== 'ja'}"
                                            class="w-1/3 py-2 px-1 text-center border-b-2 font-medium text-sm">日本語</button>
                                    </div>

                                    <p
                                        class="text-xs text-amber-600 bg-amber-50 p-3 rounded-lg border border-amber-200 font-medium mb-6">
                                        Kosongkan kolom "Pertanyaan (ID)" jika Anda tidak ingin menampilkan item FAQ
                                        tersebut (akan disembunyikan).</p>

                                    @for($i = 0; $i < 5; $i++)
                                        @php
                                            $item = $faqItems[$i] ?? ['question' => [], 'answer' => []];
                                        @endphp
                                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 relative">
                                            <h4 class="font-bold text-lg mb-4 text-gray-800">FAQ Item #{{ $i + 1 }}</h4>

                                            <div x-show="faqLang === 'id'" class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Pertanyaan
                                                        (ID)</label>
                                                    <input type="text" name="faq_data[{{$i}}][question][id]"
                                                        value="{{ old("faq_data.$i.question.id", $item['question']['id'] ?? '') }}"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Jawaban
                                                        (ID)</label>
                                                    <textarea name="faq_data[{{$i}}][answer][id]" rows="3"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">{{ old("faq_data.$i.answer.id", $item['answer']['id'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <div x-show="faqLang === 'en'" style="display:none;" class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Question
                                                        (EN)</label>
                                                    <input type="text" name="faq_data[{{$i}}][question][en]"
                                                        value="{{ old("faq_data.$i.question.en", $item['question']['en'] ?? '') }}"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Answer
                                                        (EN)</label>
                                                    <textarea name="faq_data[{{$i}}][answer][en]" rows="3"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">{{ old("faq_data.$i.answer.en", $item['answer']['en'] ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <div x-show="faqLang === 'ja'" style="display:none;" class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Question
                                                        (JA)</label>
                                                    <input type="text" name="faq_data[{{$i}}][question][ja]"
                                                        value="{{ old("faq_data.$i.question.ja", $item['question']['ja'] ?? '') }}"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-700 mb-1">Answer
                                                        (JA)</label>
                                                    <textarea name="faq_data[{{$i}}][answer][ja]" rows="3"
                                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2">{{ old("faq_data.$i.answer.ja", $item['answer']['ja'] ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <!-- Sticky Submit Footer -->
                            <div
                                class="bg-gray-50/80 backdrop-blur-md border-t border-gray-200 px-8 py-5 flex items-center justify-between">
                                <p class="text-sm text-gray-500">
                                    {{ __('Semua perubahan log akan disimpan ke dalam riwayat sistem.') }}
                                </p>
                                <button type="submit"
                                    class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors hover:scale-105 transform">
                                    {{ __('Simpan Perubahan') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-superadmin-layout>