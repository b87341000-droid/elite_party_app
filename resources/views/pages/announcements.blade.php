@extends('layouts.app')
@section('title', 'Announcements — ELITE BLOCK PARTY')
@section('meta_description', 'Official announcements from ELITE BLOCK PARTY — ticket drops, schedule changes, and important updates.')

@section('content')

<x-page-header
    eyebrow="Official Updates"
    title="ANNOUNCE"
    highlight="MENTS"
    subtitle="Important updates, ticket alerts, and official communications from ELITE HQ."
    :breadcrumb="['Home' => route('home'), 'Announcements' => null]"
/>

<section class="py-16">
    <div class="container-elite max-w-3xl">

        @if ($announcements->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-6">📣</div>
                <h3 class="heading-bebas text-3xl text-elite-bone mb-4">NO ANNOUNCEMENTS YET</h3>
                <p class="text-elite-smoke">Check back soon for updates from the ELITE team.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($announcements as $ann)
                    <div class="card-elite p-6 md:p-8" data-reveal>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-2 h-2 bg-elite-gold rounded-full"></div>
                            <span class="font-mono text-[10px] tracking-ultra text-elite-smoke">
                                {{ $ann->published_at?->format('M d, Y') ?? $ann->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        <h2 class="heading-bebas text-2xl md:text-3xl text-elite-bone mb-4">{{ $ann->title }}</h2>
                        <div class="text-elite-smoke leading-relaxed whitespace-pre-line">{{ $ann->body }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">{{ $announcements->links() }}</div>
        @endif
    </div>
</section>

@endsection
