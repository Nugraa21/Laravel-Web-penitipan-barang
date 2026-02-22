<x-superadmin-layout>
<div class="bg-gradient-to-r from-indigo-100 via-white to-indigo-100 min-h-screen p-6">

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
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
            
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
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
                                <svg class="mr-3 h-5 w-5" :class="{ 'text-indigo-500': activeSection === 'general', 'text-gray-400': activeSection !== 'general' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ __('Identitas Dasar') }}
                            </button>
                            
                            <button @click="activeSection = 'landing'"
                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'landing', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'landing' }"
                                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-colors">
                                <svg class="mr-3 h-5 w-5" :class="{ 'text-indigo-500': activeSection === 'landing', 'text-gray-400': activeSection !== 'landing' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('Teks Beranda (Landing Page)') }}
                            </button>

                            <button @click="activeSection = 'contact'"
                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'contact', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'contact' }"
                                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-colors">
                                <svg class="mr-3 h-5 w-5" :class="{ 'text-indigo-500': activeSection === 'contact', 'text-gray-400': activeSection !== 'contact' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('Kontak & Footer') }}
                            </button>

                            <button @click="activeSection = 'pricing'"
                                :class="{ 'bg-indigo-50 text-indigo-700': activeSection === 'pricing', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeSection !== 'pricing' }"
                                class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-colors">
                                <svg class="mr-3 h-5 w-5" :class="{ 'text-indigo-500': activeSection === 'pricing', 'text-gray-400': activeSection !== 'pricing' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Tarif & Biaya') }}
                            </button>
                       </nav>
                    </div>
                </div>

                <!-- Right Content Area -->
                <div class="w-full lg:w-3/4">
                    <form method="POST" action="{{ route('superadmin.settings.update') }}" class="glass-card p-0 overflow-hidden">
                        @csrf
                        
                        <!-- General Settings Section -->
                        <div x-show="activeSection === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                            <div class="mb-8">
                                <h3 class="text-xl font-black text-gray-900">{{ __('Identitas Dasar Sistem') }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Ganti nama aplikasi yang akan tampil di seluruh header, email, dan struk PDF.') }}</p>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="app_name" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Nama Aplikasi Utama') }}</label>
                                    <div class="relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </div>
                                        <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $settings['app_name'] ?? '') }}" 
                                            class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3" placeholder="Contoh: TitipBarang Pro">
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">{{ __('Nama ini akan menggantikan \'Laravel\' atau \'PenitipanApp\' secara global (White-label).') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Landing Page Section -->
                        <div x-show="activeSection === 'landing'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                            <div class="mb-8">
                                <h3 class="text-xl font-black text-gray-900">{{ __('Kustomisasi Beranda') }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Atur pesan penyambutan yang dilihat tamu sebelum mereka login atau mendaftar.') }}</p>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="hero_title" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Judul Utama (Headline)') }}</label>
                                    <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" 
                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 font-bold text-lg">
                                </div>

                                <div>
                                    <label for="hero_description" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Sub-judul / Penjelasan Singkat (Subheadline)') }}</label>
                                    <textarea name="hero_description" id="hero_description" rows="4" 
                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('hero_description', $settings['hero_description'] ?? '') }}</textarea>
                                    <p class="mt-2 text-xs text-gray-500">{{ __('Gunakan kalimat yang meyakinkan pelanggan untuk menitipkan barang mereka di tempat Anda.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Footer Section -->
                        <div x-show="activeSection === 'contact'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                            <div class="mb-8">
                                <h3 class="text-xl font-black text-gray-900">{{ __('Informasi Kontak & Footer') }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Kontak ini akan ditampilkan di halaman depan dan cetakan Struk PDF.') }}</p>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label for="contact_address" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Alamat Lengkap Kantor/Lokasi Penitipan') }}</label>
                                        <textarea name="contact_address" id="contact_address" rows="3" 
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                                    </div>

                                    <div>
                                        <label for="contact_phone" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Nomor Telepon / WhatsApp') }}</label>
                                        <div class="relative rounded-xl shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            </div>
                                            <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" 
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-100 mt-6">
                                    <label for="footer_text" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Hak Cipta Footer') }}</label>
                                    <input type="text" name="footer_text" id="footer_text" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" 
                                        class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3 text-sm" placeholder="© 2026 Hak Cipta Dilindungi">
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Section -->
                        <div x-show="activeSection === 'pricing'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="p-8">
                            <div class="mb-8">
                                <h3 class="text-xl font-black text-gray-900">{{ __('Pengaturan Tarif Penitipan') }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Tentukan biaya dasar untuk hitungan jam, hari, dan modifier untuk jenis barang tertentu.') }}</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-6">
                                    <h4 class="font-bold text-gray-900 border-b pb-2">{{ __('Biaya Dasar (Base Rates)') }}</h4>
                                    
                                    <div>
                                        <label for="price_per_hour" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Tarif Per Jam (IDR)') }}</label>
                                        <div class="relative rounded-xl shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="price_per_hour" id="price_per_hour" value="{{ old('price_per_hour', $settings['price_per_hour'] ?? '0') }}" 
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="price_per_day" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Tarif Per Hari (IDR)') }}</label>
                                        <div class="relative rounded-xl shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $settings['price_per_day'] ?? '0') }}" 
                                                class="block w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <h4 class="font-bold text-gray-900 border-b pb-2">{{ __('Pengali Jenis Barang (Multipliers)') }}</h4>
                                    
                                    <div>
                                        <label for="multiplier_electronics" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Pengali Elektronik') }}</label>
                                        <input type="number" step="0.1" name="multiplier_electronics" id="multiplier_electronics" value="{{ old('multiplier_electronics', $settings['multiplier_electronics'] ?? '1.0') }}" 
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                        <p class="mt-1 text-xs text-gray-500">{{ __('Contoh: 1.5 berarti biaya total akan dikali 1.5 jika barang adalah Elektronik.') }}</p>
                                    </div>

                                    <div>
                                        <label for="multiplier_others" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Pengali Lainnya / Umum') }}</label>
                                        <input type="number" step="0.1" name="multiplier_others" id="multiplier_others" value="{{ old('multiplier_others', $settings['multiplier_others'] ?? '1.0') }}" 
                                            class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50 py-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sticky Submit Footer -->
                        <div class="bg-gray-50/80 backdrop-blur-md border-t border-gray-200 px-8 py-5 flex items-center justify-between">
                            <p class="text-sm text-gray-500">{{ __('Semua perubahan log akan disimpan ke dalam riwayat sistem.') }}</p>
                            <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors hover:scale-105 transform">
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
