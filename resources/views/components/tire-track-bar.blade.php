{{--
    TIRE TRACK BAR — canvas that draws tire tread marks as you scroll through it.
    Usage: @include('components.tire-track-bar')
    The canvas is scrubbed by GSAP ScrollTrigger via [data-tire-bar].
--}}
<div class="relative overflow-hidden" style="height: 80px; margin: 0;">
    {{-- Gold speed stripe behind the track --}}
    <div class="absolute inset-y-0 left-0 right-0 flex flex-col justify-between pointer-events-none">
        <div class="h-px w-full bg-gradient-to-r from-transparent via-elite-gold/20 to-transparent"></div>
        <div class="h-px w-full bg-gradient-to-r from-transparent via-elite-gold/20 to-transparent"></div>
    </div>

    {{-- Tire marks canvas --}}
    <canvas data-tire-bar data-height="80"
            class="absolute inset-0 w-full"
            style="height:80px; display:block;"></canvas>

    {{-- Center diamond --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-3 h-3 bg-elite-gold rotate-45 opacity-60 shadow-gold-glow"></div>
    </div>
</div>
