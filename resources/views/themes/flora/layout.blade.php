<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Petit Formal Script (kaligrafi halus) + Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Petit+Formal+Script&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage:  { DEFAULT:'#7C9082', deep:'#4F6355', dark:'#3A4A40', pale:'#DCE5DC' },
                        blush: { DEFAULT:'var(--accent)', soft:'#F2DCD5' },
                        ivory: { DEFAULT:'#FBF8F3', warm:'#F4EDE3' },
                        bark:  '#4A4038',
                    },
                    fontFamily: {
                        script: ['"Petit Formal Script"', 'cursive'],
                        sans:   ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest2: '0.3em' },
                },
            },
        }
    </script>

    <style>
        :root { --accent: {{ $inv->accent_color ?: '#C98B7E' }}; }
        body { background:#FBF8F3; }
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

<body class="font-sans text-bark antialiased selection:bg-blush/30"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    {{-- ============ ORNAMEN SVG (didefinisikan sekali, dipakai berulang) ============ --}}
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            {{-- Ranting eucalyptus melengkung --}}
            <symbol id="sprig" viewBox="0 0 120 40">
                <path d="M4 20 C 30 20, 60 20, 116 20" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                <ellipse cx="24" cy="13" rx="7.5" ry="5" fill="currentColor" opacity=".55" transform="rotate(-22 24 13)"/>
                <ellipse cx="40" cy="27" rx="8.5" ry="5.5" fill="currentColor" opacity=".7" transform="rotate(20 40 27)"/>
                <ellipse cx="58" cy="12" rx="9" ry="5.5" fill="currentColor" opacity=".5" transform="rotate(-16 58 12)"/>
                <ellipse cx="76" cy="27" rx="8" ry="5" fill="currentColor" opacity=".68" transform="rotate(18 76 27)"/>
                <ellipse cx="94" cy="14" rx="7" ry="4.5" fill="currentColor" opacity=".45" transform="rotate(-20 94 14)"/>
            </symbol>
            {{-- Tangkai daun tegak (untuk sudut bingkai) --}}
            <symbol id="branch" viewBox="0 0 60 140">
                <path d="M30 136 C 26 100, 32 60, 30 6" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                <ellipse cx="17" cy="112" rx="11" ry="6" fill="currentColor" opacity=".5" transform="rotate(-28 17 112)"/>
                <ellipse cx="44" cy="94" rx="11" ry="6" fill="currentColor" opacity=".62" transform="rotate(28 44 94)"/>
                <ellipse cx="16" cy="74" rx="12" ry="6.5" fill="currentColor" opacity=".45" transform="rotate(-30 16 74)"/>
                <ellipse cx="45" cy="54" rx="11" ry="6" fill="currentColor" opacity=".58" transform="rotate(30 45 54)"/>
                <ellipse cx="18" cy="34" rx="9" ry="5" fill="currentColor" opacity=".4" transform="rotate(-32 18 34)"/>
                <ellipse cx="42" cy="18" rx="8" ry="4.5" fill="currentColor" opacity=".5" transform="rotate(32 42 18)"/>
            </symbol>
            {{-- Bunga kecil 5 kelopak --}}
            <symbol id="bloom" viewBox="0 0 40 40">
                <g fill="currentColor">
                    <ellipse cx="20" cy="9"  rx="5" ry="7.5" opacity=".8"/>
                    <ellipse cx="30" cy="16" rx="5" ry="7.5" opacity=".8" transform="rotate(72 30 16)"/>
                    <ellipse cx="26" cy="29" rx="5" ry="7.5" opacity=".8" transform="rotate(144 26 29)"/>
                    <ellipse cx="14" cy="29" rx="5" ry="7.5" opacity=".8" transform="rotate(216 14 29)"/>
                    <ellipse cx="10" cy="16" rx="5" ry="7.5" opacity=".8" transform="rotate(288 10 16)"/>
                </g>
                <circle cx="20" cy="20" r="4" fill="#E9C46A" opacity=".9"/>
            </symbol>
        </defs>
    </svg>

    @yield('content')

    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-12 w-12 place-items-center rounded-full bg-sage-deep/90 text-ivory shadow-lg ring-1 ring-white/30 backdrop-blur"
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
