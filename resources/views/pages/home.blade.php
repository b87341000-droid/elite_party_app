@extends('layouts.app')

@section('title', 'ELITE BLOCK PARTY — The Ultimate Car & Music Festival | Lagos Dec 20')
@section('meta_description', "Nigeria's most anticipated car showcase, music festival and nightlife experience. 200+ custom cars, headline artists, VIP experiences. Dec 20, 2025 — Eko Hotel Grounds, Lagos.")

@push('head')
<style>
/* GSAP ScrollTrigger handles [data-reveal] opacity/transform — no CSS needed */

/* ─── Hero text glitch ──────────────────────── */
@keyframes glitch-1 {
    0%, 90%, 100% { clip-path: inset(50% 0 30% 0); transform: translateX(0); }
    92%            { clip-path: inset(50% 0 30% 0); transform: translateX(-4px); }
    94%            { clip-path: inset(20% 0 60% 0); transform: translateX(4px); }
    96%            { clip-path: inset(70% 0 10% 0); transform: translateX(-2px); }
}
@keyframes glitch-2 {
    0%, 88%, 100% { clip-path: inset(30% 0 50% 0); transform: translateX(0); }
    90%            { clip-path: inset(30% 0 50% 0); transform: translateX(4px); }
    92%            { clip-path: inset(60% 0 20% 0); transform: translateX(-4px); }
    94%            { clip-path: inset(10% 0 70% 0); transform: translateX(2px); }
}
.glitch-text { position: relative; display: inline-block; }
.glitch-text::before,
.glitch-text::after {
    content: attr(data-text);
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, #FFFFFF 0%, #A0A0A0 45%, #FFFFFF 55%, #6B6B6B 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
.glitch-text::before {
    color: #00E5FF;
    animation: glitch-1 8s infinite;
    opacity: 0.6;
}
.glitch-text::after {
    color: #E11D2E;
    animation: glitch-2 8s infinite;
    opacity: 0.5;
}

/* ─── Countdown flip effect ─────────────────── */
@keyframes flip-in {
    0%   { transform: rotateX(-90deg); opacity: 0; }
    100% { transform: rotateX(0);      opacity: 1; }
}
.cd-flip { animation: flip-in 0.4s ease-out; }

/* ─── Speed line sweep ──────────────────────── */
@keyframes speed-sweep {
    0%   { opacity: 0; transform: translateX(-100%) skewX(-20deg); }
    10%  { opacity: 1; }
    80%  { opacity: 1; }
    100% { opacity: 0; transform: translateX(200%) skewX(-20deg); }
}
.speed-line { animation: speed-sweep 4s ease-in-out infinite; }
.speed-line:nth-child(2) { animation-delay: 0.5s; }
.speed-line:nth-child(3) { animation-delay: 1s; }
.speed-line:nth-child(4) { animation-delay: 1.5s; }

/* ─── Ticket card tilt ──────────────────────── */
.ticket-card { transform-style: preserve-3d; }
.ticket-card:hover { transform: perspective(800px) rotateY(-6deg) rotateX(2deg) translateY(-8px); }

/* ─── Artist card shimmer border ────────────── */
@keyframes border-travel {
    0%   { background-position: 0% 50%; }
    100% { background-position: 200% 50%; }
}
.shimmer-border {
    background: linear-gradient(90deg, #D4AF37, #F5C518, #E11D2E, #D4AF37);
    background-size: 200% auto;
    animation: border-travel 3s linear infinite;
}

/* ─── Scan line rolling effect ──────────────── */
@keyframes rolling-scan {
    0%   { top: -4px; }
    100% { top: 100%; }
}
.rolling-scan-line {
    position: absolute;
    left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(0,229,255,0.4), transparent);
    animation: rolling-scan 3s linear infinite;
    pointer-events: none;
}

/* ─── Number counter animation ──────────────── */
@keyframes count-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.stat-animate { animation: count-up 0.6s ease-out forwards; }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════ --}}
{{-- HERO SECTION                                --}}
{{-- ═══════════════════════════════════════════ --}}
<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden grain">

    {{-- ── Background layers ── --}}
    <div class="absolute inset-0 bg-gradient-to-b from-elite-black via-elite-coal to-elite-black"></div>
    <div class="absolute inset-0 bg-carbon opacity-50"></div>

    {{-- Ambient blobs --}}
    <div class="absolute top-1/3 -left-40 w-[700px] h-[700px] rounded-full"
         style="background: radial-gradient(circle, rgba(212,175,55,0.12) 0%, transparent 70%);"></div>
    <div class="absolute bottom-1/3 -right-40 w-[700px] h-[700px] rounded-full"
         style="background: radial-gradient(circle, rgba(225,29,46,0.10) 0%, transparent 70%);"></div>

    {{-- Speed lines --}}
    <div class="absolute inset-0 overflow-hidden opacity-15 pointer-events-none">
        <div class="speed-line absolute top-1/4 left-0 right-0 h-px bg-gradient-to-r from-transparent via-elite-gold to-transparent"></div>
        <div class="speed-line absolute top-2/4 left-0 right-0 h-px bg-gradient-to-r from-transparent via-elite-gold to-transparent"></div>
        <div class="speed-line absolute top-3/4 left-0 right-0 h-px bg-gradient-to-r from-transparent via-elite-gold to-transparent"></div>
        <div class="speed-line absolute top-[60%] left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-elite-crimson to-transparent"></div>
    </div>

    {{-- Vertical accent lines --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 left-[15%] w-px h-full bg-gradient-to-b from-elite-gold/0 via-elite-gold/20 to-elite-gold/0"></div>
        <div class="absolute top-0 right-[15%] w-px h-full bg-gradient-to-b from-elite-gold/0 via-elite-gold/20 to-elite-gold/0"></div>
        <div class="absolute top-0 left-[50%] w-px h-full bg-gradient-to-b from-elite-gold/0 via-elite-crimson/10 to-elite-gold/0"></div>
    </div>

    {{-- Rolling scan line --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="rolling-scan-line"></div>
    </div>

    {{-- ── Main content ── --}}
    <div class="relative container-elite text-center pt-36 pb-24 z-10">

        {{-- Eyebrow --}}
        <div class="label-eyebrow mb-8 flex items-center justify-center gap-4" data-reveal>
            <span class="hidden sm:block h-px w-16 bg-gradient-to-r from-transparent to-elite-gold"></span>
            <span class="animate-flicker">◆</span>
            December 20, 2025 &nbsp;·&nbsp; Eko Hotel Grounds, Lagos
            <span class="animate-flicker" style="animation-delay:1s;">◆</span>
            <span class="hidden sm:block h-px w-16 bg-gradient-to-l from-transparent to-elite-gold"></span>
        </div>

        {{-- ELITE wordmark --}}
        <h1 class="heading-display mb-4" aria-label="Elite Block Party">
            <span class="block glitch-text text-chrome" style="font-size: clamp(5rem, 15vw, 14rem); line-height: 0.85; letter-spacing: -0.04em;" data-text="ELITE" data-reveal data-delay="100">ELITE</span>
            <span class="block text-gold-gradient text-shadow-gold" style="font-size: clamp(2rem, 6vw, 6rem); letter-spacing: 0.05em;" data-reveal data-delay="200">BLOCK PARTY</span>
        </h1>

        {{-- Sub-headline --}}
        <p class="max-w-2xl mx-auto text-lg md:text-xl text-elite-smoke mb-12 font-light leading-relaxed" data-reveal data-delay="300">
            Where <span class="text-elite-gold font-semibold">200+ custom builds</span>,
            <span class="text-elite-gold font-semibold">Nigeria's hottest artists</span>, and
            <span class="text-elite-gold font-semibold">Lagos nightlife</span> collide
            for one night that breaks the internet.
        </p>

        {{-- ── Live Countdown ── --}}
        <div class="flex justify-center items-start gap-2 md:gap-4 mb-14" data-reveal data-delay="300">
            @foreach(['Days' => 'countdown-days', 'Hours' => 'countdown-hours', 'Minutes' => 'countdown-minutes', 'Seconds' => 'countdown-seconds'] as $label => $key)
            <div class="flex flex-col items-center">
                <div class="countdown-box w-[68px] md:w-[100px] h-[68px] md:h-[100px] relative overflow-hidden">
                    {{-- Inner scanline --}}
                    <div class="absolute inset-x-0 top-1/2 h-px bg-elite-gold/20 pointer-events-none"></div>
                    <span class="font-bebas text-3xl md:text-5xl text-gold-gradient leading-none"
                          data-countdown-{{ $key }}>00</span>
                </div>
                <div class="mt-2 font-mono text-[9px] md:text-[10px] tracking-ultra text-elite-smoke uppercase">{{ $label }}</div>
            </div>
            @if(!($label === 'Seconds'))
            <div class="font-bebas text-3xl md:text-5xl text-elite-gold/40 mt-2 md:mt-3 leading-none">:</div>
            @endif
            @endforeach
        </div>

        {{-- ── CTAs ── --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16" data-reveal data-delay="400">
            <a href="#tickets" id="hero-buy-btn" class="btn-gold !text-base !px-14 !py-5 group">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                BUY TICKETS NOW
            </a>
            <a href="#lineup" class="btn-outline-gold !text-base !px-14 !py-5 group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm12-3c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2z"/>
                </svg>
                SEE LINE-UP
            </a>
        </div>

        {{-- ── Ticket Tiers Strip ── --}}
        <div class="flex flex-wrap justify-center items-center gap-0 border border-elite-steel/50 clip-corner divide-x divide-elite-steel/50 max-w-3xl mx-auto" data-reveal data-delay="500">
            @foreach([
                ['name' => 'Regular',    'price' => '₦12,000',  'tag' => 'GENERAL ADMISSION'],
                ['name' => 'VIP',        'price' => '₦25,000',  'tag' => 'PREMIUM ACCESS'],
                ['name' => 'VVIP',       'price' => '₦40,000',  'tag' => 'EXCLUSIVE LOUNGE'],
                ['name' => 'Table of 4', 'price' => '₦220,000', 'tag' => 'PRIVATE TABLE'],
            ] as $tier)
            <div class="flex-1 min-w-[120px] px-4 py-4 text-center group cursor-pointer hover:bg-elite-gold/5 transition-colors duration-300">
                <div class="font-bebas text-2xl md:text-3xl text-elite-gold group-hover:text-elite-goldBright transition-colors">{{ $tier['price'] }}</div>
                <div class="font-display text-[10px] md:text-xs text-elite-bone tracking-wider uppercase">{{ $tier['name'] }}</div>
                <div class="font-mono text-[8px] text-elite-smoke tracking-ultra mt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">{{ $tier['tag'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Scroll CTA --}}
    <a href="#event" class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-elite-gold animate-float z-10" aria-label="Scroll down">
        <span class="font-mono text-[9px] tracking-ultra uppercase opacity-60">Scroll</span>
        <div class="w-6 h-10 border-2 border-elite-gold/30 rounded-full flex items-start justify-center p-1">
            <div class="w-1.5 h-1.5 bg-elite-gold rounded-full animate-bounce"></div>
        </div>
    </a>
</section>

{{-- ═══════════════════════════════════════════ --}}
{{-- TIRE TRACK DIVIDER: Hero → Stats            --}}
{{-- ═══════════════════════════════════════════ --}}
@include('components.tire-track-bar')

{{-- ═══════════════════════════════════════════ --}}
{{-- STATS BAR                                   --}}
{{-- ═══════════════════════════════════════════ --}}
<div class="relative z-10 bg-elite-charcoal border-y border-elite-gold/20 overflow-hidden">
    <div class="absolute inset-0 bg-carbon opacity-30"></div>
    <div class="relative container-elite py-6">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 divide-x-0 md:divide-x divide-elite-steel/40">
            @foreach([
                ['200', '200+',  'Custom Cars',         '🏎️'],
                ['10000', '10K+',  'Expected Guests',   '👥'],
                ['20', '20+',   'Live Performances',    '🎤'],
                ['1', '1',     'Night. All Year.',      '⚡'],
            ] as [$raw, $num, $label, $icon])
            <div class="flex items-center gap-4 px-4 md:px-8 py-4 md:py-2 group" data-reveal>
                <span class="text-2xl">{{ $icon }}</span>
                <div>
                    <div class="font-bebas text-3xl md:text-4xl text-elite-gold"
                         data-count-to="{{ $raw }}"
                         data-count-suffix="{{ str_contains($num, 'K') ? 'K+' : (str_contains($num, '+') ? '+' : '') }}">{{ $num }}</div>
                    <div class="font-mono text-[10px] tracking-ultra text-elite-smoke uppercase">{{ $label }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{-- PAINT SPLASH DIVIDER: Stats → Event         --}}
{{-- ═══════════════════════════════════════════ --}}
@include('components.paint-splash-divider', ['label' => '◆ THE EVENT ◆'])

{{-- ═══════════════════════════════════════════ --}}
{{-- EVENT INFO SECTION                          --}}
{{-- ═══════════════════════════════════════════ --}}
<section id="event" class="section-py relative overflow-hidden">
    <div class="glow-orb w-[600px] h-[600px] bg-elite-gold -top-32 -left-32"></div>

    <div class="container-elite">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left: copy --}}
            <div>
                <div class="label-eyebrow mb-4" data-reveal>The Experience</div>
                <h2 class="heading-display text-6xl md:text-7xl lg:text-8xl text-elite-bone mb-6" data-reveal data-delay="100">
                    NOT JUST<br>
                    <span class="text-gold-gradient">AN EVENT.</span><br>
                    A LEGEND.
                </h2>
                <div class="divider-gold mb-8 w-24" data-reveal data-delay="200"></div>
                <p class="text-elite-smoke leading-relaxed mb-8 text-lg" data-reveal data-delay="300">
                    ELITE BLOCK PARTY isn't your average Lagos outing. We're talking
                    <strong class="text-elite-bone">curated car culture</strong> meets
                    <strong class="text-elite-bone">main-stage energy</strong> meets
                    <strong class="text-elite-bone">premium hospitality</strong> — all under
                    one roof for one iconic night.
                </p>

                {{-- Info pills --}}
                <div class="space-y-4" data-reveal data-delay="400">
                    @foreach([
                        ['📅', 'Date',     'Saturday, December 20, 2025'],
                        ['📍', 'Venue',    'Eko Hotel & Suites Grounds, Victoria Island, Lagos'],
                        ['⏰', 'Gates Open', '4:00 PM — After-Party Until Dawn'],
                        ['🎟️', 'Tickets',  '₦12,000 — ₦220,000 (Table of 4)'],
                    ] as [$icon, $label, $value])
                    <div class="flex items-start gap-4 p-4 bg-elite-charcoal border-l-2 border-elite-gold/50 hover:border-elite-gold transition-colors duration-300">
                        <span class="text-xl mt-0.5">{{ $icon }}</span>
                        <div>
                            <div class="font-mono text-[10px] tracking-ultra text-elite-gold uppercase mb-1">{{ $label }}</div>
                            <div class="text-elite-bone font-medium">{{ $value }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: visual card --}}
            <div class="relative" data-reveal data-delay="200">
                {{-- Main card --}}
                <div class="relative bg-elite-charcoal clip-corner-lg border border-elite-gold/20 overflow-hidden p-10">
                    <div class="hud-corner hud-corner-tl !w-10 !h-10"></div>
                    <div class="hud-corner hud-corner-br !w-10 !h-10"></div>
                    <div class="rolling-scan-line"></div>

                    {{-- Big date display --}}
                    <div class="text-center mb-8">
                        <div class="font-mono text-xs tracking-ultra text-elite-gold mb-2">COUNTDOWN TO</div>
                        <div class="font-bebas text-7xl md:text-8xl text-chrome leading-none">DEC</div>
                        <div class="font-bebas text-[9rem] md:text-[11rem] text-gold-gradient leading-none -mt-4 text-shadow-gold">20</div>
                        <div class="font-bebas text-4xl text-elite-smoke tracking-ultra">2025</div>
                    </div>

                    {{-- Live countdown embedded --}}
                    <div class="flex justify-center gap-4 mb-6">
                        @foreach(['Days' => 'countdown-days', 'Hours' => 'countdown-hours', 'Minutes' => 'countdown-minutes'] as $label => $key)
                        <div class="text-center">
                            <div class="font-bebas text-4xl text-elite-gold" data-countdown-{{ $key }}>00</div>
                            <div class="font-mono text-[9px] tracking-ultra text-elite-smoke">{{ $label }}</div>
                        </div>
                        @if(!($label === 'Minutes'))
                        <div class="font-bebas text-4xl text-elite-gold/30 self-start mt-0.5">:</div>
                        @endif
                        @endforeach
                    </div>

                    <a href="#tickets" class="btn-gold w-full justify-center">
                        🎟️ SECURE YOUR SPOT
                    </a>
                </div>

                {{-- Floating badge --}}
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-gold-gradient flex flex-col items-center justify-center shadow-gold-glow animate-spin-slow border-4 border-elite-black">
                    <div class="font-display text-elite-black text-[10px] leading-tight text-center">EARLY<br>BIRD</div>
                    <div class="font-bebas text-elite-black text-xl leading-none">-30%</div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.tire-track-bar')
@include('components.paint-splash-divider', ['label' => '◆ TICKETS ◆'])

<section id="tickets" class="section-py relative overflow-hidden">
    <div class="absolute inset-0 bg-carbon opacity-30"></div>
    <div class="glow-orb w-[500px] h-[500px] bg-elite-crimson top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="relative container-elite">
        <div class="text-center mb-16">
            <div class="label-eyebrow mb-4" data-reveal>Secure Your Experience</div>
            <h2 class="heading-display text-6xl md:text-8xl text-elite-bone" data-reveal data-delay="100">
                CHOOSE YOUR<br><span class="text-gold-gradient">TIER</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                [
                    'name'     => 'Regular',
                    'price'    => '₦12,000',
                    'tag'      => 'General Admission',
                    'features' => ['General Area Access', 'Live Performances', 'Car Showcase Access', 'Street Food Court'],
                    'hot'      => false,
                    'color'    => 'elite-steel',
                ],
                [
                    'name'     => 'VIP',
                    'price'    => '₦25,000',
                    'tag'      => 'Premium Access',
                    'features' => ['VIP Lounge Access', 'Reserved Viewing Area', 'Complimentary Drink', 'Priority Entry', 'Car Showcase Access'],
                    'hot'      => true,
                    'color'    => 'elite-gold',
                ],
                [
                    'name'     => 'VVIP',
                    'price'    => '₦40,000',
                    'tag'      => 'Exclusive Lounge',
                    'features' => ['Exclusive VVIP Lounge', 'Open Bar (3hrs)', 'Meet & Greet Access', 'Dedicated Concierge', 'VIP Parking', 'Giftbag'],
                    'hot'      => false,
                    'color'    => 'elite-crimson',
                ],
                [
                    'name'     => 'Table of 4',
                    'price'    => '₦220,000',
                    'tag'      => 'Private Table',
                    'features' => ['Private Table for 4', 'Open Bar (Full Night)', 'Premium Food Platter', 'Dedicated Waiter', 'VIP Parking x2', 'Exclusive Giftbags', 'Priority Access All Areas'],
                    'hot'      => false,
                    'color'    => 'elite-gold',
                ],
            ] as $i => $tier)
            <div class="ticket-card card-elite transition-all duration-500 relative overflow-hidden {{ $tier['hot'] ? 'border-elite-gold/60 shadow-gold-glow' : '' }}"
                 style="transition-delay: {{ $i * 100 }}ms"
                 data-reveal data-delay="{{ $i * 100 }}">

                {{-- Hot badge --}}
                @if($tier['hot'])
                <div class="absolute top-0 right-0 bg-gold-gradient text-elite-black font-display text-[10px] tracking-wider uppercase px-3 py-1 clip-slash-left">
                    🔥 MOST POPULAR
                </div>
                @endif

                {{-- Shimmer border on hover --}}
                <div class="absolute inset-x-0 top-0 h-0.5 shimmer-border opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-8">
                    {{-- Header --}}
                    <div class="mb-6">
                        <div class="font-mono text-[10px] tracking-ultra text-elite-smoke uppercase mb-2">{{ $tier['tag'] }}</div>
                        <div class="font-display text-2xl text-elite-bone mb-4 uppercase">{{ $tier['name'] }}</div>
                        <div class="font-bebas text-5xl text-elite-gold leading-none">{{ $tier['price'] }}</div>
                        <div class="font-mono text-[10px] text-elite-smoke">PER PERSON</div>
                    </div>

                    <div class="divider-gold mb-6"></div>

                    {{-- Features --}}
                    <ul class="space-y-3 mb-8">
                        @foreach($tier['features'] as $feature)
                        <li class="flex items-center gap-3 text-sm text-elite-smoke">
                            <span class="text-elite-gold flex-shrink-0">◆</span>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>

                    {{-- CTA --}}
                    @if($tier['hot'])
                    <a href="{{ route('tickets.index') }}" class="btn-gold w-full justify-center">Buy Now</a>
                    @else
                    <a href="{{ route('tickets.index') }}" class="btn-outline-gold w-full justify-center">Select Tier</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Vendor stall note --}}
        <div class="mt-8 text-center p-6 border border-elite-steel/50 bg-elite-charcoal/50" data-reveal>
            <span class="font-mono text-xs text-elite-smoke">🏪 Vendor Stalls available from </span>
            <span class="text-elite-gold font-mono text-sm font-bold">₦150,000</span>
            <span class="font-mono text-xs text-elite-smoke"> — </span>
            <a href="#vendors" class="font-mono text-xs text-elite-gold underline hover:no-underline">Apply to be a vendor →</a>
        </div>
    </div>
</section>

@include('components.paint-splash-divider', ['label' => '◆ LINE-UP ◆'])
@include('components.tire-track-bar')

<section id="lineup" class="section-py relative overflow-hidden">
    <div class="glow-orb w-[800px] h-[400px] bg-elite-gold bottom-0 left-0 opacity-10"></div>

    <div class="container-elite">
        <div class="text-center mb-16">
            <div class="label-eyebrow mb-4" data-reveal>The Soundtrack</div>
            <h2 class="heading-display text-6xl md:text-9xl text-elite-bone" data-reveal data-delay="100">
                LINE<span class="text-crimson-gradient">—</span>UP
            </h2>
            <p class="text-elite-smoke mt-4 text-lg" data-reveal data-delay="200">
                Nigeria's biggest stages. The hottest acts. One night.
            </p>
        </div>

        {{-- Artist placeholder cards --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-12">
            @foreach([
                ['slot' => '★ HEADLINER',    'teaser' => '???',  'tier' => 'Main Stage',    'time' => '11:00 PM', 'crimson' => true],
                ['slot' => 'CO-HEADLINER',   'teaser' => '???',  'tier' => 'Main Stage',    'time' => '9:30 PM',  'crimson' => false],
                ['slot' => 'SPECIAL GUEST',  'teaser' => '???',  'tier' => 'VIP Stage',     'time' => '8:00 PM',  'crimson' => false],
                ['slot' => 'OPENING ACT',    'teaser' => '???',  'tier' => 'Main Stage',    'time' => '6:30 PM',  'crimson' => false],
                ['slot' => 'DJ SET',         'teaser' => '???',  'tier' => 'After-Party',   'time' => '1:00 AM',  'crimson' => false],
                ['slot' => 'LIVE BAND',      'teaser' => '???',  'tier' => 'VVIP Lounge',   'time' => '7:00 PM',  'crimson' => false],
                ['slot' => 'AFRO BEATS',     'teaser' => '???',  'tier' => 'Pool Stage',    'time' => '5:00 PM',  'crimson' => false],
                ['slot' => '+ MORE TBA',     'teaser' => '⚡',   'tier' => 'Coming Soon',   'time' => '???',      'crimson' => false],
            ] as $i => $artist)
            <div class="relative group card-elite overflow-hidden aspect-[3/4] flex flex-col justify-end cursor-pointer"
                 data-reveal data-delay="{{ min($i * 80, 500) }}">

                {{-- Background with noise --}}
                <div class="absolute inset-0 bg-gradient-to-b from-elite-steel/50 to-elite-black/90
                            {{ $artist['crimson'] ? 'border-2 border-elite-crimson/60 shadow-crimson-glow' : '' }}">
                </div>
                <div class="absolute inset-0 bg-carbon opacity-50"></div>

                {{-- "?" reveal --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="font-bebas text-[6rem] text-elite-steel/30 group-hover:text-elite-gold/20 transition-colors duration-500">
                        {{ $artist['teaser'] }}
                    </span>
                </div>

                {{-- Shimmer on hover --}}
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                     style="background: linear-gradient(135deg, transparent 40%, rgba(212,175,55,0.08) 100%);">
                </div>

                {{-- Content --}}
                <div class="relative p-5 z-10">
                    <div class="font-mono text-[9px] tracking-ultra text-elite-gold uppercase mb-1">{{ $artist['slot'] }}</div>
                    <div class="font-bebas text-2xl text-elite-bone">ARTIST TBA</div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="font-mono text-[9px] text-elite-smoke">{{ $artist['tier'] }}</span>
                        <span class="font-mono text-[9px] text-elite-smoke">{{ $artist['time'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Announcement CTA --}}
        <div class="text-center" data-reveal>
            <div class="inline-block relative">
                <div class="p-8 md:p-12 border border-elite-gold/30 bg-elite-charcoal clip-corner-lg text-center">
                    <div class="font-mono text-xs tracking-ultra text-elite-gold mb-3 animate-pulse">ANNOUNCEMENT DROPPING SOON</div>
                    <div class="heading-display text-4xl md:text-5xl text-elite-bone mb-4">
                        FOLLOW US FOR THE<br><span class="text-gold-gradient">REVEAL</span>
                    </div>
                    <div class="flex flex-wrap gap-3 justify-center">
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="btn-gold !px-6 !py-3 !text-xs">
                            📸 Instagram
                        </a>
                        <a href="https://tiktok.com" target="_blank" rel="noopener" class="btn-outline-gold !px-6 !py-3 !text-xs">
                            🎵 TikTok
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.tire-track-bar')
@include('components.paint-splash-divider', ['label' => '◆ EXPERIENCES ◆'])

<section id="experiences" class="section-py relative overflow-hidden bg-elite-coal">
    <div class="absolute inset-0 bg-carbon opacity-40"></div>
    <div class="glow-orb w-[600px] h-[600px] bg-elite-crimson top-1/2 right-0 -translate-y-1/2 opacity-15"></div>

    <div class="relative container-elite">
        <div class="text-center mb-16">
            <div class="label-eyebrow mb-4" data-reveal>What Awaits You</div>
            <h2 class="heading-display text-6xl md:text-8xl" data-reveal data-delay="100">
                THE <span class="text-gold-gradient">EXPERIENCE</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['🏎️', 'CAR SHOWCASE', "200+ of Lagos' most custom, exotic, and modified builds on full display. From Lambos to local builds — every machine is a statement."],
                ['🎤', 'LIVE PERFORMANCES', 'Nigeria\'s top artists bring energy you can\'t stream. Multi-stage setup. Back-to-back sets. All night long.'],
                ['👑', 'VVIP EXPERIENCE', 'Open bar, private table, dedicated waitstaff, and a ringside view of everything. The closest thing to a private event.'],
                ['🍽️', 'CULINARY STREET', 'Gourmet street food from the best vendors in Lagos. From suya to sushi — properly premium.'],
                ['📸', 'CONTENT ZONE', 'Professionally lit car showcase backdrop, branded photo booths, drone shots. Your feed will never be the same.'],
                ['🌙', 'THE AFTER-PARTY', 'When the main event wraps, the real night begins. DJ sets, exclusive access, and Lagos nightlife at its peak.'],
            ] as $i => [$icon, $title, $desc])
            <div class="relative p-8 bg-elite-charcoal border border-elite-steel hover:border-elite-gold/40 transition-all duration-500 group cursor-default"
                 data-reveal data-delay="{{ min($i * 100, 500) }}">

                {{-- Left racing stripe --}}
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-elite-gold via-elite-crimson to-elite-gold opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                {{-- HUD corner --}}
                <div class="hud-corner hud-corner-tl opacity-0 group-hover:opacity-100 transition-opacity duration-300 !w-5 !h-5"></div>

                <div class="text-4xl mb-4">{{ $icon }}</div>
                <div class="font-display text-lg text-elite-bone mb-3 uppercase tracking-wider group-hover:text-elite-gold transition-colors duration-300">
                    {{ $title }}
                </div>
                <p class="text-sm text-elite-smoke leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('components.paint-splash-divider', ['label' => '◆ VENDORS ◆'])

<section id="vendors" class="section-py relative overflow-hidden">
    <div class="glow-orb w-[500px] h-[500px] bg-elite-gold top-0 right-0 opacity-10"></div>

    <div class="container-elite">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Vendor card --}}
            <div class="relative p-10 md:p-14 bg-elite-charcoal clip-corner-lg border border-elite-gold/20
                        hover:border-elite-gold/50 hover:shadow-gold-glow transition-all duration-500 overflow-hidden"
                 data-reveal>
                <div class="hud-corner hud-corner-tl !w-8 !h-8"></div>
                <div class="hud-corner hud-corner-br !w-8 !h-8"></div>
                <div class="absolute inset-0 bg-carbon opacity-20"></div>
                <div class="relative">
                    <div class="label-eyebrow mb-4">Vendors & Exhibitors</div>
                    <h3 class="heading-display text-4xl md:text-5xl text-elite-bone mb-4">
                        SELL AT<br><span class="text-gold-gradient">ELITE</span>
                    </h3>
                    <p class="text-elite-smoke mb-8 leading-relaxed">
                        10,000+ paying guests. Premium audience. Curated experience. Stalls from ₦150,000. Food, fashion, lifestyle, auto accessories — we want the best.
                    </p>
                    <a href="#" class="btn-gold">Apply as Vendor →</a>
                </div>
            </div>

            {{-- Sponsor card --}}
            <div class="relative p-10 md:p-14 bg-elite-charcoal clip-corner-lg border border-elite-crimson/20
                        hover:border-elite-crimson/50 hover:shadow-crimson-glow transition-all duration-500 overflow-hidden"
                 data-reveal data-delay="200">
                <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-elite-crimson to-elite-crimsonDeep"></div>
                <div class="absolute inset-0 bg-carbon opacity-20"></div>
                <div class="relative">
                    <div class="label-eyebrow mb-4 !text-elite-crimson">Brand Partners</div>
                    <h3 class="heading-display text-4xl md:text-5xl text-elite-bone mb-4">
                        SPONSOR<br><span class="text-crimson-gradient">ELITE</span>
                    </h3>
                    <p class="text-elite-smoke mb-8 leading-relaxed">
                        Associate your brand with Lagos' most premium lifestyle event. Logo placement, branded zones, social media features, and live mentions.
                    </p>
                    <a href="#" class="btn-crimson">Become a Sponsor →</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.tire-track-bar')
@include('components.paint-splash-divider', ['label' => '◆ REVIEWS ◆'])

<section class="section-py relative overflow-hidden bg-elite-coal border-t border-elite-gold/10">
    <div class="glow-orb w-[700px] h-[300px] bg-elite-gold top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-5"></div>

    <div class="container-elite text-center mb-16">
        <div class="label-eyebrow mb-4" data-reveal>Word On The Street</div>
        <h2 class="heading-display text-5xl md:text-7xl text-elite-bone" data-reveal data-delay="100">
            WHAT THEY<br><span class="text-gold-gradient">SAID</span>
        </h2>
    </div>

    <div class="container-elite grid md:grid-cols-3 gap-6">
        @foreach([
            ['"Easily the best event I attended in Lagos in 2024. Cars were crazy, lineup was crazy, vibe was 100."', '@tobi_drives', '⭐⭐⭐⭐⭐'],
            ['"The VVIP experience was worth every kobo. Open bar, private table, meet & greet — I\'ve never felt more treated."', '@ada.lifestyle', '⭐⭐⭐⭐⭐'],
            ['"Bro my car got featured on 3 major pages from that show. The photography zone was elite."', '@lagos_gearhead', '⭐⭐⭐⭐⭐'],
        ] as $i => [$quote, $handle, $stars])
        <div class="relative p-8 bg-elite-charcoal border border-elite-steel hover:border-elite-gold/30 transition-all duration-500 group"
             data-reveal data-delay="{{ $i * 150 }}">
            <div class="absolute top-0 left-0 w-full h-0.5 shimmer-border opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="font-mono text-xs text-elite-gold mb-4">{{ $stars }}</div>
            <p class="text-elite-bone leading-relaxed mb-6 font-light italic">{{ $quote }}</p>
            <div class="font-bebas tracking-ultra text-elite-smoke text-sm">{{ $handle }}</div>
        </div>
        @endforeach
    </div>
</section>

@include('components.paint-splash-divider', ['label' => '◆ CONTACT ◆'])

<section id="contact" class="section-py relative">
    <div class="container-elite">
        <div class="text-center mb-16">
            <div class="label-eyebrow mb-4" data-reveal>Get In Touch</div>
            <h2 class="heading-display text-5xl md:text-7xl text-elite-bone" data-reveal data-delay="100">
                CONTACT <span class="text-gold-gradient">US</span>
            </h2>
        </div>

        <div class="max-w-2xl mx-auto" data-reveal data-delay="200">
            <form class="space-y-5" onsubmit="event.preventDefault(); alert('Contact form coming in a future step!');">
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="label-eyebrow block mb-2" for="contact-name">Your Name</label>
                        <input type="text" id="contact-name" required placeholder="John Doe"
                               class="w-full bg-elite-charcoal border border-elite-steel focus:border-elite-gold
                                      text-elite-bone font-mono text-sm placeholder-elite-smoke
                                      px-5 py-4 outline-none transition-colors duration-300">
                    </div>
                    <div>
                        <label class="label-eyebrow block mb-2" for="contact-email">Email</label>
                        <input type="email" id="contact-email" required placeholder="you@email.com"
                               class="w-full bg-elite-charcoal border border-elite-steel focus:border-elite-gold
                                      text-elite-bone font-mono text-sm placeholder-elite-smoke
                                      px-5 py-4 outline-none transition-colors duration-300">
                    </div>
                </div>
                <div>
                    <label class="label-eyebrow block mb-2" for="contact-subject">Subject</label>
                    <select id="contact-subject"
                            class="w-full bg-elite-charcoal border border-elite-steel focus:border-elite-gold
                                   text-elite-bone font-mono text-sm px-5 py-4 outline-none transition-colors duration-300">
                        <option value="">Select inquiry type...</option>
                        <option>Ticket Inquiry</option>
                        <option>Vendor Application</option>
                        <option>Sponsorship</option>
                        <option>Media / Press</option>
                        <option>General Inquiry</option>
                    </select>
                </div>
                <div>
                    <label class="label-eyebrow block mb-2" for="contact-message">Message</label>
                    <textarea id="contact-message" rows="5" required placeholder="Your message..."
                              class="w-full bg-elite-charcoal border border-elite-steel focus:border-elite-gold
                                     text-elite-bone font-mono text-sm placeholder-elite-smoke
                                     px-5 py-4 outline-none transition-colors duration-300 resize-none"></textarea>
                </div>
                <button type="submit" class="btn-gold w-full justify-center !py-5 text-base">
                    Send Message →
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
