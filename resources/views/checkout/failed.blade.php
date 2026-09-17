@extends('layouts.app')

@section('title', 'Payment Failed — ELITE BLOCK PARTY')

@section('content')

<section class="py-32">
    <div class="container-elite max-w-2xl text-center">
        <div class="w-24 h-24 mx-auto mb-8 bg-elite-crimson/10 border-2 border-elite-crimson clip-corner flex items-center justify-center">
            <svg class="w-12 h-12 text-elite-crimson" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>

        <div class="label-eyebrow mb-4">Payment Failed</div>
        <h1 class="heading-display text-5xl md:text-7xl text-elite-bone mb-6">
            SOMETHING WENT <span class="text-gold-gradient">WRONG</span>
        </h1>
        <p class="text-elite-smoke mb-10">
            Your payment could not be processed. No charge was made. Please try again.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('cart.index') }}" class="btn-gold">BACK TO CART</a>
            <a href="{{ route('contact') }}" class="btn-outline-gold">CONTACT SUPPORT</a>
        </div>
    </div>
</section>

@endsection
