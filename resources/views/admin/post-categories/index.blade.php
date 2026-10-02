@extends('layouts.admin')
@section('title', 'Post Categories — ELITE Admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="label-eyebrow mb-2">Blog</div>
        <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
            POST <span class="text-gold-gradient">CATEGORIES</span>
        </h1>
    </div>
</div>

@if (session('success'))
    <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
        ✓ {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
        ✗ {{ session('error') }}
    </div>
@endif

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Create form --}}
    <div class="lg:col-span-1">
        <div class="card-elite p-6">
            <h3 class="heading-bebas text-xl text-elite-bone mb-4">ADD CATEGORY</h3>

            @if ($errors->any())
                <div class="mb-4 p-3 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-xs">
                    @foreach ($errors->all() as $err) <div>✗ {{ $err }}</div> @endforeach
                </div>
            @endif

            <form action="{{ route('admin.post-categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">NAME *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                </div>
                <div>
                    <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">SLUG (auto)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="auto-generated"
                           class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                </div>
                <div>
                    <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">DESCRIPTION</label>
                    <textarea name="description" rows="2"
                              class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn-gold w-full">+ ADD CATEGORY</button>
            </form>
        </div>
    </div>

    {{-- Categories list --}}
    <div class="lg:col-span-2">
        <div class="card-elite p-6">
            @if ($categories->isEmpty())
                <div class="text-center py-12">
                    <div class="text-5xl mb-4">📂</div>
                    <h3 class="heading-bebas text-2xl text-elite-bone mb-3">NO CATEGORIES</h3>
                    <p class="text-elite-smoke text-sm">Use the form on the left to create your first category.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-elite-steel/50">
                                <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">NAME</th>
                                <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">SLUG</th>
                                <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">POSTS</th>
                                <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cat)
                                <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50" x-data="{ editing: false }">
                                    {{-- Display mode --}}
                                    <template x-if="!editing">
                                        <td class="py-3 text-sm text-elite-bone font-medium" colspan="4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-6">
                                                    <div>
                                                        <div class="font-medium">{{ $cat->name }}</div>
                                                        <div class="font-mono text-[10px] text-elite-smoke mt-1">{{ $cat->slug }}</div>
                                                    </div>
                                                    <span class="px-2 py-1 font-mono text-[9px] tracking-ultra bg-elite-gold/15 text-elite-gold">
                                                        {{ $cat->posts_count }} POSTS
                                                    </span>
                                                </div>
                                                <div class="flex items-center gap-4">
                                                    <button @click="editing = true"
                                                            class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
                                                        EDIT
                                                    </button>
                                                    <form action="{{ route('admin.post-categories.destroy', $cat) }}" method="POST"
                                                          onsubmit="return confirm('Delete {{ $cat->name }}?');">
                                                        @csrf @method('DELETE')
                                                        <button class="font-mono text-[10px] tracking-ultra text-elite-crimson hover:text-elite-bone">
                                                            DELETE
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </template>

                                    {{-- Edit mode --}}
                                    <template x-if="editing">
                                        <td class="py-3" colspan="4">
                                            <form action="{{ route('admin.post-categories.update', $cat) }}" method="POST"
                                                  class="flex items-end gap-3 flex-wrap">
                                                @csrf @method('PUT')
                                                <div class="flex-1 min-w-[140px]">
                                                    <label class="font-mono text-[9px] tracking-ultra text-elite-gold block mb-1">NAME</label>
                                                    <input type="text" name="name" value="{{ $cat->name }}" required
                                                           class="w-full bg-elite-black border border-elite-steel text-elite-bone px-3 py-2 font-mono text-xs">
                                                </div>
                                                <div class="flex-1 min-w-[140px]">
                                                    <label class="font-mono text-[9px] tracking-ultra text-elite-gold block mb-1">SLUG</label>
                                                    <input type="text" name="slug" value="{{ $cat->slug }}"
                                                           class="w-full bg-elite-black border border-elite-steel text-elite-bone px-3 py-2 font-mono text-xs">
                                                </div>
                                                <button type="submit" class="btn-gold !py-2 !px-4 text-xs">SAVE</button>
                                                <button type="button" @click="editing = false"
                                                        class="font-mono text-[10px] tracking-ultra text-elite-smoke hover:text-elite-bone py-2">
                                                    CANCEL
                                                </button>
                                            </form>
                                        </td>
                                    </template>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection
