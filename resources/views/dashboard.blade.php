<x-app-layout>
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 1.875rem; font-weight: 800; color: var(--c-gray-900);">
                    @if(Auth::user()->role === 'admin') {{ __('Kelola Barang') }} @else {{ __('Dashboard') }} @endif
                </h2>
                <p style="color: var(--c-gray-600); font-size: 0.875rem;">
                    {{ __('Selamat datang,') }} <span style="font-weight: 700; color: #d97706;">{{ Auth::user()->name }}</span>
                </p>
            </div>
            @if(Auth::user()->role !== 'admin')
                <a href="{{ route('items.create') }}" class="btn btn-primary">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Titip Barang Baru') }}
                </a>
            @endif
        </div>



        @if(Auth::user()->role !== 'admin')
            @php
                $total = $items->count();
                $pending = $items->where('status', 'pending')->count();
                $stored = $items->where('status', 'stored')->count();
                $retrieved = $items->where('status', 'retrieved')->count();
            @endphp
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                <!-- Total -->
                <div class="glass-card" style="padding: 1.5rem; position: relative;">
                    <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(59,130,246,0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4M8 16H4V8H8V16ZM16 16H12V8H16V16ZM20 16H20V8H20V16Z"></path></svg>
                    </div>
                    <p style="font-size: 0.85rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">{{ __('Total Barang') }}</p>
                    <p style="font-size: 3rem; font-weight: 800; color: var(--c-gray-900); line-height: 1;">{{ $total }}</p>
                </div>
                <!-- Pending -->
                <div class="glass-card" style="padding: 1.5rem; position: relative; border-left: 4px solid var(--c-warning);">
                    <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(245,158,11,0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8V12L15 15M21 12A9 9 0 113 12A9 9 0 0121 12Z"></path></svg>
                    </div>
                    <p style="font-size: 0.85rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">{{ __('Pending') }}</p>
                    <p style="font-size: 3rem; font-weight: 800; color: var(--c-gray-900); line-height: 1;">{{ $pending }}</p>
                </div>
                <!-- Stored -->
                <div class="glass-card" style="padding: 1.5rem; position: relative; border-left: 4px solid #d97706;">
                    <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(217,119,6,0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13L9 17L19 7"></path></svg>
                    </div>
                    <p style="font-size: 0.85rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">{{ __('Disimpan') }}</p>
                    <p style="font-size: 3rem; font-weight: 800; color: var(--c-gray-900); line-height: 1;">{{ $stored }}</p>
                </div>
                <!-- Retrieved -->
                <div class="glass-card" style="padding: 1.5rem; position: relative; border-left: 4px solid var(--c-success);">
                    <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(16,185,129,0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16L21 12M21 12L17 8M21 12H3"></path></svg>
                    </div>
                    <p style="font-size: 0.85rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">{{ __('Diambil') }}</p>
                    <p style="font-size: 3rem; font-weight: 800; color: var(--c-gray-900); line-height: 1;">{{ $retrieved }}</p>
                </div>
            </div>
        @endif

        <div class="glass-card" style="padding: 0; margin-bottom: 2rem;">
            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.4); display: flex; flex-direction: column; gap: 1.5rem; sm:flex-row; sm:items-center; sm:justify-between; background: rgba(255,255,255,0.3);">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--c-gray-900);">
                    {{ __('Daftar Barang Titipan') }} 
                    <span style="font-size: 0.875rem; background: rgba(0,0,0,0.1); color: var(--c-gray-900); padding: 0.2rem 0.6rem; border-radius: var(--radius-full); margin-left: 0.5rem; font-weight: 600;">{{ $items->count() }}</span>
                </h3>
                
                <!-- Search, Filter & Sort Form -->
                <form action="{{ route('dashboard') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 0.75rem; width: 100%; max-width: 650px;">
                    <div style="position: relative; flex-grow: 1; min-width: 200px;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Cari nama barang atau nomor resi...') }}" class="glass-input form-input" style="padding-left: 2.75rem;">
                        <svg style="width: 18px; height: 18px; color: var(--c-gray-500); position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <select name="status" class="glass-input form-input" style="width: auto;" onchange="this.form.submit()">
                        <option value="">{{ __('Status') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                        <option value="stored" {{ request('status') == 'stored' ? 'selected' : '' }}>{{ __('Disimpan') }}</option>
                        <option value="retrieved" {{ request('status') == 'retrieved' ? 'selected' : '' }}>{{ __('Diambil') }}</option>
                    </select>
                    <select name="sort" class="glass-input form-input" style="width: auto;" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('Terbaru') }}</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('Terlama') }}</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>{{ __('Nama (A-Z)') }}</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>{{ __('Nama (Z-A)') }}</option>
                    </select>
                </form>
            </div>

            <div style="padding: 1.5rem;">
                @if($items->isEmpty())
                    <div style="text-align: center; padding: 4rem 1rem;">
                        <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; border-radius: 50%; background: var(--c-gray-50); border: 2px dashed var(--c-gray-200); display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 32px; height: 32px; color: var(--c-gray-300);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <h4 style="font-size: 1.125rem; font-weight: 800; color: var(--c-gray-900); margin-bottom: 0.5rem;">{{ __('Belum Ada Barang') }}</h4>
                        <p style="color: var(--c-gray-500); font-size: 0.875rem; margin-bottom: 2rem;">{{ __('Mulai titipkan barang pertama kamu sekarang dan dapatkan struk digital.') }}</p>
                        @if(Auth::user()->role !== 'admin')
                            <a href="{{ route('items.create') }}" class="btn btn-primary">
                                {{ __('Titip Sekarang') }}
                            </a>
                        @endif
                    </div>
                @else
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                        @foreach($items as $item)
                            <a href="{{ route('items.show', $item) }}" class="glass-card p-0" style="display: block;">
                                
                                <div style="position: relative; height: 200px; overflow: hidden; background: rgba(0,0,0,0.05); border-bottom: 1px solid rgba(255,255,255,0.4);">
                                    <img src="{{ Storage::url($item->photo_path) }}" alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" loading="lazy">
                                    <div style="position: absolute; top: 0.75rem; right: 0.75rem;">
                                        <span class="badge badge-{{ $item->status === 'pending' ? 'pending' : ($item->status === 'stored' ? 'stored' : 'retrieved') }}">
                                            {{ __($item->status === 'pending' ? 'Pending' : ($item->status === 'stored' ? 'Disimpan' : 'Diambil')) }}
                                        </span>
                                    </div>
                                    <div style="position: absolute; bottom: 0.75rem; left: 0.75rem;">
                                        <span style="background: rgba(255,255,255,0.8); backdrop-filter: blur(4px); color: var(--c-gray-900); padding: 0.35rem 0.6rem; border-radius: var(--radius-md); font-size: 0.7rem; font-weight: 700; border: 1px solid rgba(255,255,255,0.9); box-shadow: var(--shadow-sm);">
                                            {{ $item->receipt_token ?? __('Token N/A') }}
                                        </span>
                                    </div>
                                    @if(Auth::user()->role === 'admin' && $item->messages()->where('is_read', false)->where('sender_id', '!=', Auth::user()->id)->exists())
                                        <div style="position: absolute; top: 0.75rem; left: 0.75rem; background: var(--c-danger); color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; box-shadow: var(--shadow-md);">!</div>
                                    @endif
                                </div>
                                
                                <div style="padding: 1.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                                    <h4 style="font-weight: 800; font-size: 1.1rem; color: var(--c-gray-900); margin-bottom: 0.5rem;">{{ $item->name }}</h4>
                                    
                                    @if(Auth::user()->role === 'admin')
                                        <div style="margin-bottom: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.3); border: 1px solid rgba(255,255,255,0.6); border-radius: var(--radius-md);">
                                            <p style="font-size: 0.8rem; color: var(--c-gray-800); font-weight: 700; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.25rem;">
                                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                {{ $item->user->name }}
                                            </p>
                                            @if($item->user->address)
                                                <p style="font-size: 0.75rem; color: var(--c-gray-600); display: flex; align-items: flex-start; gap: 0.35rem; font-weight: 500;">
                                                    <svg style="width: 12px; height: 12px; margin-top: 2px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    {{ Str::limit($item->user->address, 50) }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif

                                    <p style="font-size: 0.85rem; color: var(--c-gray-600); margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-weight: 500; line-height: 1.4;">
                                        {{ $item->description ?: __('Tidak ada deskripsi.') }}
                                    </p>

                                    <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.5);">
                                        <span style="font-size: 0.75rem; font-weight: 600; color: var(--c-gray-500);">{{ $item->created_at->format('d M Y') }}</span>
                                        <span style="font-size: 0.75rem; font-weight: 700; color: var(--c-primary-hover); display: flex; align-items: center; gap: 0.25rem;">
                                            {{ __('Lihat Detail') }}
                                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </span>
                                    </div>
                                </div>

                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
