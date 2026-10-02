@extends('layouts.app')
@section('title', 'Blog — ELITE BLOCK PARTY')
@section('meta_description', 'Read the latest news, artist reveals, car culture features, and attendee guides for ELITE BLOCK PARTY.')

@section('content')

<x-page-header
    eyebrow="The ELITE Journal"
    title="BL"
    highlight="OG"
    subtitle="Festival news, car culture, artist reveals, and attendee guides — straight from the ELITE camp."
    :breadcrumb="['Home' => route('home'), 'Blog' => null]"
/>

<section class="py-16">
    <div class="container-elite">

        {{-- Category filter --}}
        @if ($categories->isNotEmpty())
            <div class="flex flex-wrap gap-3 mb-10 justify-center">
                <a href="{{ route('blog.index') }}"
                   class="px-5 py-2 font-bebas text-xs tracking-wider transition-colors {{ !request('category') ? 'bg-elite-gold text-elite-black' : 'border border-elite-steel text-elite-smoke hover:text-elite-gold hover:border-elite-gold' }}">
                    ALL
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                       class="px-5 py-2 font-bebas text-xs tracking-wider transition-colors {{ request('category') === $cat->slug ? 'bg-elite-gold text-elite-black' : 'border border-elite-steel text-elite-smoke hover:text-elite-gold hover:border-elite-gold' }}">
                        {{ strtoupper($cat->name) }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($posts->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">📝</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">NO POSTS YET</h3>
                <p class="text-elite-smoke">Check back soon for updates.</p>
            </div>
        @else
            {{-- Featured (first) post --}}
            @if ($featuredPost && $posts->onFirstPage())
                <div class="mb-16" data-reveal>
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="group block">
                        <div class="grid md:grid-cols-2 gap-0 card-elite overflow-hidden">
                            <div class="aspect-[16/10] md:aspect-auto bg-elite-charcoal overflow-hidden">
                                @if ($featuredPost->cover_image)
                                    <img src="{{ Str::startsWith($featuredPost->cover_image, ['http://', 'https://', '/images/']) ? $featuredPost->cover_image : asset('storage/' . $featuredPost->cover_image) }}"
                                         alt="{{ $featuredPost->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-elite-charcoal text-elite-gold/30">
                                        <div class="font-display text-8xl">E</div>
                                    </div>
                                @endif
                            </div>
                            <div class="p-8 md:p-12 flex flex-col justify-center">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="label-eyebrow">FEATURED</span>
                                    @if ($featuredPost->category)
                                        <span class="font-mono text-[10px] tracking-ultra text-elite-gold">{{ strtoupper($featuredPost->category->name) }}</span>
                                    @endif
                                </div>
                                <h2 class="heading-display text-3xl md:text-4xl text-elite-bone mb-4 group-hover:text-elite-gold transition-colors">
                                    {{ $featuredPost->title }}
                                </h2>
                                @if ($featuredPost->excerpt)
                                    <p class="text-elite-smoke leading-relaxed mb-6">{{ $featuredPost->excerpt }}</p>
                                @endif
                                <div class="flex items-center gap-4 text-elite-smoke font-mono text-[10px] tracking-ultra">
                                    <span>{{ $featuredPost->published_at?->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ number_format($featuredPost->views) }} VIEWS</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- Post grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    @if ($posts->onFirstPage() && $loop->first)
                        @continue
                    @endif
                    <article class="card-elite overflow-hidden group" data-reveal>
                        <a href="{{ route('blog.show', $post->slug) }}" class="block">
                            <div class="aspect-[16/10] bg-elite-charcoal overflow-hidden">
                                @if ($post->cover_image)
                                    <img src="{{ Str::startsWith($post->cover_image, ['http://', 'https://', '/images/']) ? $post->cover_image : asset('storage/' . $post->cover_image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-elite-charcoal text-elite-gold/20">
                                        <div class="font-display text-5xl">E</div>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-3">
                                    @if ($post->category)
                                        <span class="font-mono text-[9px] tracking-ultra text-elite-gold bg-elite-gold/10 px-2 py-1">
                                            {{ strtoupper($post->category->name) }}
                                        </span>
                                    @endif
                                    <span class="font-mono text-[9px] tracking-ultra text-elite-smoke">
                                        {{ $post->published_at?->format('M d, Y') }}
                                    </span>
                                </div>
                                <h3 class="heading-bebas text-xl text-elite-bone group-hover:text-elite-gold transition-colors mb-3">
                                    {{ $post->title }}
                                </h3>
                                @if ($post->excerpt)
                                    <p class="text-sm text-elite-smoke line-clamp-2">{{ $post->excerpt }}</p>
                                @endif
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">{{ $posts->links() }}</div>
        @endif
    </div>
</section>

@endsection
