@extends('layouts.app')
@section('title', 'Volunteer — ELITE BLOCK PARTY')
@section('content')

<x-page-header
    eyebrow="Be Part Of The Team"
    title="VOLUN"
    highlight="TEER"
    subtitle="Work behind the scenes at Nigeria's biggest night. Free entry + meals included."
    :breadcrumb="['Home' => route('home'), 'Volunteer' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-3xl">
        <div class="card-elite p-8 md:p-12">
            <div class="label-eyebrow mb-3">Volunteer Sign-Up</div>
            <h2 class="heading-display text-4xl text-elite-bone mb-8">
                JOIN THE <span class="text-gold-gradient">CREW</span>
            </h2>

            @include('applications._form', [
                'action' => route('volunteer.apply.store'),
                'type' => 'volunteer',
                'businessLabel' => 'OCCUPATION / SCHOOL',
                'descriptionLabel' => 'WHY YOU WANT TO VOLUNTEER',
                'descriptionPlaceholder' => 'Tell us about yourself, relevant experience, and which area you prefer (gate, backstage, food, etc).',
                'documentHint' => 'Optional — student ID, résumé, or reference.',
            ])
        </div>
    </div>
</section>

@endsection