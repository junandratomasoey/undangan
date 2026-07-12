<section class="border-t border-line px-6 py-28"
         x-data="countdown('{{ $event->starts_at->toIso8601String() }}')" x-init="start()">
    <div class="reveal mx-auto max-w-2xl text-center">
        <p class="font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Menuju Hari Bahagia</p>
        <div class="mt-10 grid grid-cols-4 divide-x divide-line border-y border-line">
            @foreach(['days'=>'Hari','hours'=>'Jam','minutes'=>'Menit','seconds'=>'Detik'] as $key => $label)
                <div class="py-8">
                    <div class="font-display text-5xl sm:text-6xl" x-text="String(t.{{ $key }}).padStart(2,'0')">00</div>
                    <div class="mt-2 font-sans text-[10px] uppercase tracking-[0.2em] text-ink-soft">{{ $label }}</div>
                </div>
            @endforeach
        </div>
        <p x-show="done" x-cloak class="mt-8 font-display text-2xl italic text-accent">Hari yang dinanti telah tiba</p>
    </div>
</section>

<script>
    function countdown(target) {
        return {
            t:{days:0,hours:0,minutes:0,seconds:0}, done:false,
            start() {
                const end = new Date(target).getTime();
                const tick = () => {
                    const d = end - Date.now();
                    if (d <= 0) { this.done = true; this.t = {days:0,hours:0,minutes:0,seconds:0}; return; }
                    this.t = {
                        days:    Math.floor(d/864e5),
                        hours:   Math.floor(d%864e5/36e5),
                        minutes: Math.floor(d%36e5/6e4),
                        seconds: Math.floor(d%6e4/1e3),
                    };
                };
                tick(); setInterval(tick, 1000);
            },
        }
    }
</script>
