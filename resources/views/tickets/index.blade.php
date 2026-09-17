@extends('layouts.app')

@section('title', 'Tickets — ELITE BLOCK PARTY 2025')

@section('content')

<x-page-header
    eyebrow="Secure Your Spot"
    title="BUY"
    highlight="TICKETS"
    subtitle="Prices go up at the door. Lock in early-bird pricing now."
    :breadcrumb="['Home' => route('home'), 'Tickets' => null]"
/>

<section class="py-20">
    <div class="container-elite">

        @if (session('success'))
            <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if ($types->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🎟️</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">TICKETS COMING SOON</h3>
                <p class="text-elite-smoke max-w-md mx-auto mb-8">
                    Ticket sales aren't open yet. Subscribe to our newsletter to get early-bird alerts.
                </p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($types as $type)
                    <div class="card-elite p-8 flex flex-col relative overflow-hidden">

                        @if ($type->isSoldOut())
                            <div class="absolute top-4 right-4 px-3 py-1 bg-elite-crimson text-white font-mono text-[10px] tracking-ultra">
                                SOLD OUT
                            </div>
                        @endif

                        <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-3">
                            {{ strtoupper($type->name) }}
                        </div>

                        <div class="heading-display text-3xl md:text-4xl text-elite-bone mb-4">
                            {{ $type->name }}
                        </div>

                        @if ($type->description)
                            <p class="text-sm text-elite-smoke mb-6">{{ $type->description }}</p>
                        @endif

                        <div class="mb-6">
                            <div class="font-bebas text-5xl text-gold-gradient">
                                {{ $type->formatted_online_price }}
                            </div>
                            @if ($type->formatted_door_price)
                                <div class="font-mono text-xs text-elite-smoke mt-1">
                                    At-door: {{ $type->formatted_door_price }}
                                </div>
                            @endif
                        </div>

                        @if (!empty($type->perks))
                            <ul class="space-y-2 mb-8 flex-1">
                                @foreach ($type->perks as $perk)
                                    <li class="flex gap-2 text-sm text-elite-bone">
                                        <span class="text-elite-gold">◆</span>
                                        <span>{{ $perk }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($type->isSoldOut())
                            <button disabled class="btn-outline-gold w-full justify-center opacity-50 cursor-not-allowed">
                                SOLD OUT
                            </button>
                        @else
                            <form action="{{ route('cart.add', $type) }}" method="POST" class="space-y-3">
                                @csrf
                                <div class="flex items-center gap-3">
                                    <label class="font-mono text-[10px] tracking-ultra text-elite-gold">QTY</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $type->max_per_order }}"
                                           class="flex-1 bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-3 py-2 font-mono text-sm">
                                </div>
                                <button type="submit" class="btn-gold w-full justify-center">
                                    ADD TO CART →
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
