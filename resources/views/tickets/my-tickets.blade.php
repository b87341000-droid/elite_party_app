@extends('layouts.app')

@section('title', 'My Tickets — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="Your Passes"
    title="MY"
    highlight="TICKETS"
    subtitle="All your ELITE tickets in one place. Download PDFs, show QR at the gate."
    :breadcrumb="['Home' => route('home'), 'My Tickets' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-5xl">

        @if ($tickets->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">🎟️</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">NO TICKETS YET</h3>
                <p class="text-elite-smoke mb-8">Buy your first ticket to see it here.</p>
                <a href="{{ route('tickets.index') }}" class="btn-gold">BROWSE TICKETS</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($tickets as $ticket)
                    <div class="card-elite p-6 flex flex-col md:flex-row md:items-center gap-6">

                        {{-- Left: info --}}
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="font-mono text-[10px] tracking-ultra text-elite-gold">
                                    {{ strtoupper($ticket->ticketType->name ?? 'TICKET') }}
                                </span>
                                @if ($ticket->is_scanned)
                                    <span class="px-2 py-0.5 bg-elite-crimson/20 text-elite-crimson font-mono text-[9px] tracking-ultra">
                                        USED
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-elite-gold/20 text-elite-gold font-mono text-[9px] tracking-ultra">
                                        VALID
                                    </span>
                                @endif
                            </div>
                            <div class="heading-bebas text-2xl text-elite-bone mb-1">
                                {{ $ticket->ticket_code }}
                            </div>
                            <div class="font-mono text-xs text-elite-smoke">
                                {{ $ticket->attendee_name }} • {{ $ticket->attendee_email }}
                            </div>
                        </div>

                        {{-- Right: actions --}}
                        <div class="flex gap-3">
                            <a href="{{ route('tickets.pdf', $ticket->uuid) }}"
                               class="btn-gold !px-5 !py-3 !text-xs">
                                DOWNLOAD PDF
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection