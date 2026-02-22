<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}"
                class="p-2 bg-white rounded-full shadow hover:shadow-md transition text-gray-500 hover:text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Titip Barang Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white/80 backdrop-blur-xl shadow-2xl sm:rounded-[2rem] border border-white/60 overflow-hidden">
                <div class="p-8 md:p-12">
                    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column: Basic Info -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">
                                    {{ __('Informasi Utama') }}
                                </h3>

                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" class="font-bold text-gray-700">Nama Barang <span
                                            class="text-red-500">*</span></x-input-label>
                                    <div class="mt-2 relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" name="name" id="name"
                                            class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200 @error('name') border-red-500 @enderror"
                                            placeholder="{{ __('Contoh: Koper Hitam Polo') }}" value="{{ old('name') }}"
                                            required autofocus>
                                    </div>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Item Type (Category) -->
                                <div>
                                    <x-input-label for="item_type"
                                        class="font-bold text-gray-700">{{ __('Jenis Barang') }}</x-input-label>
                                    <div class="mt-2 relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                        </div>
                                        <select name="item_type" id="item_type" onchange="calculateCost()"
                                            class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200">
                                            <option value="" disabled selected>{{ __('Pilih Kategori (Opsional)') }}
                                            </option>
                                            <option value="Tas/Koper" {{ old('item_type') == 'Tas/Koper' ? 'selected' : '' }}>{{ __('Tas / Koper') }}</option>
                                            <option value="Elektronik" {{ old('item_type') == 'Elektronik' ? 'selected' : '' }}>{{ __('Elektronik (Laptop, dll)') }}</option>
                                            <option value="Dokumen" {{ old('item_type') == 'Dokumen' ? 'selected' : '' }}>
                                                {{ __('Dokumen Penting') }}
                                            </option>
                                            <option value="Lainnya" {{ old('item_type') == 'Lainnya' ? 'selected' : '' }}>
                                                {{ __('Lainnya') }}
                                            </option>
                                        </select>
                                    </div>
                                    @error('item_type')
                                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Brand -->
                                <div>
                                    <x-input-label for="brand"
                                        class="font-bold text-gray-700">{{ __('Merek / Brand') }}</x-input-label>
                                    <div class="mt-2 relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" name="brand" id="brand"
                                            class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                            placeholder="{{ __('Contoh: Polo, Samsung, dll') }}"
                                            value="{{ old('brand') }}">
                                    </div>
                                    @error('brand')
                                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Color -->
                                <div>
                                    <x-input-label for="color"
                                        class="font-bold text-gray-700">{{ __('Warna') }}</x-input-label>
                                    <div class="mt-2 relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" name="color" id="color"
                                            class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                            placeholder="{{ __('Contoh: Hitam, Biru, dll') }}"
                                            value="{{ old('color') }}">
                                    </div>
                                    @error('color')
                                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Estimated Value -->
                                <div>
                                    <x-input-label for="estimated_value"
                                        class="font-bold text-gray-700">{{ __('Estimasi Nilai Barang (Rp)') }}</x-input-label>
                                    <div class="mt-2 relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <span class="text-gray-500 font-bold">Rp</span>
                                        </div>
                                        <input type="number" name="estimated_value" id="estimated_value" min="0"
                                            class="pl-12 block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                            placeholder="0" value="{{ old('estimated_value') }}">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ __('Opsional, berguna untuk asuransi atau pengawasan ekstra.') }}
                                    </p>
                                    @error('estimated_value')
                                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right Column: Details & Photo -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">
                                    {{ __('Detail Tambahan') }}
                                </h3>

                                <!-- Description -->
                                <div>
                                    <x-input-label for="description" class="font-bold text-gray-700">Keterangan
                                        Umum</x-input-label>
                                    <div class="mt-2">
                                        <textarea id="description" name="description" rows="2"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-200 transition duration-200"
                                            placeholder="{{ __('Deskripsi singkat barang...') }}">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <!-- Characteristics -->
                                <div>
                                    <x-input-label for="characteristics"
                                        class="font-bold text-gray-700">{{ __('Ciri-ciri Khusus') }}</x-input-label>
                                    <div class="mt-2">
                                        <textarea id="characteristics" name="characteristics" rows="2"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                            placeholder="{{ __('Misal: Ada lecet di ujung kanan, ritsleting lepas, dll...') }}">{{ old('characteristics') }}</textarea>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div>
                                    <x-input-label for="notes"
                                        class="font-bold text-gray-700">{{ __('Catatan untuk Petugas') }}</x-input-label>
                                    <div class="mt-2">
                                        <textarea id="notes" name="notes" rows="2"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition duration-200"
                                            placeholder="{{ __('Misal: \'Barang pecah belah\', \'Jangan ditumpuk\'') }}">{{ old('notes') }}</textarea>
                                    </div>
                                </div>

                                <!-- Estimation Section -->
                                <div class="bg-blue-50/50 p-6 rounded-3xl border border-blue-100 space-y-4">
                                    <h3
                                        class="text-md font-black text-blue-900 border-b border-blue-200 pb-2 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('Estimasi & Biaya') }}
                                    </h3>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <x-input-label for="duration_type"
                                                class="font-bold text-gray-700">{{ __('Rentang') }}</x-input-label>
                                            <select name="duration_type" id="duration_type" onchange="calculateCost()"
                                                class="mt-2 block w-full rounded-xl border-gray-200 bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                                                <option value="hours" {{ old('duration_type') == 'hours' ? 'selected' : '' }}>{{ __('Jam') }}</option>
                                                <option value="days" {{ old('duration_type') == 'days' ? 'selected' : '' }}>{{ __('Hari') }}</option>
                                            </select>
                                        </div>
                                        <div>
                                            <x-input-label for="duration_value"
                                                class="font-bold text-gray-700">{{ __('Durasi') }}</x-input-label>
                                            <input type="number" name="duration_value" id="duration_value" min="1"
                                                value="{{ old('duration_value', 1) }}" oninput="calculateCost()"
                                                class="mt-2 block w-full rounded-xl border-gray-200 bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <p class="text-xs text-blue-600 font-medium mb-1">
                                            {{ __('Total Estimasi Biaya:') }}</p>
                                        <div class="text-3xl font-black text-blue-700" id="cost_display">
                                            Rp 0
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1 italic leading-tight">
                                            * {{ __('Biaya akhir mungkin berbeda saat pengambilan barang.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Upload (Full Width) -->
                        <div class="mt-8 pt-8 border-t border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                {{ __('Verifikasi Visual (Bisa lebih dari 1 foto)') }}
                                <span class="text-red-500">*</span>
                            </h3>
                            <div class="relative group cursor-pointer">
                                <input type="file" name="photos[]" id="photos"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                    accept="image/*" multiple required onchange="previewImages(event)">
                                <div id="dropzone-ui"
                                    class="p-8 border-2 border-dashed border-gray-300 rounded-3xl bg-gray-50 flex flex-col items-center justify-center gap-4 group-hover:bg-blue-50 group-hover:border-blue-400 transition duration-300 text-center relative overflow-hidden min-h-[16rem]">

                                    <div id="upload-state"
                                        class="flex flex-col items-center justify-center pointer-events-none">
                                        <div id="upload-icon"
                                            class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div id="upload-text">
                                            <p class="font-bold text-gray-700 group-hover:text-blue-600">
                                                {{ __('Klik untuk upload foto barang (Max 5)') }}
                                            </p>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ __('PNG, JPG, JPEG (Max. 2MB per foto)') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div id="image-preview-container"
                                        class="hidden absolute inset-0 w-full h-full bg-gray-100 flex overflow-x-auto gap-2 p-4 items-center snap-x z-20 pointer-events-none">
                                        <!-- Images will be injected here -->
                                    </div>
                                </div>
                            </div>
                            @error('photos')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit"
                                class="w-full py-4 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 rounded-2xl text-white font-black text-lg shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition duration-300 transform flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Simpan Data Penitipan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to preview image -->
    <script>
        function previewImages(event) {
            const input = event.target;
            const container = document.getElementById('image-preview-container');
            const uploadState = document.getElementById('upload-state');

            container.innerHTML = ''; // Clear previous

            if (input.files && input.files.length > 0) {
                uploadState.classList.add('hidden');
                container.classList.remove('hidden');

                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-full max-w-[80%] object-cover rounded-xl shadow-md border-4 border-white snap-center shrink-0';
                        container.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                uploadState.classList.remove('hidden');
                container.classList.add('hidden');
            }
        }

        const pricing = {
            hour: {{ $settings['price_per_hour'] ?? 5000 }},
            day: {{ $settings['price_per_day'] ?? 50000 }},
            multiplier: {
                electronics: {{ $settings['multiplier_electronics'] ?? 1.5 }},
                others: {{ $settings['multiplier_others'] ?? 1.0 }}
            }
        };

        function calculateCost() {
            const type = document.getElementById('duration_type').value;
            const value = parseInt(document.getElementById('duration_value').value) || 0;
            const itemType = document.getElementById('item_type').value;

            let basePrice = type === 'hours' ? pricing.hour : pricing.day;
            let multiplier = itemType === 'Elektronik' ? pricing.multiplier.electronics : pricing.multiplier.others;

            let total = basePrice * value * multiplier;

            document.getElementById('cost_display').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        // Run on load
        window.addEventListener('load', calculateCost);
    </script>
</x-app-layout>