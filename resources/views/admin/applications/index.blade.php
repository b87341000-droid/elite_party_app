@extends('layouts.admin')
@section('title', 'Applications — ELITE Admin')

@section('content')

<div class="mb-8">
    <div class="label-eyebrow mb-2">Submissions</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        APPLI<span class="text-gold-gradient">CATIONS</span>
    </h1>
</div>

{{-- Stat pills --}}
<div class="grid sm:grid-cols-3 lg:grid-cols-5 gap-3 mb-6">
    @foreach ([
        ['PENDING',    $counts['pending'],    'text-elite-gold'],
        ['APPROVED',   $counts['approved'],   'text-green-500'],
        ['REJECTED',   $counts['rejected'],   'text-elite-crimson'],
        ['VENDORS',    $counts['vendors'],    'text-elite-bone'],
        ['SPONSORS',   $counts['sponsors'],   'text-elite-bone'],
    ] as $s)
        <div class="card-elite p-4">
            <div class="font-mono text-[10px] tracking-ultra text-elite-smoke mb-1">{{ $s[0] }}</div>
            <div class="heading-bebas text-2xl {{ $s[2] }}">{{ $s[1] }}</div>
        </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="flex flex-wrap gap-2 mb-6">
    <div class="flex flex-wrap gap-2">
        @foreach (['all' => 'ALL', 'pending' => 'PENDING', 'approved' => 'APPROVED', 'rejected' => 'REJECTED'] as $key => $label)
            <a href="{{ $key === 'all' ? route('admin.applications.index') : route('admin.applications.index', ['status' => $key]) }}"
               class="px-4 py-2 font-bebas text-xs tracking-wider {{ (request('status') === $key || (!request('status') && $key === 'all')) ? 'bg-elite-gold text-elite-black' : 'border border-elite-steel text-elite-smoke hover:text-elite-gold hover:border-elite-gold' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="flex flex-wrap gap-2 ml-auto">
        @foreach (['food' => 'FOOD', 'fashion' => 'FASHION', 'sponsor' => 'SPONSOR', 'volunteer' => 'VOLUNTEER', 'performer' => 'PERFORMER', 'media' => 'MEDIA'] as $key => $label)
            <a href="{{ route('admin.applications.index', array_filter(['type' => $key, 'status' => request('status')])) }}"
               class="px-3 py-2 font-mono text-[10px] tracking-ultra {{ request('type') === $key ? 'bg-elite-gold text-elite-black' : 'border border-elite-steel text-elite-smoke hover:text-elite-gold' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

{{-- Table --}}
<div class="card-elite p-6">
    @if ($applications->isEmpty())
        <div class="text-center py-10 text-elite-smoke text-sm">No applications found.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">DATE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TYPE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">BUSINESS / NAME</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">CONTACT</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $app)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3 font-mono text-xs text-elite-smoke">{{ $app->created_at->format('M d') }}</td>
                            <td class="py-3">
                                <span class="font-mono text-[10px] tracking-ultra text-elite-gold">{{ strtoupper($app->type) }}</span>
                            </td>
                            <td class="py-3">
                                <div class="text-sm text-elite-bone">{{ $app->business_name ?: $app->contact_name }}</div>
                                <div class="font-mono text-[10px] text-elite-smoke">{{ $app->email }}</div>
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">{{ $app->phone }}</td>
                            <td class="py-3">
                                @php
                                    $badge = match($app->status) {
                                        'pending'  => 'bg-elite-gold/20 text-elite-gold',
                                        'approved' => 'bg-green-500/20 text-green-500',
                                        'rejected' => 'bg-elite-crimson/20 text-elite-crimson',
                                        default    => 'bg-elite-steel/40 text-elite-smoke',
                                    };
                                @endphp
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $badge }}">
                                    {{ strtoupper($app->status) }}
                                </span>
                            </td>
                            <td class="py-3 text-right">
                                <a href="{{ route('admin.applications.show', $app) }}"
                                   class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
                                    VIEW →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $applications->links() }}</div>
    @endif
</div>

@endsection