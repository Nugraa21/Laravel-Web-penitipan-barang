<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $app_settings['app_name'] ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-black antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
        style="background: var(--bg-main);">
        <div>
            <a href="/" class="flex flex-col items-center gap-3 group" style="text-decoration: none;">
                <div class="p-3 border-[3px] border-black transition-transform group-hover:-translate-y-1 group-hover:translate-x-1"
                    style="background: var(--c-primary); box-shadow: 4px 4px 0px #000;">
                    <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="font-black text-3xl text-black tracking-widest uppercase mt-2"
                    style="text-shadow: 2px 2px 0px var(--c-primary);">{{ $app_settings['app_name'] ?? 'PenitipanApp' }}</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-8 px-8 py-8 bg-white overflow-hidden border-[3px] border-black"
            style="box-shadow: 8px 8px 0px #000;">
            {{ $slot }}
        </div>
    </div>
</body>

</html>