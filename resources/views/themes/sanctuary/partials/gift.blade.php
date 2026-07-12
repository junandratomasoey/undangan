<section class="px-6 py-24" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-7 w-24 text-stone/60" aria-hidden="true"><use href="#olive"/></svg>
            <h2 class="mt-4 font-display text-5xl font-light text-stone-deep">Tanda Kasih</h2>
            <p class="mx-auto mt-4 max-w-md font-sans text-sm leading-relaxed text-ink/70">
                Doa restu Anda adalah berkat terindah. Namun jika ingin memberi tanda kasih, kami sediakan kemudahan berikut.
            </p>
        </header>
        <div class="mt-10 space-y-4">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal border border-stone/25 bg-ivory-warm p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-display text-2xl font-light text-stone-deep">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 bg-white object-contain p-2">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-display text-xl font-light text-stone-deep">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-ink/70">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-ink/85">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-gilt">{{ $gift->label }}</p>
                                <p class="mt-1 font-display text-2xl font-light tracking-wide text-stone-deep">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-ink/70">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 rounded-full border border-stone/40 px-4 py-2 font-sans text-[10px] uppercase tracking-[0.12em] text-stone-deep transition hover:bg-stone-deep hover:text-ivory">
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
