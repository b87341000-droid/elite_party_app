@extends('layouts.admin')
@section('title', 'Edit Post — ELITE Admin')

@section('content')

<a href="{{ route('admin.posts.index') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
    ← BACK TO POSTS
</a>

<div class="mt-4 mb-8">
    <div class="label-eyebrow mb-2">Edit</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        EDIT <span class="text-gold-gradient">POST</span>
    </h1>
</div>

<div class="card-elite p-6 md:p-8 max-w-4xl">
    @if ($errors->any())
        <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
            @foreach ($errors->all() as $err) <div>✗ {{ $err }}</div> @endforeach
        </div>
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TITLE *</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">SLUG</label>
                <input type="text" name="slug" value="{{ old('slug', $post->slug) }}"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">CATEGORY</label>
                <select name="post_category_id"
                        class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                    <option value="">— No Category —</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('post_category_id', $post->post_category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">EXCERPT</label>
            <textarea name="excerpt" rows="2"
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">BODY *</label>
            <textarea name="body" rows="12" required
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-y">{{ old('body', $post->body) }}</textarea>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">COVER IMAGE</label>
            @if ($post->cover_image)
                <div class="mb-3 inline-block">
                    <img src="{{ Str::startsWith($post->cover_image, ['http://', 'https://', '/images/']) ? $post->cover_image : asset('storage/' . $post->cover_image) }}"
                         class="w-48 h-28 object-cover border border-elite-steel">
                </div>
            @endif
            <input type="file" name="cover_image" accept="image/*"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-elite-gold file:text-elite-black file:font-bebas">
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">STATUS *</label>
                <select name="status" required
                        class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                    <option value="draft" @selected(old('status', $post->status) === 'draft')>DRAFT</option>
                    <option value="published" @selected(old('status', $post->status) === 'published')>PUBLISHED</option>
                </select>
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">PUBLISH DATE</label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-gold">UPDATE POST →</button>
            <a href="{{ route('admin.posts.index') }}" class="btn-outline-gold">CANCEL</a>
        </div>
    </form>
</div>

@endsection
