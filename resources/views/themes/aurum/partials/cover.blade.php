@php $mainEvent = $inv->main_event; @endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-between overflow-hidden bg-noir-deep px-8 text-ivory"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(120% 75% at 50% -10%, rgba(212,175,55,.22), transparent 55%),
            radial-gradient(90% 60% at 50% 115%, rgba(184,134,11,.14), transparent 60%);"></div>

    @if($inv->cover_photo)
        <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-25">
    @endif

    {{-- bingkai emas tipis --}}
    <div class="pointer-events-none absolute inset-4 border border-gold/40 sm:inset-6"></div>

    <div class="relative z-10 flex w-full max-w-md flex-1 flex-col items-center justify-center text-center">
        <p class="font-sans text-[10px] uppercase tracking-widest3 text-ivory-muted">The Wedding Of</p>

        <h1 class="mt-8 font-script gold-sheen text-7xl leading-[0.85] sm:text-8xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
        </h1>
        <span class="my-2 font-script gold-sheen text-4xl">&amp;</span>
        <h1 class="font-script gold-sheen text-7xl leading-[0.85] sm:text-8xl">
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h1>

        @if($mainEvent)
            <div class="mt-9 flex items-center justify-center gap-4 divider-gold">
                <p class="font-sans text-sm tracking-[0.15em] text-ivory/85">
                    {{ $mainEvent->starts_at->translatedFormat('d F Y') }}
                </p>
            </div>
        @endif
    </div>

    <div class="relative z-10 w-full max-w-md pb-12 text-center">
        @if($guestName)
            <p class="font-sans text-[10px] uppercase tracking-[0.25em] text-ivory-muted">Kepada Yth.</p>
            <p class="mt-1 font-script gold-sheen text-3xl">{{ $guestName }}</p>
        @endif

        <button @click="open()"
                class="group mt-7 inline-flex items-center gap-2 border border-gold px-8 py-3 font-sans text-xs uppercase tracking-[0.2em] text-gold transition hover:bg-gold hover:text-noir-deep">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="5" width="18" height="14" rx="1"/><path d="m3 7 9 6 9-6"/></svg>
            Buka Undangan
        </button>
    </div>
</section>
