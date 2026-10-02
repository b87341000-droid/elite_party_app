@extends('layouts.app')

@section('title', 'Event Details — ELITE BLOCK PARTY 2025')

@section('content')

<x-page-header
    eyebrow="December 20, 2025"
    title="EVENT"
    highlight="DETAILS"
    subtitle="Everything you need to know before the night begins."
    :breadcrumb="['Home' => route('home'), 'Event' => null]"
/>

{{-- Key info grid --}}
<section class="py-16 md:py-20">
    <div class="container-elite">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ([
                ['📅', 'DATE', 'Saturday, Dec 20, 2025'],
                ['🕕', 'TIME', 'Doors: 6 PM • Show: 8 PM – 4 AM'],
                ['📍', 'VENUE', 'Eko Hotel Grounds, Victoria Island'],
                ['🎟️', 'TICKETS', 'From ₦12,000'],
            ] as $info)
                <div class="card-elite p-6 racing-stripe pl-8">
                    <div class="text-3xl mb-3">{{ $info[0] }}</div>
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">{{ $info[1] }}</div>
                    <div class="font-bebas text-lg text-elite-bone">{{ $info[2] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- About the night --}}
<section class="py-16 md:py-20">
    <div class="container-elite max-w-4xl">
        <div class="label-eyebrow mb-4">The Night</div>
        <h2 class="heading-display text-4xl md:text-6xl text-elite-bone mb-8">
            WHAT TO <span class="text-gold-gradient">EXPECT</span>
        </h2>

        <div class="space-y-5 text-elite-smoke leading-relaxed text-lg">
            <p>
                Twelve hours of non-stop energy. Two main stages. One massive car showcase featuring over 200 custom builds, supercars, and award-winning rides from across West Africa.
            </p>
            <p>
                The night kicks off with the car parade at 6 PM, followed by the first live performances at 8 PM. Headliners take the main stage at 11 PM, and the afterparty runs until sunrise for VVIP guests.
            </p>
            <p>
                Expect surprise guest appearances. Expect a food village with 30+ premium vendors. Expect the best night of your year.
            </p>
        </div>
    </div>
</section>

{{-- Schedule timeline --}}
<section class="py-16 md:py-24 bg-elite-coal border-y border-elite-steel/40">
    <div class="container-elite max-w-4xl">
        <div class="text-center mb-12">
            <div class="label-eyebrow mb-4">Run Of Show</div>
            <h2 class="heading-display text-4xl md:text-6xl text-elite-bone">
                THE <span class="text-gold-gradient">TIMELINE</span>
            </h2>
        </div>

        <div class="space-y-6">
            @foreach ([
                ['6:00 PM', 'DOORS OPEN', 'Gates open. Security check-in begins.'],
                ['6:30 PM', 'CAR PARADE', '200+ custom builds arrive on the main strip.'],
                ['8:00 PM', 'FIRST PERFORMANCE', 'Opening acts take the stage.'],
                ['9:30 PM', 'CAR AWARDS', 'Best in Show, People\'s Choice, and more.'],
                ['11:00 PM', 'HEADLINER SET', 'The moment everyone came for.'],
                ['1:00 AM', 'SURPRISE GUEST', 'You didn\'t hear it from us.'],
                ['2:00 AM', 'AFTERPARTY', 'VVIP-only afterparty till sunrise.'],
            ] as $i => $slot)
                <div class="flex gap-6 items-start">
                    <div class="flex-shrink-0 w-24 md:w-32 pt-1">
                        <div class="font-bebas text-2xl text-gold-gradient">{{ $slot[0] }}</div>
                    </div>
                    <div class="relative flex-shrink-0 pt-1">
                        <div class="w-3 h-3 bg-elite-gold rounded-full ring-4 ring-elite-gold/20"></div>
                        @if (!$loop->last)
                            <div class="absolute top-4 left-1.5 w-px h-full bg-elite-gold/30"></div>
                        @endif
                    </div>
                    <div class="flex-1 pb-6">
                        <div class="heading-bebas text-xl text-elite-bone mb-1">{{ $slot[1] }}</div>
                        <div class="text-sm text-elite-smoke">{{ $slot[2] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Venue --}}
<section class="py-16 md:py-24">
    <div class="container-elite">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative aspect-video bg-elite-charcoal border border-elite-steel overflow-hidden card-elite group">
                <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?w=1000&h=600&fit=crop"
                     alt="Eko Hotel Grounds Lagos"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-elite-black via-elite-black/40 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
                    <div>
                        <div class="font-bebas text-xl text-elite-bone">EKO HOTEL GROUNDS</div>
                        <div class="font-mono text-[9px] tracking-ultra text-elite-gold">VICTORIA ISLAND, LAGOS</div>
                    </div>
                    <span class="px-3 py-1 bg-elite-gold text-elite-black font-mono text-[9px] tracking-ultra font-bold">VENUE</span>
                </div>
            </div>

            <div>
                <div class="label-eyebrow mb-4">Getting There</div>
                <h2 class="heading-display text-4xl md:text-5xl text-elite-bone mb-6">
                    THE <span class="text-gold-gradient">VENUE</span>
                </h2>
                <div class="space-y-4 text-elite-smoke">
                    <div>
                        <div class="font-bebas text-lg text-elite-bone">Eko Hotel & Suites</div>
                        <div class="text-sm">Plot 1415 Adetokunbo Ademola Street, Victoria Island, Lagos</div>
                    </div>
                    <div class="divider-gold"></div>
                    <ul class="space-y-3 text-sm">
                        <li class="flex gap-3">
                            <span class="text-elite-gold">◆</span>
                            <span>Complimentary parking for all ticket holders</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-elite-gold">◆</span>
                            <span>Valet service available (VIP & VVIP)</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-elite-gold">◆</span>
                            <span>Ride-hailing drop-off zone at Gate 3</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-elite-gold">◆</span>
                            <span>Fully wheelchair accessible</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 md:py-32 bg-elite-coal border-t border-elite-steel/40">
    <div class="container-elite text-center">
        <h2 class="heading-display text-5xl md:text-7xl text-elite-bone mb-8">
            READY FOR <span class="text-gold-gradient">THE NIGHT</span>?
        </h2>
        <a href="{{ route('home') }}#tickets" class="btn-gold text-base !px-12 !py-5">🎟️ BUY TICKETS NOW</a>
    </div>
</section>

@endsection
