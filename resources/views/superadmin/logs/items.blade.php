<x-superadmin-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">{{ __('Log Transaksi Barang') }}</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">
                    {{ __('Riwayat lengkap seluruh pemasukan, pengeluaran, dan perubahan status barang di gudang.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="glass-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-gray-50/80 border-b border-gray-200 text-xs font-black text-gray-600 uppercase tracking-widest">
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
                                            <span
                                                class="font-bold text-gray-900">{{ $log->user->name ?? __('Sistem') }}</span>
                                            <span
                                                class="text-[10px] font-black tracking-wider text-indigo-600 uppercase">{{ $log->user->role ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-col">
                                            @if($log->item_id)
                                                <a href="{{ route('items.show', $log->item_id) }}"
                                                    class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                                    {{ $log->item->name ?? __('Barang Terhapus') }}
                                                </a>
                                            @else
                                                <span class="font-bold text-gray-400">{{ __('Barang Terhapus') }}</span>
                                            @endif
                                            <code
                                                class="text-xs font-mono text-gray-500 mt-0.5">{{ $log->item->receipt_token ?? 'N/A' }}</code>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="inline-block px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded mb-2">
                                            {{ strtoupper(__($log->action)) }}
                                        </span>
                                        @if($log->changes && is_array($log->changes))
                                            <div
                                                class="text-xs bg-white/50 p-2 rounded border border-gray-100 max-w-sm overflow-x-auto">
                                                <pre
                                                    class="font-mono text-[10px] text-gray-600 m-0">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
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
                        {{ $itemLogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-superadmin-layout>