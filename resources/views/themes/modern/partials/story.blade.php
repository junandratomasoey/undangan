<section class="px-6 py-28">
    <div class="mx-auto max-w-xl">
        <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Perjalanan</p>
        <div class="mt-14 space-y-14">
            @foreach($inv->stories as $story)
                <div class="reveal grid gap-2 sm:grid-cols-[100px_1fr] sm:gap-8">
                    <div class="font-sans text-xs uppercase tracking-[0.15em] text-accent">{{ $story->date_label }}</div>
                    <div>
                        <h4 class="font-display text-3xl leading-tight">{{ $story->title }}</h4>
                        <p class="mt-2 font-sans text-sm leading-relaxed text-ink-soft">{{ $story->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
