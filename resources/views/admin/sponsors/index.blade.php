@extends('layouts.admin')
@section('title', 'Sponsors — ELITE Admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="label-eyebrow mb-2">Partnerships</div>
        <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
            SPON<span class="text-gold-gradient">SORS</span>
        </h1>
    </div>
    <a href="{{ route('admin.sponsors.create') }}" class="btn-gold !py-3">
        + ADD SPONSOR
    </a>
</div>

@if (session('success'))
    <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
        ✓ {{ session('success') }}
    </div>
@endif

{{-- Tier filter pills --}}
<div class="grid grid-cols-3 md:grid-cols-6 gap-3 mb-6">
    @foreach ([
        'all'      => ['ALL',      'text-elite-bone'],
        'platinum' => ['PLATINUM', 'text-elite-bone'],
        'gold'     => ['GOLD',     'text-elite-gold'],
        'silver'   => ['SILVER',   'text-elite-smoke'],
        'partner'  => ['PARTNER',  'text-elite-bone'],
        'media'    => ['MEDIA',    'text-elite-bone'],
    ] as $key => $info)
        <a href="{{ $key === 'all' ? route('admin.sponsors.index') : route('admin.sponsors.index', ['tier' => $key]) }}"
           class="card-elite p-4 text-center {{ request('tier') === $key || (!request('tier') && $key === 'all') ? 'border-elite-gold' : '' }}">
            <div class="font-mono text-[9px] tracking-ultra text-elite-smoke mb-1">{{ $info[0] }}</div>
            <div class="heading-bebas text-2xl {{ $info[1] }}">{{ $counts[$key] }}</div>
        </a>
    @endforeach
</div>

<div class="card-elite p-6">
    @if ($sponsors->isEmpty())
        <div class="text-center py-16">
            <div class="text-5xl mb-4">🤝</div>
            <h3 class="heading-bebas text-2xl text-elite-bone mb-3">NO SPONSORS YET</h3>
            <p class="text-elite-smoke text-sm mb-6">Add your first partner to show on the sponsors page.</p>
            <a href="{{ route('admin.sponsors.create') }}" class="btn-gold">+ ADD SPONSOR</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">LOGO</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">NAME</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TIER</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">WEBSITE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">SORT</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sponsors as $sponsor)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3">
                                @if ($sponsor->logo_url)
                                    <div class="w-20 h-12 bg-elite-black border border-elite-steel flex items-center justify-center p-1">
                                        <img src="{{ $sponsor->logo_url }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                @else
                                    <div class="w-20 h-12 bg-elite-black border border-elite-steel flex items-center justify-center text-elite-gold/40 font-display text-sm">
                                        {{ strtoupper(substr($sponsor->name, 0, 2)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 text-sm text-elite-bone font-medium">{{ $sponsor->name }}</td>
                            <td class="py-3">
                                @php
                                    $tierColor = match($sponsor->tier) {
                                        'platinum' => 'bg-elite-bone/20 text-elite-bone',
                                        'gold'     => 'bg-elite-gold/20 text-elite-gold',
                                        'silver'   => 'bg-elite-steel/60 text-elite-bone',
                                        'partner'  => 'bg-blue-500/20 text-blue-400',
                                        'media'    => 'bg-purple-500/20 text-purple-400',
                                        default    => 'bg-elite-steel/40 text-elite-smoke',
                                    };
                                @endphp
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $tierColor }}">
                                    {{ strtoupper($sponsor->tier) }}
                                </span>
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke truncate max-w-[200px]">
                                {{ $sponsor->website ?: '—' }}
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">{{ $sponsor->sort_order }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $sponsor->is_active ? 'bg-green-500/20 text-green-500' : 'bg-elite-steel/40 text-elite-smoke' }}">
                                    {{ $sponsor->is_active ? 'ACTIVE' : 'HIDDEN' }}
                                </span>
                            </td>
                            <td class="py-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.sponsors.edit', $sponsor) }}"
                                   class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone mr-4">
                                    EDIT
                                </a>
                                <form action="{{ route('admin.sponsors.destroy', $sponsor) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete {{ $sponsor->name }}?');">
                                    @csrf @method('DELETE')
                                    <button class="font-mono text-[10px] tracking-ultra text-elite-crimson hover:text-elite-bone">
                                        DELETE
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $sponsors->links() }}</div>
    @endif
</div>

@endsection
