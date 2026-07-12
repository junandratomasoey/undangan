<section class="px-6 py-24">
    <div class="mx-auto max-w-xl">
        <header class="reveal text-center">
            <svg class="mx-auto h-8 w-28 text-sage" aria-hidden="true"><use href="#sprig"/></svg>
            <h2 class="mt-4 font-script text-5xl text-sage-dark">Kisah Kami</h2>
        </header>
        <ol class="mt-12 space-y-10 border-l-2 border-sage/30 pl-8">
            @foreach($inv->stories as $story)
                <li class="reveal relative">
                    <svg class="absolute -left-[41px] top-0 h-5 w-5 text-blush" aria-hidden="true"><use href="#bloom"/></svg>
                    @if($story->date_label)
                        <p class="font-sans text-[10px] uppercase tracking-[0.2em] text-sage-deep">{{ $story->date_label }}</p>
                    @endif
                    <h4 class="mt-1 font-script text-3xl text-sage-dark">{{ $story->title }}</h4>
                    <p class="mt-2 font-sans text-sm leading-relaxed text-bark/75">{{ $story->body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
