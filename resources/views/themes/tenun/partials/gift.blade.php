<section class="px-6 py-24" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <div class="mx-auto mb-6 w-40 text-maroon"><div class="tenun-band tenun-band--thin"></div></div>
            <h2 class="font-display text-4xl text-maroon">Amplop Digital</h2>
            <p class="mt-3 font-sans text-sm leading-relaxed text-ink/70">
                Doa restu Anda adalah hadiah terindah. Namun jika ingin memberi tanda kasih,
                kami sediakan kemudahan berikut.
            </p>
        </header>
        <div class="mt-10 space-y-4">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal border-2 border-ochre/30 bg-cream-soft p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-display text-2xl text-maroon">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 object-contain">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-display text-xl text-maroon">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-ink/70">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-ink/80">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-xs uppercase tracking-[0.2em] text-ink/50">{{ $gift->label }}</p>
                                <p class="mt-1 font-display text-2xl tracking-wide text-maroon">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-ink/70">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 rounded-sm border border-maroon/40 px-4 py-2 font-sans text-xs uppercase tracking-[0.15em] text-maroon transition hover:bg-maroon hover:text-cream">
                                <span x-show="copied !== '{{ $gift->id }}'">Salin</span>
                                <span x-show="copied === '{{ $gift->id }}'" x-cloak>Tersalin</span>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
