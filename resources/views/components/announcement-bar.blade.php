{{-- Announcement Ticker Bar --}}
<div class="relative z-50 overflow-hidden border-b border-elite-gold/20"
     style="background: linear-gradient(90deg, #8B0F1C 0%, #E11D2E 30%, #8B0F1C 60%, #E11D2E 90%, #8B0F1C 100%);">
    <div class="relative overflow-hidden py-2">
        {{-- HUD scanline --}}
        <div class="absolute inset-0 scan-lines pointer-events-none opacity-40"></div>

        <div class="ticker-track">
            @for ($i = 0; $i < 3; $i++)
            <div class="inline-flex items-center gap-10 px-8 font-bebas text-sm tracking-ultra uppercase">
                <span class="inline-flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-elite-gold rounded-full animate-pulse-gold"></span>
                    🔥 EARLY BIRD TICKETS LIVE — SAVE 30%
                </span>
                <span class="text-elite-gold text-lg">◆</span>
                <span>🎤 HEADLINE ARTIST REVEAL — COMING SOON</span>
                <span class="text-elite-gold text-lg">◆</span>
                <span>🏎️ 200+ CUSTOM CARS ON DISPLAY</span>
                <span class="text-elite-gold text-lg">◆</span>
                <span>📍 EKO HOTEL GROUNDS, LAGOS — DEC 20, 2025</span>
                <span class="text-elite-gold text-lg">◆</span>
                <span>👑 VVIP TABLES SELLING FAST — BOOK NOW</span>
                <span class="text-elite-gold text-lg">◆</span>
                <span>🎟️ TABLES FOR 4 AVAILABLE — ₦220,000</span>
                <span class="text-elite-gold text-lg">◆</span>
            </div>
            @endfor
        </div>
    </div>
</div>
