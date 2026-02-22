<x-app-layout>
    <div class="max-w-4xl mx-auto md:py-8 lg:px-8 md:h-[calc(100vh-6rem)] h-[calc(100vh-4rem)] flex flex-col">
        <!-- Make the chat card take full height on mobile, and fixed height on desktop -->
        <div class="glass-card flex flex-col w-full h-full md:rounded-2xl border border-white shadow-2xl overflow-hidden bg-white/40"
            style="backdrop-filter: blur(16px);">

            <!-- Header -->
            <div
                class="bg-white/60 backdrop-blur-md border-b border-white/50 px-6 py-4 flex items-center justify-between shrink-0 shadow-sm z-10">
                <div class="flex items-center gap-4">
                    <a href="{{ route('items.show', $item) }}"
                        class="p-2 rounded-full hover:bg-white/80 transition-colors text-gray-600 hover:text-gray-900 border border-transparent hover:border-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-indigo-200 border-2 border-white shadow-sm flex items-center justify-center text-blue-700 font-black text-lg">
                            {{ strtoupper(substr($item->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-base md:text-lg font-black text-gray-900 leading-none">{{ $item->name }}
                            </h2>
                            <p class="text-xs font-bold text-gray-500 mt-1">Penitip: <span
                                    class="text-gray-700">{{ $item->user->name }}</span></p>
                        </div>
                    </div>
                </div>
                <span
                    class="px-3 py-1.5 rounded-full text-[0.7rem] font-black uppercase tracking-wider {{ $item->status === 'pending' ? 'bg-amber-100 text-amber-700 border-amber-200' : ($item->status === 'stored' ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-green-100 text-green-700 border-green-200') }} border shadow-sm">
                    {{ ucfirst($item->status) }}
                </span>
            </div>

            <!-- Chat Messages Area -->
            <!-- flex-1 and overflow-y-auto makes this container scrollable -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4 relative bg-gray-50/30" id="chat-messages"
                style="scroll-behavior: smooth;">

                @forelse($messages as $msg)
                    @php
                        $isSender = $msg->sender_id === Auth::id();
                    @endphp
                    <div class="flex flex-col {{ $isSender ? 'items-end' : 'items-start' }}">
                        <div class="flex items-center gap-2 mb-1 px-1">
                            <span class="text-[0.65rem] font-black uppercase text-gray-500 tracking-wider">
                                {{ $isSender ? 'Anda' : ($msg->sender->role === 'admin' ? 'Admin' : $msg->sender->name) }}
                            </span>
                            <span
                                class="text-[0.65rem] font-bold text-gray-400">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                        <div
                            class="max-w-[85%] md:max-w-[75%] px-4 py-3 text-sm md:text-[0.9375rem] shadow-md relative group font-medium {{ $isSender ? 'bg-slate-800 text-white rounded-2xl rounded-tr-sm' : 'bg-white text-gray-800 rounded-2xl rounded-tl-sm border border-gray-100' }}">
                            {!! nl2br(e($msg->message)) !!}
                        </div>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center text-gray-400 space-y-3">
                        <div
                            class="w-16 h-16 rounded-full bg-white/60 border border-white flex items-center justify-center shadow-inner">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-500">Belum ada pesan. Mulai percakapan sekarang!</p>
                    </div>
                @endforelse
            </div>

            <!-- Chat Input form -->
            <div
                class="p-4 bg-white/80 backdrop-blur-xl border-t border-white/50 shrink-0 shadow-[0_-4px_15px_rgba(0,0,0,0.03)] z-10">
                <form action="{{ route('chat.store', $item) }}" method="POST"
                    class="flex items-end gap-3 max-w-4xl mx-auto" id="chat-form">
                    @csrf
                    <div class="relative flex-1">
                        <textarea name="message" id="message-input" rows="1"
                            class="w-full rounded-2xl border-gray-200 bg-white shadow-inner focus:border-slate-800 focus:ring focus:ring-slate-200 focus:bg-white transition-all resize-none py-3 pl-4 pr-12 text-sm md:text-base font-semibold text-gray-800"
                            placeholder="Ketik pesan..." required
                            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"
                            style="max-height: 120px; outline: none;"></textarea>
                    </div>
                    <button type="submit"
                        class="shrink-0 w-12 h-12 rounded-full bg-slate-800 hover:bg-slate-900 text-white flex items-center justify-center transition-transform hover:scale-105 shadow-lg shadow-slate-900/20 mb-px">
                        <svg class="w-5 h-5 translate-x-0.5 -translate-y-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Auto-scroll to bottom of chat area securely
        document.addEventListener("DOMContentLoaded", function () {
            const chatBox = document.getElementById("chat-messages");
            if (chatBox) {
                // Scroll immediately
                chatBox.scrollTop = chatBox.scrollHeight;

                // Allow a slight delay for fonts/styles to render
                setTimeout(() => {
                    chatBox.scrollTop = chatBox.scrollHeight;
                }, 100);
            }

            // Also submit form on Enter (but allow Shift+Enter for new line)
            const msgInput = document.getElementById("message-input");
            msgInput.addEventListener("keydown", function (e) {
                if (e.key === "Enter" && !e.shiftKey) {
                    e.preventDefault();
                    if (this.value.trim() !== '') {
                        document.getElementById("chat-form").submit();
                    }
                }
            });
        });
    </script>
</x-app-layout>