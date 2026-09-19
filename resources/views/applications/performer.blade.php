@extends('layouts.app')
@section('title', 'Perform At ELITE — Artist Application')
@section('content')

<x-page-header
    eyebrow="Artist & DJ Submissions"
    title="PER"
    highlight="FORM"
    subtitle="Musicians, DJs, dancers, MCs — send us your best."
    :breadcrumb="['Home' => route('home'), 'Perform' => null]"
/>

<section class="py-20">
    <div class="container-elite max-w-3xl">
        <div class="card-elite p-8 md:p-12">
            <div class="label-eyebrow mb-3">Performer Application</div>
            <h2 class="heading-display text-4xl text-elite-bone mb-8">
                SHOW US WHAT <span class="text-gold-gradient">YOU'VE GOT</span>
            </h2>

            @include('applications._form', [
                'action' => route('performer.apply.store'),
                'type' => 'performer',
                'businessLabel' => 'STAGE NAME',
                'descriptionLabel' => 'YOUR GENRE & EXPERIENCE',
                'descriptionPlaceholder' => 'Genre, notable shows, past venues, and what you bring to ELITE. Include links to performances.',
                'documentHint' => 'Press kit, EPK, or video links (PDF).',
            ])
        </div>
    </div>
</section>

@endsection