<section class="border-t border-line bg-paper-warm px-6 py-28">
    <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Acara</p>
    <div class="mx-auto mt-14 grid max-w-3xl gap-6 sm:grid-cols-{{ min($inv->events->count(), 2) }}">
        @foreach($inv->events as $event)
            <article class="reveal border border-ink/15 bg-paper p-10 text-center">
                <h3 class="font-display text-4xl">{{ $event->title }}</h3>
                <span class="mx-auto my-6 block h-px w-10 bg-accent"></span>
                <p class="font-sans text-sm font-medium tracking-wide text-ink">{{ $event->starts_at->translatedFormat('l, d F Y') }}</p>
                <p class="mt-1 font-sans text-sm text-ink-soft">
                    {{ $event->starts_at->format('H.i') }}@if($event->ends_at) &ndash; {{ $event->ends_at->format('H.i') }} @endif WITA
                </p>
                <p class="mt-6 font-display text-2xl">{{ $event->venue_name }}</p>
                @if($event->address)
                    <p class="mt-1 font-sans text-sm leading-relaxed text-ink-soft">{{ $event->address }}</p>
                @endif
                @if($inv->hasFeature('maps_link') && ($event->maps_url || $event->hasCoordinates()))
                    <a href="{{ $event->maps_url ?: 'https://www.google.com/maps/search/?api=1&query='.$event->lat.','.$event->lng }}"
                       target="_blank" rel="noopener"
                       class="mt-7 inline-flex items-center gap-2 border-b border-ink pb-0.5 font-sans text-xs uppercase tracking-[0.15em] text-ink transition hover:text-accent hover:border-accent">
                        Lihat Peta
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>
                @endif
            </article>
        @endforeach
    </div>
</section>
