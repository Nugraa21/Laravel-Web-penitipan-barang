<x-app-layout>
    <div class="max-w-4xl mx-auto md:py-8 lg:px-8 md:h-[calc(100vh-6rem)] h-[calc(100vh-4rem)] flex flex-col">
        <div class="glass-card flex flex-col w-full h-full md:rounded-2xl border border-white shadow-2xl overflow-hidden bg-white/40"
            style="backdrop-filter: blur(16px);">

            <!-- Header -->
            <div
                class="bg-white/60 backdrop-blur-md border-b border-white/50 px-6 py-4 flex items-center justify-between shrink-0 shadow-sm z-10">
                <div class="flex items-center gap-4">
                    <a href="{{ Auth::user()->role === 'admin' ? route('chat.inbox') : route('dashboard') }}"
                        class="p-2 rounded-full hover:bg-white/80 transition-colors text-gray-600 hover:text-gray-900 border border-transparent hover:border-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 border-2 border-white shadow-sm flex items-center justify-center text-white font-black text-lg">
                            {{ strtoupper(substr($chatUser->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-base md:text-lg font-black text-gray-900 leading-none">{{ $chatUser->name }}
                            </h2>
                            <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">
                                {{ $chatUser->role === 'admin' ? __('Customer Support') : __('Pelanggan') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Messages Area -->
            <!-- flex-col-reverse ensures newest at bottom when order is DESC -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6 relative bg-gray-50/30 flex flex-col-reverse gap-4"
                id="chat-messages">
                @include('chat.partials.messages', ['messages' => $messages])

                @if($messages->isEmpty())
                    <div id="empty-chat-state"
                        class="h-full flex flex-col items-center justify-center text-gray-400 space-y-3 mt-auto mb-auto py-10">
                        <div
                            class="w-16 h-16 rounded-full bg-white/60 border border-white flex items-center justify-center shadow-inner">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-500">{{ __('Belum ada pesan. Mulai percakapan sekarang!') }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Context Item Selection (Shortcut) -->
            <div id="context-item-container"
                class="{{ $contextItem ? '' : 'hidden' }} px-6 py-3 bg-blue-50 border-t border-blue-100 flex items-center justify-between animate-in fade-in slide-in-from-bottom-2">
                <div class="flex items-center gap-3">
                    <div id="context-item-photo-wrapper"
                        class="w-10 h-10 rounded-lg bg-white border border-blue-200 flex items-center justify-center overflow-hidden shadow-sm">
                        @if($contextItem && $contextItem->photo_path)
                            <img src="{{ Storage::url($contextItem->photo_path) }}" class="w-full h-full object-cover"
                                id="context-item-img">
                        @else
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                id="context-item-svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-black text-blue-600 uppercase tracking-widest">
                            {{ __('Menyertakan Item Konteks') }}</p>
                        <h4 class="text-xs font-bold text-gray-900" id="context-item-name">
                            {{ $contextItem->name ?? '' }}
                        </h4>
                    </div>
                </div>
                <button type="button" onclick="removeContext()"
                    class="p-1.5 hover:bg-blue-100 rounded-full text-blue-400 hover:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Chat Input form -->
            <div
                class="p-4 bg-white/80 backdrop-blur-xl border-t border-white/50 shrink-0 shadow-[0_-4px_15px_rgba(0,0,0,0.03)] z-10">
                <form action="{{ route('chat.store', $chatUser->id) }}" method="POST"
                    class="flex items-end gap-3 max-w-4xl mx-auto" id="chat-form">
                    @csrf
                    <input type="hidden" name="item_id" id="context-item-id" value="{{ $contextItem->id ?? '' }}">

                    <!-- Mention Item Button -->
                    <button type="button" onclick="openItemModal()" title="Sertakan Barang ke dalam obrolan"
                        class="shrink-0 h-12 px-3 md:px-4 rounded-2xl bg-white border border-gray-200 text-gray-600 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50/50 flex items-center justify-center gap-2 transition-all group mb-px shadow-sm">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span
                            class="font-bold text-sm whitespace-nowrap hidden sm:inline">{{ __('Pilih Barang') }}</span>
                    </button>

                    <div class="relative flex-1">
                        <textarea name="message" id="message-input" rows="1"
                            class="w-full rounded-2xl border-gray-200 bg-white shadow-inner focus:border-slate-800 focus:ring focus:ring-slate-200 focus:bg-white transition-all resize-none py-3 pl-4 pr-12 text-sm md:text-base font-semibold text-gray-800"
                            placeholder="{{ __('Ketik pesan...') }}" required
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

    <!-- Item Selection Modal -->
    <div id="item-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeItemModal()"></div>
        <div
            class="glass-card w-full max-w-lg bg-white border border-white shadow-2xl rounded-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-200">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div>
                    <h3 class="font-black text-gray-900 uppercase tracking-wider">{{ __('Sertakan Barang') }}</h3>
                    <p class="text-[0.65rem] font-bold text-gray-500 uppercase mt-0.5">
                        {{ __('Pilih barang sebagai konteks obrolan') }}</p>
                </div>
                <button onclick="closeItemModal()"
                    class="p-2 rounded-full hover:bg-gray-200 text-gray-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-3 border-b border-gray-100 bg-gray-50/30">
                <div class="relative">
                    <input type="text" id="item-search-input" onkeyup="filterItems()"
                        placeholder="{{ __('Cari nama barang atau nomor resi...') }}"
                        class="w-full pl-10 pr-4 py-2 text-sm font-bold bg-white border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-all shadow-sm">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="max-h-[60vh] overflow-y-auto p-3 space-y-2" id="item-list">
                @forelse($userItems as $item)
                    <button type="button"
                        onclick="selectItem({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ $item->photo_path ? Storage::url($item->photo_path) : '' }}')"
                        class="item-entry w-full flex items-center gap-4 p-4 hover:bg-blue-50 transition-all rounded-xl text-left border border-white/50 hover:border-blue-100 group"
                        data-name="{{ strtolower($item->name) }}" data-token="{{ strtolower($item->receipt_token) }}">
                        <div class="w-14 h-14 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden shrink-0">
                            @if($item->photo_path)
                                <img src="{{ Storage::url($item->photo_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-gray-900 truncate group-hover:text-blue-600 transition-colors">
                                {{ $item->name }}
                            </h4>
                            <p class="text-[0.65rem] font-bold text-gray-500 mt-0.5">TOKEN: <span
                                    class="text-blue-500">{{ $item->receipt_token }}</span></p>
                            @if(in_array(Auth::user()->role, ['admin', 'super_admin']) && $item->user)
                                <p class="text-[0.65rem] font-bold text-gray-400 mt-0.5">{{ __('Pemilik') }}: <span
                                        class="text-indigo-500">{{ $item->user->name }}</span></p>
                            @endif
                        </div>
                        <div
                            class="opacity-0 group-hover:opacity-100 transition-opacity w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                    </button>
                @empty
                    <div class="py-10 text-center text-gray-400">
                        <p class="text-sm font-bold italic">{{ __('Tidak ada barang yang terdaftar.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function removeContext() {
            document.getElementById('context-item-container').classList.add('hidden');
            document.getElementById('context-item-id').value = '';
        }

        function filterItems() {
            const query = document.getElementById('item-search-input').value.toLowerCase();
            const items = document.querySelectorAll('.item-entry');
            const emptyState = document.getElementById('modal-empty-state');
            let visibleCount = 0;

            items.forEach(item => {
                const name = item.getAttribute('data-name');
                const token = item.getAttribute('data-token');

                if (name.includes(query) || token.includes(query)) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (visibleCount === 0) {
                if (!emptyState) {
                    const list = document.getElementById('item-list');
                    list.insertAdjacentHTML('beforeend', `
                        <div id="modal-empty-state" class="py-10 text-center text-gray-400">
                            <p class="text-sm font-bold italic">{{ __("Tidak ada hasil pencarian.") }}</p>
                        </div>
                    `);
                }
            } else {
                if (emptyState) emptyState.remove();
            }
        }

        function openItemModal() {
            document.getElementById('item-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeItemModal() {
            document.getElementById('item-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function selectItem(id, name, photoUrl) {
            const container = document.getElementById('context-item-container');
            const hiddenInput = document.getElementById('context-item-id');
            const nameEl = document.getElementById('context-item-name');
            const photoWrapper = document.getElementById('context-item-photo-wrapper');

            hiddenInput.value = id;
            nameEl.innerText = name;

            if (photoUrl) {
                photoWrapper.innerHTML = `<img src="${photoUrl}" class="w-full h-full object-cover" id="context-item-img">`;
            } else {
                photoWrapper.innerHTML = `
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="context-item-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                `;
            }

            container.classList.remove('hidden');
            closeItemModal();
        }

        function deleteMessage(messageId) {
            if (confirm('{{ __("Yakin ingin menghapus pesan ini?") }}')) {
                fetch(`/chat/message/${messageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const msgElement = document.getElementById(`message-${messageId}`);
                            if (msgElement) {
                                msgElement.remove();
                            }
                        } else {
                            alert(data.message || '{{ __("Gagal menghapus pesan.") }}');
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting message:', error);
                        alert('{{ __("Terjadi kesalahan sistem.") }}');
                    });
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const msgInput = document.getElementById("message-input");
            if (msgInput) {
                msgInput.addEventListener("keydown", function (e) {
                    if (e.key === "Enter" && !e.shiftKey) {
                        e.preventDefault();
                        if (this.value.trim() !== '') {
                            document.getElementById("chat-form").submit();
                        }
                    }
                });
            }

            // Real-time polling
            let lastMessageId = {{ $messages->first()->id ?? 0 }}; // First is newest because of DESC
            setInterval(() => {
                fetch(`{{ route('chat.poll', $chatUser->id) }}?last_id=${lastMessageId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.html) {
                            const chatBox = document.getElementById("chat-messages");
                            const emptyState = document.getElementById('empty-chat-state');
                            if (emptyState) emptyState.remove();

                            chatBox.insertAdjacentHTML('afterbegin', data.html);
                            lastMessageId = data.last_id;
                        }
                    })
                    .catch(err => console.error('Polling error:', err));
            }, 3000);
        });
    </script>
</x-app-layout>