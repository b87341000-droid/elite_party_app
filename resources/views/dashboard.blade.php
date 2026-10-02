@extends('layouts.app')
@section('title', 'My Attendee Dashboard — Elite Block Party')

@section('content')
<div class="pt-28 pb-16 bg-[#080808] min-h-screen text-white relative">
    {{-- Ambient glow --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-[#E50914]/15 blur-[120px] rounded-full"></div>
    </div>

    <div class="container-elite relative z-10 max-w-5xl mx-auto px-4 sm:px-6">
        {{-- Welcome Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-8 border-b border-white/10">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[10px] font-mono tracking-widest text-[#D4AF37] uppercase bg-[#D4AF37]/10 border border-[#D4AF37]/20 px-2 py-0.5 rounded">
                        {{ strtoupper(auth()->user()->role ?? 'ATTENDEE') }} ACCOUNT
                    </span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span class="text-xs text-emerald-400 font-mono">Active</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Welcome, <span class="text-gradient-gold">{{ auth()->user()->name }}</span>
                </h1>
                <p class="text-sm text-white/50 mt-1 font-mono text-xs">
                    {{ auth()->user()->email }} &bull; Member since {{ auth()->user()->created_at->format('M Y') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('tickets.mine') }}" class="btn-primary py-2.5 px-5 text-xs font-mono tracking-wider flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    <span>VIEW MY TICKETS</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-mono text-white/50 hover:text-rose-400 border border-white/10 hover:border-rose-500/30 px-3.5 py-2.5 rounded-xl transition-colors">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>

        {{-- Admin Banner if user is Admin --}}
        @if(auth()->user()->isAdmin())
        <div class="mt-6 p-6 rounded-2xl bg-gradient-to-r from-[#D4AF37]/15 via-[#E50914]/10 to-transparent border border-[#D4AF37]/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-[0_0_30px_rgba(212,175,55,0.1)]">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#D4AF37]/20 border border-[#D4AF37]/40 flex items-center justify-center text-[#D4AF37]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-white">Administrator Access Detected</h3>
                    <p class="text-xs text-white/60">Full management control over tickets, scanners, lineup, sponsors, blog & subscribers.</p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="py-2.5 px-6 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#AA7C11] hover:brightness-110 text-black font-bold text-xs font-mono tracking-widest uppercase transition-all shadow-lg shadow-yellow-500/20 whitespace-nowrap text-center">
                ENTER ADMIN PANEL &rarr;
            </a>
        </div>
        @endif

        {{-- Quick Stat / Action Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            {{-- Card 1: My Tickets --}}
            <div class="p-6 rounded-2xl bg-[#121214] border border-white/10 hover:border-[#D4AF37]/40 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-[#D4AF37]/10 border border-[#D4AF37]/20 flex items-center justify-center text-[#D4AF37] mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                </div>
                <h3 class="font-bold text-lg text-white mb-1">My Festival Tickets</h3>
                <p class="text-xs text-white/50 mb-4">Access QR codes, download PDF passes, and verify your admission.</p>
                <a href="{{ route('tickets.mine') }}" class="text-xs font-mono text-[#D4AF37] hover:underline flex items-center gap-1">
                    <span>Manage Tickets</span> &rarr;
                </a>
            </div>

            {{-- Card 2: Festival Lineup --}}
            <div class="p-6 rounded-2xl bg-[#121214] border border-white/10 hover:border-[#E50914]/40 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-[#E50914]/10 border border-[#E50914]/20 flex items-center justify-center text-[#E50914] mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                </div>
                <h3 class="font-bold text-lg text-white mb-1">Artist Line-Up</h3>
                <p class="text-xs text-white/50 mb-4">Check performing headliners, DJ sets, schedule times, and car showcase.</p>
                <a href="{{ route('lineup') }}" class="text-xs font-mono text-[#E50914] hover:underline flex items-center gap-1">
                    <span>Explore Lineup</span> &rarr;
                </a>
            </div>

            {{-- Card 3: Vendor & Car Registration --}}
            <div class="p-6 rounded-2xl bg-[#121214] border border-white/10 hover:border-white/20 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="font-bold text-lg text-white mb-1">Vendor Application</h3>
                <p class="text-xs text-white/50 mb-4">Apply for food stalls, exhibition booths, or register your custom vehicle.</p>
                <a href="{{ route('vendor.apply') }}" class="text-xs font-mono text-white/70 hover:text-white flex items-center gap-1">
                    <span>Submit Application</span> &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
