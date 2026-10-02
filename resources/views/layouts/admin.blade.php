<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin — ELITE BLOCK PARTY')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-elite-black text-elite-bone font-sans min-h-screen">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="hidden lg:flex flex-col w-64 bg-elite-coal border-r border-elite-steel/50 fixed inset-y-0">
        {{-- Brand --}}
        <div class="p-6 border-b border-elite-steel/50">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="font-display text-xl text-gold-gradient">ELITE</div>
                <div class="font-mono text-[9px] tracking-ultra text-elite-gold">ADMIN</div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            @php
                $navItems = [
                    ['admin.dashboard',          '📊', 'Dashboard'],
                    ['admin.applications.index', '📥', 'Applications'],
                    ['admin.artists.index',      '🎤', 'Artists'],
                    ['admin.sponsors.index',     '🤝', 'Sponsors'],
                    ['admin.posts.index',        '📝', 'Blog Posts'],
                    ['admin.announcements.index','📢', 'Announcements'],
                    ['admin.subscribers.index',  '📧', 'Subscribers'],
                    ['admin.scanner',            '📷', 'Scanner'],
                    ['admin.scan-logs.index',    '📋', 'Scan Logs'],
                ];
            @endphp

            @foreach ($navItems as $item)
                <a href="{{ route($item[0]) }}"
                   class="flex items-center gap-3 px-4 py-3 font-bebas tracking-wider uppercase text-sm transition-colors
                          {{ request()->routeIs($item[0].'*') ? 'bg-elite-gold/10 text-elite-gold border-l-2 border-elite-gold' : 'text-elite-smoke hover:text-elite-bone hover:bg-elite-charcoal' }}">
                    <span>{{ $item[1] }}</span>
                    <span>{{ $item[2] }}</span>
                </a>
            @endforeach
        </nav>

        {{-- Bottom --}}
        <div class="p-4 border-t border-elite-steel/50">
            <div class="text-xs text-elite-smoke mb-2">{{ auth()->user()->name }}</div>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">VIEW SITE</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="font-mono text-[10px] tracking-ultra text-elite-crimson hover:text-elite-bone">LOGOUT</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 lg:ml-64">

        {{-- Mobile top bar --}}
        <div class="lg:hidden bg-elite-coal border-b border-elite-steel/50 p-4 flex items-center justify-between sticky top-0 z-30">
            <div class="font-display text-lg text-gold-gradient">ELITE ADMIN</div>
            <a href="{{ route('admin.dashboard') }}" class="text-elite-gold text-xs font-mono">HOME</a>
        </div>

        <main class="p-6 md:p-10">
            @if (session('success'))
                <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">✓ {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">✗ {{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>