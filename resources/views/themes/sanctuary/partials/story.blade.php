<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-7 w-24 text-stone/60" aria-hidden="true"><use href="#olive"/></svg>
            <h2 class="mt-4 font-display text-5xl font-light text-stone-deep">Perjalanan Kami</h2>
        </header>
        <ol class="mt-12 space-y-10 border-l border-gilt/40 pl-8">
            @foreach($inv->stories as $story)
                <li class="reveal relative">
                    <svg class="absolute -left-[27px] top-1 h-5 w-3.5 bg-ivory text-gilt" aria-hidden="true"><use href="#cross"/></svg>
                    @if($story->date_label)
                        <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-gilt">{{ $story->date_label }}</p>
                    @endif
                    <h4 class="mt-1 font-display text-3xl font-light text-stone-deep">{{ $story->title }}</h4>
                    <p class="mt-2 font-sans text-sm leading-relaxed text-ink/75">{{ $story->body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
