@extends('layouts.app')

@section('title', 'About ELITE BLOCK PARTY — Our Story')

@section('content')

<x-page-header
    eyebrow="Our Story"
    title="ABOUT"
    highlight="ELITE"
    subtitle="Born from Lagos nightlife. Built for a generation that demands more."
    :breadcrumb="['Home' => route('home'), 'About' => null]"
/>

{{-- Origin story --}}
<section class="py-20 md:py-28">
    <div class="container-elite grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
        <div class="relative aspect-[4/5] bg-elite-charcoal border border-elite-steel overflow-hidden card-elite group">
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800&h=1000&fit=crop"
                 alt="Elite Block Party Festival Origins"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-elite-black via-elite-black/30 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6">
                <div class="font-mono text-xs tracking-ultra text-elite-gold mb-1">EST. 2018 • LAGOS</div>
                <div class="heading-display text-2xl text-elite-bone">WHERE IT ALL STARTED</div>
            </div>
            <div class="absolute top-4 left-4 w-12 h-12 border-t-2 border-l-2 border-elite-gold pointer-events-none"></div>
            <div class="absolute bottom-4 right-4 w-12 h-12 border-b-2 border-r-2 border-elite-gold pointer-events-none"></div>
        </div>

        <div>
            <div class="label-eyebrow mb-4">The Beginning</div>
            <h2 class="heading-display text-4xl md:text-6xl text-elite-bone mb-6">
                FROM A <span class="text-gold-gradient">PARKING LOT</span> TO A MOVEMENT
            </h2>
            <div class="space-y-5 text-elite-smoke leading-relaxed">
                <p>
                    ELITE BLOCK PARTY started in 2018 as a small gathering of car enthusiasts in a Lekki parking lot. Fifty cars. One sound system. A night nobody wanted to end.
                </p>
                <p>
                    Seven years later, it's Nigeria's most anticipated convergence of car culture, live music, and premium nightlife — hosting <span class="text-elite-gold font-medium">200+ custom builds</span>, <span class="text-elite-gold font-medium">50+ artists</span>, and <span class="text-elite-gold font-medium">35,000+ attendees</span> under one sky.
                </p>
                <p>
                    We don't just throw events. We engineer moments that people talk about for years.
                </p>
            </div>

            <div class="divider-gold my-8"></div>

            <div class="grid grid-cols-3 gap-6">
                @foreach ([['2018','FOUNDED'],['7','EDITIONS'],['35K+','FAMILY']] as $stat)
                    <div>
                        <div class="font-bebas text-3xl text-gold-gradient">{{ $stat[0] }}</div>
                        <div class="font-mono text-[10px] tracking-ultra text-elite-smoke mt-1">{{ $stat[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Mission --}}
<section class="py-20 md:py-28 bg-elite-coal border-y border-elite-steel/40">
    <div class="container-elite">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <div class="label-eyebrow mb-4">What We Stand For</div>
            <h2 class="heading-display text-5xl md:text-7xl text-elite-bone">
                OUR <span class="text-gold-gradient">MISSION</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ([
                ['🎯', 'CURATE EXCELLENCE', 'Every detail — from sound to lighting to security — is engineered to world-class standard.'],
                ['🤝', 'BUILD COMMUNITY', 'We connect enthusiasts, creators, and brands who share a passion for culture and craft.'],
                ['🚀', 'ELEVATE THE CULTURE', 'We push Nigerian entertainment to global standards. No compromises. No shortcuts.'],
            ] as $value)
                <div class="card-elite p-8 text-center">
                    <div class="text-5xl mb-6">{{ $value[0] }}</div>
                    <h3 class="heading-bebas text-2xl text-elite-bone mb-3">{{ $value[1] }}</h3>
                    <p class="text-sm text-elite-smoke leading-relaxed">{{ $value[2] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 md:py-32">
    <div class="container-elite text-center">
        <h2 class="heading-display text-5xl md:text-7xl text-elite-bone mb-8">
            BE PART OF <span class="text-gold-gradient">THE NEXT CHAPTER</span>
        </h2>
        <a href="{{ route('home') }}#tickets" class="btn-gold text-base !px-12 !py-5">🎟️ BUY TICKETS</a>
    </div>
</section>

@endsection
