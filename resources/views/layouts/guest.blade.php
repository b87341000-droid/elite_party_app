<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Elite Block Party') }} — Portal Access</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#080808] text-white font-sans antialiased min-h-screen selection:bg-[#E50914] selection:text-white relative overflow-x-hidden">
        {{-- Ambient background glows --}}
        <div class="fixed inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[450px] bg-gradient-to-b from-[#E50914]/20 via-[#D4AF37]/10 to-transparent blur-[120px] rounded-full"></div>
            <div class="absolute -bottom-40 -left-20 w-[450px] h-[450px] bg-[#E50914]/15 blur-[130px] rounded-full"></div>
            <div class="absolute -bottom-40 -right-20 w-[450px] h-[450px] bg-[#D4AF37]/10 blur-[130px] rounded-full"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff08_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-between items-center py-8 px-4 sm:px-6 relative z-10">
            {{-- Top Bar --}}
            <div class="w-full max-w-md flex items-center justify-between mb-4">
                <a href="/" class="inline-flex items-center gap-2 text-xs font-mono tracking-wider text-white/60 hover:text-[#D4AF37] transition-colors py-1 px-3 rounded-full bg-white/5 border border-white/10 hover:border-[#D4AF37]/40">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>RETURN TO MAIN SITE</span>
                </a>
                <span class="text-[10px] font-mono text-emerald-400 flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    SECURE PORTAL
                </span>
            </div>

            {{-- Main Container --}}
            <div class="w-full max-w-md my-auto">
                <div class="text-center mb-6">
                    <a href="/" class="inline-block transform hover:scale-105 transition-transform duration-300">
                        <x-application-logo />
                    </a>
                </div>

                {{-- Glassmorphic Card --}}
                <div class="bg-[#121214]/90 backdrop-blur-2xl border border-white/10 rounded-2xl p-6 sm:p-8 shadow-[0_0_50px_rgba(0,0,0,0.8)] relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#E50914] to-[#D4AF37]"></div>
                    {{ $slot }}
                </div>
            </div>

            {{-- Footer info --}}
            <div class="text-center text-xs text-white/40 font-mono mt-8">
                &copy; {{ date('Y') }} ELITE BLOCK PARTY &bull; LAGOS, NIGERIA
            </div>
        </div>
    </body>
</html>
