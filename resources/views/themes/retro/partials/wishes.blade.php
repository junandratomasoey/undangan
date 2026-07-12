<section class="px-6 py-24"
         x-data="wishBook('{{ route('invitation.wishes', $inv) }}', {{ Illuminate\Support\Js::from($inv->wishes->map(fn($w)=>['name'=>$w->name,'message'=>$w->message,'ago'=>$w->created_at->diffForHumans()])) }})">
    <div class="mx-auto max-w-md">
        <header class="reveal text-center">
            <svg class="mx-auto h-4 w-24 text-olive" aria-hidden="true"><use href="#wavy"/></svg>
            <h2 class="mt-4 font-display text-5xl uppercase text-cocoa">Ucapan</h2>
        </header>
        <form class="reveal mt-8 space-y-3" @submit.prevent="submit">
            <input x-model="form.name" type="text" placeholder="Nama" required
                   class="w-full rounded-2xl border-2 border-cocoa bg-cream-warm px-4 py-3 font-sans text-sm outline-none focus:border-rust focus:ring-0">
            <textarea x-model="form.message" rows="3" placeholder="Tulis ucapan &amp; doa…" required
                      class="w-full rounded-2xl border-2 border-cocoa bg-cream-warm px-4 py-3 font-sans text-sm outline-none focus:border-rust focus:ring-0"></textarea>
            <p x-show="error" x-cloak x-text="error" class="font-sans text-sm text-red-700"></p>
            <button type="submit" :disabled="loading"
                    class="w-full rounded-full bg-cocoa py-3.5 font-sans text-sm font-bold uppercase tracking-[0.12em] text-cream transition hover:bg-rust disabled:opacity-60">
                <span x-show="!loading">Kirim Ucapan</span>
                <span x-show="loading" x-cloak>Mengirim…</span>
            </button>
        </form>
        <div class="mt-10 max-h-96 space-y-3 overflow-y-auto pr-1">
            <template x-for="(w, i) in wishes" :key="i">
                <div class="rounded-2xl border-2 border-cocoa/30 bg-cream-warm p-4">
                    <div class="flex items-baseline justify-between gap-3">
                        <p class="font-display text-xl uppercase text-cocoa" x-text="w.name"></p>
                        <p class="font-sans text-[10px] text-cocoa/50" x-text="w.ago"></p>
                    </div>
                    <p class="mt-1 font-sans text-sm leading-relaxed text-cocoa/80" x-text="w.message"></p>
                </div>
            </template>
            <p x-show="!wishes.length" x-cloak class="text-center font-sans text-sm text-cocoa/50">Jadilah yang pertama mengirim ucapan</p>
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
