<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <p class="font-sans text-xs uppercase tracking-[0.25em] text-sage">Perjalanan Kami</p>
            <h2 class="mt-2 font-display text-4xl text-forest">Love Story</h2>
        </header>
        <ol class="mt-12 space-y-10 border-l border-accent/30 pl-8">
            @foreach($inv->stories as $story)
                <li class="reveal relative">
                    <span class="absolute -left-[37px] top-1 grid h-4 w-4 place-items-center rounded-full bg-accent ring-4 ring-ivory"></span>
                    @if($story->date_label)
                        <p class="font-sans text-xs uppercase tracking-[0.2em] text-sage">{{ $story->date_label }}</p>
                    @endif
                    <h4 class="mt-1 font-display text-2xl text-forest">{{ $story->title }}</h4>
                    <p class="mt-2 font-sans text-sm leading-relaxed text-forest-ink/75">{{ $story->body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
