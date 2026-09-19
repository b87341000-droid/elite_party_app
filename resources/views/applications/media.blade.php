@extends('layouts.app')
@section('title', 'Media Partners — ELITE BLOCK PARTY')
@section('content')

<x-page-header
    eyebrow="Press Accreditation"
    title="MEDIA"
    highlight="PASSES"
    subtitle="Apply for press accreditation and media access."
    :breadcrumb="['Home' => route('home'), 'Media Partners' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-3xl">
        <div class="card-elite p-8 md:p-12">
            <div class="label-eyebrow mb-3">Press / Media Application</div>
            <h2 class="heading-display text-4xl text-elite-bone mb-8">
                COVER THE <span class="text-gold-gradient">NIGHT</span>
            </h2>

            @include('applications._form', [
                'action' => route('media.apply.store'),
                'type' => 'media',
                'businessLabel' => 'OUTLET / PUBLICATION',
                'descriptionLabel' => 'COVERAGE PLAN',
                'descriptionPlaceholder' => 'Who you represent, coverage angle, deliverables, and previous event coverage.',
                'documentHint' => 'Press credentials, editor letter, or outlet profile.',
            ])
        </div>
    </div>
</section>

@endsection