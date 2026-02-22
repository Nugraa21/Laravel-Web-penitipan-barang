<x-app-layout>
    <div class="container py-12 lg:py-16 my-8" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
        
        <!-- Header Actions -->
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('Kembali') }}
            </a>
            <div class="flex gap-2">
                @if(Auth::user()->role === 'admin' && $item->status === 'pending')
                    <form action="{{ route('items.mark_stored', $item) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="glass-btn bg-emerald-500 hover:bg-emerald-600 text-white border-0 shadow-lg px-4 py-2 flex items-center gap-2 font-bold transition-all">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            {{ __('Terima Barang') }}
                        </button>
                    </form>
                @endif
                <a href="{{ route('chat.index', $item) }}" class="btn btn-outline" style="color: var(--c-primary); border-color: var(--c-primary-light); background: var(--c-primary-light);">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    {{ __('Live Chat') }}
                </a>
                @if(Auth::user()->role === 'admin' || (Auth::id() === $item->user_id && $item->status === 'pending'))
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-primary">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Data
                    </a>
                @endif
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
            <style>
                @media (min-width: 1024px) {
                    .layout-grid { grid-template-columns: 2fr 1fr !important; }
                }
            </style>
            <div class="layout-grid" style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                
                <!-- Main Content -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    
                    <!-- Digital Receipt (Struk) -->
                    <div class="glass-card" style="padding: 2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                            <div>
                                <h2 style="font-weight: 800; color: var(--c-primary); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.25rem;">{{ __('Struk Penitipan') }}</h2>
                                <p style="color: var(--c-gray-500); font-size: 0.875rem; margin-bottom: 1.5rem;">{{ __('Tunjukkan kode ini saat pengambilan barang') }}</p>
                            </div>
                            <a href="{{ route('items.print', $item) }}" target="_blank" class="glass-btn" style="display: flex; align-items: center; gap: 0.5rem; background: var(--c-primary); color: white; padding: 0.5rem 1rem; border-radius: 8px; font-weight: bold; text-decoration: none; font-size: 0.875rem;">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Cetak PDF
                            </a>
                        </div>
                        
                        <div style="background: rgba(255,255,255,0.4); padding: 1.5rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.8); margin-bottom: 1.5rem; display: inline-block; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                            <span style="font-family: monospace; font-size: 2.5rem; font-weight: 800; color: var(--c-gray-900); letter-spacing: 4px;">{{ $item->receipt_token ?? 'N/A' }}</span>
                        </div>

                        <div style="border-top: 1px dashed rgba(255,255,255,0.6); padding-top: 1.5rem; display: flex; justify-content: space-between; text-align: left;">
                            <div>
                                <p style="font-size: 0.75rem; color: var(--c-gray-500); text-transform: uppercase; font-weight: 700;">{{ __('Nama Penitip') }}</p>
                                <p style="font-weight: 800; color: var(--c-gray-900);">{{ $item->user->name }}</p>
                            </div>
                            <div style="text-align: right;">
                                <p style="font-size: 0.75rem; color: var(--c-gray-500); text-transform: uppercase; font-weight: 700;">Tanggal</p>
                                <p style="font-weight: 800; color: var(--c-gray-900);">{{ $item->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item Details Card -->
                    <div class="glass-card p-0 overflow-hidden">
                        <div style="position: relative;">
                            
                            <!-- Gallery Scrolling Container -->
                            <div style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; height: 400px; background: rgba(0,0,0,0.05); scroll-behavior: smooth;">
                                <!-- Main Photo -->
                                <img src="{{ Storage::url($item->photo_path) }}" alt="{{ $item->name }}" class="zoomable-image" style="flex: 0 0 100%; height: 100%; object-fit: cover; scroll-snap-align: center; cursor: zoom-in;">
                                
                                <!-- Additional Photos -->
                                @foreach($item->photos as $photo)
                                    <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $item->name }}" class="zoomable-image" style="flex: 0 0 100%; height: 100%; object-fit: cover; scroll-snap-align: center; cursor: zoom-in;">
                                @endforeach
                            </div>

                            <!-- Overlay Badges -->
                            <div style="position: absolute; top: 1rem; left: 1rem; z-index: 10;">
                                <span class="badge badge-{{ $item->status === 'pending' ? 'pending' : ($item->status === 'stored' ? 'stored' : 'retrieved') }}" style="box-shadow: var(--shadow-md); backdrop-filter: blur(4px);">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            <!-- Gallery Indicators -->
                            @if($item->photos->count() > 0)
                                <div style="position: absolute; top: 1rem; right: 1rem; z-index: 10;">
                                    <span style="background: rgba(0,0,0,0.6); color: white; padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 800; backdrop-filter: blur(4px); box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: 0.35rem;">
                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                        {{ __('Geser untuk foto lainnya') }} ({{ $item->photos->count() + 1 }})
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div style="padding: 2rem;">
                            <h1 style="font-size: 1.875rem; font-weight: 900; margin-bottom: 0.5rem;">{{ $item->name }}</h1>
                            <p style="color: var(--c-gray-500); margin-bottom: 1.5rem;">{{ $item->description ?: __('Tidak ada deskripsi.') }}</p>
                            
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                                @if($item->item_type)
                                <div style="background: rgba(255,255,255,0.4); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.6);">
                                    <p style="font-size: 0.75rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase;">{{ __('Jenis Barang') }}</p>
                                    <p style="font-weight: 800; color: var(--c-gray-900); font-size: 1.1rem;">{{ $item->item_type }}</p>
                                </div>
                                @endif
                                @if($item->brand)
                                <div style="background: rgba(255,255,255,0.4); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.6);">
                                    <p style="font-size: 0.75rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase;">{{ __('Merek / Brand') }}</p>
                                    <p style="font-weight: 800; color: var(--c-gray-900); font-size: 1.1rem;">{{ $item->brand }}</p>
                                </div>
                                @endif
                                @if($item->color)
                                <div style="background: rgba(255,255,255,0.4); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.6);">
                                    <p style="font-size: 0.75rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase;">{{ __('Warna') }}</p>
                                    <p style="font-weight: 800; color: var(--c-gray-900); font-size: 1.1rem;">{{ $item->color }}</p>
                                </div>
                                @endif
                                @if($item->expected_retrieval_date)
                                <div style="background: rgba(255,255,255,0.4); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.6);">
                                    <p style="font-size: 0.75rem; font-weight: 700; color: var(--c-gray-500); text-transform: uppercase;">{{ __('Rencana Diambil') }}</p>
                                    <p style="font-weight: 800; color: var(--c-gray-900); font-size: 1.1rem;">{{ \Carbon\Carbon::parse($item->expected_retrieval_date)->format('d M Y') }}</p>
                                </div>
                                @endif
                                @if($item->estimated_value)
                                <div style="background: linear-gradient(135deg, rgba(59,130,246,0.1) 0%, rgba(59,130,246,0.05) 100%); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(59,130,246,0.2);">
                                    <p style="font-size: 0.75rem; font-weight: 700; color: #3b82f6; text-transform: uppercase;">{{ __('Estimasi Nilai') }}</p>
                                    <p style="font-weight: 800; color: #2563eb; font-size: 1.1rem;">Rp {{ number_format($item->estimated_value, 0, ',', '.') }}</p>
                                </div>
                                @endif
                            </div>

                            @if($item->characteristics)
                            <div style="background: rgba(139,92,246,0.1); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(139,92,246,0.2); margin-bottom: 2rem;">
                                <p style="font-size: 0.75rem; font-weight: 700; color: #6d28d9; text-transform: uppercase; margin-bottom: 0.5rem;">{{ __('Ciri-ciri Khusus Deskriptif') }}</p>
                                <p style="color: #4c1d95; font-weight: 600;">{{ $item->characteristics }}</p>
                            </div>
                            @endif

                            @if($item->notes)
                            <div style="background: rgba(245,158,11,0.1); padding: 1.25rem; border-radius: var(--radius-lg); border: 1px solid rgba(245,158,11,0.2);">
                                <p style="font-size: 0.75rem; font-weight: 700; color: #d97706; text-transform: uppercase; margin-bottom: 0.5rem;">{{ __('Catatan Tambahan') }}</p>
                                <p style="color: #92400e; font-weight: 600;">{{ $item->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Side Panel (History) -->
                <div>
                    <div class="glass-card p-6" style="position: sticky; top: 6rem;">
                        <h3 style="font-weight: 800; font-size: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <svg style="width: 24px; height: 24px; color: var(--c-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ __('Histori Aktivitas') }}
                        </h3>
                        
                        <div class="timeline">
                            <!-- Creation Event -->
                            <div class="timeline-item">
                                <p style="font-weight: 700; color: var(--c-gray-900); font-size: 0.875rem;">{{ __('Barang didaftarkan') }}</p>
                                <p style="font-size: 0.75rem; color: var(--c-gray-500);">{{ __('Oleh') }} {{ $item->user->name }} &bull; {{ $item->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <!-- Dynamic History -->
                            @foreach($item->histories as $history)
                                <div class="timeline-item">
                                    <p style="font-weight: 700; color: var(--c-gray-900); font-size: 0.875rem;">
                                        @if($history->action === 'updated_by_user')
                                            {{ __('User mengedit data barang') }}
                                        @elseif($history->action === 'status_changed')
                                            {{ __('Status diperbarui Admin') }}
                                        @else
                                            {{ __('Aktivitas:') }} {{ $history->action }}
                                        @endif
                                    </p>
                                    <p style="font-size: 0.75rem; color: var(--c-gray-500); margin-bottom: 0.5rem;">
                                        Oleh {{ $history->user->name ?? 'Sistem' }} &bull; {{ $history->created_at->format('d/m/Y H:i') }}
                                    </p>
                                    
                                    @if($history->changes)
                                        <div style="background: rgba(255,255,255,0.5); padding: 0.75rem; border-radius: var(--radius-md); font-family: monospace; font-size: 0.75rem; color: var(--c-gray-600); border: 1px solid rgba(255,255,255,0.8); max-height: 150px; overflow-y: auto;">
                                            @foreach($history->changes as $key => $change)
                                                <div style="margin-bottom: 0.5rem; border-bottom: 1px dashed rgba(0,0,0,0.1); padding-bottom: 0.25rem;">
                                                    <strong style="color: var(--c-gray-800);">{{ $key }}:</strong><br>
                                                    <span style="color: #ef4444;">[-] {{ Str::limit(is_array($change) ? ($change['old'] ?? '') : '', 30) }}</span><br>
                                                    <span style="color: #10b981;">[+] {{ Str::limit(is_array($change) ? ($change['new'] ?? '') : '', 30) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div style="margin-top: 2rem; border-top: 1px solid var(--c-gray-200); padding-top: 2rem; display: flex; justify-content: flex-end;">
                <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('{{ __('Hapus catatan barang ini secara permanen?') }}');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="color: var(--c-danger); border-color: var(--c-danger-bg); background: var(--c-danger-bg);">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        {{ __('Hapus Barang') }}
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</x-app-layout>
