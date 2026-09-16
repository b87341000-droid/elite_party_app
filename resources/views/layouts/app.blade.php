<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ELITE BLOCK PARTY — The Ultimate Car & Music Festival')</title>
    <meta name="description" content="@yield('meta_description', "ELITE BLOCK PARTY — Nigeria's most anticipated car showcase, music festival, and nightlife experience. Secure your tickets now.")">
    <meta property="og:title" content="@yield('og_title', 'ELITE BLOCK PARTY')">
    <meta property="og:description" content="@yield('og_description', 'Car showcase. Music festival. Nightlife. One night. One city.')">
    <meta property="og:type" content="website">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-elite-black text-elite-bone font-sans overflow-x-hidden">

    {{-- Announcement Ticker --}}
    @include('components.announcement-bar')

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Mobile Sticky CTA --}}
    @include('components.buy-tickets-button')

    @stack('scripts')

    {{-- Alpine.js & scroll reveal inline init --}}
    <script>
        // Intersection Observer for scroll reveals
        const reveals = document.querySelectorAll('[data-reveal]');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('revealed');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });
        reveals.forEach(el => io.observe(el));

        // Countdown timer
        function initCountdown(targetDate) {
            const update = () => {
                const diff = new Date(targetDate) - new Date();
                if (diff <= 0) return;
                const d = Math.floor(diff / 86400000);
                const h = Math.floor((diff % 86400000) / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);
                document.querySelectorAll('[data-countdown-days]').forEach(el => el.textContent = String(d).padStart(2,'0'));
                document.querySelectorAll('[data-countdown-hours]').forEach(el => el.textContent = String(h).padStart(2,'0'));
                document.querySelectorAll('[data-countdown-minutes]').forEach(el => el.textContent = String(m).padStart(2,'0'));
                document.querySelectorAll('[data-countdown-seconds]').forEach(el => el.textContent = String(s).padStart(2,'0'));
            };
            update();
            setInterval(update, 1000);
        }
        initCountdown('2025-12-20T22:00:00+01:00');
    </script>
</body>
</html>
