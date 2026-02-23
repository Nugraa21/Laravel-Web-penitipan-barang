@if (auth()->check() && auth()->user()->role === 'super_admin')
    <x-superadmin-layout>
        @if (isset($header))
            <x-slot name="header">
                {{ $header }}
            </x-slot>
        @endif
        {{ $slot }}
    </x-superadmin-layout>
@else
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $app_settings['app_name'] ?? config('app.name', 'PenitipanApp') }}</title>

    <!-- Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Glass Toast Notification */
        .glass-toast {
            position: fixed;
            bottom: -100px;
            right: 2rem;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            border-radius: 16px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            z-index: 9999;
            transition: bottom 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-weight: 700;
            color: #1f2937;
        }

        .glass-toast.show {
            bottom: 2rem;
        }

        .toast-success-icon {
            color: var(--c-success);
        }

        .toast-error-icon {
            color: var(--c-danger);
        }

        .toast-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Main layout liquid background */
        .app-liquid-bg {
            background: linear-gradient(135deg, #fdfbf7 0%, #faedce 100%);
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .app-blob-1 {
            position: fixed;
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(251, 211, 141, 0.5) 0%, rgba(251, 211, 141, 0) 70%);
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
            animation: float 15s ease-in-out infinite alternate;
            pointer-events: none;
        }

        .app-blob-2 {
            position: fixed;
            bottom: -20%;
            right: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.2) 0%, rgba(52, 211, 153, 0) 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 20s ease-in-out infinite alternate-reverse;
            pointer-events: none;
        }

        @keyframes float {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-50px) scale(1.1);
            }
        }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col app-liquid-bg">
    <!-- Global Blobs -->
    <div class="app-blob-1"></div>
    <div class="app-blob-2"></div>

    <div class="flex-grow flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <div class="glass-panel sticky top-16 z-40">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>

    <footer class="mt-auto glass-panel border-t border-white/40 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
            <div class="flex items-center gap-2.5">
                <div
                    class="p-1.5 rounded-xl bg-gradient-to-br from-amber-200 to-amber-400 shadow-sm border border-white">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span
                    class="font-black text-gray-800 uppercase tracking-wider text-xl">{{ $app_settings['app_name'] ?? 'PenitipanApp' }}</span>
            </div>
            <div class="text-gray-600 font-bold text-sm uppercase flex items-center gap-1.5">
                <span>By</span>
                <span class="bg-gray-800 text-white rounded-md px-2 py-0.5 shadow-sm">Nugra21</span>
            </div>
        </div>
    </footer>

    <!-- Glass Toast Notification System -->
    <!-- Glass Toast Notification System -->
    <div id="glass-toast" class="glass-toast">
        <div id="toast-icon-wrapper" class="toast-icon">
            <svg id="toast-icon-svg" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path id="toast-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div id="toast-message" class="font-medium text-sm"></div>
        <button onclick="document.getElementById('glass-toast').classList.remove('show'); window.event.stopPropagation();"
            style="margin-left: auto; background: none; border: none; cursor: pointer; color: #9ca3af; transition: color 0.2s;"
            onmouseover="this.style.color='#1f2937'" onmouseout="this.style.color='#9ca3af'">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Notification Sound -->
    <audio id="notification-sound" preload="auto">
        <source src="data:audio/mp3;base64,//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq" type="audio/mpeg">
    </audio>

    <!-- Floating Chat Button (FAB) -->
    @auth
    <a href="{{ Auth::user()->role === 'admin' ? route('chat.inbox') : route('chat.index') }}" 
       id="floating-chat-btn"
       class="fixed bottom-6 right-6 z-[9000] w-14 h-14 bg-slate-800 hover:bg-slate-900 text-white rounded-full flex items-center justify-center shadow-lg shadow-slate-900/20 transition-transform hover:scale-105 group border-2 border-white/50"
       title="Pesan">
        <svg class="w-6 h-6 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <span id="fab-badge" class="absolute -top-1.5 -right-1.5 w-6 h-6 bg-red-500 text-white text-[0.65rem] font-black rounded-full flex items-center justify-center border-2 border-white shadow-sm transition-all duration-300 {{ (isset($unread_chats_count) && $unread_chats_count > 0) ? 'scale-100' : 'scale-0' }}">
            {{ (isset($unread_chats_count) && $unread_chats_count > 9) ? '9+' : ($unread_chats_count ?? 0) }}
        </span>
    </a>
    @endauth

    <script>
        function showToast(message, type = 'success', onClickUrl = null) {
            const toast = document.getElementById('glass-toast');
            const msgEl = document.getElementById('toast-message');
            const iconWrapper = document.getElementById('toast-icon-wrapper');
            const iconPath = document.getElementById('toast-icon-path');

            msgEl.innerHTML = message;
            iconWrapper.className = 'toast-icon';
            
            if (type === 'success') {
                iconWrapper.classList.add('toast-success-icon');
                iconPath.setAttribute('d', 'M5 13l4 4L19 7');
            } else if (type === 'error') {
                iconWrapper.classList.add('toast-error-icon');
                iconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            } else if (type === 'chat') {
                iconWrapper.classList.add('text-blue-500');
                iconPath.setAttribute('d', 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z');
            }

            if (onClickUrl) {
                toast.style.cursor = 'pointer';
                toast.onclick = function(e) {
                    if(!e.target.closest('button')) {
                        window.location.href = onClickUrl;
                    }
                };
            } else {
                toast.style.cursor = 'default';
                toast.onclick = null;
            }

            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success') || session('error'))
                @php
                    $sessionType = session('success') ? 'success' : 'error';
                    $sessionMessage = session('success') ?? session('error');
                @endphp
                setTimeout(() => {
                    showToast(`{!! addslashes($sessionMessage) !!}`, '{{ $sessionType }}');
                }, 100);
            @endif

            @auth
            // Global Notification Polling
            let currentUnreadCount = {{ $unread_chats_count ?? 0 }};
            const chatUrl = "{{ Auth::user()->role === 'admin' ? route('chat.inbox') : route('chat.index') }}";
            
            setInterval(() => {
                fetch('{{ route('chat.notifications') }}')
                    .then(res => res.json())
                    .then(data => {
                        const newCount = data.count;
                        
                        // Update FAB badge in DOM
                        const fabBadge = document.getElementById('fab-badge');
                        if (fabBadge) {
                            if (newCount > 0) {
                                fabBadge.textContent = newCount > 9 ? '9+' : newCount;
                                fabBadge.classList.replace('scale-0', 'scale-100');
                                fabBadge.classList.add('animate-bounce');
                                setTimeout(() => fabBadge.classList.remove('animate-bounce'), 1000);
                            } else {
                                fabBadge.classList.replace('scale-100', 'scale-0');
                            }
                        }
                        
                        // If there is a new message that we haven't seen yet
                        if (newCount > currentUnreadCount && data.latest) {
                            const sender = data.latest.sender_name;
                            const msg = data.latest.message;
                            
                            // Try playing sound silently
                            const audio = document.getElementById('notification-sound');
                            if(audio) audio.play().catch(e => {}); 
                            
                            showToast(`<div><p class="font-black text-gray-900 mb-0.5">${sender}</p><p class="text-[0.7rem] leading-tight text-gray-500 font-semibold">${msg}</p></div>`, 'chat', chatUrl);
                        }
                        
                        currentUnreadCount = newCount;
                    })
                    .catch(e => console.error('Polling error:', e));
            }, 5000);
            @endauth
        });
    </script>

    <!-- Universal Image Lightbox -->
    <div id="glass-lightbox"
        class="fixed inset-0 z-[10000] hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 cursor-pointer" onclick="closeLightbox()"></div>
        <button
            class="absolute top-4 right-4 z-10 p-2 text-white bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-md transition-all"
            onclick="closeLightbox()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="relative max-w-5xl max-h-[90vh] p-2 overflow-hidden mx-4 scale-95 transition-transform duration-300"
            id="lightbox-content">
            <img id="lightbox-img" src="" alt="Zoomed Image"
                class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl border border-white/20">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lightbox functionality
            const zoomableImages = document.querySelectorAll('.zoomable-image');
            zoomableImages.forEach(img => {
                img.addEventListener('click', function () {
                    openLightbox(this.src);
                });
            });
        });

        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('glass-lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxContent = document.getElementById('lightbox-content');

            lightboxImg.src = imageSrc;

            // Show lightbox
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');

            // Trigger animation
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
                lightbox.classList.add('opacity-100');
                lightboxContent.classList.remove('scale-95');
                lightboxContent.classList.add('scale-100');
            }, 10);

            // Prevent scrolling on body
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('glass-lightbox');
            const lightboxContent = document.getElementById('lightbox-content');

            // Revert animation
            lightbox.classList.remove('opacity-100');
            lightbox.classList.add('opacity-0');
            lightboxContent.classList.remove('scale-100');
            lightboxContent.classList.add('scale-95');

            // Hide lightbox after animation finishes
            setTimeout(() => {
                lightbox.classList.remove('flex');
                lightbox.classList.add('hidden');
                // Restore body scrolling
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Close on esc key
        document.addEventListener('keydown', function (event) {
            if (event.key === "Escape") {
                const lightbox = document.getElementById('glass-lightbox');
                if (!lightbox.classList.contains('hidden')) {
                    closeLightbox();
                }
            }
        });
    </script>
</body>

</html>
@endif