<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PenitipanApp') }}</title>

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
                <span class="font-black text-gray-800 uppercase tracking-wider text-xl">Penitipan<span
                        class="text-amber-500">App</span></span>
            </div>
            <div class="text-gray-600 font-bold text-sm uppercase flex items-center gap-1.5">
                <span>By</span>
                <span class="bg-gray-800 text-white rounded-md px-2 py-0.5 shadow-sm">Nugra21</span>
            </div>
        </div>
    </footer>

    <!-- Glass Toast Notification System -->
    @if(session('success') || session('error'))
        @php
            $type = session('success') ? 'success' : 'error';
            $message = session('success') ?? session('error');
        @endphp
        <div id="glass-toast" class="glass-toast">
            <div class="toast-icon toast-{{ $type }}-icon">
                @if($type === 'success')
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                @else
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                @endif
            </div>
            <div class="font-medium text-sm">{!! $message !!}</div>
            <button onclick="document.getElementById('glass-toast').classList.remove('show')"
                style="margin-left: auto; background: none; border: none; cursor: pointer; color: #9ca3af; transition: color 0.2s;"
                onmouseover="this.style.color='#1f2937'" onmouseout="this.style.color='#9ca3af'">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toast = document.getElementById('glass-toast');

                // Show toast slightly after load for animation effect
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);

                // Auto hide after 5 seconds
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 5000);
            });
        </script>
    @endif

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
                img.addEventListener('click', function() {
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
        document.addEventListener('keydown', function(event) {
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