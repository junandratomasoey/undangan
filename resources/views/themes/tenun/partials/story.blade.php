<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <p class="font-sans text-xs uppercase tracking-[0.25em] text-ink/50">Perjalanan Kami</p>
            <h2 class="mt-2 font-display text-4xl text-maroon">Kisah Kami</h2>
        </header>
        <ol class="mt-12 space-y-10 border-l-2 border-ochre/40 pl-8">
            @foreach($inv->stories as $story)
                <li class="reveal relative">
                    <span class="absolute -left-[41px] top-1 h-4 w-4 rotate-45 bg-ochre ring-4 ring-cream"></span>
                    @if($story->date_label)
                        <p class="font-sans text-xs uppercase tracking-[0.2em] text-ink/40">{{ $story->date_label }}</p>
                    @endif
                    <h4 class="mt-1 font-display text-2xl text-maroon">{{ $story->title }}</h4>
                    <p class="mt-2 font-sans text-sm leading-relaxed text-ink/75">{{ $story->body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
