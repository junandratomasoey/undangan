@php $mainEvent = $inv->main_event; @endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-center overflow-hidden bg-stone-dark px-6 text-ivory"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    {{-- cahaya lembut dari atas, seperti kaca patri --}}
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(90% 55% at 50% -5%, rgba(183,148,87,.25), transparent 60%),
            radial-gradient(80% 50% at 50% 108%, rgba(217,224,229,.08), transparent 60%);"></div>

    {{-- JENDELA GOTIK: bentuk signature --}}
    <div class="gothic relative z-10 w-full max-w-[19rem] overflow-hidden border border-gilt/40 bg-stone-deep/60 px-8 pb-9 pt-16 text-center backdrop-blur-sm">
        @if($inv->cover_photo)
            <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
                 alt="" class="absolute inset-0 h-full w-full object-cover opacity-20">
        @endif

        <div class="relative">
            <svg class="mx-auto h-9 w-6 text-gilt" aria-hidden="true"><use href="#cross"/></svg>

            <p class="mt-6 font-sans text-[10px] uppercase tracking-widest2 text-ivory/60">Pemberkatan Nikah</p>

            <h1 class="mt-5 font-display text-5xl font-light leading-tight sm:text-6xl">
                {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
                <span class="my-1 block text-3xl italic text-gilt">&amp;</span>
                {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
            </h1>

            <div class="rule-gilt mt-6 flex items-center justify-center gap-3">
                <svg class="h-4 w-6 text-gilt" aria-hidden="true"><use href="#dove"/></svg>
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
                class="mt-5 w-full rounded-full border border-gilt bg-gilt/10 px-8 py-3 font-sans text-xs uppercase tracking-[0.18em] text-gilt transition hover:bg-gilt hover:text-stone-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gilt">
            Buka Undangan
        </button>
    </div>
</section>
