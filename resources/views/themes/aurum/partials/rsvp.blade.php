<section class="px-6 py-24"
         x-data="rsvpForm('{{ route('invitation.rsvp', $inv) }}', '{{ $guestName }}')">
    <div class="mx-auto max-w-md">
        <header class="reveal text-center">
            <p class="font-sans text-[10px] uppercase tracking-widest3 text-ivory-muted">Konfirmasi Kehadiran</p>
            <h2 class="mt-2 font-script gold-sheen text-6xl">RSVP</h2>
        </header>

        <form class="reveal mt-10 space-y-5" @submit.prevent="submit" x-show="!sent">
            <div>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-ivory-muted">Nama</label>
                <input x-model="form.name" type="text" required
                       class="mt-2 w-full border border-gold/30 bg-noir-panel px-4 py-3 font-sans text-sm text-ivory outline-none focus:border-gold">
            </div>
            <div>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-ivory-muted">Kehadiran</label>
                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach(['hadir'=>'Hadir','ragu'=>'Ragu','tidak_hadir'=>'Berhalangan'] as $val => $label)
                        <button type="button" @click="form.attendance='{{ $val }}'"
                                :class="form.attendance==='{{ $val }}' ? 'bg-gold text-noir-deep border-gold' : 'border-gold/30 text-ivory/70'"
                                class="border px-2 py-3 font-sans text-xs transition">{{ $label }}</button>
                    @endforeach
                </div>
            </div>
            <div x-show="form.attendance==='hadir'" x-cloak>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-ivory-muted">Jumlah tamu</label>
                <input x-model.number="form.headcount" type="number" min="1" max="20"
                       class="mt-2 w-full border border-gold/30 bg-noir-panel px-4 py-3 font-sans text-sm text-ivory outline-none focus:border-gold">
            </div>
            <p x-show="error" x-cloak x-text="error" class="font-sans text-sm text-red-400"></p>
            <button type="submit" :disabled="loading"
                    class="w-full border border-gold bg-gold py-3 font-sans text-xs uppercase tracking-[0.2em] text-noir-deep transition hover:bg-gold-light disabled:opacity-60">
                <span x-show="!loading">Kirim Konfirmasi</span>
                <span x-show="loading" x-cloak>Mengirim…</span>
            </button>
        </form>

        <div x-show="sent" x-cloak class="reveal mt-10 border border-gold/40 bg-noir-panel p-10 text-center">
            <p class="font-script gold-sheen text-4xl" x-text="message"></p>
            <div class="mt-6 grid grid-cols-3 gap-3">
                <div><div class="gold-sheen font-script text-4xl" x-text="summary.hadir">0</div><div class="font-sans text-[10px] uppercase tracking-[0.15em] text-ivory/60">Hadir</div></div>
                <div><div class="gold-sheen font-script text-4xl" x-text="summary.ragu">0</div><div class="font-sans text-[10px] uppercase tracking-[0.15em] text-ivory/60">Ragu</div></div>
                <div><div class="gold-sheen font-script text-4xl" x-text="summary.tidak_hadir">0</div><div class="font-sans text-[10px] uppercase tracking-[0.15em] text-ivory/60">Absen</div></div>
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
