<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }} — Undangan Pernikahan</title>

    {{-- Fonts: Cormorant (display) + Plus Jakarta Sans (body, dibuat oleh Tokotype, Indonesia) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Leaflet (peta) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    {{--
        DEMO uses Tailwind Play CDN so the file previews with zero build.
        PRODUKSI: ganti dengan build Tailwind kamu (@vite / cp public/build),
        sesuai workflow shared-hosting tanpa symlink yang biasa kamu pakai.
    --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: { DEFAULT: '#0F3D3A', deep: '#0A2725', ink: '#16211F' },
                        ivory:  { DEFAULT: '#F6F1E7', soft: '#EFE7D6' },
                        sage:   '#9DB0A3',
                        accent: 'var(--accent)',
                    },
                    fontFamily: {
                        display: ['Cormorant', 'ui-serif', 'Georgia', 'serif'],
                        sans:    ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    letterSpacing: { widest2: '0.35em' },
                },
            },
        }
    </script>

    <style>
        :root { --accent: {{ $inv->accent_color ?: '#C8A04B' }}; }
        body { background:#0A2725; }
        /* thin gold botanical divider used across sections */
        .divider-leaf::before,
        .divider-leaf::after {
            content:''; height:1px; width:56px;
            background:linear-gradient(90deg,transparent,var(--accent));
        }
        .divider-leaf::after { transform:rotate(180deg); }
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

<body class="font-sans text-forest-ink antialiased selection:bg-accent/30"
      x-data="invitation(@js($inv->music_url), {{ $inv->hasFeature('music') ? 'true' : 'false' }})">

    @yield('content')

    {{-- Floating music toggle (platinum) --}}
    @if($inv->hasFeature('music') && $inv->music_url)
        <button @click="toggleMusic()" x-show="opened" x-cloak
                class="fixed bottom-5 right-5 z-50 grid h-12 w-12 place-items-center rounded-full bg-forest-deep/90 text-ivory shadow-lg ring-1 ring-accent/40 backdrop-blur"
                :aria-label="playing ? 'Matikan musik' : 'Putar musik'">
            <svg x-show="playing" class="h-5 w-5 animate-spin" style="animation-duration:3s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            <svg x-show="!playing" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/><line x1="3" y1="3" x2="21" y2="21"/></svg>
        </button>
        <audio x-ref="audio" loop src="{{ $inv->music_url }}"></audio>
    @endif

    <script>
        function invitation(musicUrl, autoplay) {
            return {
                opened: false,
                playing: false,
                open() {
                    this.opened = true;
                    document.body.style.overflow = '';
                    this.$nextTick(() => {
                        document.getElementById('content')?.scrollIntoView({ behavior: 'smooth' });
                        if (autoplay && musicUrl) this.toggleMusic();
                    });
                },
                toggleMusic() {
                    const a = this.$refs.audio; if (!a) return;
                    if (a.paused) { a.play().then(() => this.playing = true).catch(() => {}); }
                    else { a.pause(); this.playing = false; }
                },
                init() {
                    document.body.style.overflow = 'hidden'; // lock scroll behind cover
                    const io = new IntersectionObserver((els) => {
                        els.forEach(e => e.isIntersecting && e.target.classList.add('in'));
                    }, { threshold: 0.15 });
                    this.$nextTick(() => document.querySelectorAll('.reveal').forEach(el => io.observe(el)));
                },
            }
        }

        // shared CSRF helper for fetch()
        window.csrf = () => document.querySelector('meta[name=csrf-token]').content;
    </script>
</body>
</html>
