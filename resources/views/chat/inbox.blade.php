<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 lg:px-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 px-4 lg:px-0">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight uppercase flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </span>
                    Kotak Pesan
                </h1>
                <p class="text-gray-500 font-medium mt-2">Kelola obrolan langsung terkait barang titipan.</p>
            </div>
            
            <div class="glass-card px-4 py-2.5 rounded-full flex items-center gap-3 w-full md:w-auto">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" id="search-inbox" placeholder="Cari percakapan..." class="bg-transparent border-none focus:ring-0 p-0 text-sm font-semibold w-full md:w-48 placeholder-gray-400">
            </div>
        </div>

        <!-- Chat List Card -->
        <div class="glass-card shadow-xl overflow-hidden rounded-2xl border border-white/60 mx-4 lg:mx-0">
            @if($items->count() > 0)
                <div class="divide-y divide-gray-100/50" id="chat-list">
                    @foreach($items as $item)
                        @php
                            $latestMessage = $item->messages->first();
                            $hasUnread = $item->messages->where('is_read', false)->where('sender_id', '!=', Auth::id())->count() > 0;
                        @endphp
                        
                        <a href="{{ route('chat.index', $item) }}" class="flex items-center gap-4 p-5 hover:bg-white/60 transition-colors {{ $hasUnread ? 'bg-blue-50/30' : '' }} group relative">
                            <!-- Avatar -->
                            <div class="relative shrink-0 w-14 h-14 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 border-2 border-white shadow-sm flex items-center justify-center text-gray-700 font-black text-xl group-hover:scale-105 transition-transform">
                                {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                @if($hasUnread)
                                    <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-blue-500 border-2 border-white rounded-full"></span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-base font-bold text-gray-900 truncate pr-4 flex items-center gap-2">
                                        {{ $item->user->name }}
                                        <span class="px-2 py-0.5 rounded-md text-[0.65rem] font-bold uppercase tracking-wider {{ $item->status === 'pending' ? 'bg-amber-100/80 text-amber-700' : ($item->status === 'stored' ? 'bg-blue-100/80 text-blue-700' : 'bg-green-100/80 text-green-700') }}">
                                            {{ $item->name }}
                                        </span>
                                    </h3>
                                    @if($latestMessage)
                                        <span class="text-xs font-bold {{ $hasUnread ? 'text-blue-600' : 'text-gray-400' }} shrink-0">
                                            {{ $latestMessage->created_at->isToday() ? $latestMessage->created_at->format('H:i') : $latestMessage->created_at->format('d M') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-sm truncate font-medium {{ $hasUnread ? 'text-gray-900' : 'text-gray-500' }}">
                                        @if($latestMessage)
                                            @if($latestMessage->sender_id === Auth::id())
                                                <span class="text-gray-400 font-bold mr-1">Anda:</span>
                                            @endif
                                            {{ Str::limit($latestMessage->message, 80) }}
                                        @else
                                            <span class="italic font-normal text-gray-400">Belum ada percakapan. Mulai obrolan sekarang.</span>
                                        @endif
                                    </p>
                                    @if($hasUnread)
                                        <span class="shrink-0 w-5 h-5 rounded-full bg-blue-600 text-white text-[0.65rem] font-bold flex items-center justify-center shadow-md shadow-blue-500/30">
                                            {{ $item->messages->where('is_read', false)->where('sender_id', '!=', Auth::id())->count() }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center text-gray-500 flex flex-col items-center justify-center">
                    <div class="w-20 h-20 rounded-full bg-gray-100 border-4 border-white flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-1">Belum Ada Percakapan</h3>
                    <p class="font-medium text-sm max-w-sm">Saat ini belum ada obrolan aktif terkait barang titipan manapun.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-inbox');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    const links = document.querySelectorAll('#chat-list > a');
                    links.forEach(link => {
                        const text = link.innerText.toLowerCase();
                        link.style.display = text.includes(term) ? 'flex' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>
