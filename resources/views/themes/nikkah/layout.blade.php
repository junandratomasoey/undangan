<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Amiri: serif yang dirancang untuk teks Arab & Latin (naskh) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald2: { DEFAULT:'#1B4D3E', deep:'#123528', dark:'#0C2419', pale:'#D6E3DC' },
                        ivory:    { DEFAULT:'#FAF6EC', warm:'#F0E8D6' },
                        gold:     { DEFAULT:'var(--accent)', soft:'#D9C285' },
                        ink:      '#26302B',
                    },
                    fontFamily: {
                        display: ['Amiri', 'ui-serif', 'Georgia', 'serif'],
                        sans:    ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest2: '0.3em' },
                },
            },
        }
    </script>

    <style>
        :root {
            --accent: {{ $inv->accent_color ?: '#C0A053' }};
            /* Girih: pola geometris Islam (bintang 8 + anyaman), tileable 40px.
               Dipakai sebagai CSS mask agar warnanya mengikuti currentColor. */
            --girih: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cg fill='none' stroke='%23000' stroke-width='1.4'%3E%3Cpath d='M20 2 L38 20 L20 38 L2 20 Z'/%3E%3Cpath d='M2 2 L38 38 M38 2 L2 38'/%3E%3Cpath d='M20 10 L30 20 L20 30 L10 20 Z'/%3E%3C/g%3E%3C/svg%3E");
        }
        body { background:#0C2419; }

        /* Pita pola girih */
        .girih-band {
            height:34px;
            background-color:currentColor;
            -webkit-mask:var(--girih) repeat-x center / auto 34px;
                    mask:var(--girih) repeat-x center / auto 34px;
        }
        .girih-band--thin { height:22px; -webkit-mask-size:auto 22px; mask-size:auto 22px; }

        /* Latar pola girih samar (untuk section) */
        .girih-bg::before {
            content:''; position:absolute; inset:0; pointer-events:none; opacity:.07;
            background-color:currentColor;
            -webkit-mask:var(--girih) repeat center / 40px 40px;
                    mask:var(--girih) repeat center / 40px 40px;
        }

        /* Lengkung mihrab — arch runcing khas masjid */
        .mihrab { border-radius:50% 50% 8px 8px / 46% 46% 5px 5px; }

        .rule-gold::before, .rule-gold::after {
            content:''; height:1px; width:46px;
            background:linear-gradient(90deg,transparent,var(--accent));
        }
        .rule-gold::after { transform:rotate(180deg); }

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

<body class="font-sans text-ink antialiased selection:bg-gold/25"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    {{-- ============ ORNAMEN SVG ============ --}}
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            {{-- Bintang 8 (khatam) — motif Islam paling ikonik --}}
            <symbol id="khatam" viewBox="0 0 40 40">
                <path d="M20 2 L25 12 L36 9 L31 20 L36 31 L25 28 L20 38 L15 28 L4 31 L9 20 L4 9 L15 12 Z"
                      fill="none" stroke="currentColor" stroke-width="1.3"/>
                <path d="M20 10 L27 20 L20 30 L13 20 Z" fill="currentColor" opacity=".35"/>
            </symbol>
            {{-- Ornamen arabesque melengkung --}}
            <symbol id="arabesque" viewBox="0 0 120 24">
                <path d="M6 12 C 20 2, 34 22, 48 12 C 62 2, 76 22, 90 12 C 100 5, 108 9, 114 12"
                      fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                <circle cx="27" cy="8"  r="2.2" fill="currentColor" opacity=".7"/>
                <circle cx="69" cy="8"  r="2.2" fill="currentColor" opacity=".7"/>
                <circle cx="48" cy="16" r="2"   fill="currentColor" opacity=".5"/>
            </symbol>
            {{-- Kubah masjid + bulan sabit --}}
            <symbol id="dome" viewBox="0 0 40 44">
                <path d="M20 6 C 30 12, 34 22, 34 34 L 6 34 C 6 22, 10 12, 20 6 Z"
                      fill="none" stroke="currentColor" stroke-width="1.3"/>
                <path d="M20 6 L20 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                <circle cx="20" cy="1.5" r="1.5" fill="currentColor"/>
                <path d="M14 34 L14 24 C 14 20, 26 20, 26 24 L 26 34" fill="none" stroke="currentColor" stroke-width="1.1" opacity=".6"/>
            </symbol>
        </defs>
    </svg>

    @yield('content')

    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-12 w-12 place-items-center rounded-full bg-emerald2-deep/90 text-gold shadow-lg ring-1 ring-gold/40 backdrop-blur"
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
