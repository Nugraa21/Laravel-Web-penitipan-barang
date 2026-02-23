<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $app_settings['app_name'] ?? 'PenitipanApp' }} -
        {{ $app_settings['hero_title'] ?? 'Titip Barang Aman & Mudah' }}
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for FAQ interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        .hero-section {
            padding: 8rem 1rem 4rem 1rem;
            text-align: center;
            position: relative;
            background: transparent;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: clamp(3rem, 8vw, 5rem);
            font-weight: 900;
            color: var(--c-gray-900);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--c-primary), #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .hero-desc {
            font-size: clamp(1.125rem, 3vw, 1.25rem);
            color: var(--c-gray-600);
            margin-bottom: 3rem;
            font-weight: 500;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .nav-wrapper {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 50;
            background: var(--bg-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            padding: 1rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--c-gray-900);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title {
            font-size: clamp(2rem, 5vw, 2.75rem);
            font-weight: 800;
            text-align: center;
            color: var(--c-gray-900);
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            text-align: center;
            color: var(--c-gray-600);
            font-size: 1.125rem;
            max-width: 600px;
            margin: 0 auto 4rem auto;
            line-height: 1.6;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem 1rem 6rem 1rem;
            position: relative;
        }

        .glass-card {
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.8), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
            z-index: 0;
        }

        .glass-card>* {
            position: relative;
            z-index: 1;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.7);
        }

        .glass-card:hover::before {
            opacity: 1;
        }

        .feat-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, rgba(251, 211, 141, 0.8) 0%, rgba(251, 211, 141, 0.2) 100%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(217, 119, 6, 0.15);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover .feat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .feat-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--c-gray-900);
            margin-bottom: 1rem;
            letter-spacing: -0.01em;
        }

        .feat-desc {
            color: var(--c-gray-600);
            line-height: 1.6;
            font-weight: 500;
        }

        .btn-hero {
            padding: 1rem 2.5rem;
            font-size: 1.125rem;
            font-weight: 800;
            border-radius: 999px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-hero:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .btn-hero-primary {
            background: var(--c-primary);
            color: #000;
            box-shadow: 0 6px 20px -5px rgba(251, 211, 141, 0.6), 0 2px 4px -1px rgba(251, 211, 141, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn-hero-outline {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            color: var(--c-gray-800);
            box-shadow: var(--shadow-sm);
        }

        /* How to Use Steps - Premium Glass Timeline */
        .step-container {
            position: relative;
            padding: 2rem 0;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .step-container {
                grid-template-columns: repeat(4, 1fr);
            }

            .step-container::before {
                content: '';
                position: absolute;
                top: 5rem;
                /* Center behind the icon circles */
                left: 10%;
                right: 10%;
                height: 3px;
                background: linear-gradient(90deg,
                        rgba(251, 211, 141, 0) 0%,
                        rgba(251, 211, 141, 0.8) 20%,
                        rgba(251, 211, 141, 0.8) 80%,
                        rgba(251, 211, 141, 0) 100%);
                z-index: 0;
                border-radius: 4px;
            }
        }

        .step-item {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-item::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 24px;
            padding: 2px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(251, 211, 141, 0.2) 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .step-item:hover {
            transform: translateY(-12px) scale(1.02);
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 40px -10px rgba(217, 119, 6, 0.15);
        }

        .step-item:hover::after {
            opacity: 1;
        }

        .step-icon-wrapper {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #fff, #fef3c7);
            color: #d97706;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -4rem auto 1.5rem auto;
            box-shadow: 0 8px 20px rgba(217, 119, 6, 0.2), inset 0 2px 4px rgba(255, 255, 255, 0.8);
            border: 4px solid var(--bg-glass);
            position: relative;
            transition: transform 0.4s bounce;
        }

        .step-item:hover .step-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .step-icon-wrapper svg {
            width: 32px;
            height: 32px;
            filter: drop-shadow(0 2px 4px rgba(217, 119, 6, 0.3));
        }

        .step-number-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 24px;
            height: 24px;
            background: var(--c-gray-900);
            color: #fff;
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Pricing Area - Hostinger Style */
        .pricing-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            overflow: hidden;
            position: relative;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 2.5rem 2rem;
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .pricing-card.popular {
            border: 2px solid var(--c-primary);
            box-shadow: 0 20px 40px -10px rgba(217, 119, 6, 0.2);
            transform: scale(1.05);
            z-index: 10;
        }

        .pricing-card.popular:hover {
            transform: scale(1.05) translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(217, 119, 6, 0.25);
        }

        .pricing-card.popular::before {
            content: 'PALING LARIS';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, #d97706, #f59e0b);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.5rem 0;
            text-align: center;
            letter-spacing: 1px;
            z-index: 20;
        }

        .price-val {
            font-size: 3rem;
            font-weight: 900;
            color: var(--c-gray-900);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 0.25rem;
            margin: 1.5rem 0 0.5rem 0;
            line-height: 1;
        }

        .price-val span {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--c-gray-500);
            margin-top: 0.5rem;
        }

        .pricing-card.popular .price-val {
            color: #000;
        }

        .pricing-list-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #374151;
            font-size: 0.95rem;
            text-align: left;
            padding: 0.5rem 0;
        }

        .pricing-list-icon {
            color: #10b981;
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
        }

        .pricing-card.popular .btn-hero {
            background: var(--c-primary);
            color: #000;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.3);
        }

        .pricing-card:not(.popular) .btn-hero {
            background: transparent;
            color: var(--c-primary);
            border: 2px solid var(--c-primary);
            box-shadow: none;
        }

        .pricing-card:not(.popular) .btn-hero:hover {
            background: var(--c-primary);
            color: #000;
        }

        .price-val {
            font-size: 3rem;
            font-weight: 900;
            color: var(--c-gray-900);
            margin: 1.5rem 0 0.5rem 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            line-height: 1;
        }

        .price-val span {
            font-size: 1.25rem;
            margin-top: 0.25rem;
            margin-right: 0.25rem;
            color: var(--c-gray-500);
        }

        /* Location / Image Frame */
        .image-glass-frame {
            padding: 1rem;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-xl);
            transform: rotate(2deg);
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .image-glass-frame:hover {
            transform: rotate(0deg) scale(1.02);
        }

        .image-glass-frame img {
            border-radius: 20px;
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 16/10;
        }

        /* Full Background Blobs */
        .app-liquid-bg {
            background: linear-gradient(135deg, #fdfbf7 0%, #fef3c7 100%);
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .app-blob-1,
        .app-blob-2,
        .app-blob-3 {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
            animation: float 20s ease-in-out infinite alternate;
        }

        .app-blob-1 {
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(251, 211, 141, 0.6) 0%, rgba(251, 211, 141, 0) 70%);
        }

        .app-blob-2 {
            top: 40%;
            right: -20%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.15) 0%, rgba(52, 211, 153, 0) 70%);
            animation-duration: 25s;
            animation-direction: alternate-reverse;
        }

        .app-blob-3 {
            bottom: -10%;
            left: 10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.15) 0%, rgba(96, 165, 250, 0) 70%);
            animation-duration: 30s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(5%, 5%) scale(1.1);
            }

            100% {
                transform: translate(-5%, -5%) scale(0.9);
            }
        }

        .animate-float-slow {
            animation: floatUpDown 6s ease-in-out infinite;
        }

        .animate-float-delay-1 {
            animation: floatUpDown 6s ease-in-out 1s infinite;
        }

        .animate-float-delay-2 {
            animation: floatUpDown 6s ease-in-out 2s infinite;
        }

        @keyframes floatUpDown {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .content-layer {
            position: relative;
            z-index: 10;
        }
    </style>
</head>

<body class="antialiased app-liquid-bg text-gray-800">
    <div class="app-blob-1"></div>
    <div class="app-blob-2"></div>
    <div class="app-blob-3"></div>

    @if(!empty(\App\Helpers\SettingHelper::get_localized('promo_text')))
        <!-- Top Promo Banner -->
        <div class="bg-amber-100/80 backdrop-blur-md relative z-50">
            <div class="max-w-7xl mx-auto py-2.5 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center flex-wrap gap-2 text-center">
                    <span class="flex p-1 rounded-lg bg-amber-200/50">
                        <svg class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </span>
                    <p class="font-bold text-amber-800 text-xs sm:text-sm tracking-wide">
                        {{ \App\Helpers\SettingHelper::get_localized('promo_text') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <nav class="nav-wrapper">
        <div class="container mx-auto px-4 nav-inner max-w-7xl">
            <a href="/" class="nav-brand" style="text-decoration: none;">
                <div
                    style="background: linear-gradient(135deg, var(--c-primary) 0%, #fbbf24 100%); padding: 0.5rem; border-radius: 12px; box-shadow: 0 4px 10px rgba(251, 211, 141, 0.4); display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 24px; height: 24px; color: #fff;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <span>{{ $app_settings['app_name'] ?? 'PenitipanApp' }}</span>
                <span>{{ \App\Helpers\SettingHelper::get_localized('app_name') ?? 'PenitipanApp' }}</span>
            </a>
            <div class="hidden md:flex items-center gap-6 font-bold text-gray-600 text-sm tracking-wide uppercase">
                <a href="#cara-kerja" class="hover:text-amber-600 transition-colors">Cara Kerja</a>
                <a href="#harga" class="hover:text-amber-600 transition-colors">Harga</a>
                <a href="#lokasi" class="hover:text-amber-600 transition-colors">Lokasi</a>
                <a href="#faq" class="hover:text-amber-600 transition-colors">FAQ</a>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <!-- Language Switcher -->
                <div class="relative group" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center gap-1 font-bold text-gray-600 hover:text-amber-600 transition-colors bg-white/50 px-3 py-1.5 rounded-lg border border-gray-200 backdrop-blur-sm shadow-sm"
                        style="font-size: 0.875rem;">
                        @php $currentLang = session('locale', str_replace('_', '-', app()->getLocale())); @endphp
                        @if($currentLang == 'en')
                            🇬🇧 EN
                        @elseif($currentLang == 'ja')
                            🇯🇵 JA
                        @else
                            🇮🇩 ID
                        @endif
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown -->
                    <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('lang.switch', 'id') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 font-medium {{ $currentLang == 'id' ? 'bg-amber-50 text-amber-600' : '' }}">
                            🇮🇩 Indonesia
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 font-medium {{ $currentLang == 'en' ? 'bg-amber-50 text-amber-600' : '' }}">
                            🇬🇧 English
                        </a>
                        <a href="{{ route('lang.switch', 'ja') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 font-medium {{ $currentLang == 'ja' ? 'bg-amber-50 text-amber-600' : '' }}">
                            🇯🇵 日本語
                        </a>
                    </div>
                </div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-hero btn-hero-primary"
                            style="padding: 0.5rem 1.5rem; font-size: 0.875rem;">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-outline hidden sm:flex"
                            style="padding: 0.5rem 1.5rem; font-size: 0.875rem;">{{ \App\Helpers\SettingHelper::get_localized('login_btn_text', 'Masuk') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-hero btn-hero-primary"
                                style="padding: 0.5rem 1.5rem; font-size: 0.875rem;">{{ \App\Helpers\SettingHelper::get_localized('register_btn_text', 'Daftar Gratis') }}</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="content-layer">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container mx-auto px-4 hero-content">
                @if(!empty(\App\Helpers\SettingHelper::get_localized('promo_text')))
                    <p
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 border border-amber-300 shadow-sm text-sm font-bold text-amber-700 mb-6 backdrop-blur-md">
                        <span class="relative flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                        </span>
                        {{ \App\Helpers\SettingHelper::get_localized('promo_text') }}
                    </p>
                @endif
                <h1 class="hero-title">
                    <span>{{ \App\Helpers\SettingHelper::get_localized('hero_title') ?? 'Titip Barang Tenang & Mudah' }}</span>
                </h1>
                <p class="hero-desc">
                    {{ \App\Helpers\SettingHelper::get_localized('hero_description') ?? 'Jalan-jalan makin bebas tanpa beban bawaan. Fasilitas lengkap, dapatkan Struk Digital QR Code seketika, dan lacak status pesanan realtime.' }}
                </p>

                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">
                        Mulai Titip Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="#cara-kerja" class="btn-hero btn-hero-outline">Pelajari Lebih Lanjut</a>
                </div>

                <!-- Floating Stats Badges -->
                <div style="display: flex; gap: 2.5rem; justify-content: center; margin-top: 6rem; padding-top: 4rem; flex-wrap: wrap;"
                    class="border-t border-gray-300/30 relative z-20">
                    <div class="glass-card flex flex-col items-center animate-float-delay-1"
                        style="min-width: 220px; padding: 2rem 1.5rem; border-color: rgba(217, 119, 6, 0.3);">
                        <h4
                            style="font-size: 2.5rem; font-weight: 900; color: var(--c-primary); margin-bottom: 0; line-height: 1; text-shadow: 0 2px 4px rgba(217, 119, 6, 0.2);">
                            Struk</h4>
                        <p
                            style="color: var(--c-gray-700); font-weight: 800; font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: -0.01em;">
                            Digital QR Code</p>
                    </div>
                    <div class="glass-card flex flex-col items-center animate-float-slow"
                        style="min-width: 220px; padding: 2rem 1.5rem; box-shadow: 0 20px 40px -10px rgba(217, 119, 6, 0.15); background: rgba(255,255,255,0.7); transform: translateY(-10px);">
                        <h4
                            style="font-size: 2.5rem; font-weight: 900; color: #d97706; margin-bottom: 0; line-height: 1; text-shadow: 0 2px 4px rgba(217, 119, 6, 0.3);">
                            24/7</h4>
                        <p
                            style="color: #92400e; font-weight: 800; font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: -0.01em;">
                            Aman Terjaga</p>
                    </div>
                    <div class="glass-card flex flex-col items-center animate-float-delay-2"
                        style="min-width: 220px; padding: 2rem 1.5rem; border-color: rgba(16, 185, 129, 0.3);">
                        <h4
                            style="font-size: 2.5rem; font-weight: 900; color: #10b981; margin-bottom: 0; line-height: 1; text-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);">
                            Live</h4>
                        <p
                            style="color: #047857; font-weight: 800; font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: -0.01em;">
                            Chat Internal</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How it Works Section -->
        <section id="cara-kerja" class="py-20">
            <div class="container mx-auto px-4 max-w-7xl">
                <h2 class="section-title">Semudah Menghitung 1, 2, 3</h2>
                <p class="section-subtitle">Proses titip barang digital kami didesain agar Anda tidak perlu mengantre
                    lama. Semua bisa disiapkan dari genggaman Anda sebelum tiba di lokasi.</p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 step-container mt-12">
                    <div class="step-item group">
                        <div class="step-number-badge">1</div>
                        <div class="step-icon-wrapper">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-amber-700 transition-colors">
                            Buat Akun</h3>
                        <p class="text-gray-600 text-sm font-medium leading-relaxed">Daftar gratis melalui website kami
                            hanya dalam 30 detik. Login untuk mengakses dashboard pintar Anda.</p>
                    </div>

                    <div class="step-item group">
                        <div class="step-number-badge">2</div>
                        <div class="step-icon-wrapper">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-amber-700 transition-colors">
                            Input Barang</h3>
                        <p class="text-gray-600 text-sm font-medium leading-relaxed">Klik "+ Titip Barang", isi
                            deskripsi, estimasi jaminan, lalu foto barang Anda langsung dari HP.</p>
                    </div>

                    <div class="step-item group">
                        <div class="step-number-badge">3</div>
                        <div class="step-icon-wrapper">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-amber-700 transition-colors">
                            Dapat Token</h3>
                        <p class="text-gray-600 text-sm font-medium leading-relaxed">Sistem akan secara otomatis
                            menerbitkan Token unik dan tiket QR Code sebagai bukti kepemilikan Anda.</p>
                    </div>

                    <div class="step-item group">
                        <div class="step-number-badge">4</div>
                        <div class="step-icon-wrapper">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-amber-700 transition-colors">
                            Serahkan/Ambil</h3>
                        <p class="text-gray-600 text-sm font-medium leading-relaxed">Tunjukkan layar HP Anda ke Admin di
                            loket untuk proses verifikasi cepat saat menyimpan / mengambil.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-10">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="feature-grid p-0 mt-0">
                    <div class="glass-card">
                        <div class="feat-icon">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="feat-title">Daftar & Foto Mandiri</h3>
                        <p class="feat-desc">Tidak perlu lagi mengisi formulir kertas. Semua dicatat secara digital
                            termasuk dokumentasi foto kondisi barang Anda untuk mencegah perselisihan.</p>
                    </div>

                    <div class="glass-card popular">
                        <div class="feat-icon"
                            style="color: #047857; background: linear-gradient(135deg, rgba(16,185,129,0.2) 0%, rgba(16,185,129,0.05) 100%); border-color: rgba(16,185,129,0.3); box-shadow: 0 8px 16px rgba(16,185,129,0.15)">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="feat-title">Keamanan Super Ekstra</h3>
                        <p class="feat-desc">Gudang penyimpanan dilengkapi kamera CCTV 24 jam. Kami juga melakukan
                            verifikasi ketat ganda (QR dan Face Match) sebelum merilis barang.</p>
                    </div>

                    <div class="glass-card">
                        <div class="feat-icon"
                            style="color: #1d4ed8; background: linear-gradient(135deg, rgba(59,130,246,0.2) 0%, rgba(59,130,246,0.05) 100%); border-color: rgba(59,130,246,0.3); box-shadow: 0 8px 16px rgba(59,130,246,0.15)">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="feat-title">Notifikasi & Live Chat</h3>
                        <p class="feat-desc">Ada masalah atau perlu mengubah jadwal pengambilan? Buka dashboard dan
                            bicara langsung dengan Admin via antarmuka obrolan realtime terintegrasi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="harga" class="py-20 bg-white/10 backdrop-blur-sm border-y border-white/30">
            <div class="container mx-auto px-4 max-w-7xl">
                <h2 class="section-title">
                    {{ \App\Helpers\SettingHelper::get_localized('welcome_pricing_title') ?? 'Pilih Opsi Penitipan Sesuai Kebutuhan' }}
                </h2>
                <p class="section-subtitle max-w-3xl mx-auto">
                    {{ \App\Helpers\SettingHelper::get_localized('welcome_pricing_subtitle') ?? 'Khusus untuk lokasi Bandara atau Stasiun KRL/KAI. Pembayaran dilakukan secara lokal di loket oleh pegawai kami, namun Anda tetap dapat mendaftar dan memantau estimasi barang dari jarak jauh.' }}
                </p>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-4 lg:gap-8 mt-12 max-w-6xl mx-auto items-stretch">
                    <!-- Paket Kecil -->
                    <div class="pricing-card h-full justify-between">
                        <div class="w-full text-center flex flex-col items-center">
                            <h4 class="text-xl font-extrabold text-gray-900 border-b border-gray-100 w-full pb-4">Loker
                                Kecil</h4>
                            <div class="price-val">
                                <span>Rp</span>{{ number_format(\App\Helpers\SettingHelper::get_localized('price_daily') ?? 15000, 0, ',', '.') }}
                            </div>
                            <p class="text-gray-500 font-bold text-sm mb-6">per 24 jam</p>

                            <div class="mt-4 mb-8 w-full">
                                <a href="{{ route('register') }}" class="btn-hero w-full !py-3 !text-sm">Pilih Paket</a>
                            </div>
                        </div>

                        <div class="w-full border-t border-gray-100 pt-6">
                            <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-4 text-left">Fitur
                                Unggulan:</p>
                            <ul class="text-left w-full space-y-3 flex-1 pb-4">
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Dimensi Maks 30x30x30 cm
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Muat Tas Ransel / Helm
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Struk QR Otomatis
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Paket Besar (Populer) -->
                    <div class="pricing-card popular h-full justify-between">
                        <div class="w-full text-center flex flex-col items-center">
                            <h4
                                class="text-xl font-extrabold text-amber-900 border-b border-amber-100 w-full pb-4 pt-4">
                                Loker Besar</h4>
                            <div class="price-val">
                                <span>Rp</span>{{ number_format(\App\Helpers\SettingHelper::get_localized('price_weekly') ?? 50000, 0, ',', '.') }}
                            </div>
                            <p class="text-amber-700 font-bold text-sm mb-6">per 7 hari</p>

                            <div class="mt-4 mb-8 w-full">
                                <a href="{{ route('register') }}" class="btn-hero w-full !py-3 !text-sm">Pilih
                                    Sekarang</a>
                            </div>
                        </div>

                        <div class="w-full border-t border-amber-100 pt-6">
                            <p class="text-xs font-bold text-amber-900 uppercase tracking-wider mb-4 text-left">
                                Semua fitur Loker Kecil, plus:</p>
                            <ul class="text-left w-full space-y-3 flex-1 pb-4">
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-bold text-amber-900">Dimensi Maks 80x60x50 cm</span>
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Muat Koper (Cabin/Medium)
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Jaminan Asuransi Dasar
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Keamanan Terjamin 24/7
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Paket VIP -->
                    <div class="pricing-card h-full justify-between">
                        <div class="w-full text-center flex flex-col items-center">
                            <h4 class="text-xl font-extrabold text-gray-900 border-b border-gray-100 w-full pb-4">
                                Khusus / VIP</h4>
                            <div class="price-val">
                                <span>Rp</span>{{ number_format(\App\Helpers\SettingHelper::get_localized('price_monthly') ?? 150000, 0, ',', '.') }}
                            </div>
                            <p class="text-gray-500 font-bold text-sm mb-6">per 30 hari</p>

                            <div class="mt-4 mb-8 w-full">
                                <a href="{{ route('register') }}" class="btn-hero w-full !py-3 !text-sm">Pilih
                                    Paket</a>
                            </div>
                        </div>

                        <div class="w-full border-t border-gray-100 pt-6">
                            <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-4 text-left">Cocok
                                Untuk Bisnis:</p>
                            <ul class="text-left w-full space-y-3 flex-1 pb-4">
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Barang Bernilai Tinggi / Lebar
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Penyimpanan Ruang Khusus AC
                                </li>
                                <li class="pricing-list-item">
                                    <svg class="pricing-list-icon" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Pengawasan 1 CCTV Dedicated
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-6 text-sm font-bold text-gray-500">* Harga di atas dapat berubah
                    sewaktu-waktu tergantung kebijakan pengelola. Tanyakan Admin untuk konfirmasi promo harian.
                </div>
            </div>
        </section>

        <!-- Location Section -->
        <section id="lokasi" class="py-24">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">
                            {!! nl2br(e(\App\Helpers\SettingHelper::get_localized('welcome_location_title') ?? 'Lokasi Strategis & Terjangkau')) !!}
                        </h2>
                        <p class="text-lg text-gray-600 font-medium mb-8">
                            {{ \App\Helpers\SettingHelper::get_localized('welcome_location_subtitle') ?? 'Kunjungi kantor layanan offline kami yang berada tepat di pusat mobilitas. Kami berdedikasi menjaga properti Anda selagi Anda beraktivitas.' }}
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-white shadow-sm border border-amber-200 flex items-center justify-center text-amber-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-lg font-bold text-gray-900">Alamat Pengecekan</h5>
                                    <p class="text-gray-600 font-medium text-sm mt-1">
                                        {!! nl2br(e(\App\Helpers\SettingHelper::get_localized('contact_address') ?? "Gedung Pusat Kegiatan Administrasi Lt. 1,\nJalan Sudirman No. 45, Kompleks Area A.")) !!}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-white shadow-sm border border-emerald-200 flex items-center justify-center text-emerald-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-lg font-bold text-gray-900">Jam Operasional</h5>
                                    <p class="text-gray-600 font-medium text-sm mt-1">Senin - Minggu: 07.00 - 22.00
                                        WIB<br><span class="text-emerald-600 font-bold">Layanan Live Chat: 24 Jam</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative px-4">
                        <div class="relative z-10 w-full rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                            <!-- Google Maps Embed -->
                            <iframe
                                src="{{ $app_settings['store_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8809968417725!2d110.40612167575294!3d-7.78124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59eb858348af%3A0xe5f86c1284b1d624!2sUniversitas%20Teknologi%20Digital%20Indonesia%20(UTDI)!5e0!3m2!1sen!2sid!4v1714150530467!5m2!1sen!2sid' }}"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            <div
                                class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-sm pb-3 pt-3 px-5 rounded-xl shadow-lg border border-gray-100 flex items-center justify-between">
                                <div>
                                    <span
                                        class="block text-sm font-bold text-gray-900 border-b border-gray-100 pb-1 mb-1">Kantor
                                        Pusat</span>
                                    <span class="text-xs font-semibold text-gray-500">Buka di Maps untuk rute</span>
                                </div>
                                <a href="https://maps.app.goo.gl/9uK2C" target="_blank"
                                    class="w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center hover:bg-amber-600 transition-colors shadow-md">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="py-24 bg-white/5 backdrop-blur-sm relative z-10">
            <div class="container mx-auto px-4 max-w-4xl">
                <h2 class="section-title">
                    {{ \App\Helpers\SettingHelper::get_localized('welcome_faq_title', 'FAQ (Pertanyaan Umum)') }}
                </h2>
                <p class="section-subtitle max-w-2xl mx-auto mb-16">
                    {{ \App\Helpers\SettingHelper::get_localized('welcome_faq_subtitle', 'Temukan jawaban cepat untuk pertanyaan yang sering diajukan pelanggan kami.') }}
                </p>

                <div class="mt-8 space-y-4" x-data="{ active: null }">
                    @php
                        $faqItemsRaw = \App\Models\Setting::where('key', 'faq_data')->value('value');
                        $faqItems = [];
                        if ($faqItemsRaw) {
                            $decoded = json_decode($faqItemsRaw, true);
                            if (is_array($decoded)) {
                                $faqItems = array_filter($decoded, function ($item) {
                                    $qId = $item['question']['id'] ?? '';
                                    return !empty(trim($qId));
                                });
                            }
                        }
                    @endphp

                    @forelse($faqItems as $index => $item)
                        @php
                            $qId = $item['question']['id'] ?? '';
                            $qEn = $item['question']['en'] ?? $qId;
                            $qJa = $item['question']['ja'] ?? $qId;
                            $question = app()->getLocale() == 'en' ? $qEn : (app()->getLocale() == 'ja' ? $qJa : $qId);

                            $aId = $item['answer']['id'] ?? '';
                            $aEn = $item['answer']['en'] ?? $aId;
                            $aJa = $item['answer']['ja'] ?? $aId;
                            $answer = app()->getLocale() == 'en' ? $aEn : (app()->getLocale() == 'ja' ? $aJa : $aId);
                        @endphp
                        <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow cursor-pointer"
                            @click="active = (active === {{ $index }}) ? null : {{ $index }}">
                            <div
                                class="p-5 md:px-8 md:py-6 flex justify-between items-center bg-white hover:bg-gray-50 transition-colors">
                                <h4 class="text-base md:text-lg font-bold text-gray-900 pr-4">{{ $question }}</h4>
                                <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-amber-600 transform transition-transform duration-300"
                                        :class="{'rotate-180': active === {{ $index }}}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div x-show="active === {{ $index }}" x-collapse style="display: none;">
                                <div
                                    class="p-5 md:px-8 pb-6 text-gray-600 text-sm md:text-base font-medium leading-relaxed border-t border-gray-100 bg-gray-50/50">
                                    {!! nl2br(e($answer)) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-8 bg-white/50 rounded-xl border border-gray-100">
                            <p class="text-gray-500 font-medium">{{ __('FAQ belum tersedia saat ini.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pre-footer CTA Ribbon -->
            <section class="py-20 relative z-10">
                <div class="container mx-auto px-4 max-w-5xl">
                    <div class="bg-gradient-to-br from-amber-400 via-amber-300 to-amber-500 border border-amber-200 rounded-[2.5rem] p-12 lg:p-16 text-center shadow-2xl shadow-amber-500/20 relative overflow-hidden slide-up"
                        style="animation-delay: 500ms">
                        <!-- Decor -->
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/40 rounded-full blur-2xl">
                        </div>
                        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/30 rounded-full blur-2xl">
                        </div>

                        <h2 class="text-3xl md:text-5xl font-black mb-6 relative z-10 text-amber-950">
                            {{ \App\Helpers\SettingHelper::get_localized('welcome_prefooter_title', 'Siap Menitipkan Barang Anda?') }}
                        </h2>
                        <p class="text-lg md:text-xl text-amber-800 mb-10 max-w-2xl mx-auto relative z-10 font-bold">
                            {{ \App\Helpers\SettingHelper::get_localized('welcome_prefooter_subtitle', 'Login sekarang untuk mulai mencatat dan menitipkan barang Anda dengan sistem QR dan Face Match kami.') }}
                        </p>
                        <a href="{{ route('register') }}"
                            class="btn-hero bg-white text-amber-700 shadow-md border border-amber-100 !py-4 !px-8 text-lg inline-flex items-center gap-2 hover:scale-105 hover:bg-amber-50 transition-all">
                            Daftar Akun Sekarang Gratis
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

    </main>

    <footer class="border-t border-gray-200 bg-white relative z-10 pt-16 pb-4 shadow-[0_-10px_40px_rgba(0,0,0,0.02)]">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="p-1 rounded-xl bg-gradient-to-br from-amber-200 to-amber-400 border border-white">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span
                            class="font-black text-xl text-gray-900 uppercase tracking-wider">{{ $app_settings['app_name'] ?? 'PenitipanApp' }}</span>
                    </div>
                    <p class="text-gray-600 font-medium max-w-sm mb-6 leading-relaxed">Platform penitipan barang digital
                        pertama yang menghubungkan keamanan fisik ekstra dengan kenyamanan web monitoring modern.</p>
                </div>

                <div>
                    <h4 class="font-black text-gray-900 uppercase tracking-wide mb-4">Akses Cepat</h4>
                    <ul class="space-y-3 font-semibold text-gray-600">
                        <li><a href="#cara-kerja" class="hover:text-amber-600 transition-colors">Cara Kerja</a></li>
                        <li><a href="#harga" class="hover:text-amber-600 transition-colors">Harga Loker</a></li>
                        <li><a href="#faq" class="hover:text-amber-600 transition-colors">Bantuan (FAQ)</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-black text-gray-900 uppercase tracking-wide mb-4">Legal & Dukungan</h4>
                    <ul class="space-y-3 font-semibold text-gray-600">
                        <li><a href="#" class="hover:text-amber-600 transition-colors">Syarat Ketentuan</a></li>
                        <li><a href="#" class="hover:text-amber-600 transition-colors">Kebijakan Privasi</a></li>
                        @if (!empty($app_settings['social_facebook']) || !empty($app_settings['social_instagram']) || !empty($app_settings['social_twitter']))
                            <li class="pt-2 flex gap-3">
                                @if (!empty($app_settings['social_facebook']))
                                    <a href="{{ $app_settings['social_facebook'] }}" target="_blank"
                                        class="w-8 h-8 rounded-full bg-white/50 border border-white flex items-center justify-center hover:bg-amber-100 text-amber-700 transition-colors">
                                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                        </svg>
                                    </a>
                                @endif
                                @if (!empty($app_settings['social_instagram']))
                                    <a href="{{ $app_settings['social_instagram'] }}" target="_blank"
                                        class="w-8 h-8 rounded-full bg-white/50 border border-white flex items-center justify-center hover:bg-amber-100 text-amber-700 transition-colors">
                                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>
                                    </a>
                                @endif
                                @if (!empty($app_settings['social_twitter']))
                                    <a href="{{ $app_settings['social_twitter'] }}" target="_blank"
                                        class="w-8 h-8 rounded-full bg-white/50 border border-white flex items-center justify-center hover:bg-amber-100 text-amber-700 transition-colors">
                                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-200 text-center text-sm font-bold text-gray-500">
                &copy; {{ date('Y') }} {{ $app_settings['footer_text'] ?? 'PenitipanApp' }}. All rights reserved. <span
                    class="text-amber-600 ml-1">Liquid Glass Crafted.</span>
            </div>
        </div>
    </footer>

</body>

</html>