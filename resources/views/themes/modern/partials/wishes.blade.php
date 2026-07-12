<section class="border-t border-line bg-paper-warm px-6 py-28"
         x-data="wishBook('{{ route('invitation.wishes', $inv) }}', {{ Illuminate\Support\Js::from($inv->wishes->map(fn($w)=>['name'=>$w->name,'message'=>$w->message,'ago'=>$w->created_at->diffForHumans()])) }})">
    <div class="mx-auto max-w-md">
        <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Ucapan &amp; Doa</p>
        <form class="reveal mt-10 space-y-3" @submit.prevent="submit">
            <input x-model="form.name" type="text" placeholder="Nama" required
                   class="w-full border border-line bg-paper px-4 py-3 font-sans text-sm focus:border-ink focus:ring-0">
            <textarea x-model="form.message" rows="3" placeholder="Tulis ucapan &amp; doa…" required
                      class="w-full border border-line bg-paper px-4 py-3 font-sans text-sm focus:border-ink focus:ring-0"></textarea>
            <p x-show="error" x-cloak x-text="error" class="font-sans text-sm text-red-700"></p>
            <button type="submit" :disabled="loading"
                    class="w-full bg-ink py-3 font-sans text-xs uppercase tracking-[0.2em] text-paper transition hover:bg-accent disabled:opacity-60">
                <span x-show="!loading">Kirim Ucapan</span>
                <span x-show="loading" x-cloak>Mengirim…</span>
            </button>
        </form>
        <div class="mt-10 max-h-96 space-y-3 overflow-y-auto pr-1">
            <template x-for="(w, i) in wishes" :key="i">
                <div class="border border-line bg-paper p-4">
                    <div class="flex items-baseline justify-between gap-3">
                        <p class="font-display text-xl" x-text="w.name"></p>
                        <p class="font-sans text-[10px] text-ink-soft" x-text="w.ago"></p>
                    </div>
                    <p class="mt-1 font-sans text-sm leading-relaxed text-ink-soft" x-text="w.message"></p>
                </div>
            </template>
            <p x-show="!wishes.length" x-cloak class="text-center font-sans text-sm text-ink-soft">Jadilah yang pertama mengirim ucapan</p>
        </div>
    </div>
</section>

<script>
    function wishBook(url, initial) {
        return {
            url, wishes: initial, loading:false, error:null,
            form:{ name:'', message:'' },
            async submit() {
                this.error = null; this.loading = true;
                try {
                    const res = await fetch(this.url, {
                        method:'POST',
                        headers:{ 'Content-Type':'application/json', 'X-CSRF-TOKEN': window.csrf(), 'Accept':'application/json' },
                        body: JSON.stringify(this.form),
                    });
                    const data = await res.json();
                    if (!res.ok) throw new Error('Gagal mengirim ucapan.');
                    this.wishes.unshift(data.wish);
                    this.form.message = '';
                } catch (e) { this.error = e.message; }
                finally { this.loading = false; }
            },
        }
    }
</script>
