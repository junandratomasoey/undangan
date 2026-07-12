@php $mainEvent = $inv->main_event; @endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-center overflow-hidden bg-paper px-8 text-ink"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    @if($inv->cover_photo)
        <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-10">
    @endif

    {{-- hairline frame, sangat tipis --}}
    <div class="pointer-events-none absolute inset-5 border border-line sm:inset-8"></div>

    <div class="relative z-10 w-full max-w-lg text-center">
        <p class="font-sans text-[10px] font-medium uppercase tracking-widest3 text-ink-soft">Undangan Pernikahan</p>

        <h1 class="mt-10 font-display text-7xl font-normal leading-[0.9] sm:text-8xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="my-2 block text-4xl italic text-accent sm:text-5xl">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h1>

        @if($mainEvent)
            <div class="mt-10 flex items-center justify-center gap-4">
                <span class="rule-accent"></span>
                <p class="font-sans text-sm font-medium tracking-[0.2em] text-ink">
                    {{ $mainEvent->starts_at->format('d.m.y') }}
                </p>
                <span class="rule-accent"></span>
            </div>
        @endif

        @if($guestName)
            <p class="mt-12 font-sans text-[10px] uppercase tracking-[0.3em] text-ink-soft">Kepada</p>
            <p class="mt-2 font-display text-3xl">{{ $guestName }}</p>
        @endif

        <button @click="open()"
                class="group mt-10 inline-flex items-center gap-2 border border-ink px-8 py-3 font-sans text-xs font-medium uppercase tracking-[0.2em] text-ink transition hover:bg-ink hover:text-paper">
            Buka Undangan
            <svg class="h-3.5 w-3.5 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
    </div>
</section>
