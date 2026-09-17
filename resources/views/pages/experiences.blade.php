@extends('layouts.app')

@section('title', 'Experiences & Activities — ELITE BLOCK PARTY 2025')

@section('content')

<x-page-header
    eyebrow="Not Just A Concert"
    title="THE"
    highlight="EXPERIENCE"
    subtitle="Six worlds. One night. Built for those who want more than a show."
    :breadcrumb="['Home' => route('home'), 'Experiences' => null]"
/>

<section class="py-20">
    <div class="container-elite">
        @if ($experiences->isEmpty())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['🏎️','CAR SHOWCASE','200+ custom builds, supercars, and award-winning rides on full display all night.'],
                    ['🎤','LIVE PERFORMANCES',"Nigeria's biggest artists, DJs, and surprise guests across two main stages."],
                    ['👑','VVIP LOUNGE','Private restrooms, front-row views, dedicated bar service, and complimentary welcome drinks.'],
                    ['🍽️','FOOD VILLAGE','30+ premium vendors — from suya to sushi, jollof to wagyu. Curated for taste.'],
                    ['🛍️','SHOP THE DROP','Limited-edition merch, fashion collabs, and car accessories on-site.'],
                    ['🍾','AFTERPARTY','The night doesn\'t end. VVIP afterparty runs till sunrise.'],
                ] as $i => $exp)
                    <div class="card-elite p-8 relative group">
                        <div class="absolute top-4 right-4 font-mono text-[10px] text-elite-gold/40">
                            0{{ $i + 1 }}
                        </div>
                        <div class="text-5xl mb-6 group-hover:scale-110 transition-transform duration-500">{{ $exp[0] }}</div>
                        <h3 class="heading-display text-2xl text-elite-bone mb-3">{{ $exp[1] }}</h3>
                        <p class="text-sm text-elite-smoke leading-relaxed">{{ $exp[2] }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($experiences as $i => $exp)
                    <div class="card-elite p-8 relative group">
                        <div class="absolute top-4 right-4 font-mono text-[10px] text-elite-gold/40">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="text-5xl mb-6 group-hover:scale-110 transition-transform duration-500">
                            {{ $exp->icon ?? '✨' }}
                        </div>
                        <h3 class="heading-display text-2xl text-elite-bone mb-3">{{ $exp->title }}</h3>
                        <p class="text-sm text-elite-smoke leading-relaxed">{{ $exp->description }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- VVIP Highlight --}}
<section class="py-20 bg-elite-coal border-y border-elite-steel/40">
    <div class="container-elite">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="label-eyebrow mb-4">Elevated Experience</div>
                <h2 class="heading-display text-5xl md:text-7xl text-elite-bone mb-6">
                    GO <span class="text-gold-gradient">VVIP</span>
                </h2>
                <p class="text-elite-smoke text-lg mb-8">
                    The ultimate way to experience ELITE. Front-row views, private everything, and service that anticipates your next move.
                </p>

                <ul class="space-y-4">
                    @foreach ([
                        'Front-row stage & car showcase views',
                        'Dedicated bar service — no lines',
                        'Private restrooms & VIP lounge access',
                        'Complimentary welcome drinks & canapés',
                        'VIP afterparty access till sunrise',
                        'Priority valet parking',
                    ] as $perk)
                        <li class="flex gap-3 items-start">
                            <span class="text-elite-gold mt-1">◆</span>
                            <span class="text-elite-bone">{{ $perk }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <div>
                        <div class="font-mono text-[10px] tracking-ultra text-elite-smoke">VVIP FROM</div>
                        <div class="font-bebas text-4xl text-gold-gradient">₦40,000</div>
                    </div>
                    <a href="{{ route('home') }}#tickets" class="btn-gold self-center">SECURE VVIP →</a>
                </div>
            </div>

            <div class="relative aspect-square bg-elite-charcoal border border-elite-gold/30 overflow-hidden card-elite">
                <div class="absolute inset-0 bg-gradient-to-br from-elite-gold/20 via-transparent to-elite-crimson/20"></div>
                <div class="absolute inset-0 bg-carbon opacity-40"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-8xl mb-4">👑</div>
                        <div class="heading-display text-4xl text-gold-gradient">VVIP</div>
                    </div>
                </div>
                <div class="absolute top-4 left-4 w-12 h-12 border-t-2 border-l-2 border-elite-gold"></div>
                <div class="absolute bottom-4 right-4 w-12 h-12 border-b-2 border-r-2 border-elite-gold"></div>
            </div>
        </div>
    </div>
</section>

<section class="py-24">
    <div class="container-elite text-center">
        <h2 class="heading-display text-5xl md:text-7xl text-elite-bone mb-8">
            PICK YOUR <span class="text-gold-gradient">WORLD</span>
        </h2>
        <a href="{{ route('home') }}#tickets" class="btn-gold text-base !px-12 !py-5">🎟️ VIEW ALL TICKETS</a>
    </div>
</section>

@endsection
