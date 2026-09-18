@extends('layouts.admin')

@section('title', 'Admin Dashboard — ELITE')

@section('content')

<div class="mb-8">
    <div class="label-eyebrow mb-2">Admin Panel</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        DASH<span class="text-gold-gradient">BOARD</span>
    </h1>
</div>

{{-- Stats --}}
<div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
    @foreach ([
        ['REVENUE',       '₦' . number_format($stats['revenue'], 0),  'total', $stats['revenue'] > 0],
        ['ORDERS TODAY',  $stats['orders_today'],                     'today',  $stats['orders_today'] > 0],
        ['TICKETS SOLD',  $stats['tickets_sold'],                     'issued', $stats['tickets_sold'] > 0],
        ['SCANNED',       $stats['tickets_scanned'],                  'at gate',$stats['tickets_scanned'] > 0],
        ['CUSTOMERS',     $stats['customers'],                        'total',  $stats['customers'] > 0],
    ] as $stat)
        <div class="card-elite p-5">
            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">{{ $stat[0] }}</div>
            <div class="heading-bebas text-3xl text-elite-bone">{{ $stat[1] }}</div>
            <div class="font-mono text-[9px] text-elite-smoke mt-1">{{ $stat[2] }}</div>
        </div>
    @endforeach
</div>

{{-- Quick actions --}}
<div class="grid md:grid-cols-2 gap-4 mb-10">
    <a href="{{ route('admin.scanner') }}" class="card-elite p-6 group flex items-center gap-5">
        <div class="text-4xl">📷</div>
        <div>
            <div class="heading-bebas text-2xl text-elite-bone group-hover:text-elite-gold transition-colors">OPEN SCANNER</div>
            <div class="font-mono text-[10px] tracking-ultra text-elite-smoke mt-1">Scan tickets at the gate</div>
        </div>
    </a>
    <a href="{{ route('admin.scan-logs.index') }}" class="card-elite p-6 group flex items-center gap-5">
        <div class="text-4xl">📋</div>
        <div>
            <div class="heading-bebas text-2xl text-elite-bone group-hover:text-elite-gold transition-colors">SCAN LOGS</div>
            <div class="font-mono text-[10px] tracking-ultra text-elite-smoke mt-1">Full scan history</div>
        </div>
    </a>
</div>

{{-- Recent orders --}}
<div class="card-elite p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <div class="heading-bebas text-2xl text-elite-bone">RECENT ORDERS</div>
        <div class="font-mono text-[10px] tracking-ultra text-elite-gold">{{ count($recentOrders) }} SHOWN</div>
    </div>

    @if ($recentOrders->isEmpty())
        <div class="text-center py-10 text-elite-smoke text-sm">No orders yet.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">REFERENCE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">CUSTOMER</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TOTAL</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3 font-mono text-xs text-elite-bone">{{ $order->reference }}</td>
                            <td class="py-3 text-sm text-elite-bone">{{ $order->customer_name }}</td>
                            <td class="py-3 font-bebas text-lg text-gold-gradient">{{ $order->formatted_total }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra
                                    {{ $order->status === 'paid' ? 'bg-elite-gold/20 text-elite-gold' : 'bg-elite-crimson/20 text-elite-crimson' }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">{{ $order->created_at->format('M d, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- Recent scans --}}
<div class="card-elite p-6">
    <div class="heading-bebas text-2xl text-elite-bone mb-6">RECENT CHECK-INS</div>

    @if ($recentScans->isEmpty())
        <div class="text-center py-10 text-elite-smoke text-sm">No scans yet.</div>
    @else
        <div class="space-y-2">
            @foreach ($recentScans as $ticket)
                <div class="flex items-center justify-between p-3 bg-elite-black border border-elite-steel/30">
                    <div>
                        <div class="font-bebas text-elite-bone">{{ $ticket->attendee_name }}</div>
                        <div class="font-mono text-[10px] text-elite-smoke">
                            {{ $ticket->ticket_code }} • {{ strtoupper($ticket->ticketType->name ?? '') }}
                        </div>
                    </div>
                    <div class="font-mono text-[10px] text-elite-gold">
                        {{ $ticket->scanned_at->format('g:i A') }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection