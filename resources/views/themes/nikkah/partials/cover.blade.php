@php
    $mainEvent = $inv->main_event;
    $extra = $inv->data_tambahan ?? [];
    // Bismillah bisa dimatikan lewat data_tambahan['tampil_bismillah'] = false
    $tampilBismillah = $extra['tampil_bismillah'] ?? true;
@endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-center overflow-hidden bg-emerald2-dark px-6 text-ivory"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(95% 55% at 50% -5%, rgba(192,160,83,.22), transparent 60%),
            radial-gradient(80% 50% at 50% 108%, rgba(214,227,220,.07), transparent 60%);"></div>

    {{-- pita girih atas & bawah --}}
    <div class="absolute inset-x-0 top-0 text-gold/50"><div class="girih-band girih-band--thin"></div></div>
    <div class="absolute inset-x-0 bottom-0 text-gold/50"><div class="girih-band girih-band--thin"></div></div>

    {{-- MIHRAB: bentuk signature --}}
    <div class="mihrab relative z-10 w-full max-w-[19rem] overflow-hidden border border-gold/45 bg-emerald2-deep/60 px-8 pb-9 pt-16 text-center backdrop-blur-sm">
        <div class="relative">
            <svg class="mx-auto h-10 w-9 text-gold" aria-hidden="true"><use href="#dome"/></svg>

            @if($tampilBismillah)
                <p class="mt-5 font-display text-2xl text-gold-soft" dir="rtl" lang="ar">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            @endif

            <p class="mt-4 font-sans text-[10px] uppercase tracking-widest2 text-ivory/60">Walimatul 'Urs</p>

            <h1 class="mt-4 font-display text-5xl leading-tight sm:text-6xl">
                {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
                <span class="my-1 block text-3xl text-gold">&amp;</span>
                {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
            </h1>

            <div class="rule-gold mt-6 flex items-center justify-center gap-3">
                <svg class="h-5 w-5 text-gold" aria-hidden="true"><use href="#khatam"/></svg>
            </div>

            @if($mainEvent)
                <p class="mt-5 font-sans text-sm tracking-[0.12em] text-ivory/80">
                    {{ $mainEvent->starts_at->translatedFormat('d F Y') }}
                </p>
            @endif
        </div>
    </div>

    <div class="relative z-10 mt-8 w-full max-w-[19rem] text-center">
        @if($guestName)
            <p class="font-sans text-[10px] uppercase tracking-[0.25em] text-ivory/55">Kepada Yth.</p>
            <p class="mt-1 font-display text-2xl">{{ $guestName }}</p>
        @endif

        <button @click="open()"
                class="mt-5 w-full rounded-full border border-gold bg-gold/10 px-8 py-3 font-sans text-xs uppercase tracking-[0.18em] text-gold transition hover:bg-gold hover:text-emerald2-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold">
            Buka Undangan
        </button>
    </div>
</section>
