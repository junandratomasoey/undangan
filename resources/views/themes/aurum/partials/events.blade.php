<section class="border-t border-gold/15 bg-noir-panel px-6 py-24">
    <header class="reveal text-center">
        <div class="divider-gold mx-auto flex items-center justify-center gap-4"></div>
        <h2 class="mt-6 font-script gold-sheen text-6xl">Save The Date</h2>
    </header>
    <div class="mx-auto mt-14 grid max-w-3xl gap-8 sm:grid-cols-{{ min($inv->events->count(), 2) }}">
        @foreach($inv->events as $event)
            <article class="reveal border border-gold/25 bg-noir p-10 text-center">
                <h3 class="font-script gold-sheen text-4xl">{{ $event->title }}</h3>
                <div class="divider-gold mx-auto my-5 flex items-center justify-center gap-3"></div>
                <p class="font-sans text-sm font-medium tracking-wide text-ivory">{{ $event->starts_at->translatedFormat('l, d F Y') }}</p>
                <p class="mt-1 font-sans text-sm text-ivory/70">
                    {{ $event->starts_at->format('H.i') }}@if($event->ends_at) &ndash; {{ $event->ends_at->format('H.i') }} @endif WITA
                </p>
                <p class="mt-5 font-sans text-lg text-gold-light">{{ $event->venue_name }}</p>
                @if($event->address)
                    <p class="mt-1 font-sans text-sm leading-relaxed text-ivory/65">{{ $event->address }}</p>
                @endif
                @if($inv->hasFeature('maps_link') && ($event->maps_url || $event->hasCoordinates()))
                    <a href="{{ $event->maps_url ?: 'https://www.google.com/maps/search/?api=1&query='.$event->lat.','.$event->lng }}"
                       target="_blank" rel="noopener"
                       class="mt-6 inline-flex items-center gap-2 border border-gold/50 px-5 py-2 font-sans text-[10px] uppercase tracking-[0.15em] text-gold transition hover:bg-gold hover:text-noir-deep">
                        Lihat Peta
                    </a>
                @endif
            </article>
        @endforeach
    </div>
</section>
