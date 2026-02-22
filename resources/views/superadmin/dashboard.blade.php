<x-superadmin-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">Super Admin Dashboard</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">Sistem Kendali Utama & Overview Menyeluruh</p>
            </div>
            <div class="hidden lg:flex gap-2">
                <a href="{{ route('superadmin.settings') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ __('Settings') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 lg:py-16 my-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- AdminLTE Style Widgets / Fast Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Super Admins -->
                <div
                    class="relative overflow-hidden rounded-2xl bg-indigo-600 p-6 shadow-lg shadow-indigo-600/20 text-white group">
                    <div
                        class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-indigo-100 font-bold uppercase tracking-wider text-xs mb-1">Super Admins</p>
                        <h3 class="text-4xl font-black">{{ $totalSuperAdmins }}</h3>
                        <a href="{{ route('admin.users.index') }}"
                            class="mt-4 inline-flex items-center text-sm font-semibold text-indigo-100 hover:text-white group-hover:gap-2 transition-all">
                            Kelola Akses <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Admins -->
                <div
                    class="relative overflow-hidden rounded-2xl bg-teal-500 p-6 shadow-lg shadow-teal-500/20 text-white group">
                    <div
                        class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-teal-100 font-bold uppercase tracking-wider text-xs mb-1">Admin Biasa</p>
                        <h3 class="text-4xl font-black">{{ $totalAdmins }}</h3>
                        <a href="{{ route('admin.users.index') }}"
                            class="mt-4 inline-flex items-center text-sm font-semibold text-teal-100 hover:text-white group-hover:gap-2 transition-all">
                            Lihat Admin <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Users -->
                <div
                    class="relative overflow-hidden rounded-2xl bg-orange-500 p-6 shadow-lg shadow-orange-500/20 text-white group">
                    <div
                        class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-orange-100 font-bold uppercase tracking-wider text-xs mb-1">Pelanggan Aktif</p>
                        <h3 class="text-4xl font-black">{{ $totalUsers }}</h3>
                        <a href="{{ route('admin.users.index') }}"
                            class="mt-4 inline-flex items-center text-sm font-semibold text-orange-100 hover:text-white group-hover:gap-2 transition-all">
                            Daftar Pelanggan <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Items & Value -->
                <div
                    class="relative overflow-hidden rounded-2xl bg-slate-800 p-6 shadow-lg shadow-slate-900/20 text-white group">
                    <div
                        class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H10a3 3 0 013 3v1a1 1 0 102 0v-1a5 5 0 00-5-5H8.414l1.293-1.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-xs mb-1">Total Nilai Barang</p>
                        <h3 class="text-3xl font-black truncate"
                            title="Rp {{ number_format($totalEstimatedValue, 0, ',', '.') }}">Rp
                            {{ number_format($totalEstimatedValue, 0, ',', '.') }}
                        </h3>
                        <div class="mt-4 flex items-center gap-2 text-sm font-semibold text-slate-300">
                            <span class="px-2 py-0.5 bg-white/10 rounded-md">{{ $totalItems }} Barang</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Main Split Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

                <!-- Left Column (Recent Activity) -->
                <div class="lg:col-span-2 glass-card p-0 flex flex-col">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">Aktivitas Penitipan Terakhir</h3>
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="text-sm rounded-lg bg-gray-50 hover:bg-gray-100 px-3 py-1.5 font-bold text-gray-700 transition">Semua
                            Barang</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50/50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    <th class="py-4 px-6 w-1/3">Barang & Pemilik</th>
                                    <th class="py-4 px-6">Token</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentItems as $item)
                                    <tr class="hover:bg-white/40 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-900">{{ $item->name }}</span>
                                                <span class="text-xs text-gray-500 mt-0.5">Milik:
                                                    {{ $item->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <code
                                                class="px-2 py-1 bg-gray-100 rounded text-xs font-mono font-bold">{{ $item->receipt_token }}</code>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="badge badge-{{ $item->status === 'pending' ? 'pending' : ($item->status === 'stored' ? 'stored' : 'retrieved') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <a href="{{ route('items.show', $item) }}"
                                                class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-bold text-sm">
                                                Lihat &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-400">Belum ada barang terdaftar di
                                            seluruh sistem.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Column (System Integrity) -->
                <div class="space-y-6">
                    <div class="glass-card p-6">
                        <h4 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            Sistem Gudang
                        </h4>

                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-4 bg-red-50/50 border border-red-100 rounded-xl">
                                <div>
                                    <p class="text-xs font-bold text-red-600 uppercase">Perlu Verifikasi</p>
                                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $pendingItems }}</p>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 bg-emerald-50/50 border border-emerald-100 rounded-xl">
                                <div>
                                    <p class="text-xs font-bold text-emerald-600 uppercase">Aman Disimpan</p>
                                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $storedItems }}</p>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 bg-gray-50/50 border border-gray-200 rounded-xl">
                                <div>
                                    <p class="text-xs font-bold text-gray-600 uppercase">Telah Diambil</p>
                                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $retrievedItems }}</p>
                                </div>
                                <div
                                    class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.dashboard') }}"
                            class="mt-4 w-full flex items-center justify-center gap-2 py-3 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl text-sm font-bold transition-colors">
                            Buka Dashboard Kasir
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-superadmin-layout>