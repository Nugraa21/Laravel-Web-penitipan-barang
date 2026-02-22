<x-superadmin-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">{{ __('Manajemen Transaksi') }}</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">
                    {{ __('Pantau seluruh transaksi barang penitipan secara real-time.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            <div class="glass-card p-6 mb-6">
                <form method="GET" action="{{ route('superadmin.transactions') }}"
                    class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">{{ __('Cari') }}</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="{{ __('Nama barang / token...') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                    </div>
                    <div class="w-full sm:w-48">
                        <label for="status"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">{{ __('Filter Status') }}</label>
                        <select name="status" id="status"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors">
                            <option value="">{{ __('Semua Status') }}</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}
                            </option>
                            <option value="stored" {{ request('status') === 'stored' ? 'selected' : '' }}>
                                {{ __('Disimpan') }}
                            </option>
                            <option value="retrieved" {{ request('status') === 'retrieved' ? 'selected' : '' }}>
                                {{ __('Diambil') }}
                            </option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-sm transition-colors">
                            {{ __('Terapkan') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="glass-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-gray-50/80 border-b border-gray-200 text-xs font-black text-gray-600 uppercase tracking-widest">
                                <th class="py-4 px-6">{{ __('Token') }}</th>
                                <th class="py-4 px-6">{{ __('Barang & Pemilik') }}</th>
                                <th class="py-4 px-6">{{ __('Status') }}</th>
                                <th class="py-4 px-6">{{ __('Tanggal') }}</th>
                                <th class="py-4 px-6 text-right">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white/40">
                            @forelse($items as $item)
                                <tr class="hover:bg-white/60 transition-colors">
                                    <td class="py-4 px-6">
                                        <code
                                            class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md font-mono text-sm font-bold border border-gray-200">{{ $item->receipt_token }}</code>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900">{{ $item->name }}</span>
                                            <span
                                                class="text-xs font-medium text-gray-500 mt-0.5">{{ $item->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold @if($item->status == 'pending') bg-yellow-100 text-yellow-800 @elseif($item->status == 'stored') bg-green-100 text-green-800 @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(__($item->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600">
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('items.show', $item) }}"
                                            class="inline-flex items-center justify-center p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                            title="{{ __('Lihat Detail') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('items.edit', $item) }}"
                                            class="inline-flex items-center justify-center p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors mx-1"
                                            title="{{ __('Edit Paksa') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('items.print', $item) }}" target="_blank"
                                            class="inline-flex items-center justify-center p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="{{ __('Cetak Struk') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500 font-medium">
                                        {{ __('Tidak ada data transaksi yang ditemukan.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($items->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-white/50">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-superadmin-layout>