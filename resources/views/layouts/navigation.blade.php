<nav x-data="{ open: false }" class="sticky top-0 z-50 glass-panel">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + Nav Links -->
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group shrink-0"
                    style="text-decoration: none;">
                    <div
                        class="p-1.5 rounded-xl bg-gradient-to-br from-amber-200 to-amber-400 shadow-sm border border-white transition-transform group-hover:-translate-y-1">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span
                        class="font-black text-xl text-gray-800 uppercase tracking-wider">{{ $app_settings['app_name'] ?? 'PenitipanApp' }}</span>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden sm:flex items-center gap-3 ml-4">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-bold uppercase tracking-wide transition-all rounded-xl {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-600 hover:bg-white/50 hover:text-gray-900' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        @if(Auth::user()->role === 'admin') {{ __('Barang Masuk') }} @else {{ __('Dashboard') }} @endif
                    </a>

                    <!-- Admin Dropdown Menu -->
                    @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                        <div x-data="{ adminMenuOpen: false }" class="relative">
                            <button @click="adminMenuOpen = !adminMenuOpen" @click.outside="adminMenuOpen = false"
                                class="flex items-center gap-2 px-4 py-2 text-sm font-bold uppercase tracking-wide transition-all rounded-xl text-gray-600 hover:bg-white/50 hover:text-gray-900 {{ request()->routeIs('admin.*') || request()->routeIs('superadmin.*') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg>
                                {{ __('Menu Admin') }}
                                <svg class="w-4 h-4 transition-transform duration-200"
                                    :class="{'rotate-180': adminMenuOpen}" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="adminMenuOpen" style="display: none;" x-transition
                                class="absolute left-0 mt-2 w-56 bg-white rounded-xl border border-gray-100 shadow-xl overflow-hidden z-50 py-1">

                                @if(Auth::user()->role === 'super_admin')
                                    <a href="{{ route('superadmin.dashboard') }}"
                                        class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold uppercase transition-colors hover:bg-indigo-50 text-indigo-600 {{ request()->routeIs('superadmin.dashboard') ? 'bg-indigo-50' : '' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                                            </path>
                                        </svg>
                                        {{ __('Super Admin') }}
                                    </a>
                                    <div class="h-px bg-gray-100 my-1"></div>
                                @endif

                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold uppercase transition-colors text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-50 text-indigo-600' : '' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    {{ __('Overview') }}
                                </a>
                                <a href="{{ route('admin.users.index') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold uppercase transition-colors text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.users.index') ? 'bg-gray-50 text-indigo-600' : '' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                    {{ __('Pengguna') }}
                                </a>
                                <a href="{{ route('admin.scan') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold uppercase transition-colors text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.scan') ? 'bg-amber-50 text-amber-600' : '' }}">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 00-1 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                        </path>
                                    </svg>
                                    {{ __('Scan Token') }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <a href="{{ Auth::user()->role === 'admin' ? route('chat.inbox') : route('chat.index') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-bold uppercase tracking-wide transition-all rounded-xl {{ (request()->routeIs('chat.inbox') || request()->routeIs('chat.index')) ? 'bg-gray-800 text-white shadow-md' : 'text-gray-600 hover:bg-white/50 hover:text-gray-900' }} relative">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        {{ __('Pesan') }}
                    </a>

                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('items.create') }}"
                            class="glass-btn flex items-center gap-2 px-5 py-2 text-sm font-bold uppercase tracking-wide ml-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            {{ __('Titip Barang') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: User Dropdown & Language Switcher -->
            <div class="hidden sm:flex sm:items-center pl-6 my-2 border-l border-white/40 gap-4">

                <!-- Language Dropdown -->
                <div x-data="{ langOpen: false }" class="relative">
                    <button @click="langOpen = !langOpen"
                        class="flex items-center gap-1.5 px-2 py-1.5 rounded-xl text-sm font-bold uppercase transition-all hover:bg-white/40 text-gray-800">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                            </path>
                        </svg>
                        <span>{{ strtoupper(App::getLocale()) }}</span>
                    </button>
                    <div x-show="langOpen" @click.outside="langOpen = false"
                        style="display: none; top: 50px; right: 0; position: absolute;"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="w-32 glass-card border border-white overflow-hidden shadow-lg z-[100] mt-2">
                        <div class="p-1">
                            <a href="{{ route('lang.switch', 'id') }}"
                                class="block px-3 py-2 text-sm text-gray-700 hover:bg-white/50 rounded-lg font-bold {{ App::getLocale() == 'id' ? 'bg-white/60' : '' }}">🇮🇩
                                ID</a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="block px-3 py-2 text-sm text-gray-700 hover:bg-white/50 rounded-lg font-bold {{ App::getLocale() == 'en' ? 'bg-white/60' : '' }}">🇬🇧
                                EN</a>
                            <a href="{{ route('lang.switch', 'ja') }}"
                                class="block px-3 py-2 text-sm text-gray-700 hover:bg-white/50 rounded-lg font-bold {{ App::getLocale() == 'ja' ? 'bg-white/60' : '' }}">🇯🇵
                                JA</a>
                        </div>
                    </div>
                </div>

                <div x-data="{ dropOpen: false }" class="relative border-l border-white/40 pl-4">
                    <button @click="dropOpen = !dropOpen"
                        class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl text-sm font-bold uppercase transition-all hover:bg-white/40 border border-transparent hover:border-white/60 text-gray-800">
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar"
                                class="w-8 h-8 rounded-full shadow-sm object-cover border border-white">
                        @else
                            <div
                                class="w-8 h-8 rounded-full shadow-sm flex items-center justify-center text-gray-800 font-black text-sm border border-white bg-amber-200">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="text-left hidden lg:block">
                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-xs font-semibold text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                            :class="{'rotate-180': dropOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="dropOpen" @click.outside="dropOpen = false"
                        style="display: none; top: 72px; right: 1.5rem; position: fixed;"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="w-56 glass-card border border-white overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.1)] z-[100]">
                        <!-- User Info Header -->
                        <div class="px-5 py-4 border-b border-white/30 bg-white/20">
                            <p class="text-sm font-black text-gray-900 truncate uppercase">{{ Auth::user()->name }}</p>
                            <p class="text-xs font-semibold text-gray-600 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-white/50 transition-colors font-bold uppercase">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('Edit Profil') }}
                            </a>
                            @if(Auth::user()->role === 'super_admin')
                                <a href="{{ route('superadmin.settings') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-white/50 transition-colors font-bold uppercase mt-1">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ __('Pengaturan') }}
                                </a>
                            @endif
                            <a href="{{ Auth::user()->role === 'admin' ? route('chat.inbox') : route('chat.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-white/50 transition-colors font-bold uppercase mt-1 relative">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                {{ __('Pesan') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-3 py-2.5 mt-1 rounded-lg text-sm text-red-600 hover:bg-red-50 transition-colors font-bold uppercase text-left">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden pl-4 border-l border-white/40 shadow-sm relative">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-gray-600 hover:bg-white/40 focus:bg-white/60 transition-colors border border-transparent relative">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden glass-panel border-t border-white/60">
        <div class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-bold uppercase transition-colors {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-white border-gray-800' : 'text-gray-800 border-white/60 hover:bg-white/50' }}">
                @if(Auth::user()->role === 'admin') {{ __('Barang Masuk') }} @else {{ __('Dashboard') }} @endif
            </a>
            @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('superadmin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-bold uppercase transition-colors {{ request()->routeIs('superadmin.dashboard') ? 'bg-indigo-600 text-white border-indigo-600 shadow-md shadow-indigo-500/30' : 'text-indigo-600 border-indigo-200 bg-indigo-50/50 hover:bg-indigo-100' }}">
                    {{ __('Super Admin') }}
                </a>
            @endif
            @if(in_array(Auth::user()->role, ['admin', 'super_admin']))
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-bold uppercase transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white border-gray-800' : 'text-gray-800 border-white/60 hover:bg-white/50' }}">
                    {{ __('Overview') }}
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-bold uppercase transition-colors {{ request()->routeIs('admin.users.index') ? 'bg-gray-800 text-white border-gray-800' : 'text-gray-800 border-white/60 hover:bg-white/50' }}">
                    {{ __('Pengguna') }}
                </a>
                <a href="{{ route('admin.scan') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-bold uppercase transition-colors {{ request()->routeIs('admin.scan') ? 'bg-gradient-to-r from-amber-300 to-amber-500 text-gray-900 border-amber-400' : 'text-gray-800 border-white/60 hover:bg-white/50' }}">
                    {{ __('Scan Token') }}
                </a>
            @endif
            <a href="{{ Auth::user()->role === 'admin' ? route('chat.inbox') : route('chat.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl border text-sm font-bold uppercase transition-colors {{ (request()->routeIs('chat.inbox') || request()->routeIs('chat.index')) ? 'bg-gray-800 text-white border-gray-800' : 'text-gray-800 border-white/60 hover:bg-white/50' }} relative">
                {{ __('Pesan') }}
            </a>
            @if(Auth::user()->role === 'user')
                <a href="{{ route('items.create') }}"
                    class="glass-btn flex items-center justify-center gap-3 px-4 py-3 border w-full mt-4">
                    + {{ __('Titip Barang') }}
                </a>
            @endif
        </div>

        <div class="p-4 bg-white/20 border-t border-white/40">
            <!-- Mobile Language Switcher -->
            <div class="flex items-center gap-3 p-3 mb-4 rounded-xl bg-white/30 border border-white/50 justify-between">
                <span class="text-xs font-bold text-gray-600 uppercase">{{ __('Bahasa') }}</span>
                <div class="flex gap-2">
                    <a href="{{ route('lang.switch', 'id') }}"
                        class="px-2 py-1 rounded-md text-sm font-bold {{ App::getLocale() == 'id' ? 'bg-amber-400 text-white' : 'bg-white/40 text-gray-700' }}">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-2 py-1 rounded-md text-sm font-bold {{ App::getLocale() == 'en' ? 'bg-amber-400 text-white' : 'bg-white/40 text-gray-700' }}">EN</a>
                    <a href="{{ route('lang.switch', 'ja') }}"
                        class="px-2 py-1 rounded-md text-sm font-bold {{ App::getLocale() == 'ja' ? 'bg-amber-400 text-white' : 'bg-white/40 text-gray-700' }}">JA</a>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 mb-4 rounded-xl bg-white/30 border border-white/50">
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar"
                        class="w-10 h-10 rounded-full shadow-sm object-cover border border-white">
                @else
                    <div
                        class="w-10 h-10 rounded-full shadow-sm flex items-center justify-center text-gray-800 font-black text-sm border border-white bg-amber-200">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="font-black text-gray-900 text-sm uppercase">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-semibold text-gray-600">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('profile.edit') }}"
                    class="flex-1 text-center py-2.5 rounded-xl border border-white/60 bg-white/40 hover:bg-white/60 text-sm font-bold text-gray-800 transition-colors">
                    {{ __('Profil') }}
                </a>
                @if(Auth::user()->role === 'super_admin')
                    <a href="{{ route('superadmin.settings') }}"
                        class="flex-1 text-center py-2.5 rounded-xl border border-white/60 bg-white/40 hover:bg-white/60 text-sm font-bold text-gray-800 transition-colors">
                        {{ __('Pengaturan') }}
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full text-center py-2.5 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-sm font-bold text-red-600 transition-colors">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>