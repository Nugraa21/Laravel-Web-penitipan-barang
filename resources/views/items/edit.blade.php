<x-app-layout>
    <div class="container py-12 lg:py-16 my-8 max-w-4xl mx-auto">
        <div class="card p-6 border-t border-black rounded-xl">

            <div class="flex items-center gap-4 mb-6 pb-4" style="border-bottom: 1px solid var(--c-gray-100);">
                <a href="{{ route('items.show', $item) }}" class="btn btn-outline"
                    style="padding: 0.5rem; border-radius: 50%;">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 900; color: var(--c-gray-900);">
                        {{ Auth::user()->role === 'admin' ? __('Update Status Barang') : __('Edit Data Barang') }}
                    </h2>
                    <p style="color: var(--c-gray-500); font-size: 0.875rem;">{{ $item->name }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if(Auth::user()->role === 'admin')
                    <!-- ADMIN VIEW: Update Status Only -->
                    <div class="form-group">
                        <label class="form-label">{{ __('Pilih Status Terbaru') }}</label>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <label
                                style="display: flex; align-items: center; padding: 1rem; border: 1px solid var(--c-gray-200); border-radius: var(--radius-xl); cursor: pointer; transition: var(--transition);"
                                onmouseover="this.style.background='var(--c-warning-bg)'"
                                onmouseout="this.style.background='transparent'">
                                <input type="radio" name="status" value="pending" {{ $item->status === 'pending' ? 'checked' : '' }} style="margin-right: 1rem;">
                                <span style="font-weight: 700; color: var(--c-warning-text);">{{ __('Pending') }}</span>
                            </label>

                            <label
                                style="display: flex; align-items: center; padding: 1rem; border: 1px solid var(--c-gray-200); border-radius: var(--radius-xl); cursor: pointer; transition: var(--transition);"
                                onmouseover="this.style.background='var(--c-primary-light)'"
                                onmouseout="this.style.background='transparent'">
                                <input type="radio" name="status" value="stored" {{ $item->status === 'stored' ? 'checked' : '' }} style="margin-right: 1rem;">
                                <span style="font-weight: 700; color: var(--c-primary);">{{ __('Stored / Disimpan') }}</span>
                            </label>

                            <label
                                style="display: flex; align-items: center; padding: 1rem; border: 1px solid var(--c-gray-200); border-radius: var(--radius-xl); cursor: pointer; transition: var(--transition);"
                                onmouseover="this.style.background='var(--c-success-bg)'"
                                onmouseout="this.style.background='transparent'">
                                <input type="radio" name="status" value="retrieved" {{ $item->status === 'retrieved' ? 'checked' : '' }} style="margin-right: 1rem;">
                                <span style="font-weight: 700; color: var(--c-success-text);">{{ __('Retrieved / Diambil') }}</span>
                            </label>
                        </div>
                        @error('status')<p style="color: var(--c-danger); font-size: 0.75rem; margin-top: 0.5rem;">
                            {{ $message }}
                        </p>@enderror
                    </div>
                @else
                    <!-- USER VIEW: Edit Item Data -->
                    @if($errors->has('message'))
                        <div
                            style="background: var(--c-danger-bg); color: var(--c-danger-text); padding: 1rem; border-radius: var(--radius-xl); margin-bottom: 1.5rem; font-weight: 600; font-size: 0.875rem;">
                            {{ $errors->first('message') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Nama Barang') }}</label>
                        <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $item->name) }}"
                            required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label for="item_type" class="form-label">{{ __('Jenis Barang') }}</label>
                            <input type="text" name="item_type" id="item_type" class="form-input"
                                value="{{ old('item_type', $item->item_type) }}">
                        </div>
                        <div class="form-group">
                            <label for="estimated_value" class="form-label">{{ __('Estimasi Nilai (Rp)') }}</label>
                            <input type="number" name="estimated_value" id="estimated_value" class="form-input"
                                value="{{ old('estimated_value', $item->estimated_value) }}">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label for="brand" class="form-label">{{ __('Merek / Brand') }}</label>
                            <input type="text" name="brand" id="brand" class="form-input"
                                value="{{ old('brand', $item->brand) }}">
                        </div>
                        <div class="form-group">
                            <label for="color" class="form-label">{{ __('Warna') }}</label>
                            <input type="text" name="color" id="color" class="form-input"
                                value="{{ old('color', $item->color) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Keterangan Umum') }}</label>
                        <textarea name="description" id="description" class="form-input"
                            rows="2">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="characteristics" class="form-label">{{ __('Ciri-ciri Khusus (Lecet, dll)') }}</label>
                        <textarea name="characteristics" id="characteristics" class="form-input"
                            rows="2">{{ old('characteristics', $item->characteristics) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="form-label">{{ __('Catatan Tambahan (Opsional)') }}</label>
                        <textarea name="notes" id="notes" class="form-input"
                            rows="2">{{ old('notes', $item->notes) }}</textarea>
                    </div>

                    @if($item->photos->count() > 0)
                    <div class="form-group mb-4">
                        <label class="form-label">{{ __('Foto Barang Saat Ini') }}</label>
                        <div class="flex gap-4 overflow-x-auto pb-4">
                            @foreach($item->photos as $photo)
                                <div class="relative shrink-0 w-32 h-32 rounded-xl overflow-hidden border-2 border-gray-200 shadow-sm group">
                                    <img src="{{ Storage::url($photo->photo_path) }}" class="w-full h-full object-cover zoomable-image cursor-zoom-in" onclick="openLightbox(this.src)">
                                    
                                    @if($item->photos->count() > 1)
                                    <button type="button" onclick="deleteStoredPhoto({{ $photo->id }})" class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-full shadow-md hover:bg-red-600 transition-all opacity-0 group-hover:opacity-100 z-10">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                    @endif
                                    
                                    @if($item->photo_path === $photo->photo_path)
                                    <span class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-[10px] uppercase font-bold text-center py-1">Main Photo</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="form-group mb-4">
                        <label for="photos" class="form-label">{{ __('Tambah Foto Baru (Opsional)') }}</label>
                        <p class="text-xs text-gray-500 mb-2">{{ __('Pilih file untuk menambah foto barang (Total max 5 foto gabungan).') }}</p>
                        <div class="relative group cursor-pointer h-48 border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 flex flex-col items-center justify-center transition-all overflow-hidden"
                            id="dropzone-edit">
                            <input type="file" name="photos[]" id="photos"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*"
                                multiple onchange="previewImagesEdit(event)">

                            <div id="upload-state-edit"
                                class="flex flex-col items-center justify-center pointer-events-none">
                                <svg style="width: 40px; height: 40px; margin: 0 auto; color: var(--c-primary);" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p style="margin-top: 1rem; font-weight: 700; color: var(--c-gray-900);">{{ __('Klik untuk memperbarui foto (bisa >1)') }}</p>
                                <p style="font-size: 0.75rem; color: var(--c-gray-500); margin-top: 0.25rem;">{{ __('Max 2MB per foto (JPG, PNG)') }}</p>
                            </div>

                            <div id="image-preview-container-edit"
                                class="hidden absolute inset-0 w-full h-full bg-gray-100 flex overflow-x-auto gap-2 p-2 items-center snap-x z-20 pointer-events-none">
                                <!-- Previews injected here -->
                            </div>
                        </div>
                    </div>
                @endif

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                    <a href="{{ route('items.show', $item) }}" class="btn btn-outline"
                        style="color: var(--c-gray-600); border-color: transparent;">{{ __('Batal') }}</a>
                    <button type="submit" class="btn btn-primary" style="padding-left: 2rem; padding-right: 2rem;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        {{ __('Simpan Perubahan') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Delete Photo Form (Hidden) -->
    <form id="delete-photo-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Script to preview image -->
    <script>
        function deleteStoredPhoto(photoId) {
            if (confirm('{{ __('Apakah Anda yakin ingin menghapus foto ini?') }}')) {
                const form = document.getElementById('delete-photo-form');
                form.action = `/items/{{ $item->id }}/photos/${photoId}`;
                form.submit();
            }
        }

        function previewImagesEdit(event) {
            const input = event.target;
            const container = document.getElementById('image-preview-container-edit');
            const uploadState = document.getElementById('upload-state-edit');

            container.innerHTML = '';

            if (input.files && input.files.length > 0) {
                uploadState.classList.add('hidden');
                container.classList.remove('hidden');

                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-full object-cover rounded shadow border-2 border-white snap-center shrink-0 max-w-[80%] zoomable-image cursor-pointer';
                        img.onclick = function () { openLightbox(this.src); };
                        container.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                uploadState.classList.remove('hidden');
                container.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>