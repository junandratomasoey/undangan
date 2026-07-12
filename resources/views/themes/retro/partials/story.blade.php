<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-4 w-24 text-olive" aria-hidden="true"><use href="#wavy"/></svg>
            <h2 class="mt-4 font-display text-5xl uppercase text-cocoa">Kisah Kami</h2>
        </header>
        <div class="mt-12 space-y-6">
            @foreach($inv->stories as $story)
                <div class="reveal rounded-3xl border-2 border-cocoa bg-cream-warm p-6">
                    <div class="flex items-center gap-3">
                        <svg class="h-7 w-7 shrink-0 text-mustard-deep" aria-hidden="true"><use href="#daisy"/></svg>
                        <div>
                            @if($story->date_label)
                                <p class="font-sans text-[10px] font-bold uppercase tracking-[0.2em] text-rust">{{ $story->date_label }}</p>
                            @endif
                            <h4 class="font-display text-2xl uppercase text-cocoa">{{ $story->title }}</h4>
                        </div>
                    </div>
                    <p class="mt-3 font-sans text-sm leading-relaxed text-cocoa/80">{{ $story->body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
