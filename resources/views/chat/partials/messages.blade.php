@foreach($messages as $msg)
    @php
        $isSender = $msg->sender_id === Auth::id();
    @endphp
    <div class="flex flex-col {{ $isSender ? 'items-end' : 'items-start' }}">
        <div class="flex items-center gap-2 mb-1 px-1">
            <span class="text-[0.65rem] font-black uppercase text-gray-500 tracking-wider">
                {{ $isSender ? 'Anda' : ($msg->sender->role === 'admin' ? 'Admin' : $msg->sender->name) }}
            </span>
            <span class="text-[0.65rem] font-bold text-gray-400">{{ $msg->created_at->format('H:i') }}</span>
        </div>
        <div
            class="max-w-[85%] md:max-w-[75%] px-4 py-3 text-sm md:text-[0.9375rem] shadow-md relative group font-medium {{ $isSender ? 'bg-slate-800 text-white rounded-2xl rounded-tr-sm' : 'bg-white text-gray-800 rounded-2xl rounded-tl-sm border border-gray-100' }}">
            {!! nl2br(e($msg->message)) !!}
        </div>
    </div>
@endforeach