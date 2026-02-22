<x-superadmin-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">{{ __('Log Sistem & Aktivitas') }}</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">
                    {{ __('Pusat pemantauan seluruh riwayat transaksi barang dan aktivitas login pengguna.') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ activeTab: 'items' }">
        <div class="max-w-7xl mx-auto">

            <!-- Tabs Navigation -->
            <div class="mb-6 flex space-x-2 border-b border-gray-200">
                <button @click="activeTab = 'items'"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'items', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'items' }"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    {{ __('Log Transaksi Barang') }}
                </button>
                <button @click="activeTab = 'users'"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'users', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'users' }"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    {{ __('Log Aktivitas Pengguna') }}
                </button>
            </div>

            <!-- Tab 1: Item Logs -->
            <div x-show="activeTab === 'items'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="glass-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-200 text-xs font-black text-gray-600 uppercase tracking-widest">
                                <th class="py-4 px-6">{{ __('Waktu') }}</th>
                                <th class="py-4 px-6">{{ __('Aktor') }}</th>
                                <th class="py-4 px-6">{{ __('Barang (Token)') }}</th>
                                <th class="py-4 px-6">{{ __('Aksi & Detail') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white/40">
                            @forelse($itemLogs as $log)
                                <tr class="hover:bg-white/60 transition-colors">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600 whitespace-nowrap">
                                        {{ $log->created_at->format('d M Y H:i:s') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900">{{ $log->user->name ?? __('Sistem') }}</span>
                                            <span class="text-[10px] font-black tracking-wider text-indigo-600 uppercase">{{ $log->user->role ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-col">
                                            <a href="{{ $log->item_id ? route('items.show', $log->item_id) : '#' }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                                {{ $log->item->name ?? __('Barang Terhapus') }}
                                            </a>
                                            <code class="text-xs font-mono text-gray-500 mt-0.5">{{ $log->item->receipt_token ?? 'N/A' }}</code>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-block px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded mb-2">
                                            {{ strtoupper(__($log->action)) }}
                                        </span>
                                        @if(is_array($log->changes))
                                            <div class="text-xs bg-white/50 p-2 rounded border border-gray-100 max-w-sm overflow-x-auto">
                                                <pre class="font-mono text-[10px] text-gray-600 m-0">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-500">{{ __('Tidak ada detail khusus.') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500 font-medium">
                                        {{ __('Sistem log transaksi saat ini kosong.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($itemLogs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-white/50">
                        {{ $itemLogs->appends(['user_page' => request('user_page')])->links() }}
                    </div>
                @endif
            </div>

            <!-- Tab 2: User Logs -->
            <div x-show="activeTab === 'users'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="glass-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-200 text-xs font-black text-gray-600 uppercase tracking-widest">
                                <th class="py-4 px-6">{{ __('Waktu') }}</th>
                                <th class="py-4 px-6">{{ __('Pengguna') }}</th>
                                <th class="py-4 px-6">{{ __('Aksi Sistem') }}</th>
                                <th class="py-4 px-6">{{ __('Alamat IP') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white/40">
                            @forelse($userLogs as $log)
                                <tr class="hover:bg-white/60 transition-colors">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600 whitespace-nowrap">
                                        {{ $log->created_at->format('d M Y H:i:s') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($log->user)
                                            <a href="{{ route('admin.users.show', $log->user->id) }}" class="flex items-center gap-3 group">
                                                @if($log->user->avatar)
                                                    <img src="{{ asset('storage/' . $log->user->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover border border-gray-200 shadow-sm" />
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs border border-indigo-200">
                                                        {{ substr($log->user->name, 0, 2) }}
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <span class="font-bold text-indigo-600 group-hover:text-indigo-800 transition-colors">{{ $log->user->name }}</span>
                                                    <span class="text-[10px] font-black tracking-wider text-gray-500 uppercase">{{ $log->user->role }}</span>
                                                </div>
                                            </a>
                                        @else
                                            <span class="font-bold text-gray-500 italic">{{ __('Tidak Diketahui / Dihapus') }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-col items-start gap-1">
                                            @php
                                                $actionColor = match($log->action) {
                                                    'login' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                    'logout' => 'bg-gray-100 text-gray-800 border-gray-200',
                                                    'register', 'create_user' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'update_profile', 'update_user' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                    'delete_account', 'delete_user' => 'bg-red-100 text-red-800 border-red-200',
                                                    default => 'bg-slate-100 text-slate-800 border-slate-200',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold border {{ $actionColor }}">
                                                {{ strtoupper(str_replace('_', ' ', __($log->action))) }}
                                            </span>
                                            <span class="text-xs text-gray-500">{{ __($log->description) }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-mono text-gray-500">
                                        {{ $log->ip_address ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500 font-medium">
                                        {{ __('Log aktivitas pengguna saat ini kosong.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($userLogs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-white/50">
                        {{ $userLogs->appends(['item_page' => request('item_page')])->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-superadmin-layout>