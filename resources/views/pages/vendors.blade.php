@extends('layouts.app')

@section('title', 'Vendors & Directory — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="Food • Fashion • Merch"
    title="OUR"
    highlight="VENDORS"
    subtitle="30+ curated vendors bringing the best of Lagos to one place."
    :breadcrumb="['Home' => route('home'), 'Vendors' => null]"
/>

<section class="py-20">
    <div class="container-elite">
        @if ($vendors->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🛍️</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">VENDOR LIST COMING SOON</h3>
                <p class="text-elite-smoke max-w-md mx-auto mb-8">
                    We're curating this year's lineup of premium vendors. Check back soon for the full directory.
                </p>
                <a href="{{ route('contact') }}" class="btn-gold">APPLY AS VENDOR →</a>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $vendorImages = [
                        'food' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=300&fit=crop',
                        'merchandise' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=600&h=300&fit=crop',
                        'drinks' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=600&h=300&fit=crop',
                    ];
                @endphp
                @foreach ($vendors as $vendor)
                    <div class="card-elite overflow-hidden group">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ $vendorImages[$vendor->type] ?? 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=300&fit=crop' }}"
                                 alt="{{ $vendor->business_name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-elite-charcoal via-transparent to-transparent"></div>
                            <span class="absolute top-3 left-3 px-2 py-0.5 bg-elite-gold text-elite-black font-mono text-[9px] tracking-ultra font-bold uppercase">
                                {{ $vendor->type }}
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="heading-bebas text-2xl text-elite-bone mb-2">
                                {{ $vendor->business_name }}
                            </h3>
                            <p class="text-sm text-elite-smoke line-clamp-3">
                                {{ $vendor->description }}
                            </p>
                            @if ($vendor->instagram)
                                <a href="https://instagram.com/{{ ltrim($vendor->instagram, '@') }}"
                                   target="_blank" rel="noopener"
                                   class="inline-block mt-4 font-mono text-xs text-elite-gold hover:text-elite-bone transition-colors">
                                    {{ $vendor->instagram }} →
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Vendor CTA --}}
        <div class="mt-20 p-10 md:p-16 bg-elite-charcoal border border-elite-gold/30 clip-corner-lg text-center">
            <div class="label-eyebrow mb-4">Got Something To Sell?</div>
            <h2 class="heading-display text-4xl md:text-6xl text-elite-bone mb-6">
                BECOME A <span class="text-gold-gradient">VENDOR</span>
            </h2>
            <p class="text-elite-smoke max-w-xl mx-auto mb-8">
                Food, fashion, merch, or lifestyle — if your brand fits the ELITE vibe, we want to hear from you.
            </p>
            <a href="{{ route('contact') }}" class="btn-gold">APPLY NOW →</a>
        </div>
    </div>
</section>

@endsection
