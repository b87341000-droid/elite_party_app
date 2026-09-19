@extends('layouts.app')
@section('title', 'Become A Sponsor — ELITE BLOCK PARTY')
@section('content')

<x-page-header
    eyebrow="B2B Partnership"
    title="BECOME A"
    highlight="SPONSOR"
    subtitle="Put your brand in front of 35,000+ attendees and millions online."
    :breadcrumb="['Home' => route('home'), 'Sponsor' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-3xl">
        <div class="card-elite p-8 md:p-12">
            <div class="label-eyebrow mb-3">Sponsor Proposal</div>
            <h2 class="heading-display text-4xl text-elite-bone mb-8">
                PARTNER WITH <span class="text-gold-gradient">ELITE</span>
            </h2>

            @include('applications._form', [
                'action' => route('sponsor.apply.store'),
                'type' => 'sponsor',
                'businessLabel' => 'COMPANY / BRAND NAME',
                'descriptionLabel' => 'YOUR GOALS & BUDGET RANGE',
                'descriptionPlaceholder' => 'Tell us about your brand, objectives for the partnership, and approximate budget range.',
                'documentHint' => 'Company profile, brand deck, or brief.',
            ])
        </div>
    </div>
</section>

@endsection