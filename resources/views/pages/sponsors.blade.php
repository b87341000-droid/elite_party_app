@extends('layouts.app')

@section('title', 'Sponsors & Partners — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="Backed By The Best"
    title="OUR"
    highlight="PARTNERS"
    subtitle="The brands that make ELITE possible."
    :breadcrumb="['Home' => route('home'), 'Sponsors' => null]"
/>

<section class="py-20">
    <div class="container-elite">

        @if ($sponsors->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🤝</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">SPONSORS ANNOUNCED SOON</h3>
                <p class="text-elite-smoke max-w-md mx-auto">
                    Our 2025 partner lineup will be revealed shortly.
                </p>
            </div>
        @else
            @foreach ($tiers as $tierName => $tierSponsors)
                @if ($tierSponsors->isNotEmpty())
                    <div class="mb-16">
                        <div class="flex items-center gap-6 mb-8">
                            <div class="label-eyebrow whitespace-nowrap">{{ strtoupper($tierName) }} PARTNERS</div>
                            <div class="flex-1 divider-gold"></div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($tierSponsors as $sponsor)
                                <a href="{{ $sponsor->website ?? '#' }}"
                                   target="_blank" rel="noopener"
                                   class="card-elite p-8 aspect-square flex flex-col items-center justify-center text-center group">
                                    @if ($sponsor->logo)
                                        <img src="{{ asset('storage/' . $sponsor->logo) }}"
                                             alt="{{ $sponsor->name }}"
                                             class="max-w-full max-h-20 mb-4 grayscale group-hover:grayscale-0 transition-all duration-500">
                                    @endif
                                    <div class="font-bebas text-lg text-elite-bone group-hover:text-elite-gold transition-colors">
                                        {{ $sponsor->name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        {{-- Sponsor CTA --}}
        <div class="mt-20 p-10 md:p-16 bg-elite-charcoal border border-elite-gold/30 clip-corner-lg text-center">
            <div class="label-eyebrow mb-4">Partner With Us</div>
            <h2 class="heading-display text-4xl md:text-6xl text-elite-bone mb-6">
                BECOME A <span class="text-gold-gradient">SPONSOR</span>
            </h2>
            <p class="text-elite-smoke max-w-xl mx-auto mb-8">
                Reach 35,000+ engaged attendees and millions online. Custom packages available.
            </p>
            <a href="{{ route('contact') }}" class="btn-gold">REQUEST PROPOSAL →</a>
        </div>
    </div>
</section>

@endsection
