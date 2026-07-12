<section class="bg-cocoa px-6 py-24 text-cream">
    <header class="reveal text-center">
        <svg class="mx-auto h-12 w-20 text-mustard" aria-hidden="true"><use href="#sunburst"/></svg>
        <h2 class="mt-4 font-display text-5xl uppercase">Acara</h2>
    </header>
    <div class="mx-auto mt-14 grid max-w-3xl gap-8 sm:grid-cols-{{ min($inv->events->count(), 2) }}">
        @foreach($inv->events as $event)
            <article class="reveal arch overflow-hidden bg-cream px-7 pb-8 pt-12 text-center text-cocoa">
                <h3 class="font-display text-3xl uppercase">{{ $event->title }}</h3>
                <svg class="mx-auto my-4 h-4 w-20 text-rust" aria-hidden="true"><use href="#wavy"/></svg>
                <p class="font-sans text-sm font-bold tracking-wide">{{ strtoupper($event->starts_at->translatedFormat('l, d M Y')) }}</p>
                <p class="mt-1 font-sans text-sm text-cocoa/75">
                    {{ $event->starts_at->format('H.i') }}@if($event->ends_at) &ndash; {{ $event->ends_at->format('H.i') }} @endif WITA
                </p>
                <p class="mt-5 font-display text-2xl">{{ $event->venue_name }}</p>
                @if($event->address)
                    <p class="mt-1 font-sans text-sm leading-relaxed text-cocoa/70">{{ $event->address }}</p>
                @endif
                @if($inv->hasFeature('maps_link') && ($event->maps_url || $event->hasCoordinates()))
                    <a href="{{ $event->maps_url ?: 'https://www.google.com/maps/search/?api=1&query='.$event->lat.','.$event->lng }}"
                       target="_blank" rel="noopener"
                       class="mt-6 inline-block rounded-full bg-cocoa px-6 py-2.5 font-sans text-xs font-bold uppercase tracking-[0.12em] text-cream transition hover:bg-rust">
                        Lihat Peta
                    </a>
                @endif
            </article>
        @endforeach
    </div>
</section>
