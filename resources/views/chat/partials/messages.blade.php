@foreach($messages as $msg)
    @php
        $isSender = $msg->sender_id === Auth::id();
    @endphp
    <div class="flex flex-col {{ $isSender ? 'items-end' : 'items-start' }}" id="message-{{ $msg->id }}">
        <div class="flex items-center gap-2 mb-1 px-1">
            <span class="text-[0.65rem] font-black uppercase text-gray-500 tracking-wider">
                {{ $isSender ? __('Anda') : (in_array($msg->sender->role, ['admin', 'super_admin']) ? __('Admin') : $msg->sender->name) }}
            </span>
            <span class="text-[0.65rem] font-bold text-gray-400">{{ $msg->created_at->format('H:i') }}</span>
        </div>

        <div class="max-w-[85%] md:max-w-[75%] space-y-2 relative group">
            @if($msg->item)
                <!-- Item Shortcut Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-3 shadow-sm flex items-center gap-3 mb-1">
                    <div
                        class="w-12 h-12 rounded-lg bg-white border border-blue-100 flex items-center justify-center shrink-0 overflow-hidden shadow-sm">
                        @if($msg->item->photo_path)
                            <img src="{{ Storage::url($msg->item->photo_path) }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-[0.65rem] font-black text-blue-600 uppercase tracking-widest leading-none mb-1">Shortcut
                            Item</p>
                        <h4 class="text-xs font-bold text-gray-900 truncate">{{ $msg->item->name }}</h4>
                        <p class="text-[0.6rem] font-bold text-gray-500 truncate">{{ $msg->item->receipt_token }}</p>
                    </div>
                </div>
            @endif

            <div class="relative group flex items-center gap-2 {{ $isSender ? 'flex-row-reverse' : 'flex-row' }}">
                <div
                    class="px-4 py-3 text-sm md:text-[0.9375rem] shadow-md relative font-medium {{ $isSender ? 'bg-slate-800 text-white rounded-2xl rounded-tr-sm' : 'bg-white text-gray-800 rounded-2xl rounded-tl-sm border border-gray-100' }}">
                    {!! nl2br(e($msg->message)) !!}
                </div>

                <!-- Delete Chat Button -->
                @if($isSender || in_array(Auth::user()->role, ['admin', 'super_admin']))
                    <button type="button" onclick="deleteMessage({{ $msg->id }})"
                        class="opacity-0 group-hover:opacity-100 transition-opacity p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full focus:outline-none"
                        title="{{ __('Hapus Pesan') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endforeach