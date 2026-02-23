<x-superadmin-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center pb-4 border-b border-gray-200 gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">{{ __('Log Aktivitas Pengguna') }}</h2>
                <p class="text-gray-500 font-medium text-sm mt-1">
                    {{ __('Pemantauan aktivitas login, logout, pendaftaran, dan pengelolaan akun pengguna.') }}</p>
            </div>
            <div class="w-full md:w-auto mt-4 md:mt-0">
                <form action="{{ route('superadmin.logs.users') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Cari Nama, Email, atau Aksi...') }}" class="w-full md:w-72 pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="glass-card overflow-hidden">
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
                                        <div class="flex flex-col">
                                            <span>{{ $log->ip_address ?? 'N/A' }}</span>
                                            @if($log->user_agent)
                                                <span class="text-[10px] text-gray-400 font-sans truncate max-w-[200px]" title="{{ $log->user_agent }}">
                                                    {{ $log->user_agent }}
                                                </span>
                                            @endif
                                        </div>
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
                        {{ $userLogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-superadmin-layout>
