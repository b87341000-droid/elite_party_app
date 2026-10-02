@extends('layouts.admin')
@section('title', 'Announcements — ELITE Admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="label-eyebrow mb-2">Broadcast</div>
        <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
            ANNOUNCE<span class="text-gold-gradient">MENTS</span>
        </h1>
    </div>
    <a href="{{ route('admin.announcements.create') }}" class="btn-gold !py-3">
        + NEW ANNOUNCEMENT
    </a>
</div>

@if (session('success'))
    <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
        ✓ {{ session('success') }}
    </div>
@endif

{{-- Stats --}}
<div class="grid grid-cols-3 gap-3 mb-6">
    @foreach ([
        ['ALL',       $counts['all'],       'text-elite-bone'],
        ['PUBLISHED', $counts['published'], 'text-green-500'],
        ['EMAILED',   $counts['emailed'],   'text-elite-gold'],
    ] as $s)
        <div class="card-elite p-4 text-center">
            <div class="font-mono text-[9px] tracking-ultra text-elite-smoke mb-1">{{ $s[0] }}</div>
            <div class="heading-bebas text-2xl {{ $s[2] }}">{{ $s[1] }}</div>
        </div>
    @endforeach
</div>

<div class="card-elite p-6">
    @if ($announcements->isEmpty())
        <div class="text-center py-16">
            <div class="text-5xl mb-4">📣</div>
            <h3 class="heading-bebas text-2xl text-elite-bone mb-3">NO ANNOUNCEMENTS</h3>
            <p class="text-elite-smoke text-sm mb-6">Create an announcement to broadcast to your audience.</p>
            <a href="{{ route('admin.announcements.create') }}" class="btn-gold">+ NEW ANNOUNCEMENT</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TITLE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">AUDIENCE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">EMAIL</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">DATE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $ann)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3">
                                <div class="text-sm text-elite-bone font-medium max-w-xs truncate">{{ $ann->title }}</div>
                            </td>
                            <td class="py-3">
                                @php
                                    $audColor = match($ann->audience) {
                                        'all'            => 'bg-elite-gold/15 text-elite-gold',
                                        'customers'      => 'bg-green-500/20 text-green-400',
                                        'vendors'        => 'bg-blue-500/20 text-blue-400',
                                        'ticket_holders' => 'bg-purple-500/20 text-purple-400',
                                        default          => 'bg-elite-steel/40 text-elite-smoke',
                                    };
                                @endphp
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $audColor }}">
                                    {{ strtoupper(str_replace('_', ' ', $ann->audience)) }}
                                </span>
                            </td>
                            <td class="py-3">
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $ann->is_published ? 'bg-green-500/20 text-green-500' : 'bg-elite-steel/40 text-elite-smoke' }}">
                                    {{ $ann->is_published ? 'LIVE' : 'DRAFT' }}
                                </span>
                            </td>
                            <td class="py-3">
                                @if ($ann->emailed_at)
                                    <span class="px-2 py-1 font-mono text-[9px] tracking-ultra bg-green-500/20 text-green-500">
                                        SENT {{ $ann->emailed_at->format('M d') }}
                                    </span>
                                @elseif ($ann->send_email)
                                    <span class="px-2 py-1 font-mono text-[9px] tracking-ultra bg-yellow-500/20 text-yellow-400">
                                        PENDING
                                    </span>
                                @else
                                    <span class="text-elite-smoke text-xs">—</span>
                                @endif
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">
                                {{ $ann->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-3 text-right whitespace-nowrap">
                                @if (! $ann->emailed_at)
                                    <form action="{{ route('admin.announcements.send', $ann) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Send this announcement to all {{ $ann->audience }} users?');">
                                        @csrf
                                        <button class="font-mono text-[10px] tracking-ultra text-green-500 hover:text-elite-bone mr-4">
                                            📤 SEND
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.announcements.edit', $ann) }}"
                                   class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone mr-4">
                                    EDIT
                                </a>
                                <form action="{{ route('admin.announcements.destroy', $ann) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this announcement?');">
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

        <div class="mt-6">{{ $announcements->links() }}</div>
    @endif
</div>

@endsection
