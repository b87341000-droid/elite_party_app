@extends('layouts.app')
@section('title', 'Become A Vendor — ELITE BLOCK PARTY')
@section('content')

<x-page-header
    eyebrow="Secure Your Stall"
    title="BECOME A"
    highlight="VENDOR"
    subtitle="Food, fashion, merch, or lifestyle — sell to 35,000+ hungry attendees."
    :breadcrumb="['Home' => route('home'), 'Vendor Application' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-3xl">
        <div class="card-elite p-8 md:p-12">
            <div class="label-eyebrow mb-3">Vendor Application</div>
            <h2 class="heading-display text-4xl text-elite-bone mb-8">
                TELL US ABOUT <span class="text-gold-gradient">YOUR BRAND</span>
            </h2>

            @include('applications._form', [
                'action' => route('vendor.apply.store'),
                'type' => 'food',
                'businessLabel' => 'BUSINESS / STALL NAME',
                'descriptionLabel' => 'WHAT YOU SELL & YOUR SETUP',
                'descriptionPlaceholder' => 'Describe your products, setup requirements, past events...',
                'documentHint' => 'CAC cert, food permit, or photos of your previous stall.',
            ])
        </div>
    </div>
</section>

@endsection