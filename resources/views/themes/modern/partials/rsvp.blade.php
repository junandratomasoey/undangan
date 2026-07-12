<section class="border-t border-line px-6 py-28"
         x-data="rsvpForm('{{ route('invitation.rsvp', $inv) }}', '{{ $guestName }}')">
    <div class="mx-auto max-w-md">
        <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Konfirmasi Kehadiran</p>

        <form class="reveal mt-12 space-y-6" @submit.prevent="submit" x-show="!sent">
            <div>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-ink-soft">Nama</label>
                <input x-model="form.name" type="text" required
                       class="mt-2 w-full border-0 border-b border-line bg-transparent px-0 py-2 font-sans text-sm focus:border-ink focus:ring-0">
            </div>
            <div>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-ink-soft">Kehadiran</label>
                <div class="mt-3 grid grid-cols-3 gap-2">
                    @foreach(['hadir'=>'Hadir','ragu'=>'Ragu','tidak_hadir'=>'Berhalangan'] as $val => $label)
                        <button type="button" @click="form.attendance='{{ $val }}'"
                                :class="form.attendance==='{{ $val }}' ? 'bg-ink text-paper border-ink' : 'border-line text-ink-soft'"
                                class="border px-2 py-3 font-sans text-xs transition">{{ $label }}</button>
                    @endforeach
                </div>
            </div>
            <div x-show="form.attendance==='hadir'" x-cloak>
                <label class="font-sans text-[10px] uppercase tracking-[0.15em] text-ink-soft">Jumlah tamu</label>
                <input x-model.number="form.headcount" type="number" min="1" max="20"
                       class="mt-2 w-full border-0 border-b border-line bg-transparent px-0 py-2 font-sans text-sm focus:border-ink focus:ring-0">
            </div>
            <p x-show="error" x-cloak x-text="error" class="font-sans text-sm text-red-700"></p>
            <button type="submit" :disabled="loading"
                    class="w-full bg-ink py-3 font-sans text-xs uppercase tracking-[0.2em] text-paper transition hover:bg-accent disabled:opacity-60">
                <span x-show="!loading">Kirim Konfirmasi</span>
                <span x-show="loading" x-cloak>Mengirim…</span>
            </button>
        </form>

        <div x-show="sent" x-cloak class="reveal mt-12 border border-line p-10 text-center">
            <p class="font-display text-3xl" x-text="message"></p>
            <div class="mt-8 grid grid-cols-3 divide-x divide-line border-y border-line">
                <div class="py-4"><div class="font-display text-3xl" x-text="summary.hadir">0</div><div class="mt-1 font-sans text-[10px] uppercase tracking-[0.15em] text-ink-soft">Hadir</div></div>
                <div class="py-4"><div class="font-display text-3xl" x-text="summary.ragu">0</div><div class="mt-1 font-sans text-[10px] uppercase tracking-[0.15em] text-ink-soft">Ragu</div></div>
                <div class="py-4"><div class="font-display text-3xl" x-text="summary.tidak_hadir">0</div><div class="mt-1 font-sans text-[10px] uppercase tracking-[0.15em] text-ink-soft">Absen</div></div>
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
