@extends('layouts.app')

@section('title', 'Checkout — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="Almost There"
    title="CHECK"
    highlight="OUT"
    subtitle="Your tickets will be emailed to you instantly after payment."
    :breadcrumb="['Home' => route('home'), 'Cart' => route('cart.index'), 'Checkout' => null]"
/>

<section class="py-20">
    <div class="container-elite grid lg:grid-cols-3 gap-10">

        {{-- Form --}}
        <div class="lg:col-span-2">
            <div class="card-elite p-8 md:p-10">
                <div class="label-eyebrow mb-3">Your Details</div>
                <h2 class="heading-display text-4xl text-elite-bone mb-8">
                    WHO'S <span class="text-gold-gradient">COMING</span>?
                </h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
                        @foreach ($errors->all() as $error)
                            <div>✗ {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">FULL NAME *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                               class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">EMAIL *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                        </div>
                        <div>
                            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">PHONE *</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required
                                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">NOTES (OPTIONAL)</label>
                        <textarea name="notes" rows="3"
                                  class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('notes') }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-elite-steel">
                        <div class="flex items-start gap-3 text-sm text-elite-smoke mb-4">
                            <span class="text-elite-gold mt-1">🔒</span>
                            <span>Payment is secure. Your tickets with QR codes will be emailed instantly after successful payment.</span>
                        </div>

                        <button type="submit" class="btn-gold w-full justify-center text-base !py-5 shimmer-btn">
                            <span class="relative z-10">PAY NOW →</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Order summary --}}
        <div class="lg:col-span-1">
            <div class="card-elite p-6 sticky top-24">
                <div class="label-eyebrow mb-4">Order Summary</div>

                <div class="space-y-3 mb-6">
                    @foreach ($cart['items'] as $item)
                        <div class="flex justify-between items-start text-sm">
                            <div>
                                <div class="font-bebas text-elite-bone">{{ $item['ticket_type']->name }}</div>
                                <div class="font-mono text-[10px] text-elite-smoke">
                                    {{ $item['quantity'] }} × {{ '₦' . number_format($item['unit_price'], 0) }}
                                </div>
                            </div>
                            <div class="font-mono text-elite-gold">
                                {{ '₦' . number_format($item['line_total'], 0) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="divider-gold mb-4"></div>

                <div class="flex justify-between items-center">
                    <span class="font-bebas text-lg text-elite-bone">TOTAL</span>
                    <span class="font-bebas text-3xl text-gold-gradient">
                        {{ '₦' . number_format($cart['total'], 0) }}
                    </span>
                </div>

                <div class="mt-6 p-4 bg-elite-gold/5 border border-elite-gold/20 text-center">
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">
                        ⚡ DEV MODE
                    </div>
                    <div class="font-mono text-[10px] text-elite-smoke">
                        Mock payment auto-succeeds
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
