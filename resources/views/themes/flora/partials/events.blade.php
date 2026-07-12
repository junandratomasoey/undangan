<section class="bg-ivory-warm px-6 py-24">
    <header class="reveal text-center">
        <svg class="mx-auto h-9 w-32 text-sage" aria-hidden="true"><use href="#sprig"/></svg>
        <h2 class="mt-4 font-script text-5xl text-sage-dark">Rangkaian Acara</h2>
    </header>
    <div class="mx-auto mt-14 grid max-w-3xl gap-8 sm:grid-cols-{{ min($inv->events->count(), 2) }}">
        @foreach($inv->events as $event)
            <article class="reveal rounded-3xl border border-sage/25 bg-ivory p-8 text-center shadow-sm">
                <h3 class="font-script text-4xl text-sage-dark">{{ $event->title }}</h3>
                <svg class="mx-auto my-4 h-6 w-20 text-sage/70" aria-hidden="true"><use href="#sprig"/></svg>
                <p class="font-sans text-sm font-medium tracking-wide text-bark">{{ $event->starts_at->translatedFormat('l, d F Y') }}</p>
                <p class="mt-1 font-sans text-sm text-bark/70">
                    {{ $event->starts_at->format('H.i') }}@if($event->ends_at) &ndash; {{ $event->ends_at->format('H.i') }} @endif WITA
                </p>
                <p class="mt-5 font-sans text-lg font-medium text-sage-deep">{{ $event->venue_name }}</p>
                @if($event->address)
                    <p class="mt-1 font-sans text-sm leading-relaxed text-bark/65">{{ $event->address }}</p>
                @endif
                @if($inv->hasFeature('maps_link') && ($event->maps_url || $event->hasCoordinates()))
                    <a href="{{ $event->maps_url ?: 'https://www.google.com/maps/search/?api=1&query='.$event->lat.','.$event->lng }}"
                       target="_blank" rel="noopener"
                       class="mt-6 inline-flex items-center gap-2 rounded-full border border-sage-deep/50 px-5 py-2 font-sans text-xs uppercase tracking-[0.12em] text-sage-deep transition hover:bg-sage-deep hover:text-ivory">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s-7-6.3-7-11a7 7 0 0 1 14 0c0 4.7-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        Lihat Peta
                    </a>
                @endif
            </article>
        @endforeach
    </div>
</section>
