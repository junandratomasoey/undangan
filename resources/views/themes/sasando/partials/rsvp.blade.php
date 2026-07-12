<section class="bg-ivory-soft px-6 py-24"
         x-data="rsvpForm('{{ route('invitation.rsvp', $inv) }}', '{{ $guestName }}')">
    <div class="mx-auto max-w-md">
        <header class="reveal text-center">
            <p class="font-sans text-xs uppercase tracking-[0.25em] text-sage">Konfirmasi Kehadiran</p>
            <h2 class="mt-2 font-display text-4xl text-forest">RSVP</h2>
        </header>

        {{-- form --}}
        <form class="reveal mt-10 space-y-5" @submit.prevent="submit" x-show="!sent">
            <div>
                <label class="font-sans text-xs uppercase tracking-[0.15em] text-forest-ink/70">Nama</label>
                <input x-model="form.name" type="text" required
                       class="mt-2 w-full rounded-sm border border-forest/25 bg-white/70 px-4 py-3 font-sans text-sm outline-none focus:border-accent focus:ring-1 focus:ring-accent">
            </div>

            <div>
                <label class="font-sans text-xs uppercase tracking-[0.15em] text-forest-ink/70">Kehadiran</label>
                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach(['hadir'=>'Hadir','ragu'=>'Ragu','tidak_hadir'=>'Berhalangan'] as $val => $label)
                        <button type="button" @click="form.attendance='{{ $val }}'"
                                :class="form.attendance==='{{ $val }}' ? 'bg-forest text-ivory border-forest' : 'border-forest/25 text-forest-ink/70'"
                                class="rounded-sm border px-2 py-3 font-sans text-xs transition">{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            <div x-show="form.attendance==='hadir'" x-cloak>
                <label class="font-sans text-xs uppercase tracking-[0.15em] text-forest-ink/70">Jumlah tamu</label>
                <input x-model.number="form.headcount" type="number" min="1" max="20"
                       class="mt-2 w-full rounded-sm border border-forest/25 bg-white/70 px-4 py-3 font-sans text-sm outline-none focus:border-accent focus:ring-1 focus:ring-accent">
            </div>

            <p x-show="error" x-cloak x-text="error" class="font-sans text-sm text-red-700"></p>

            <button type="submit" :disabled="loading"
                    class="w-full rounded-full bg-accent px-6 py-3 font-sans text-sm font-medium text-forest-deep transition hover:brightness-105 disabled:opacity-60">
                <span x-show="!loading">Kirim Konfirmasi</span>
                <span x-show="loading" x-cloak>Mengirim…</span>
            </button>
        </form>

        {{-- success --}}
        <div x-show="sent" x-cloak class="reveal mt-10 rounded-sm border border-accent/40 bg-white/70 p-8 text-center">
            <p class="font-display text-2xl text-forest" x-text="message"></p>
            <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                <div><div class="font-display text-3xl text-accent" x-text="summary.hadir">0</div><div class="font-sans text-[10px] uppercase tracking-[0.15em] text-forest-ink/60">Hadir</div></div>
                <div><div class="font-display text-3xl text-accent" x-text="summary.ragu">0</div><div class="font-sans text-[10px] uppercase tracking-[0.15em] text-forest-ink/60">Ragu</div></div>
                <div><div class="font-display text-3xl text-accent" x-text="summary.tidak_hadir">0</div><div class="font-sans text-[10px] uppercase tracking-[0.15em] text-forest-ink/60">Berhalangan</div></div>
            </div>
        </div>
    </div>
</section>

<script>
    function rsvpForm(url, guest) {
        return {
            url, loading:false, sent:false, error:null, message:'',
            summary:{ hadir:0, ragu:0, tidak_hadir:0 },
            form:{ name: guest || '', attendance:'hadir', headcount:1 },
            async submit() {
                this.error = null; this.loading = true;
                try {
                    const res = await fetch(this.url, {
                        method:'POST',
                        headers:{ 'Content-Type':'application/json', 'X-CSRF-TOKEN': window.csrf(), 'Accept':'application/json' },
                        body: JSON.stringify(this.form),
                    });
                    const data = await res.json();
                    if (!res.ok) throw new Error(data.message || 'Gagal mengirim. Coba lagi.');
                    this.message = data.message; this.summary = data.summary; this.sent = true;
                } catch (e) { this.error = e.message; }
                finally { this.loading = false; }
            },
        }
    }
</script>
