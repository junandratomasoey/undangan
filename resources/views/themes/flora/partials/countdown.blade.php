<section class="relative overflow-hidden bg-sage-deep px-6 py-24 text-ivory"
         x-data="countdown('{{ $event->starts_at->toIso8601String() }}')" x-init="start()">
    <svg class="pointer-events-none absolute -left-4 top-4 h-36 w-16 rotate-12 text-ivory/15" aria-hidden="true"><use href="#branch"/></svg>
    <svg class="pointer-events-none absolute -right-4 bottom-4 h-36 w-16 rotate-[192deg] text-ivory/15" aria-hidden="true"><use href="#branch"/></svg>

    <div class="reveal relative mx-auto max-w-2xl text-center">
        <p class="font-sans text-[10px] uppercase tracking-widest2 text-ivory/70">Menuju Hari Bahagia</p>
        <div class="mt-8 grid grid-cols-4 gap-3 sm:gap-5">
            @foreach(['days'=>'Hari','hours'=>'Jam','minutes'=>'Menit','seconds'=>'Detik'] as $key => $label)
                <div class="rounded-2xl bg-ivory/10 py-6 backdrop-blur-sm">
                    <div class="font-script text-4xl sm:text-5xl" x-text="String(t.{{ $key }}).padStart(2,'0')">00</div>
                    <div class="mt-1 font-sans text-[10px] uppercase tracking-[0.2em] text-ivory/70">{{ $label }}</div>
                </div>
            @endforeach
        </div>
        <p x-show="done" x-cloak class="mt-8 font-script text-3xl">Hari yang dinanti telah tiba</p>
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
