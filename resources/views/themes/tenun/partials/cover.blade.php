@php $mainEvent = $inv->main_event; @endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-between overflow-hidden bg-maroon-deep text-cream"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(120% 70% at 50% -10%, rgba(198,137,44,.22), transparent 55%),
            radial-gradient(100% 60% at 50% 110%, rgba(30,42,68,.5), transparent 60%);"></div>

    @if($inv->cover_photo)
        <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-20">
    @endif

    {{-- ikat band: pembingkai atas & bawah (signature tema) --}}
    <div class="relative z-10 w-full pt-6 text-ochre"><div class="tenun-band"></div></div>

    <div class="relative z-10 flex w-full max-w-md flex-1 flex-col items-center justify-center px-8 text-center">
        <p class="font-sans text-[11px] uppercase tracking-widest2 text-cream/70">Undangan Pernikahan</p>

        <h1 class="mt-6 font-display text-6xl leading-[0.95] sm:text-7xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="my-1 block text-3xl italic text-ochre sm:text-4xl">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h1>

        @if($mainEvent)
            <p class="mt-6 font-sans text-sm tracking-wide text-cream/80">
                {{ $mainEvent->starts_at->translatedFormat('l, d F Y') }}
            </p>
        @endif
    </div>

    <div class="relative z-10 w-full max-w-md px-8 text-center">
        @if($guestName)
            <p class="font-sans text-xs uppercase tracking-[0.2em] text-cream/60">Kepada Yth.</p>
            <p class="mt-1 font-display text-2xl text-cream">{{ $guestName }}</p>
        @endif

        <button @click="open()"
                class="mt-6 inline-flex items-center gap-2 rounded-sm bg-ochre px-7 py-3 font-sans text-sm font-medium text-maroon-deep shadow-lg transition hover:brightness-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ochre">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            Buka Undangan
        </button>
    </div>

    <div class="relative z-10 w-full pb-6 text-ochre"><div class="tenun-band"></div></div>
</section>
