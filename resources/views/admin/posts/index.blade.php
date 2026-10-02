@extends('layouts.admin')
@section('title', 'Blog Posts — ELITE Admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="label-eyebrow mb-2">Content</div>
        <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
            BLOG <span class="text-gold-gradient">POSTS</span>
        </h1>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn-gold !py-3">
        + NEW POST
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
        ['DRAFT',     $counts['draft'],     'text-elite-smoke'],
    ] as $s)
        <div class="card-elite p-4 text-center">
            <div class="font-mono text-[9px] tracking-ultra text-elite-smoke mb-1">{{ $s[0] }}</div>
            <div class="heading-bebas text-2xl {{ $s[2] }}">{{ $s[1] }}</div>
        </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="flex flex-wrap gap-3 mb-6">
    <div class="flex gap-2">
        @foreach (['all' => 'ALL', 'published' => 'PUBLISHED', 'draft' => 'DRAFT'] as $key => $label)
            <a href="{{ $key === 'all' ? route('admin.posts.index') : route('admin.posts.index', ['status' => $key]) }}"
               class="px-4 py-2 font-bebas text-xs tracking-wider {{ (request('status') === $key || (!request('status') && $key === 'all')) ? 'bg-elite-gold text-elite-black' : 'border border-elite-steel text-elite-smoke hover:text-elite-gold hover:border-elite-gold' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    @if ($categories->isNotEmpty())
        <select onchange="if(this.value) window.location='{{ route('admin.posts.index') }}?category='+this.value; else window.location='{{ route('admin.posts.index') }}';"
                class="bg-elite-black border border-elite-steel text-elite-bone px-4 py-2 font-mono text-xs">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
    @endif

    <form method="GET" class="flex-1 min-w-[200px]">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search posts..."
               class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-2 font-mono text-sm">
    </form>
</div>

<div class="card-elite p-6">
    @if ($posts->isEmpty())
        <div class="text-center py-16">
            <div class="text-5xl mb-4">📝</div>
            <h3 class="heading-bebas text-2xl text-elite-bone mb-3">NO POSTS YET</h3>
            <p class="text-elite-smoke text-sm mb-6">Create your first blog post to engage your audience.</p>
            <a href="{{ route('admin.posts.create') }}" class="btn-gold">+ NEW POST</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TITLE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">CATEGORY</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">STATUS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">VIEWS</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">DATE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3">
                                <div class="text-sm text-elite-bone font-medium max-w-xs truncate">{{ $post->title }}</div>
                                <div class="font-mono text-[10px] text-elite-smoke mt-1">{{ $post->slug }}</div>
                            </td>
                            <td class="py-3">
                                @if ($post->category)
                                    <span class="px-2 py-1 font-mono text-[9px] tracking-ultra bg-elite-gold/15 text-elite-gold">
                                        {{ strtoupper($post->category->name) }}
                                    </span>
                                @else
                                    <span class="text-elite-smoke text-xs">—</span>
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $post->status === 'published' ? 'bg-green-500/20 text-green-500' : 'bg-elite-steel/40 text-elite-smoke' }}">
                                    {{ strtoupper($post->status) }}
                                </span>
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">{{ number_format($post->views) }}</td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">
                                {{ ($post->published_at ?? $post->created_at)->format('M d, Y') }}
                            </td>
                            <td class="py-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                   class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone mr-4">
                                    EDIT
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this post?');">
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

        <div class="mt-6">{{ $posts->links() }}</div>
    @endif
</div>

@endsection
