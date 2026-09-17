@extends('layouts.app')

@section('title', 'Gallery — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="From The Archive"
    title="THE"
    highlight="GALLERY"
    subtitle="Seven editions. Thousands of moments. Here are some of the best."
    :breadcrumb="['Home' => route('home'), 'Gallery' => null]"
/>

<section class="py-20">
    <div class="container-elite">

        @if ($items->isEmpty())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px]">
                @php
                    $spans = [
                        'md:col-span-2 md:row-span-2',
                        '',
                        '',
                        '',
                        'md:col-span-2',
                        '',
                        '',
                        'md:col-span-2 md:row-span-2',
                        '',
                        '',
                        '',
                        'md:col-span-2',
                    ];
                @endphp
                @foreach ($spans as $i => $span)
                    <div class="group relative bg-elite-charcoal border border-elite-steel overflow-hidden card-elite {{ $span }}">
                        <div class="absolute inset-0 bg-gradient-to-br from-elite-gold/5 via-transparent to-elite-crimson/5"></div>
                        <div class="absolute inset-0 bg-carbon opacity-40"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-elite-gold/20 group-hover:text-elite-gold/50 group-hover:scale-110 transition-all duration-700">
                            <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-elite-black to-transparent">
                            <div class="font-mono text-[10px] tracking-ultra text-elite-gold">EDITION 2024</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px]">
                @foreach ($items as $item)
                    <div class="group relative bg-elite-charcoal border border-elite-steel overflow-hidden card-elite">
                        @if ($item->type === 'image' && $item->file_path)
                            <img src="{{ str_starts_with($item->file_path, 'http') || str_starts_with($item->file_path, 'images/') ? asset($item->file_path) : asset('storage/' . $item->file_path) }}"
                                 alt="{{ $item->title }}"
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="absolute inset-0 bg-carbon opacity-40"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-elite-gold/30">
                                <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-elite-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <div class="font-bebas text-lg text-elite-bone">{{ $item->title }}</div>
                            <div class="font-mono text-[10px] tracking-ultra text-elite-gold">{{ strtoupper($item->category) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
