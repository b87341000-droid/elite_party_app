@extends('layouts.app')
@section('title', 'Application Received — ELITE')
@section('content')

<section class="py-32">
    <div class="container-elite max-w-2xl text-center">
        <div class="w-24 h-24 mx-auto mb-8 bg-elite-gold/10 border-2 border-elite-gold clip-corner flex items-center justify-center">
            <svg class="w-12 h-12 text-elite-gold" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <div class="label-eyebrow mb-4">Submitted Successfully</div>
        <h1 class="heading-display text-5xl md:text-7xl text-gold-gradient mb-6">
            WE'VE GOT IT.
        </h1>
        <p class="text-elite-smoke text-lg mb-10">
            Your {{ session('application_type', '') }} application is in. Check your email for a confirmation — we'll review and respond within 5–7 business days.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="btn-gold">BACK TO HOME</a>
            <a href="{{ route('gallery') }}" class="btn-outline-gold">BROWSE GALLERY</a>
        </div>
    </div>
</section>

@endsection