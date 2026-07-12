<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-6 w-28 text-emerald2/50" aria-hidden="true"><use href="#arabesque"/></svg>
            <h2 class="mt-4 font-display text-5xl text-emerald2-deep">Perjalanan Kami</h2>
        </header>
        <ol class="mt-12 space-y-10 border-l border-gold/40 pl-8">
            @foreach($inv->stories as $story)
                <li class="reveal relative">
                    <svg class="absolute -left-[29px] top-1 h-5 w-5 bg-ivory text-gold" aria-hidden="true"><use href="#khatam"/></svg>
                    @if($story->date_label)
                        <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-gold">{{ $story->date_label }}</p>
                    @endif
                    <h4 class="mt-1 font-display text-3xl text-emerald2-deep">{{ $story->title }}</h4>
                    <p class="mt-2 font-sans text-sm leading-relaxed text-ink/75">{{ $story->body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
