<x-superadmin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">Super Admin Dashboard</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">Sistem Kendali Utama & Overview Menyeluruh</p>
            </div>
            <span
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-indigo-600 bg-indigo-100/50 border border-indigo-200 rounded-full shadow-sm backdrop-blur-md">
                <span class="w-2.5 h-2.5 bg-indigo-500 rounded-full animate-pulse"></span> Root Control
            </span>
        </div>
    </x-slot>

    <div class="py-12 lg:py-16 my-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stat Cards: Aligned with Admin Dashboard UI -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Admin Biasa -->
                <div class="glass-card p-6 border-t-4 border-t-indigo-400 group">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Admin Biasa</p>
                    <p class="text-4xl font-black text-gray-900">{{ $totalAdmins }}</p>
                    <div class="mt-4 flex justify-between items-end">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-500 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <a href="{{ route('admin.users.index') }}"
                            class="text-xs font-bold text-indigo-600 uppercase hover:underline">Kelola Akses</a>
                    </div>
                </div>

                <!-- Pelanggan Aktif -->
                <div class="glass-card p-6 border-t-4 border-t-emerald-400 group">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Pelanggan Aktif</p>
                    <p class="text-4xl font-black text-gray-900">{{ $totalUsers }}</p>
                    <div class="mt-4 flex justify-between items-end">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-500 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <a href="{{ route('admin.users.index') }}"
                            class="text-xs font-bold text-emerald-600 uppercase hover:underline">Lihat Admin</a>
                    </div>
                </div>

                <!-- Total Nilai Barang -->
                <div class="glass-card p-6 border-t-4 border-t-amber-400 group">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Nilai Barang</p>
                    <p class="text-3xl font-black text-gray-900 truncate"
                        title="Rp {{ number_format($totalEstimatedValue, 0, ',', '.') }}">
                        Rp {{ number_format($totalEstimatedValue, 0, ',', '.') }}
                    </p>
                    <div class="mt-4 flex justify-between items-end">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center bg-amber-100 text-amber-500 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase">{{ $totalItems }} barang</span>
                    </div>
                </div>

                <!-- Warehouse Overview -->
                <div class="glass-card p-6 border-t-4 border-t-slate-800 group">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Ringkasan Gudang</p>
                    <div class="flex gap-2 items-baseline">
                        <p class="text-4xl font-black text-gray-900">{{ $storedItems }}</p>
                        <p class="text-xs font-bold text-gray-400 uppercase">aktif</p>
                    </div>
                    <div class="mt-4 flex justify-between items-end">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center bg-slate-100 text-slate-800 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-xs font-bold text-slate-800 uppercase hover:underline">Panel Kasir</a>
                    </div>
                </div>
            </div>

            <!-- Main Grid: Table + Sidebar -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Recent Item Activity: Aligned with Admin Dashboard UI -->
                <div class="lg:col-span-2 glass-card p-0 overflow-hidden flex flex-col">
                    <div class="flex justify-between items-center px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-gray-100 text-gray-800 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Aktivitas Terbaru</h3>
                                <p class="text-xs text-gray-500 font-medium">Log pergerakan barang terakhir</p>
                            </div>
                        </div>
                        <a href="{{ route('superadmin.logs.items') }}"
                            class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                            Log Lengkap &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Barang</th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Token
                                    </th>
                                    <th
                                        class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentItems as $item)
                                    <tr class="hover:bg-white/40 transition-colors group">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $item->name }}</span>
                                                <span class="text-xs text-gray-500 font-medium">Pemilik:
                                                    {{ $item->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 font-mono text-xs font-bold text-indigo-600">
                                            <span
                                                class="px-2 py-1 bg-indigo-50 border border-indigo-100 rounded-md">{{ $item->receipt_token }}</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <a href="{{ route('items.show', $item) }}"
                                                class="inline-flex p-2 text-gray-400 hover:text-indigo-600 transition-colors bg-white rounded-lg shadow-sm border border-gray-100 hover:border-indigo-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-12 text-center text-gray-400 font-bold italic">Belum ada
                                            barang terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Column: Distribution & Quick Actions -->
                <div class="space-y-6">

                    <!-- Quick Actions: Super Admin Specific -->
                    <div class="glass-card p-0 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-lg">Kendali Sistem</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <a href="{{ route('superadmin.settings') }}"
                                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-white/50 hover:bg-white hover:shadow-md transition-all group">
                                <div
                                    class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-amber-100 text-amber-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-gray-900 text-base">Pengaturan Core</p>
                                    <p class="text-gray-500 text-xs truncate mt-0.5">Konfigurasi sistem utama</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-white/50 hover:bg-white hover:shadow-md transition-all group">
                                <div
                                    class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-indigo-100 text-indigo-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-gray-900 text-base">Kelola Semua Akun</p>
                                    <p class="text-gray-500 text-xs truncate mt-0.5">Admin & Pelanggan Aktif</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Status Distribution: Aligned with Admin Dashboard UI -->
                    <div class="glass-card p-6 bg-gradient-to-br from-white to-gray-50/50">
                        <h4 class="font-bold text-gray-900 text-lg mb-5">Distribusi Status Gudang</h4>
                        <div class="space-y-5">
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-bold text-gray-600">Terverifikasi (Stored)</span>
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
                                    <span class="font-bold text-gray-600">Menunggu (Pending)</span>
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
                                    <span class="font-bold text-gray-600">Telah Diambil (Retrieved)</span>
                                    <span class="font-bold text-gray-900">{{ $retrievedItems }}</span>
                                </div>
                                <div class="h-2.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full bg-indigo-500 rounded-full"
                                        style="width: {{ $totalItems > 0 ? round($retrievedItems / $totalItems * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-superadmin-layout>