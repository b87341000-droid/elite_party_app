@props([
    'eyebrow'    => 'Elite Block Party',
    'title'      => '',
    'highlight'  => '',
    'subtitle'   => '',
    'breadcrumb' => [],
])

<section class="relative pt-40 pb-20 overflow-hidden grain">
    <div class="absolute inset-0 bg-gradient-to-b from-elite-coal to-elite-black"></div>
    <div class="absolute inset-0 bg-carbon opacity-30"></div>
    <div class="absolute top-0 left-1/4 w-[400px] h-[400px] bg-elite-gold/10 rounded-full blur-[100px]"></div>

    <div class="relative container-elite text-center">

        @if (!empty($breadcrumb))
            <div class="flex items-center justify-center gap-3 mb-6 font-mono text-[10px] tracking-ultra text-elite-smoke">
                @foreach ($breadcrumb as $label => $url)
                    @if ($url)
                        <a href="{{ $url }}" class="hover:text-elite-gold transition-colors">{{ $label }}</a>
                    @else
                        <span class="text-elite-gold">{{ $label }}</span>
                    @endif
                    @if (!$loop->last) <span class="text-elite-gold/50">/</span> @endif
                @endforeach
            </div>
        @endif

        <div class="label-eyebrow mb-4">{{ $eyebrow }}</div>

        <h1 class="heading-display text-5xl sm:text-6xl md:text-8xl lg:text-9xl text-elite-bone leading-[0.85]">
            {{ $title }}
            @if ($highlight)
                <span class="text-gold-gradient text-shadow-gold">{{ $highlight }}</span>
            @endif
        </h1>

        @if ($subtitle)
            <p class="max-w-2xl mx-auto mt-6 text-lg text-elite-smoke">{{ $subtitle }}</p>
        @endif
    </div>
</section>
