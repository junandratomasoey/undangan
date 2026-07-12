<section class="girih-bg relative overflow-hidden bg-emerald2 px-6 py-24 text-ivory"
         x-data="countdown('{{ $event->starts_at->toIso8601String() }}')" x-init="start()">
    <div class="reveal relative mx-auto max-w-2xl text-center">
        <p class="font-sans text-[10px] uppercase tracking-widest2 text-ivory/70">Menuju Hari Bahagia</p>
        <div class="mt-8 grid grid-cols-4 gap-3 sm:gap-5">
            @foreach(['days'=>'Hari','hours'=>'Jam','minutes'=>'Menit','seconds'=>'Detik'] as $key => $label)
                <div class="border border-gold/35 bg-emerald2-deep/50 py-6">
                    <div class="font-display text-4xl text-gold sm:text-5xl" x-text="String(t.{{ $key }}).padStart(2,'0')">00</div>
                    <div class="mt-1 font-sans text-[10px] uppercase tracking-[0.2em] text-ivory/65">{{ $label }}</div>
                </div>
            @endforeach
        </div>
        <p x-show="done" x-cloak class="mt-8 font-display text-3xl italic text-gold">Hari yang dinanti telah tiba</p>
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
