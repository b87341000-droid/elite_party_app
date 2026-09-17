@extends('layouts.app')

@section('title', 'Your Cart — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="Review & Pay"
    title="YOUR"
    highlight="CART"
    subtitle="Double-check your order before checkout."
    :breadcrumb="['Home' => route('home'), 'Tickets' => route('tickets.index'), 'Cart' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-5xl">

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

        @if (empty($cart['items']))
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🛒</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">YOUR CART IS EMPTY</h3>
                <p class="text-elite-smoke mb-8">Add some tickets and come back.</p>
                <a href="{{ route('tickets.index') }}" class="btn-gold">BROWSE TICKETS</a>
            </div>
        @else

            <div class="space-y-4 mb-8">
                @foreach ($cart['items'] as $item)
                    <div class="card-elite p-6 flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex-1">
                            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">
                                {{ strtoupper($item['ticket_type']->name) }}
                            </div>
                            <div class="heading-bebas text-2xl text-elite-bone">
                                {{ $item['ticket_type']->name }}
                            </div>
                            <div class="font-mono text-xs text-elite-smoke mt-1">
                                {{ '₦' . number_format($item['unit_price'], 0) }} each
                            </div>
                        </div>

                        <form action="{{ route('cart.update', $item['ticket_type']) }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                   min="0" max="{{ $item['ticket_type']->max_per_order }}"
                                   class="w-20 bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-3 py-2 font-mono text-sm">
                            <button type="submit" class="text-elite-gold font-mono text-xs tracking-ultra hover:text-elite-bone transition-colors">
                                UPDATE
                            </button>
                        </form>

                        <div class="font-bebas text-2xl text-gold-gradient min-w-[100px] text-right">
                            {{ '₦' . number_format($item['line_total'], 0) }}
                        </div>

                        <form action="{{ route('cart.remove', $item['ticket_type']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-elite-crimson hover:text-elite-bone transition-colors text-2xl">
                                ×
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="divider-gold mb-8"></div>

            <div class="grid md:grid-cols-2 gap-8 items-start">
                <div>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-elite-smoke font-mono text-xs tracking-ultra hover:text-elite-crimson transition-colors">
                            ✗ CLEAR CART
                        </button>
                    </form>
                </div>

                <div class="card-elite p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-mono text-xs tracking-ultra text-elite-smoke">SUBTOTAL</span>
                        <span class="font-bebas text-xl text-elite-bone">
                            {{ '₦' . number_format($cart['subtotal'], 0) }}
                        </span>
                    </div>
                    <div class="divider-gold mb-4"></div>
                    <div class="flex justify-between items-center mb-6">
                        <span class="font-bebas text-lg text-elite-bone">TOTAL</span>
                        <span class="font-bebas text-3xl text-gold-gradient">
                            {{ '₦' . number_format($cart['total'], 0) }}
                        </span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn-gold w-full justify-center">
                        PROCEED TO CHECKOUT →
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
