<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Fraunces (display, karakter heritage) + Plus Jakarta Sans (body, buatan Indonesia) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo2: { DEFAULT:'#1E2A44', deep:'#141C30' },
                        maroon:  { DEFAULT:'#6E2A2A', deep:'#4E1D1D' },
                        cream:   { DEFAULT:'#EFE6D2', soft:'#E4D8BE' },
                        ochre:   'var(--accent)',
                        ink:     '#241A16',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'ui-serif', 'Georgia', 'serif'],
                        sans:    ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest2: '0.3em' },
                },
            },
        }
    </script>

    <style>
        :root {
            --accent: {{ $inv->accent_color ?: '#C6892C' }};
            /* Motif ikat NTT: cincin belah ketupat + zigzag, tileable 30px, dipakai sebagai CSS mask
               sehingga warnanya mengikuti `color` elemen (currentColor). */
            --tenun: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3E%3Cpath fill-rule='evenodd' d='M15 3 L27 15 L15 27 L3 15 Z M15 9 L21 15 L15 21 L9 15 Z'/%3E%3Cpath d='M15 13 L17 15 L15 17 L13 15 Z'/%3E%3Cpath d='M0 0 L5 5 L10 0 Z M10 0 L15 5 L20 0 Z M20 0 L25 5 L30 0 Z'/%3E%3Cpath d='M0 30 L5 25 L10 30 Z M10 30 L15 25 L20 30 Z M20 30 L25 25 L30 30 Z'/%3E%3C/svg%3E");
        }
        body { background:#141C30; }
        .tenun-band {
            height:24px;
            background-color:currentColor;
            -webkit-mask:var(--tenun) repeat-x center / auto 24px;
                    mask:var(--tenun) repeat-x center / auto 24px;
        }
        .tenun-band--thin { height:16px; -webkit-mask-size:auto 16px; mask-size:auto 16px; }
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

<body class="font-sans text-ink antialiased selection:bg-ochre/30"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    @yield('content')

    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-12 w-12 place-items-center rounded-full bg-maroon-deep/90 text-cream shadow-lg ring-1 ring-ochre/50 backdrop-blur"
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
