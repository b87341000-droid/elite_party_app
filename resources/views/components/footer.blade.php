<footer class="relative mt-32 bg-elite-coal border-t border-elite-gold/20 overflow-hidden">
    {{-- Ambient blobs --}}
    <div class="glow-orb w-[500px] h-[500px] bg-elite-gold top-0 left-1/4"></div>
    <div class="glow-orb w-[500px] h-[500px] bg-elite-crimson bottom-0 right-1/4"></div>

    <div class="relative container-elite py-20">

        {{-- Newsletter strip --}}
        <div class="mb-20 p-8 md:p-14 bg-elite-charcoal clip-corner-lg relative overflow-hidden border border-elite-gold/20">
            <div class="absolute inset-0 bg-carbon opacity-20"></div>
            {{-- Diagonal accent --}}
            <div class="absolute top-0 right-0 w-64 h-full bg-gradient-to-l from-elite-gold/5 to-transparent pointer-events-none"></div>
            {{-- HUD corners --}}
            <div class="hud-corner hud-corner-tl !w-8 !h-8"></div>
            <div class="hud-corner hud-corner-br !w-8 !h-8"></div>

            <div class="relative grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <div class="label-eyebrow mb-4">Never Miss A Drop</div>
                    <h3 class="heading-display text-4xl md:text-6xl text-elite-bone mb-4">
                        Get <span class="text-gold-gradient">Early Access</span>
                    </h3>
                    <p class="text-elite-smoke leading-relaxed">
                        Ticket drops, secret afterparty locations, artist reveals — straight to your inbox before anyone else.
                    </p>
                </div>
                <form class="space-y-3" onsubmit="event.preventDefault(); alert('Newsletter coming soon!');">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="email" required placeholder="your@email.com"
                               id="newsletter-email"
                               class="flex-1 bg-elite-black border border-elite-steel
                                      focus:border-elite-gold focus:ring-0
                                      text-elite-bone font-mono text-sm
                                      placeholder-elite-smoke px-5 py-4 outline-none
                                      transition-colors duration-300">
                        <button type="submit" class="btn-gold whitespace-nowrap !py-4">
                            Subscribe
                        </button>
                    </div>
                    <p class="font-mono text-[10px] text-elite-smoke tracking-wider">
                        No spam. Unsubscribe anytime. By subscribing you agree to our Privacy Policy.
                    </p>
                </form>
            </div>
        </div>

        {{-- Main grid --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 lg:gap-12 mb-16">
            {{-- Brand col (2 cols on md) --}}
            <div class="col-span-2 md:col-span-2">
                {{-- Logo --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 clip-corner bg-gold-gradient flex items-center justify-center flex-shrink-0">
                        <span class="font-display text-elite-black text-xl">E</span>
                    </div>
                    <div>
                        <div class="font-display text-2xl text-elite-bone tracking-tightest">ELITE</div>
                        <div class="font-mono text-[9px] tracking-ultra text-elite-gold">BLOCK PARTY</div>
                    </div>
                </div>

                <p class="text-elite-smoke text-sm leading-relaxed mb-6 max-w-xs">
                    The ultimate car showcase, music festival, and nightlife experience. One night. One city. Infinite energy.
                </p>

                {{-- Socials --}}
                <div class="flex gap-3">
                    @foreach([
                        ['label' => 'Instagram', 'href' => 'https://instagram.com', 'icon' => '<path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.5.4 1 .4 2.2.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.5.2-1 .4-2.2.4-1.3.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.5-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.5-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2a6.6 6.6 0 100 13.2 6.6 6.6 0 000-13.2zm0 10.9a4.3 4.3 0 110-8.6 4.3 4.3 0 010 8.6zm6.8-11.2a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>'],
                        ['label' => 'TikTok', 'href' => 'https://tiktok.com', 'icon' => '<path d="M19.6 6.3a5.4 5.4 0 01-3.2-1.1 5.4 5.4 0 01-2.1-3.5h-3.1v12.4a2.9 2.9 0 01-2.9 2.8 2.9 2.9 0 01-2.9-2.8 2.9 2.9 0 012.9-2.8c.3 0 .6 0 .9.1V7.9a6 6 0 00-.9-.1 6 6 0 106 6V9.6a8.5 8.5 0 004.9 1.5V8a5.4 5.4 0 01-.6-.1z"/>'],
                        ['label' => 'Twitter/X', 'href' => 'https://twitter.com', 'icon' => '<path d="M18.2 3h3.3l-7.1 8.2L22.7 21H16l-5.1-6.7L4.9 21H1.6l7.6-8.7L1 3h6.9l4.6 6.1L18.2 3zm-1.2 16.1h1.8L6.9 4.9H5L17 19.1z"/>'],
                    ] as $social)
                    <a href="{{ $social['href'] }}" target="_blank" rel="noopener"
                       aria-label="{{ $social['label'] }}"
                       class="w-10 h-10 flex items-center justify-center
                              border border-elite-steel text-elite-smoke
                              hover:border-elite-gold hover:bg-elite-gold hover:text-elite-black
                              transition-all duration-300 clip-corner">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            {!! $social['icon'] !!}
                        </svg>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Event --}}
            <div>
                <h4 class="font-bebas text-lg tracking-ultra text-elite-gold mb-5 pb-2 border-b border-elite-gold/20">Event</h4>
                <ul class="space-y-3">
                    @foreach(['Event Details' => '#event', 'Line-Up' => '#lineup', 'Experiences' => '#experiences', 'Gallery' => '#gallery', 'Tickets' => '#tickets'] as $label => $href)
                    <li><a href="{{ $href }}" class="text-sm text-elite-smoke hover:text-elite-gold transition-colors flex items-center gap-2 group">
                        <span class="w-1 h-1 bg-elite-gold rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        {{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Get Involved --}}
            <div>
                <h4 class="font-bebas text-lg tracking-ultra text-elite-gold mb-5 pb-2 border-b border-elite-gold/20">Participate</h4>
                <ul class="space-y-3">
                    @foreach(['Become A Vendor' => '#', 'Become A Sponsor' => '#', 'Perform At Elite' => '#', 'Volunteer' => '#', 'Media Partners' => '#'] as $label => $href)
                    <li><a href="{{ $href }}" class="text-sm text-elite-smoke hover:text-elite-gold transition-colors flex items-center gap-2 group">
                        <span class="w-1 h-1 bg-elite-gold rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        {{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-bebas text-lg tracking-ultra text-elite-gold mb-5 pb-2 border-b border-elite-gold/20">Contact</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="mailto:hello@eliteblockparty.com"
                           class="text-sm text-elite-smoke hover:text-elite-gold transition-colors break-all">
                            hello@eliteblockparty.com
                        </a>
                    </li>
                    <li>
                        <a href="tel:+2348000000000"
                           class="text-sm text-elite-smoke hover:text-elite-gold transition-colors">
                            +234 800 000 0000
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/2348000000000" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 text-sm text-elite-smoke hover:text-elite-gold transition-colors">
                            <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.2-.1-.4-.1-.6.1l-.9 1c-.1.2-.3.2-.6.1-1.4-.7-2.4-1.6-3.3-3-.3-.4 0-.6.2-.8l.5-.7c.1-.2.2-.4.1-.6L10 8.2c-.2-.5-.4-.4-.6-.5h-.5c-.2 0-.5.1-.7.3C7.6 8.5 7 9.3 7 10.7c0 1.4 1 2.7 1.1 2.9.1.2 2 3 4.7 4.2 2.7 1.2 2.7.8 3.2.8s1.6-.7 1.9-1.3c.2-.6.2-1.2.1-1.3l-.5-.6z"/>
                                <path d="M12 2a10 10 0 00-8.6 14.9L2 22l5.3-1.4A10 10 0 1012 2zm0 18.2a8.2 8.2 0 01-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3A8.2 8.2 0 1112 20.2z"/>
                            </svg>
                            WhatsApp Support
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="divider-gold mb-8"></div>

        {{-- Bottom bar --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="font-mono text-xs text-elite-smoke">
                © {{ date('Y') }} ELITE BLOCK PARTY. All rights reserved.
            </div>
            <div class="flex items-center gap-6">
                @foreach(['Privacy Policy' => '#', 'Terms of Use' => '#', 'Refund Policy' => '#'] as $label => $href)
                <a href="{{ $href }}" class="font-mono text-xs text-elite-smoke hover:text-elite-gold transition-colors">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
