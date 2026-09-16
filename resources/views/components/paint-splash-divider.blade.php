{{--
    PAINT SPLASH DIVIDER — canvas that erupts in paint when scrolled into view.
    Usage: @include('components.paint-splash-divider', ['label' => 'Optional Label'])
    Animated by GSAP ScrollTrigger via [data-paint-canvas].
--}}
@props(['label' => null, 'flip' => false])

<div class="relative overflow-visible" style="height: 220px; margin: -1px 0;">
    {{-- Canvas for paint burst --}}
    <canvas
        data-paint-canvas
        data-height="220"
        class="absolute inset-0 w-full pointer-events-none"
        style="width:100%; height:220px; display:block; z-index:10;"
    ></canvas>

    {{-- SVG tire track path that draws itself on scroll --}}
    <svg id="tire-svg-{{ uniqid() }}"
         class="absolute inset-0 w-full h-full pointer-events-none"
         viewBox="0 0 1440 220"
         preserveAspectRatio="none"
         xmlns="http://www.w3.org/2000/svg"
         style="z-index: 5;">

        {{-- Wavy tire skid path --}}
        <path data-tire-path
              d="M-10,180 C100,140 200,200 360,160 C520,120 600,185 760,155 C920,125 1020,190 1180,160 C1340,130 1400,170 1460,155"
              stroke="#D4AF37"
              stroke-width="3"
              fill="none"
              stroke-dasharray="8,6"
              opacity="0.7"/>

        {{-- Second track (offset) --}}
        <path data-tire-path
              d="M-10,60 C80,90 220,40 380,70 C540,100 640,45 800,75 C960,105 1060,50 1220,80 C1380,110 1420,65 1460,75"
              stroke="#E11D2E"
              stroke-width="3"
              fill="none"
              stroke-dasharray="6,8"
              opacity="0.6"/>

        {{-- Diagonal slash accent --}}
        <path data-tire-path
              d="M0,0 L1440,220"
              stroke="rgba(212,175,55,0.08)"
              stroke-width="80"
              fill="none"/>
    </svg>

    {{-- Optional center label --}}
    @if($label)
    <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
        <div class="relative px-8 py-2 bg-elite-black border border-elite-gold/30">
            <div class="font-mono text-[10px] tracking-ultra uppercase text-elite-gold">{{ $label }}</div>
        </div>
    </div>
    @endif
</div>
