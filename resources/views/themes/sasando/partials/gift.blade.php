<section class="px-6 py-24" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <div class="divider-leaf mx-auto flex items-center justify-center gap-4"></div>
            <h2 class="mt-6 font-display text-4xl text-forest">Amplop Digital</h2>
            <p class="mt-3 font-sans text-sm leading-relaxed text-forest-ink/70">
                Doa restu Anda adalah hadiah terindah. Namun jika ingin memberi tanda kasih,
                kami sediakan kemudahan berikut.
            </p>
        </header>

        <div class="mt-10 space-y-4">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal rounded-sm border border-accent/30 bg-white/60 p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-display text-2xl text-forest">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 rounded-sm object-contain">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-display text-xl text-forest">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-forest-ink/70">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-forest-ink/80">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-xs uppercase tracking-[0.2em] text-sage">{{ $gift->label }}</p>
                                <p class="mt-1 font-display text-2xl tracking-wide text-forest">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-forest-ink/70">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 rounded-full border border-forest/30 px-4 py-2 font-sans text-xs uppercase tracking-[0.15em] text-forest transition hover:bg-forest hover:text-ivory">
                                <span x-show="copied !== '{{ $gift->id }}'">Salin</span>
                                <span x-show="copied === '{{ $gift->id }}'" x-cloak>Tersalin ✓</span>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
