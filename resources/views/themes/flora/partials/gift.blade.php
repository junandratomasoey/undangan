<section class="px-6 py-24" x-data="{ copied:null }">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-8 w-28 text-sage" aria-hidden="true"><use href="#sprig"/></svg>
            <h2 class="mt-4 font-script text-5xl text-sage-dark">Tanda Kasih</h2>
            <p class="mx-auto mt-4 max-w-md font-sans text-sm leading-relaxed text-bark/70">
                Doa restu Anda adalah hadiah terindah. Namun jika ingin memberi tanda kasih, kami sediakan kemudahan berikut.
            </p>
        </header>
        <div class="mt-10 space-y-4">
            @foreach($inv->giftAccounts as $gift)
                <div class="reveal rounded-3xl border border-sage/25 bg-sage-pale/40 p-6">
                    @if($gift->kind === 'qris')
                        <p class="text-center font-script text-3xl text-sage-dark">{{ $gift->label }}</p>
                        @if($gift->qris_image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($gift->qris_image,'http') ? $gift->qris_image : \Storage::url($gift->qris_image) }}"
                                 alt="QRIS" class="mx-auto mt-4 h-56 w-56 rounded-2xl bg-white object-contain p-2">
                        @endif
                    @elseif($gift->kind === 'address')
                        <p class="font-script text-2xl text-sage-dark">{{ $gift->label }}</p>
                        <p class="mt-1 font-sans text-sm text-bark/70">{{ $gift->account_name }}</p>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-bark/80">{{ $gift->note }}</p>
                    @else
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-sage-deep">{{ $gift->label }}</p>
                                <p class="mt-1 font-sans text-xl font-medium tracking-wide text-sage-dark">{{ $gift->account_number }}</p>
                                <p class="font-sans text-sm text-bark/70">a.n. {{ $gift->account_name }}</p>
                            </div>
                            <button @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied='{{ $gift->id }}'; setTimeout(()=>copied=null,1800)"
                                    class="shrink-0 rounded-full border border-sage-deep/50 px-4 py-2 font-sans text-[10px] uppercase tracking-[0.12em] text-sage-deep transition hover:bg-sage-deep hover:text-ivory">
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
