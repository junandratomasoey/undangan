@php
    $mainEvent = $inv->main_event;
@endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-between overflow-hidden bg-forest-deep text-ivory"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    {{-- ambient background: soft radial + faint botanical stroke --}}
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(120% 80% at 50% -10%, rgba(200,160,75,.18), transparent 55%),
            radial-gradient(100% 60% at 50% 110%, rgba(157,176,163,.14), transparent 55%);"></div>

    @if($inv->cover_photo)
        <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-25">
    @endif

    {{-- thin gold frame --}}
    <div class="pointer-events-none absolute inset-4 rounded-[2px] border border-accent/40 sm:inset-6"></div>

    <div class="relative z-10 flex w-full max-w-md flex-1 flex-col items-center justify-center px-8 text-center">
        <p class="font-sans text-[11px] uppercase tracking-widest2 text-sage">The Wedding Of</p>

        <h1 class="mt-6 font-display text-6xl leading-[0.95] sm:text-7xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="my-1 block text-3xl italic text-accent sm:text-4xl">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h1>

        @if($mainEvent)
            <p class="mt-6 font-sans text-sm tracking-wide text-ivory/80">
                {{ $mainEvent->starts_at->translatedFormat('l, d F Y') }}
            </p>
        @endif
    </div>

    {{-- guest personalization + open button --}}
    <div class="relative z-10 w-full max-w-md px-8 pb-12 text-center">
        @if($guestName)
            <p class="font-sans text-xs uppercase tracking-[0.2em] text-sage">Kepada Yth.</p>
            <p class="mt-1 font-display text-2xl text-ivory">{{ $guestName }}</p>
        @endif

        <button @click="open()"
                class="group mt-6 inline-flex items-center gap-2 rounded-full bg-accent px-7 py-3 font-sans text-sm font-medium text-forest-deep shadow-lg transition hover:brightness-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            Buka Undangan
        </button>
    </div>
</section>
