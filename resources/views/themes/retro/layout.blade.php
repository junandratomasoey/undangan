<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Rozha One (display tebal berkarakter) + DM Sans (geometrik, terasa 70-an) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rozha+One&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        rust:    { DEFAULT:'#C1502E', deep:'#8F3A20' },
                        mustard: { DEFAULT:'var(--accent)', deep:'#C9922B' },
                        cocoa:   { DEFAULT:'#4A2C1D', deep:'#33200F' },
                        cream:   { DEFAULT:'#F5E9D4', warm:'#EBD9BC' },
                        olive:   '#7A7A38',
                    },
                    fontFamily: {
                        display: ['"Rozha One"', 'ui-serif', 'Georgia', 'serif'],
                        sans:    ['"DM Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest2: '0.3em' },
                },
            },
        }
    </script>

    <style>
        :root { --accent: {{ $inv->accent_color ?: '#E3A72F' }}; }
        body { background:#33200F; }
        /* Arch — bentuk lengkung khas poster 70-an */
        .arch      { border-radius:999px 999px 16px 16px; }
        .arch-full { border-radius:999px 999px 999px 999px / 60% 60% 40% 40%; }
        [x-cloak] { display:none !important; }
        .reveal { opacity:0; transform:translateY(24px); transition:opacity .9s ease, transform .9s ease; }
        .reveal.in { opacity:1; transform:none; }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity:1; transform:none; transition:none; }
            html { scroll-behavior:auto; }
        }
    </style>

    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-cocoa antialiased selection:bg-mustard/40"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    {{-- ============ ORNAMEN SVG ============ --}}
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            {{-- Matahari bergaris (sunburst) — ikon 70-an --}}
            <symbol id="sunburst" viewBox="0 0 100 60">
                <circle cx="50" cy="50" r="18" fill="currentColor"/>
                <rect x="12" y="44" width="76" height="4" rx="2" fill="currentColor" opacity=".9"/>
                <rect x="6"  y="52" width="88" height="3" rx="1.5" fill="currentColor" opacity=".7"/>
                <g fill="currentColor">
                    <rect x="48" y="4"  width="4" height="14" rx="2"/>
                    <rect x="48" y="4"  width="4" height="14" rx="2" transform="rotate(-40 50 50)"/>
                    <rect x="48" y="4"  width="4" height="14" rx="2" transform="rotate(40 50 50)"/>
                    <rect x="48" y="4"  width="4" height="14" rx="2" transform="rotate(-70 50 50)"/>
                    <rect x="48" y="4"  width="4" height="14" rx="2" transform="rotate(70 50 50)"/>
                </g>
            </symbol>
            {{-- Gelombang groovy --}}
            <symbol id="wavy" viewBox="0 0 120 16">
                <path d="M0 8 Q 15 0, 30 8 T 60 8 T 90 8 T 120 8" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            </symbol>
            {{-- Bunga daisy retro --}}
            <symbol id="daisy" viewBox="0 0 40 40">
                <g fill="currentColor">
                    <ellipse cx="20" cy="7"  rx="5.5" ry="8"/>
                    <ellipse cx="20" cy="33" rx="5.5" ry="8"/>
                    <ellipse cx="7"  cy="20" rx="8" ry="5.5"/>
                    <ellipse cx="33" cy="20" rx="8" ry="5.5"/>
                    <ellipse cx="11" cy="11" rx="6.5" ry="5" transform="rotate(-45 11 11)"/>
                    <ellipse cx="29" cy="11" rx="6.5" ry="5" transform="rotate(45 29 11)"/>
                    <ellipse cx="11" cy="29" rx="6.5" ry="5" transform="rotate(45 11 29)"/>
                    <ellipse cx="29" cy="29" rx="6.5" ry="5" transform="rotate(-45 29 29)"/>
                </g>
                <circle cx="20" cy="20" r="6" fill="#C1502E"/>
            </symbol>
        </defs>
    </svg>

    @yield('content')

    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-12 w-12 place-items-center rounded-full bg-rust text-cream shadow-lg ring-2 ring-mustard"
                :aria-label="playing ? 'Matikan musik' : 'Putar musik'">
            <svg x-show="playing" class="h-5 w-5 animate-spin" style="animation-duration:3s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            <svg x-show="!playing" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/><line x1="3" y1="3" x2="21" y2="21"/></svg>
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
