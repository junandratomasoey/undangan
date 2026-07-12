<section class="px-6 py-24" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-12 w-20 text-mustard-deep" aria-hidden="true"><use href="#sunburst"/></svg>
            <h2 class="mt-4 font-display text-5xl uppercase text-cocoa">Tanda Kasih</h2>
            <p class="mx-auto mt-4 max-w-md font-sans text-sm leading-relaxed text-cocoa/75">
                Doa restu Anda adalah hadiah terindah. Namun jika ingin memberi tanda kasih, kami sediakan kemudahan berikut.
            </p>
        </header>
        <div class="mt-10 space-y-4">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal rounded-3xl border-2 border-cocoa bg-cream-warm p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-display text-2xl uppercase text-cocoa">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 rounded-2xl bg-white object-contain p-2">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-display text-xl uppercase text-cocoa">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-cocoa/70">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-cocoa/85">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-[10px] font-bold uppercase tracking-[0.2em] text-rust">{{ $gift->label }}</p>
                                <p class="mt-1 font-display text-2xl text-cocoa">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-cocoa/70">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 rounded-full bg-cocoa px-4 py-2 font-sans text-[10px] font-bold uppercase tracking-[0.12em] text-cream transition hover:bg-rust">
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
