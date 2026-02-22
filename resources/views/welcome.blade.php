<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $app_settings['app_name'] ?? 'PenitipanApp' }} -
        {{ $app_settings['hero_title'] ?? 'Titip Barang Aman & Mudah' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-section {
            padding: 8rem 1rem;
            text-align: center;
            position: relative;
            background: transparent;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            color: var(--c-gray-900);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--c-primary), #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .hero-desc {
            font-size: 1.25rem;
            color: var(--c-gray-600);
            margin-bottom: 3rem;
            font-weight: 500;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .nav-wrapper {
            position: fixed;
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

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 5rem 1rem;
            position: relative;
        }

        .feat-card {
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .feat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 0.5);
        }

        .feat-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, rgba(251, 211, 141, 0.5) 0%, rgba(251, 211, 141, 0.1) 100%);
            border: 1px solid rgba(251, 211, 141, 0.5);
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(251, 211, 141, 0.2);
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
        }

        .btn-hero:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .btn-hero-primary {
            background: var(--c-primary);
            color: #000;
            box-shadow: 0 4px 6px -1px rgba(251, 211, 141, 0.5), 0 2px 4px -1px rgba(251, 211, 141, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn-hero-outline {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            color: var(--c-gray-800);
            box-shadow: var(--shadow-sm);
        }
    </style>
</head>

<body class="antialiased app-liquid-bg">
    <div class="app-blob-1"></div>
    <div class="app-blob-2"></div>

    <nav class="nav-wrapper">
        <div class="container nav-inner">
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
            </a>
            <div style="display: flex; gap: 1rem; align-items: center;">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-hero btn-hero-primary"
                            style="padding: 0.5rem 1.5rem; font-size: 0.875rem;">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-outline"
                            style="padding: 0.5rem 1.5rem; font-size: 0.875rem;">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-hero btn-hero-primary"
                                style="padding: 0.5rem 1.5rem; font-size: 0.875rem;">Daftar Gratis</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="hero-section" style="margin-top: 60px;">
        <div class="container hero-content">
            <h1 class="hero-title"><span>{{ $app_settings['hero_title'] ?? 'Titip Barang Tenang & Mudah' }}</span></h1>
            <p class="hero-desc">
                {{ $app_settings['hero_description'] ?? 'Mau jalan-jalan tapi bawaan ribet? Titipkan di PenitipanApp! Fasilitas lengkap, dapatkan Struk Digital, dan lacak realtime dengan antarmuka yang modern.' }}
            </p>

            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">Mulai Sekarang</a>
                <a href="{{ route('login') }}" class="btn-hero btn-hero-outline">Sudah Punya Akun</a>
            </div>

            <div
                style="display: flex; gap: 3rem; justify-content: center; margin-top: 5rem; border-top: 1px solid rgba(0,0,0,0.1); padding-top: 3rem; flex-wrap: wrap;">
                <div
                    style="background: rgba(255,255,255,0.4); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.6); border-radius: 24px; box-shadow: var(--shadow-md); padding: 1.5rem 2rem; min-width: 200px; display: flex; flex-direction: column; align-items: center;">
                    <h4 style="font-size: 2.5rem; font-weight: 800; color: var(--c-primary); margin-bottom: 0;">Struk
                    </h4>
                    <p style="color: var(--c-gray-600); font-weight: 700;">Digital Unik</p>
                </div>
                <div
                    style="background: rgba(251,211,141,0.2); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.8); border-radius: 24px; box-shadow: var(--shadow-md); padding: 1.5rem 2rem; min-width: 200px; display: flex; flex-direction: column; align-items: center;">
                    <h4 style="font-size: 2.5rem; font-weight: 800; color: #d97706; margin-bottom: 0;">24/7</h4>
                    <p style="color: #92400e; font-weight: 700;">Aman Total</p>
                </div>
                <div
                    style="background: rgba(16,185,129,0.1); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.6); border-radius: 24px; box-shadow: var(--shadow-md); padding: 1.5rem 2rem; min-width: 200px; display: flex; flex-direction: column; align-items: center;">
                    <h4 style="font-size: 2.5rem; font-weight: 800; color: #10b981; margin-bottom: 0;">Live</h4>
                    <p style="color: #047857; font-weight: 700;">Chat Admin</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container feature-grid">
        <div class="feat-card">
            <div class="feat-icon">
                <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="feat-title">Daftar & Foto</h3>
            <p class="feat-desc">Buat akun gratis, isi data barang, dan foto dari smartphone Anda. Dapatkan Token
                Penitipan unik seketika.</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon">
                <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                    </path>
                </svg>
            </div>
            <h3 class="feat-title">Keamanan Ekstra</h3>
            <p class="feat-desc">CCTV 24 jam + otorisasi role terpercaya. Barang Anda disimpan di gudang yang steril dan
                aman.</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon">
                <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
            </div>
            <h3 class="feat-title">Live Tracking & Chat</h3>
            <p class="feat-desc">Pantau status barang dari Dashboard. Hubungi admin langsung melalui Live Chat jika ada
                pertanyaan.</p>
        </div>
    </div>

    <footer
        style="text-align: center; padding: 3rem 1rem; border-top: 1px solid rgba(0,0,0,0.1); background: transparent; color: var(--c-gray-500); font-size: 0.875rem; font-weight: 600;">
        &copy; {{ date('Y') }} {{ $app_settings['footer_text'] ?? 'PenitipanApp. Liquid Glass Redesign.' }}
    </footer>

</body>

</html>