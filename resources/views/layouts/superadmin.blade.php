<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $app_settings['app_name'] ?? config('app.name', 'Laravel') }} - {{ __('Super Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --c-bg: #f8fafc;
            --c-sidebar: #1e293b;
            --c-sidebar-hover: #334155;
            --c-sidebar-text: #e2e8f0;
            --c-sidebar-active: #4f46e5;
            --c-primary: #4f46e5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--c-bg);
            color: #334155;
            -webkit-font-smoothing: antialiased;
        }

        /* Glassmorphism Elements (reused from main theme) */
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 260px;
            background-color: var(--c-sidebar);
            color: var(--c-sidebar-text);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
        }

        .admin-sidebar-header {
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            background-color: rgba(0, 0, 0, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .admin-sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--c-sidebar-text);
            transition: all 0.2s;
            text-decoration: none;
        }

        .admin-nav-item:hover {
            background-color: var(--c-sidebar-hover);
            color: #ffffff;
        }

        .admin-nav-item.active {
            background-color: var(--c-primary);
            color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .admin-nav-icon {
            width: 1.25rem;
            height: 1.25rem;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .admin-nav-item:hover .admin-nav-icon,
        .admin-nav-item.active .admin-nav-icon {
            opacity: 1;
        }

        /* Main Content Area */
        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Top Navbar */
        .admin-topbar {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .admin-content {
            flex: 1;
            padding: 2rem;
            background-image:
                radial-gradient(at 0% 0%, rgba(250, 245, 235, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(230, 240, 255, 0.5) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* Mobile Adjustments */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 lg:hidden"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" :class="{ 'open': sidebarOpen }">
        <div class="admin-sidebar-header">
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center gap-3 w-full">
                <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
                <span class="font-black text-white text-lg tracking-wide truncate">{{ __('Super Admin') }}</span>
            </a>
        </div>

        <nav class="admin-sidebar-nav">
            <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-4">{{ __('Menu Utama') }}
            </p>

            <a href="{{ route('superadmin.dashboard') }}"
                class="admin-nav-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                {{ __('Dashboard') }}
            </a>

            <a href="{{ route('superadmin.transactions') ?? '#' }}"
                class="admin-nav-item {{ request()->routeIs('superadmin.transactions*') ? 'active' : '' }}">
                <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m3-3h.01M9 13h.01M9 17h.01M13 13h3m-3 4h3">
                    </path>
                </svg>
                {{ __('Transaksi Barang') }}
            </a>

            <a href="{{ route('superadmin.logs') ?? '#' }}"
                class="admin-nav-item {{ request()->routeIs('superadmin.logs*') ? 'active' : '' }}">
                <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ __('Log Sistem') }}
            </a>

            <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">
                {{ __('Manajemen Akses') }}</p>

            <a href="{{ route('admin.users.index') }}"
                class="admin-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                {{ __('Pengguna & Admin') }}
            </a>

            <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6">{{ __('Sistem') }}</p>

            <a href="{{ route('superadmin.settings') }}"
                class="admin-nav-item {{ request()->routeIs('superadmin.settings') ? 'active' : '' }}">
                <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ __('Pengaturan Core') }}
            </a>

            <!-- Return to public app -->
            <div class="mt-auto pt-6 pb-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-center gap-2 w-full py-2.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 transition-colors text-sm font-bold border border-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Kembali ke Aplikasi') }}
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Container -->
    <main class="admin-main">
        <!-- Top Navbar -->
        <header class="admin-topbar">
            <!-- Mobile Toggle -->
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <!-- Page Title (Desktop) -->
            <div class="hidden lg:block">
                @if (isset($header))
                    {{ $header }}
                @endif
            </div>

            <!-- Right Nav Actions -->
            <div class="flex items-center gap-4 ml-auto">
                <!-- Language Switcher -->
                <div x-data="{ langOpen: false }" class="relative">
                    <button @click="langOpen = !langOpen"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-sm font-bold uppercase transition-all hover:bg-gray-100 text-gray-700">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                            </path>
                        </svg>
                        <span>{{ strtoupper(App::getLocale()) }}</span>
                    </button>
                    <div x-show="langOpen" @click.outside="langOpen = false" style="display: none;" x-transition
                        class="absolute right-0 mt-2 w-32 bg-white rounded-xl border border-gray-100 shadow-xl overflow-hidden z-50">
                        <div class="p-1">
                            <a href="{{ route('lang.switch', 'id') }}"
                                class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg font-bold">🇮🇩
                                ID</a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg font-bold">🇬🇧
                                EN</a>
                            <a href="{{ route('lang.switch', 'ja') }}"
                                class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg font-bold">🇯🇵
                                JA</a>
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div x-data="{ dropOpen: false }" class="relative">
                    <button @click="dropOpen = !dropOpen" class="flex items-center gap-2 pl-4 border-l border-gray-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-900 leading-none mb-1">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold tracking-wider text-indigo-600 uppercase">
                                {{ Auth::user()->role }}</p>
                        </div>
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar"
                                class="w-9 h-9 rounded-full object-cover">
                        @else
                            <div
                                class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black text-sm bg-indigo-500">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="dropOpen" @click.outside="dropOpen = false" style="display: none;" x-transition
                        class="absolute right-0 mt-3 w-48 bg-white rounded-xl border border-gray-100 shadow-xl overflow-hidden z-50">
                        <div class="px-4 py-3 bg-gray-50/50 border-b border-gray-100">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="p-1">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg font-medium">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('Profil') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg font-medium text-left">
                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    {{ __('Keluar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="admin-content">
            {{ $slot }}
        </main>
    </main>

</body>

</html>