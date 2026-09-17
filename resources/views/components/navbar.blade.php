<header id="navbar" class="fixed top-0 left-0 right-0 z-40 transition-all duration-500 py-5">
    <div class="absolute inset-0 border-b border-transparent" id="navbar-bg"
         style="transition: all 0.5s ease;"></div>

    <nav class="container-elite flex items-center justify-between relative">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="Elite Block Party Home">
            {{-- Gold glow blob --}}
            <div class="relative">
                <div class="absolute -inset-2 bg-elite-gold/20 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                {{-- Logo icon: stylized "E" monogram --}}
                <div class="relative w-10 h-10 clip-corner bg-gold-gradient flex items-center justify-center">
                    <span class="font-display text-elite-black text-xl leading-none font-black">E</span>
                </div>
            </div>
            <div>
                <div class="font-display text-xl leading-none tracking-tightest text-elite-bone group-hover:text-gold-gradient transition-colors duration-300">ELITE</div>
                <div class="font-mono text-[9px] tracking-ultra text-elite-gold">BLOCK PARTY</div>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <ul class="hidden lg:flex items-center gap-7 font-bebas text-sm tracking-ultra uppercase" role="navigation">
            <li><a href="{{ route('home') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Home</a></li>
            <li><a href="{{ route('about') }}" class="text-elite-bone hover:text-elite-gold transition-colors">About</a></li>
            <li><a href="{{ route('event') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Event</a></li>
            <li><a href="{{ route('lineup') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Line-Up</a></li>
            <li><a href="{{ route('experiences') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Experiences</a></li>
            <li><a href="{{ route('gallery') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Gallery</a></li>
            <li><a href="{{ route('vendors') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Vendors</a></li>
            <li><a href="{{ route('sponsors') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Sponsors</a></li>
            <li><a href="{{ route('contact') }}" class="text-elite-bone hover:text-elite-gold transition-colors">Contact</a></li>
        </ul>

        {{-- Desktop CTA --}}
        <div class="hidden lg:flex items-center gap-4">
            @auth
            <a href="{{ url('/dashboard') }}"
               class="font-bebas text-xs tracking-ultra uppercase text-elite-smoke hover:text-elite-gold transition-colors">
                {{ Str::limit(auth()->user()->name, 12) }}
            </a>
            @else
            <a href="{{ route('login') }}"
               class="font-bebas text-xs tracking-ultra uppercase text-elite-smoke hover:text-elite-gold transition-colors">
                Login
            </a>
            @endauth
            <a href="{{ route('home') }}#tickets" class="btn-gold !px-5 !py-2.5 !text-xs !shadow-none hover:!shadow-gold-glow">
                <span>🎟️</span>
                <span>Buy Tickets</span>
            </a>
        </div>

        {{-- Mobile hamburger --}}
        <button id="menu-toggle"
                class="lg:hidden relative w-10 h-10 flex flex-col items-center justify-center gap-[5px] group"
                aria-label="Toggle mobile menu" aria-expanded="false">
            <span class="w-7 h-0.5 bg-elite-bone group-[.open]:rotate-45 group-[.open]:translate-y-[7px] transition-all duration-300 origin-center"></span>
            <span class="w-7 h-0.5 bg-elite-bone group-[.open]:opacity-0 transition-all duration-300"></span>
            <span class="w-7 h-0.5 bg-elite-bone group-[.open]:-rotate-45 group-[.open]:-translate-y-[7px] transition-all duration-300 origin-center"></span>
        </button>
    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu"
         class="lg:hidden fixed inset-0 top-[62px] z-50 bg-elite-black/98 backdrop-blur-2xl
                translate-x-full transition-transform duration-500 ease-in-out
                border-t border-elite-gold/20">
        <div class="container-elite py-8 h-full overflow-y-auto">
            {{-- Nav links --}}
            <nav class="space-y-1 mb-8">
                @foreach ([
                    'Home'         => route('home'),
                    'About'        => route('about'),
                    'Event'        => route('event'),
                    'Line-Up'      => route('lineup'),
                    'Experiences'  => route('experiences'),
                    'Gallery'      => route('gallery'),
                    'Vendors'      => route('vendors'),
                    'Sponsors'     => route('sponsors'),
                    'Contact'      => route('contact'),
                ] as $label => $url)
                    <a href="{{ $url }}"
                       onclick="document.getElementById('mobile-menu').classList.add('translate-x-full'); document.body.style.overflow=''"
                       class="flex items-center justify-between py-4 border-b border-elite-steel/30
                              font-display text-3xl text-elite-bone hover:text-elite-gold
                              transition-colors duration-300 racing-stripe pl-4">
                        {{ $label }}
                        <svg class="w-5 h-5 text-elite-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                @endforeach
            </nav>

            {{-- Mobile CTAs --}}
            <div class="space-y-3 mb-8">
                <a href="{{ route('home') }}#tickets" class="btn-gold w-full justify-center !py-5 text-base">
                    🎟️ BUY TICKETS NOW
                </a>
                @guest
                <a href="{{ route('login') }}" class="btn-outline-gold w-full justify-center !py-4">
                    LOGIN / REGISTER
                </a>
                @endguest
            </div>

            {{-- Quick stats --}}
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <div class="font-bebas text-3xl text-elite-gold">200+</div>
                    <div class="font-mono text-[9px] tracking-ultra text-elite-smoke">CARS</div>
                </div>
                <div>
                    <div class="font-bebas text-3xl text-elite-gold">10K+</div>
                    <div class="font-mono text-[9px] tracking-ultra text-elite-smoke">GUESTS</div>
                </div>
                <div>
                    <div class="font-bebas text-3xl text-elite-gold">DEC 20</div>
                    <div class="font-mono text-[9px] tracking-ultra text-elite-smoke">DATE</div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
(function() {
    const navbar   = document.getElementById('navbar');
    const navbarBg = document.getElementById('navbar-bg');
    const toggle   = document.getElementById('menu-toggle');
    const menu     = document.getElementById('mobile-menu');
    let menuOpen   = false;

    // Scroll effect
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY > 40;
        navbar.style.paddingTop    = scrolled ? '12px' : '20px';
        navbar.style.paddingBottom = scrolled ? '12px' : '20px';
        navbarBg.style.background  = scrolled ? 'rgba(5,5,5,0.92)' : 'transparent';
        navbarBg.style.backdropFilter = scrolled ? 'blur(16px)' : 'none';
        navbarBg.style.borderBottomColor = scrolled ? 'rgba(212,175,55,0.2)' : 'transparent';
    }, { passive: true });

    // Mobile menu toggle
    toggle.addEventListener('click', () => {
        menuOpen = !menuOpen;
        toggle.classList.toggle('open', menuOpen);
        menu.classList.toggle('translate-x-full', !menuOpen);
        toggle.setAttribute('aria-expanded', menuOpen);
        document.body.style.overflow = menuOpen ? 'hidden' : '';
    });
})();
</script>
