<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 my-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8 pb-4" style="border-bottom: 2px solid var(--c-gray-100);">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline"
                    style="padding: 0.5rem; border-radius: 50%;">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 900; color: var(--c-gray-900);">Detail User:
                        {{ $user->name }}
                    </h2>
                    <p style="color: var(--c-gray-500); font-size: 0.875rem;">Memonitor informasi lengkap dan log
                        aktivitas user ini.</p>
                </div>
            </div>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary"
                style="display: flex; align-items: center; gap: 0.5rem;">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                    </path>
                </svg>
                Edit Profil
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
            <style>
                @media (min-width: 1024px) {
                    .layout-grid {
                        grid-template-columns: 1fr 2fr !important;
                    }
                }
            </style>
            <div class="layout-grid" style="display: grid; grid-template-columns: 1fr; gap: 2rem;">

                <!-- Left Column: User Details & Stats -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">

                    <!-- Profile Card -->
                    <div class="card p-6" style="text-align: center;">
                        <div
                            style="width: 96px; height: 96px; margin: 0 auto 1.5rem auto; border-radius: 50%; overflow: hidden; background: var(--c-gray-100); border: 4px solid var(--c-white); box-shadow: var(--shadow-md);">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div
                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 900; color: var(--c-gray-400);">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h3
                            style="font-size: 1.25rem; font-weight: 900; color: var(--c-gray-900); margin-bottom: 0.25rem;">
                            {{ $user->name }}
                        </h3>
                        <p style="color: var(--c-gray-500); font-size: 0.875rem; margin-bottom: 1rem;">
                            {{ $user->email }}
                        </p>
                        <span class="badge"
                            style="background: {{ $user->role === 'admin' ? 'var(--c-primary-light)' : 'var(--c-gray-100)' }}; color: {{ $user->role === 'admin' ? 'var(--c-primary)' : 'var(--c-gray-600)' }};">
                            Role: {{ ucfirst($user->role) }}
                        </span>

                        <div
                            style="margin-top: 2rem; border-top: 1px solid var(--c-gray-100); padding-top: 1.5rem; text-align: left;">
                            <div style="margin-bottom: 1rem;">
                                <p
                                    style="font-size: 0.75rem; font-weight: 700; color: var(--c-gray-400); text-transform: uppercase;">
                                    No Whatsapp/Telepon</p>
                                <p style="font-weight: 600; color: var(--c-gray-900);">{{ $user->phone ?: '-' }}</p>
                            </div>
                            <div>
                                <p
                                    style="font-size: 0.75rem; font-weight: 700; color: var(--c-gray-400); text-transform: uppercase;">
                                    Tanggal Bergabung</p>
                                <p style="font-weight: 600; color: var(--c-gray-900);">
                                    {{ $user->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="card p-6" style="background: var(--c-primary); color: white;">
                        <h3 style="font-size: 1rem; font-weight: 800; margin-bottom: 1.5rem; opacity: 0.9;">Statistik
                            Penitipan</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div
                                style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: var(--radius-lg);">
                                <p style="font-size: 2rem; font-weight: 900; line-height: 1;">
                                    {{ $user->items->count() }}
                                </p>
                                <p
                                    style="font-size: 0.75rem; font-weight: 600; opacity: 0.8; margin-top: 0.5rem; text-transform: uppercase;">
                                    Total Barang</p>
                            </div>
                            <div
                                style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: var(--radius-lg);">
                                <p style="font-size: 2rem; font-weight: 900; line-height: 1;">
                                    {{ $user->items->where('status', 'stored')->count() }}
                                </p>
                                <p
                                    style="font-size: 0.75rem; font-weight: 600; opacity: 0.8; margin-top: 0.5rem; text-transform: uppercase;">
                                    Aktif Disimpan</p>
                            </div>
                            <div
                                style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: var(--radius-lg);">
                                <p style="font-size: 2rem; font-weight: 900; line-height: 1;">
                                    {{ $user->items->where('status', 'pending')->count() }}
                                </p>
                                <p
                                    style="font-size: 0.75rem; font-weight: 600; opacity: 0.8; margin-top: 0.5rem; text-transform: uppercase;">
                                    Pending</p>
                            </div>
                            <div
                                style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: var(--radius-lg);">
                                <p style="font-size: 2rem; font-weight: 900; line-height: 1;">
                                    {{ $user->items->where('status', 'retrieved')->count() }}
                                </p>
                                <p
                                    style="font-size: 0.75rem; font-weight: 600; opacity: 0.8; margin-top: 0.5rem; text-transform: uppercase;">
                                    Selesai</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Tabs (Items & Logs) -->
                <div>
                    <!-- Items List -->
                    <div class="card p-6 mb-8">
                        <h3
                            style="font-weight: 800; font-size: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <svg style="width: 24px; height: 24px; color: var(--c-primary);" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Daftar Barang Penitipan
                        </h3>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; min-width: 500px;">
                                <thead>
                                    <tr style="border-bottom: 2px solid var(--c-gray-100);">
                                        <th
                                            style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; color: var(--c-gray-500); text-transform: uppercase;">
                                            Barang</th>
                                        <th
                                            style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; color: var(--c-gray-500); text-transform: uppercase;">
                                            Token Resi</th>
                                        <th
                                            style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; color: var(--c-gray-500); text-transform: uppercase;">
                                            Status</th>
                                        <th style="padding: 0.75rem 1rem; text-align: right;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($user->items as $item)
                                        <tr style="border-bottom: 1px solid var(--c-gray-100);">
                                            <td style="padding: 1rem; font-weight: 700; color: var(--c-gray-900);">
                                                {{ $item->name }}
                                            </td>
                                            <td
                                                style="padding: 1rem; font-family: monospace; font-weight: 600; color: var(--c-gray-600);">
                                                {{ $item->receipt_token ?? '-' }}
                                            </td>
                                            <td style="padding: 1rem;">
                                                <span
                                                    class="badge badge-{{ $item->status === 'pending' ? 'pending' : ($item->status === 'stored' ? 'stored' : 'retrieved') }}">{{ ucfirst($item->status) }}</span>
                                            </td>
                                            <td style="padding: 1rem; text-align: right;">
                                                <a href="{{ route('items.show', $item) }}" class="btn btn-outline"
                                                    style="padding: 0.35rem 0.75rem; font-size: 0.75rem;">Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                style="padding: 2rem; text-align: center; color: var(--c-gray-400);">Belum
                                                pernah menitipkan barang.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Activity Logs -->
                    <div class="card p-6">
                        <h3
                            style="font-weight: 800; font-size: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <svg style="width: 24px; height: 24px; color: var(--c-primary);" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Log Aktivitas (Terkini)
                        </h3>
                        <div class="timeline">
                            @forelse($activities as $log)
                                <div class="timeline-item">
                                    <p style="font-weight: 700; color: var(--c-gray-900); font-size: 0.875rem;">
                                        @if($log->action === 'updated_by_user')
                                            User mengedit data barang <a href="{{ route('items.show', $log->item) }}"
                                                style="color: var(--c-primary);">"{{ $log->item->name }}"</a>
                                        @elseif($log->action === 'status_changed')
                                            Status <a href="{{ route('items.show', $log->item) }}"
                                                style="color: var(--c-primary);">"{{ $log->item->name }}"</a> diubah menjadi
                                            {{ current($log->changes)['new_status'] ?? ($log->changes['new_status'] ?? 'N/A') }}
                                        @else
                                            Aktivitas: {{ $log->action }} pada <a
                                                href="{{ route('items.show', $log->item) }}">{{ $log->item->name }}</a>
                                        @endif
                                    </p>
                                    <p style="font-size: 0.75rem; color: var(--c-gray-500); margin-bottom: 0.5rem;">
                                        Oleh {{ $log->user->name ?? 'Admin Sistem' }} &bull;
                                        {{ $log->created_at->format('d M Y, H:i') }}
                                    </p>

                                    @if($log->action === 'updated_by_user' && $log->changes)
                                        <div
                                            style="background: var(--c-gray-50); padding: 0.5rem; border-radius: var(--radius-md); font-family: monospace; font-size: 0.7rem; color: var(--c-gray-600); border: 1px solid var(--c-gray-200); max-height: 100px; overflow-y: auto;">
                                            @foreach($log->changes as $key => $change)
                                                <div style="margin-bottom: 0.25rem;">
                                                    <strong style="color: var(--c-primary);">{{ $key }}:</strong>
                                                    {{ Str::limit(is_array($change) ? ($change['new'] ?? '') : '', 20) }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p style="color: var(--c-gray-400); font-size: 0.875rem;">Tidak ada log aktivitas.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>