<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">{{ __('Admin Overview') }}</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">{{ __('Statistik sistem penitipan — realtime') }}</p>
            </div>
            <span
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-orange-600 bg-orange-100/50 border border-orange-200 rounded-full shadow-sm backdrop-blur-md">
                <span class="w-2.5 h-2.5 bg-orange-500 rounded-full animate-pulse"></span> {{ __('Admin Mode') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12 lg:py-16 my-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stat Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users -->
                <div class="glass-card p-6 border-t-4 border-t-orange-400">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Total Pengguna') }}
                    </p>
                    <p class="text-4xl font-black text-gray-900">{{ $totalUsers }}</p>
                    <div class="mt-4 flex justify-between items-end">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center bg-orange-100 text-orange-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase">{{ __('akun terdaftar') }}</span>
                    </div>
                </div>

                <!-- Total Items -->
                <div class="glass-card p-6 border-t-4 border-t-blue-400">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Total Barang') }}
                    </p>
                    <p class="text-4xl font-black text-gray-900">{{ $totalItems }}</p>
                    <div class="mt-4 flex justify-between items-end">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-100 text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase">{{ __('dititipkan') }}</span>
                    </div>
                </div>

                <!-- Pending -->
                <div class="glass-card p-6 border-t-4 border-t-red-400">
                    <p class="text-sm font-bold text-red-500 uppercase tracking-wider mb-1">{{ __('Perlu Verifikasi') }}
                    </p>
                    <p class="text-4xl font-black text-gray-900">{{ $pendingItems }}</p>
                    <div class="mt-4 flex justify-between items-end">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-red-100 text-red-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @if($pendingItems > 0)
                            <span
                                class="text-xs font-bold text-white uppercase bg-red-500 px-2 py-1 rounded-full animate-pulse shadow-sm shadow-red-500/50">{{ __('Perlu aksi!') }}</span>
                        @else
                            <span class="text-xs font-bold text-gray-400 uppercase">{{ __('semua beres') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Stored -->
                <div class="glass-card p-6 border-t-4 border-t-emerald-400">
                    <p class="text-sm font-bold text-emerald-500 uppercase tracking-wider mb-1">
                        {{ __('Aman Disimpan') }}</p>
                    <p class="text-4xl font-black text-gray-900">{{ $storedItems }}</p>
                    <div class="mt-4 flex justify-between items-end">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase">{{ __('dalam gudang') }}</span>
                    </div>
                </div>
            </div>

            <!-- Main Grid: Table + Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Recent Items Table -->
                <div class="lg:col-span-2 glass-card p-0 overflow-hidden flex flex-col">
                    <div class="flex justify-between items-center px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-orange-100 text-orange-500 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ __('Barang Terbaru') }}</h3>
                                <p class="text-xs text-gray-500 font-medium">{{ __('10 barang terakhir masuk') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="text-sm font-bold text-orange-500 hover:text-orange-600 transition-colors">
                            Lihat Semua &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        {{ __('Barang') }}
                                    </th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        {{ __('Pemilik') }}
                                    </th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        {{ __('Nilai') }}
                                    </th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th
                                        class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                                        {{ __('Aksi') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentItems as $item)
                                    <tr class="hover:bg-white/40 transition-colors group">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ Storage::url($item->photo_path) }}" alt="{{ $item->name }}"
                                                    class="w-10 h-10 rounded-lg object-cover shadow-sm">
                                                <div>
                                                    <a href="{{ route('items.show', $item) }}"
                                                        class="font-bold text-gray-900 text-sm group-hover:text-orange-500 transition-colors">{{ $item->name }}</a>
                                                    @if($item->item_type)
                                                        <p class="text-xs text-gray-500 mt-0.5">
                                                            {{ $item->item_type }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-gray-700 text-sm font-medium">{{ $item->user->name }}</td>
                                        <td class="py-4 px-6 text-sm font-semibold text-gray-900">
                                            @if($item->estimated_value) Rp
                                                {{ number_format($item->estimated_value, 0, ',', '.') }}
                                            @else <span class="text-gray-400 italic">—</span> @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="badge badge-{{ $item->status === 'pending' ? 'pending' : ($item->status === 'stored' ? 'stored' : 'retrieved') }}">
                                                {{ __(ucfirst($item->status)) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('items.show', $item) }}"
                                                    class="p-2 text-gray-400 hover:text-blue-500 transition-colors bg-white rounded-lg shadow-sm border border-gray-100 hover:border-blue-200"
                                                    title="Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('items.edit', $item) }}"
                                                    class="p-2 text-gray-400 hover:text-orange-500 transition-colors bg-white rounded-lg shadow-sm border border-gray-100 hover:border-orange-200"
                                                    title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-10 text-center text-gray-500 font-medium text-sm">
                                            {{ __('Belum ada data barang masuk.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="glass-card p-0 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-lg">{{ __('Aksi Cepat') }}</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-white/50 hover:bg-white hover:shadow-md transition-all group">
                                <div
                                    class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-purple-100 text-purple-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-gray-900 text-base">{{ __('Kelola Pengguna') }}</p>
                                    <p class="text-gray-500 text-xs truncate mt-0.5">{{ __('Lihat & atur akun user') }}
                                    </p>
                                </div>
                            </a>

                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-white/50 hover:bg-white hover:shadow-md transition-all group">
                                <div
                                    class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-blue-100 text-blue-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-gray-900 text-base">{{ __('Semua Barang') }}</p>
                                    <p class="text-gray-500 text-xs truncate mt-0.5">
                                        {{ __('Update & verifikasi status') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Status Distribution -->
                    <div class="glass-card p-6 bg-gradient-to-br from-white/40 to-white/10">
                        <h4 class="font-bold text-gray-900 text-lg mb-5">{{ __('Distribusi Status') }}</h4>
                        <div class="space-y-5">
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-bold text-gray-600">{{ __('Pending') }}</span>
                                    <span class="font-bold text-gray-900">{{ $pendingItems }}</span>
                                </div>
                                <div class="h-2.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full bg-red-500 rounded-full"
                                        style="width: {{ $totalItems > 0 ? round($pendingItems / $totalItems * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-bold text-gray-600">{{ __('Aman Disimpan') }}</span>
                                    <span class="font-bold text-gray-900">{{ $storedItems }}</span>
                                </div>
                                <div class="h-2.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full bg-emerald-500 rounded-full"
                                        style="width: {{ $totalItems > 0 ? round($storedItems / $totalItems * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-bold text-gray-600">{{ __('Telah Diambil') }}</span>
                                    <span
                                        class="font-bold text-gray-900">{{ $totalItems - $pendingItems - $storedItems }}</span>
                                </div>
                                <div class="h-2.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full bg-blue-500 rounded-full"
                                        style="width: {{ $totalItems > 0 ? round(($totalItems - $pendingItems - $storedItems) / $totalItems * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>