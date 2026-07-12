<section class="border-t border-gold/15 bg-noir-panel px-6 py-24" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <div class="divider-gold mx-auto flex items-center justify-center gap-4"></div>
            <h2 class="mt-6 font-script gold-sheen text-6xl">Wedding Gift</h2>
            <p class="mx-auto mt-4 max-w-md font-sans text-sm leading-relaxed text-ivory/70">
                Doa restu Anda adalah hadiah terindah. Namun jika ingin memberi tanda kasih, kami sediakan kemudahan berikut.
            </p>
        </header>
        <div class="mt-10 space-y-4">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal border border-gold/30 bg-noir p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-script gold-sheen text-3xl">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 rounded bg-white object-contain p-2">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-script gold-sheen text-2xl">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-ivory/70">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-ivory/80">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-gold">{{ $gift->label }}</p>
                                <p class="mt-1 font-sans text-xl tracking-wide text-ivory">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-ivory/70">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 border border-gold/50 px-4 py-2 font-sans text-[10px] uppercase tracking-[0.15em] text-gold transition hover:bg-gold hover:text-noir-deep">
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
