<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <p class="font-sans text-[10px] uppercase tracking-widest3 text-ivory-muted">Perjalanan Kami</p>
            <h2 class="mt-2 font-script gold-sheen text-6xl">Our Story</h2>
        </header>
        <ol class="mt-12 space-y-10 border-l border-gold/30 pl-8">
            @foreach($inv->stories as $story)
                <li class="reveal relative">
                    <span class="absolute -left-[37px] top-1 grid h-4 w-4 place-items-center rounded-full bg-gold ring-4 ring-noir"></span>
                    @if($story->date_label)
                        <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-gold">{{ $story->date_label }}</p>
                    @endif
                    <h4 class="mt-1 font-script gold-sheen text-4xl">{{ $story->title }}</h4>
                    <p class="mt-2 font-sans text-sm leading-relaxed text-ivory/75">{{ $story->body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
