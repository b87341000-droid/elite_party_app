@extends('layouts.app')

@section('title', 'Contact — ELITE BLOCK PARTY')

@section('content')

<x-page-header
    eyebrow="Talk To Us"
    title="GET IN"
    highlight="TOUCH"
    subtitle="Questions, partnerships, or press — we're here."
    :breadcrumb="['Home' => route('home'), 'Contact' => null]"
/>

<section class="py-20">
    <div class="container-elite">
        <div class="grid lg:grid-cols-5 gap-12">

            {{-- Contact info --}}
            <div class="lg:col-span-2 space-y-6">
                @foreach ([
                    ['📧', 'EMAIL', 'hello@eliteblockparty.com', 'mailto:hello@eliteblockparty.com'],
                    ['📱', 'PHONE', '+234 800 000 0000', 'tel:+2348000000000'],
                    ['💬', 'WHATSAPP', 'Chat with support', 'https://wa.me/2348000000000'],
                    ['📍', 'OFFICE', 'Victoria Island, Lagos, Nigeria', null],
                ] as $item)
                    <a href="{{ $item[3] ?? '#' }}"
                       @if ($item[3]) target="_blank" rel="noopener" @endif
                       class="card-elite p-6 flex gap-5 items-start {{ $item[3] ? 'group' : '' }}">
                        <div class="text-3xl flex-shrink-0">{{ $item[0] }}</div>
                        <div>
                            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">{{ $item[1] }}</div>
                            <div class="font-bebas text-lg text-elite-bone group-hover:text-elite-gold transition-colors">
                                {{ $item[2] }}
                            </div>
                        </div>
                    </a>
                @endforeach

                <div class="divider-gold my-8"></div>

                <div>
                    <div class="label-eyebrow mb-4">Follow Us</div>
                    <div class="flex gap-3">
                        <a href="https://instagram.com/elite-tickets" target="_blank" rel="noopener"
                           class="w-12 h-12 flex items-center justify-center border border-elite-steel hover:border-elite-gold hover:bg-elite-gold hover:text-elite-black transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.5.4 1 .4 2.2.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.5.2-1 .4-2.2.4-1.3.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.5-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.5-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2a6.6 6.6 0 100 13.2 6.6 6.6 0 000-13.2zm0 10.9a4.3 4.3 0 110-8.6 4.3 4.3 0 010 8.6zm6.8-11.2a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                        </a>
                        <a href="https://tiktok.com/@elite-tickets" target="_blank" rel="noopener"
                           class="w-12 h-12 flex items-center justify-center border border-elite-steel hover:border-elite-gold hover:bg-elite-gold hover:text-elite-black transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.6 6.3a5.4 5.4 0 01-3.2-1.1 5.4 5.4 0 01-2.1-3.5h-3.1v12.4a2.9 2.9 0 01-2.9 2.8 2.9 2.9 0 01-2.9-2.8 2.9 2.9 0 012.9-2.8c.3 0 .6 0 .9.1V7.9a6 6 0 00-.9-.1 6 6 0 106 6V9.6a8.5 8.5 0 004.9 1.5V8a5.4 5.4 0 01-.6-.1z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Contact form --}}
            <div class="lg:col-span-3">
                <div class="card-elite p-8 md:p-10">
                    <div class="label-eyebrow mb-3">Send A Message</div>
                    <h2 class="heading-display text-4xl text-elite-bone mb-8">
                        DROP US A <span class="text-gold-gradient">LINE</span>
                    </h2>

                    @if (session('success'))
                        <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
                            @foreach ($errors->all() as $error)
                                <div>✗ {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">NAME *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                            </div>
                            <div>
                                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">EMAIL *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">PHONE</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                            </div>
                            <div>
                                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">SUBJECT</label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">MESSAGE *</label>
                            <textarea name="message" rows="6" required
                                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn-gold w-full justify-center">
                            SEND MESSAGE →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
