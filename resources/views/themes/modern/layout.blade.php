<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Instrument Serif (display editorial) + Inter (grotesk bersih) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        paper: { DEFAULT:'#FBFBFA', warm:'#F3F2EE' },
                        ink:   { DEFAULT:'#1A1A1A', soft:'#6B6B6B' },
                        line:  '#E4E2DC',
                        accent:'var(--accent)',
                    },
                    fontFamily: {
                        display: ['"Instrument Serif"', 'ui-serif', 'Georgia', 'serif'],
                        sans:    ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest3: '0.4em' },
                },
            },
        }
    </script>

    <style>
        :root { --accent: {{ $inv->accent_color ?: '#B08D6A' }}; }
        body { background:#FBFBFA; }
        .hairline { height:1px; background:var(--tw-hairline, #E4E2DC); }
        .rule-accent { height:1px; width:40px; background:var(--accent); }
        [x-cloak] { display:none !important; }
        .reveal { opacity:0; transform:translateY(20px); transition:opacity 1s ease, transform 1s ease; }
        .reveal.in { opacity:1; transform:none; }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity:1; transform:none; transition:none; }
            html { scroll-behavior:auto; }
        }
    </style>

    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-ink antialiased selection:bg-accent/20"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    @yield('content')

    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-11 w-11 place-items-center rounded-full border border-line bg-paper/90 text-ink shadow-sm backdrop-blur"
                :aria-label="playing ? 'Matikan musik' : 'Putar musik'">
            <svg x-show="playing" class="h-4 w-4 animate-spin" style="animation-duration:3s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            <svg x-show="!playing" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/><line x1="3" y1="3" x2="21" y2="21"/></svg>
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
