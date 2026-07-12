<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Cormorant Garamond (serif klasik, terasa gereja) + Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Plus+Jakarta+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        stone:  { DEFAULT:'#4A5A6B', deep:'#33424F', dark:'#22303B', pale:'#D9E0E5' },
                        ivory:  { DEFAULT:'#FAF7F1', warm:'#F0EADF' },
                        gilt:   { DEFAULT:'var(--accent)', soft:'#D9BE85' },
                        ink:    '#2C3238',
                    },
                    fontFamily: {
                        display: ['"Cormorant Garamond"', 'ui-serif', 'Georgia', 'serif'],
                        sans:    ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest2: '0.3em' },
                },
            },
        }
    </script>

    <style>
        :root { --accent: {{ $inv->accent_color ?: '#B79457' }}; }
        body { background:#22303B; }
        /* Jendela lengkung gotik — signature tema */
        .gothic { border-radius:50% 50% 6px 6px / 42% 42% 4px 4px; }
        .rule-gilt::before, .rule-gilt::after {
            content:''; height:1px; width:48px;
            background:linear-gradient(90deg,transparent,var(--accent));
        }
        .rule-gilt::after { transform:rotate(180deg); }
        [x-cloak] { display:none !important; }
        .reveal { opacity:0; transform:translateY(22px); transition:opacity 1s ease, transform 1s ease; }
        .reveal.in { opacity:1; transform:none; }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity:1; transform:none; transition:none; }
            html { scroll-behavior:auto; }
        }
    </style>

    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-ink antialiased selection:bg-gilt/25"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    {{-- ============ ORNAMEN SVG ============ --}}
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            {{-- Salib halus (garis tipis, tidak mencolok) --}}
            <symbol id="cross" viewBox="0 0 24 36">
                <rect x="10.6" y="2" width="2.8" height="32" rx="1.4" fill="currentColor"/>
                <rect x="3" y="11" width="18" height="2.8" rx="1.4" fill="currentColor"/>
            </symbol>
            {{-- Merpati (Roh Kudus) --}}
            <symbol id="dove" viewBox="0 0 48 32">
                <path d="M4 20 C 10 10, 22 6, 34 8 C 40 9, 44 13, 45 18 C 40 16, 34 16, 30 19 C 26 22, 20 26, 12 26 C 8 26, 5 24, 4 20 Z" fill="currentColor" opacity=".9"/>
                <path d="M18 15 C 22 10, 28 8, 33 9" fill="none" stroke="currentColor" stroke-width="1" opacity=".5"/>
                <circle cx="40" cy="13" r="1.2" fill="#FAF7F1"/>
            </symbol>
            {{-- Ornamen daun zaitun --}}
            <symbol id="olive" viewBox="0 0 120 30">
                <path d="M6 15 C 35 15, 85 15, 114 15" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"/>
                <ellipse cx="28" cy="9"  rx="7" ry="3.5" fill="currentColor" opacity=".6" transform="rotate(-25 28 9)"/>
                <ellipse cx="44" cy="21" rx="7" ry="3.5" fill="currentColor" opacity=".7" transform="rotate(25 44 21)"/>
                <ellipse cx="60" cy="8"  rx="7.5" ry="3.5" fill="currentColor" opacity=".55" transform="rotate(-20 60 8)"/>
                <ellipse cx="76" cy="21" rx="7" ry="3.5" fill="currentColor" opacity=".7" transform="rotate(20 76 21)"/>
                <ellipse cx="92" cy="10" rx="6" ry="3" fill="currentColor" opacity=".5" transform="rotate(-25 92 10)"/>
            </symbol>
        </defs>
    </svg>

    @yield('content')

    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-12 w-12 place-items-center rounded-full bg-stone-deep/90 text-gilt shadow-lg ring-1 ring-gilt/40 backdrop-blur"
                :aria-label="playing ? 'Matikan musik' : 'Putar musik'">
            <svg x-show="playing" class="h-5 w-5 animate-spin" style="animation-duration:3s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            <svg x-show="!playing" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/><line x1="3" y1="3" x2="21" y2="21"/></svg>
        </button>
        <audio x-ref="audio" loop src="{{ $inv->music_url }}"></audio>
    @endif

    <script>
        function invitation(musicUrl, autoplay) {
            return {
                opened:false, playing:false,
                open() {
                    this.opened = true; document.body.style.overflow = '';
                    this.$nextTick(() => {
                        document.getElementById('content')?.scrollIntoView({ behavior:'smooth' });
                        if (autoplay && musicUrl) this.toggleMusic();
                    });
                },
                toggleMusic() {
                    const a = this.$refs.audio; if (!a) return;
                    if (a.paused) a.play().then(() => this.playing = true).catch(() => {});
                    else { a.pause(); this.playing = false; }
                },
                init() {
                    document.body.style.overflow = 'hidden';
                    const io = new IntersectionObserver(els =>
                        els.forEach(e => e.isIntersecting && e.target.classList.add('in')),
                        { threshold:0.15 });
                    this.$nextTick(() => document.querySelectorAll('.reveal').forEach(el => io.observe(el)));
                },
            }
        }
        window.csrf = () => document.querySelector('meta[name=csrf-token]').content;
    </script>
</body>
</html>
