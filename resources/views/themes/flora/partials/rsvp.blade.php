<section class="bg-ivory-warm px-6 py-24"
         x-data="rsvpForm('{{ route('invitation.rsvp', $inv) }}', '{{ $guestName }}')">
    <div class="mx-auto max-w-md">
        <header class="reveal text-center">
            <svg class="mx-auto h-8 w-28 text-sage" aria-hidden="true"><use href="#sprig"/></svg>
            <h2 class="mt-4 font-script text-5xl text-sage-dark">Konfirmasi Kehadiran</h2>
        </header>

        <form class="reveal mt-10 space-y-5" @submit.prevent="submit" x-show="!sent">
            <div>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-sage-deep">Nama</label>
                <input x-model="form.name" type="text" required
                       class="mt-2 w-full rounded-2xl border border-sage/30 bg-ivory px-4 py-3 font-sans text-sm outline-none focus:border-sage-deep focus:ring-1 focus:ring-sage-deep">
            </div>
            <div>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-sage-deep">Kehadiran</label>
                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach(['hadir'=>'Hadir','ragu'=>'Ragu','tidak_hadir'=>'Berhalangan'] as $val => $label)
                        <button type="button" @click="form.attendance='{{ $val }}'"
                                :class="form.attendance==='{{ $val }}' ? 'bg-sage-deep text-ivory border-sage-deep' : 'border-sage/30 text-bark/70 bg-ivory'"
                                class="rounded-2xl border px-2 py-3 font-sans text-xs transition">{{ $label }}</button>
                    @endforeach
                </div>
            </div>
            <div x-show="form.attendance==='hadir'" x-cloak>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-sage-deep">Jumlah tamu</label>
                <input x-model.number="form.headcount" type="number" min="1" max="20"
                       class="mt-2 w-full rounded-2xl border border-sage/30 bg-ivory px-4 py-3 font-sans text-sm outline-none focus:border-sage-deep focus:ring-1 focus:ring-sage-deep">
            </div>
            <p x-show="error" x-cloak x-text="error" class="font-sans text-sm text-red-700"></p>
            <button type="submit" :disabled="loading"
                    class="w-full rounded-full bg-sage-deep py-3 font-sans text-sm font-medium text-ivory transition hover:bg-sage-dark disabled:opacity-60">
                <span x-show="!loading">Kirim Konfirmasi</span>
                <span x-show="loading" x-cloak>Mengirim…</span>
            </button>
        </form>

        <div x-show="sent" x-cloak class="reveal mt-10 rounded-3xl border border-sage/30 bg-sage-pale/50 p-8 text-center">
            <svg class="mx-auto h-9 w-9 text-blush" aria-hidden="true"><use href="#bloom"/></svg>
            <p class="mt-3 font-script text-3xl text-sage-dark" x-text="message"></p>
            <div class="mt-6 grid grid-cols-3 gap-3">
                <div><div class="font-script text-3xl text-sage-deep" x-text="summary.hadir">0</div><div class="font-sans text-[10px] uppercase tracking-[0.12em] text-bark/60">Hadir</div></div>
                <div><div class="font-script text-3xl text-sage-deep" x-text="summary.ragu">0</div><div class="font-sans text-[10px] uppercase tracking-[0.12em] text-bark/60">Ragu</div></div>
                <div><div class="font-script text-3xl text-sage-deep" x-text="summary.tidak_hadir">0</div><div class="font-sans text-[10px] uppercase tracking-[0.12em] text-bark/60">Absen</div></div>
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
