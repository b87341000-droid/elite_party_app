@extends('layouts.app')

@section('title', 'Payment Successful — ELITE BLOCK PARTY')

@section('content')

<section class="py-32">
    <div class="container-elite max-w-3xl text-center">

        <div class="w-24 h-24 mx-auto mb-8 bg-elite-gold/10 border-2 border-elite-gold clip-corner flex items-center justify-center">
            <svg class="w-12 h-12 text-elite-gold" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <div class="label-eyebrow mb-4">Payment Confirmed</div>
        <h1 class="heading-display text-5xl md:text-7xl text-gold-gradient mb-6">
            YOU'RE IN.
        </h1>
        <p class="text-elite-smoke text-lg mb-10 max-w-xl mx-auto">
            Your tickets have been issued. A confirmation email is on its way with your QR codes.
        </p>

        {{-- Order card --}}
        <div class="card-elite p-8 text-left mb-10">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">ORDER REFERENCE</div>
                    <div class="font-bebas text-xl text-elite-bone">{{ $order->reference }}</div>
                </div>
                <div>
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">AMOUNT PAID</div>
                    <div class="font-bebas text-xl text-gold-gradient">{{ $order->formatted_total }}</div>
                </div>
                <div>
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">NAME</div>
                    <div class="font-bebas text-xl text-elite-bone">{{ $order->customer_name }}</div>
                </div>
                <div>
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">EMAIL</div>
                    <div class="font-bebas text-base text-elite-bone truncate">{{ $order->customer_email }}</div>
                </div>
            </div>

            <div class="divider-gold mb-6"></div>

            <div class="label-eyebrow mb-4">Your Tickets ({{ $order->tickets->count() }})</div>

            <div class="space-y-3">
                @foreach ($order->tickets as $ticket)
                    <div class="flex items-center justify-between p-4 bg-elite-black border border-elite-steel">
                        <div>
                            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">
                                {{ strtoupper($ticket->ticketType->name ?? 'TICKET') }}
                            </div>
                            <div class="font-bebas text-lg text-elite-bone">{{ $ticket->ticket_code }}</div>
                        </div>
                        <div class="font-mono text-[10px] text-elite-smoke">
                            QR emailed
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="btn-gold">BACK TO HOME</a>
            <a href="{{ route('tickets.index') }}" class="btn-outline-gold">BUY MORE TICKETS</a>
        </div>
    </div>
</section>

@endsection
