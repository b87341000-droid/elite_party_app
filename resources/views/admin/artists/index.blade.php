@extends('layouts.admin')
@section('title', 'Artists — ELITE Admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="label-eyebrow mb-2">Line-Up Management</div>
        <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
            ART<span class="text-gold-gradient">ISTS</span>
        </h1>
    </div>
    <a href="{{ route('admin.artists.create') }}" class="btn-gold !py-3">
        + ADD ARTIST
    </a>
</div>

@if (session('success'))
    <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
        ✓ {{ session('success') }}
    </div>
@endif

<div class="card-elite p-6">
    @if ($artists->isEmpty())
        <div class="text-center py-16">
            <div class="text-5xl mb-4">🎤</div>
            <h3 class="heading-bebas text-2xl text-elite-bone mb-3">NO ARTISTS YET</h3>
            <p class="text-elite-smoke text-sm mb-6">Add your first artist to populate the line-up page.</p>
            <a href="{{ route('admin.artists.create') }}" class="btn-gold">+ ADD ARTIST</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">PHOTO</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">NAME</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">ROLE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">HEADLINER</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">SORT</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artists as $artist)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3">
                                @if ($artist->photo_url)
                                    <img src="{{ $artist->photo_url }}" class="w-12 h-12 object-cover border border-elite-steel">
                                @else
                                    <div class="w-12 h-12 bg-elite-black border border-elite-steel flex items-center justify-center text-elite-gold/40 font-display text-lg">
                                        {{ strtoupper(substr($artist->display_name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-3">
                                <div class="text-sm text-elite-bone font-medium">{{ $artist->display_name }}</div>
                                @if ($artist->stage_name && $artist->name !== $artist->stage_name)
                                    <div class="font-mono text-[10px] text-elite-smoke">{{ $artist->name }}</div>
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="font-mono text-[10px] tracking-ultra text-elite-gold">{{ strtoupper($artist->role) }}</span>
                            </td>
                            <td class="py-3">
                                @if ($artist->is_headliner)
                                    <span class="px-2 py-1 bg-elite-gold/20 text-elite-gold font-mono text-[9px] tracking-ultra">YES</span>
                                @else
                                    <span class="font-mono text-[10px] text-elite-smoke">—</span>
                                @endif
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">{{ $artist->sort_order }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $artist->is_active ? 'bg-green-500/20 text-green-500' : 'bg-elite-steel/40 text-elite-smoke' }}">
                                    {{ $artist->is_active ? 'ACTIVE' : 'HIDDEN' }}
                                </span>
                            </td>
                            <td class="py-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.artists.edit', $artist) }}"
                                   class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone mr-4">
                                    EDIT
                                </a>
                                <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete {{ $artist->display_name }}? This cannot be undone.');">
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

        <div class="mt-6">{{ $artists->links() }}</div>
    @endif
</div>

@endsection