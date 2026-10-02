@extends('layouts.admin')
@section('title', 'Newsletter Subscribers — ELITE Admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="label-eyebrow mb-2">Audience</div>
        <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
            NEWSLETTER <span class="text-gold-gradient">SUBSCRIBERS</span>
        </h1>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.subscribers.export') }}" class="btn-gold !py-3">
            ⬇ EXPORT CSV
        </a>
    </div>
</div>

@if (session('success'))
    <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
        ✓ {{ session('success') }}
    </div>
@endif

<div class="card-elite p-6 mb-6">
    <form method="GET" action="{{ route('admin.subscribers.index') }}" class="flex gap-4">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by email or name..."
               class="bg-elite-black border border-elite-steel text-elite-bone px-4 py-2 text-sm w-full md:w-80 focus:border-elite-gold outline-none">
        <button type="submit" class="px-5 py-2 bg-elite-gold text-elite-black font-mono text-xs font-bold tracking-wider uppercase hover:bg-white transition-colors">
            SEARCH
        </button>
        @if (!empty($search))
            <a href="{{ route('admin.subscribers.index') }}" class="px-4 py-2 border border-elite-steel text-elite-smoke font-mono text-xs flex items-center hover:text-white">
                CLEAR
            </a>
        @endif
    </form>
</div>

<div class="card-elite p-6">
    @if ($subscribers->isEmpty())
        <div class="text-center py-16">
            <div class="text-5xl mb-4">📧</div>
            <h3 class="heading-bebas text-2xl text-elite-bone mb-3">NO SUBSCRIBERS FOUND</h3>
            <p class="text-elite-smoke text-sm">No subscriber records matched your criteria.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">EMAIL</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">NAME</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">SOURCE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">SUBSCRIBED AT</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $sub)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3 text-sm text-elite-bone font-medium">{{ $sub->email }}</td>
                            <td class="py-3 text-sm text-elite-smoke">{{ $sub->name ?: '—' }}</td>
                            <td class="py-3 font-mono text-xs text-elite-gold">{{ strtoupper($sub->source ?? 'website') }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $sub->is_active ? 'bg-green-500/20 text-green-500' : 'bg-red-500/20 text-red-500' }}">
                                    {{ $sub->is_active ? 'ACTIVE' : 'UNSUBSCRIBED' }}
                                </span>
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">
                                {{ $sub->created_at ? $sub->created_at->format('M d, Y H:i') : '—' }}
                            </td>
                            <td class="py-3 text-right whitespace-nowrap">
                                <form action="{{ route('admin.subscribers.destroy', $sub) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Remove {{ $sub->email }}?');">
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

        <div class="mt-6">{{ $subscribers->links() }}</div>
    @endif
</div>

@endsection
