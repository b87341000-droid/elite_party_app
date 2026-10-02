@extends('layouts.app')
@section('title', $post->title . ' — ELITE Blog')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->body), 155))

@section('content')

{{-- Hero --}}
<section class="relative pt-32 pb-16 overflow-hidden grain">
    <div class="absolute inset-0 bg-gradient-to-b from-elite-coal to-elite-black"></div>
    <div class="absolute inset-0 bg-carbon opacity-30"></div>
    <div class="absolute top-0 left-1/4 w-[400px] h-[400px] bg-elite-gold/10 rounded-full blur-[100px]"></div>

    <div class="relative container-elite">
        <div class="flex items-center justify-center gap-3 mb-6 font-mono text-[10px] tracking-ultra text-elite-smoke">
            <a href="{{ route('home') }}" class="hover:text-elite-gold transition-colors">Home</a>
            <span class="text-elite-gold/50">/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-elite-gold transition-colors">Blog</a>
            <span class="text-elite-gold/50">/</span>
            <span class="text-elite-gold">{{ Str::limit($post->title, 40) }}</span>
        </div>

        <div class="max-w-3xl mx-auto text-center">
            <div class="flex items-center justify-center gap-4 mb-6">
                @if ($post->category)
                    <span class="font-mono text-[10px] tracking-ultra text-elite-gold bg-elite-gold/10 px-3 py-1">
                        {{ strtoupper($post->category->name) }}
                    </span>
                @endif
                @if (! $post->isPublished())
                    <span class="font-mono text-[10px] tracking-ultra text-yellow-400 bg-yellow-500/20 px-3 py-1">
                        DRAFT PREVIEW
                    </span>
                @endif
            </div>

            <h1 class="heading-display text-4xl sm:text-5xl md:text-6xl text-elite-bone leading-tight mb-6">
                {{ $post->title }}
            </h1>

            <div class="flex items-center justify-center gap-6 text-elite-smoke font-mono text-[10px] tracking-ultra">
                @if ($post->author)
                    <span>By {{ $post->author->name }}</span>
                @endif
                <span>{{ ($post->published_at ?? $post->created_at)->format('M d, Y') }}</span>
                <span>{{ number_format($post->views) }} VIEWS</span>
            </div>
        </div>
    </div>
</section>

{{-- Cover image --}}
@if ($post->cover_image)
    <section class="pb-12">
        <div class="container-elite max-w-4xl">
            <div class="aspect-[2/1] overflow-hidden card-elite">
                <img src="{{ Str::startsWith($post->cover_image, ['http://', 'https://', '/images/']) ? $post->cover_image : asset('storage/' . $post->cover_image) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover">
            </div>
        </div>
    </section>
@endif

{{-- Article body --}}
<article class="py-12">
    <div class="container-elite max-w-3xl">
        <div class="prose prose-invert prose-lg max-w-none
                    prose-headings:font-display prose-headings:text-elite-bone
                    prose-p:text-elite-smoke prose-p:leading-relaxed
                    prose-a:text-elite-gold prose-a:no-underline hover:prose-a:underline
                    prose-strong:text-elite-bone
                    prose-ul:text-elite-smoke prose-ol:text-elite-smoke
                    prose-blockquote:border-elite-gold prose-blockquote:text-elite-smoke">
            {!! nl2br(e($post->body)) !!}
        </div>

        {{-- Share / back --}}
        <div class="mt-16 pt-8 border-t border-elite-steel/30 flex items-center justify-between">
            <a href="{{ route('blog.index') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
                ← BACK TO BLOG
            </a>
            <div class="flex items-center gap-3 font-mono text-[10px] tracking-ultra text-elite-smoke">
                <span>SHARE:</span>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
                   target="_blank" class="text-elite-gold hover:text-elite-bone">TWITTER</a>
            </div>
        </div>
    </div>
</article>

{{-- Related posts --}}
@if ($relatedPosts->isNotEmpty())
    <section class="py-16 bg-elite-coal">
        <div class="container-elite">
            <div class="label-eyebrow text-center mb-4">Keep Reading</div>
            <h2 class="heading-display text-3xl md:text-4xl text-elite-bone text-center mb-10">
                RELATED <span class="text-gold-gradient">ARTICLES</span>
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($relatedPosts as $related)
                    <article class="card-elite overflow-hidden group">
                        <a href="{{ route('blog.show', $related->slug) }}" class="block">
                            <div class="aspect-[16/10] bg-elite-charcoal overflow-hidden">
                                @if ($related->cover_image)
                                    <img src="{{ Str::startsWith($related->cover_image, ['http://', 'https://', '/images/']) ? $related->cover_image : asset('storage/' . $related->cover_image) }}"
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-elite-charcoal text-elite-gold/20">
                                        <div class="font-display text-5xl">E</div>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="heading-bebas text-lg text-elite-bone group-hover:text-elite-gold transition-colors mb-2">
                                    {{ $related->title }}
                                </h3>
                                <span class="font-mono text-[9px] tracking-ultra text-elite-smoke">
                                    {{ $related->published_at?->format('M d, Y') }}
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection
