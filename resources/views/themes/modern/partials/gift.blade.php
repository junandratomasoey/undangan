<section class="border-t border-line bg-paper-warm px-6 py-28" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Amplop Digital</p>
        <p class="reveal mx-auto mt-4 max-w-md text-center font-sans text-sm leading-relaxed text-ink-soft">
            Doa restu Anda adalah hadiah terindah. Namun jika ingin memberi tanda kasih, kami sediakan kemudahan berikut.
        </p>
        <div class="mt-12 space-y-3">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal border border-line bg-paper p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-display text-2xl">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 object-contain">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-display text-xl">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-ink-soft">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-ink-soft">{{ $gift->label }}</p>
                                <p class="mt-1 font-display text-2xl tracking-wide">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-ink-soft">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 border border-ink px-4 py-2 font-sans text-[10px] uppercase tracking-[0.15em] text-ink transition hover:bg-ink hover:text-paper">
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
