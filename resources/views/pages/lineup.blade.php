@extends('layouts.app')

@section('title', 'Line-Up — ELITE BLOCK PARTY 2025')

@section('content')

<x-page-header
    eyebrow="Full Roster"
    title="THE"
    highlight="LINE-UP"
    subtitle="50+ artists. DJs. Hosts. Special guests you won't see coming."
    :breadcrumb="['Home' => route('home'), 'Line-Up' => null]"
/>

<section class="py-20">
    <div class="container-elite">

        @if ($artists->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🎤</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">LINE-UP ANNOUNCEMENT SOON</h3>
                <p class="text-elite-smoke max-w-md mx-auto">
                    Artists will be revealed over the coming weeks. Follow us on Instagram for first-look announcements.
                </p>
            </div>
        @else

            {{-- Headliners --}}
            @if ($headliners->isNotEmpty())
                <div class="mb-20">
                    <div class="label-eyebrow mb-6 text-center">Headliners</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($headliners as $artist)
                            <div class="group relative aspect-[3/4] bg-elite-charcoal border border-elite-steel overflow-hidden card-elite">
                                @if ($artist->photo_url)
                                    <img src="{{ $artist->photo_url }}"
                                         alt="{{ $artist->display_name }}"
                                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-elite-gold/10 via-transparent to-elite-crimson/10"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="heading-display text-9xl text-gold-gradient/20">
                                            {{ strtoupper(substr($artist->display_name, 0, 1)) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-elite-black via-elite-black/40 to-transparent"></div>

                                <div class="absolute top-4 left-4 px-3 py-1 bg-elite-gold text-elite-black font-mono text-[10px] tracking-ultra">
                                    HEADLINER
                                </div>

                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">
                                        {{ strtoupper($artist->role) }}
                                    </div>
                                    <div class="heading-display text-3xl md:text-4xl text-elite-bone">
                                        {{ $artist->display_name }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Performers --}}
            @if ($performers->isNotEmpty())
                <div>
                    <div class="label-eyebrow mb-6 text-center">Performers & DJs</div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($performers as $artist)
                            <div class="group relative aspect-square bg-elite-charcoal border border-elite-steel overflow-hidden card-elite">
                                @if ($artist->photo_url)
                                    <img src="{{ $artist->photo_url }}"
                                         alt="{{ $artist->display_name }}"
                                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="absolute inset-0 bg-carbon opacity-40"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="heading-display text-6xl text-gold-gradient/20">
                                            {{ strtoupper(substr($artist->display_name, 0, 1)) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-elite-black to-transparent"></div>

                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="heading-bebas text-lg text-elite-bone">{{ $artist->display_name }}</div>
                                    <div class="font-mono text-[9px] tracking-ultra text-elite-gold mt-1">
                                        {{ strtoupper($artist->role) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>

<section class="py-24 bg-elite-coal border-t border-elite-steel/40">
    <div class="container-elite text-center">
        <h2 class="heading-display text-5xl md:text-7xl text-elite-bone mb-8">
            DON'T MISS <span class="text-gold-gradient">A SINGLE SET</span>
        </h2>
        <a href="{{ route('home') }}#tickets" class="btn-gold text-base !px-12 !py-5">🎟️ BUY TICKETS</a>
    </div>
</section>

@endsection
