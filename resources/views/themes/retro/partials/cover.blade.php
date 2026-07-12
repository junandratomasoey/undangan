@php $mainEvent = $inv->main_event; @endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-center overflow-hidden bg-cocoa-deep px-6 text-cream"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    {{-- daisy melayang di sudut --}}
    <svg class="pointer-events-none absolute left-6 top-8 h-10 w-10 text-mustard/70" aria-hidden="true"><use href="#daisy"/></svg>
    <svg class="pointer-events-none absolute right-8 bottom-10 h-8 w-8 text-rust/80" aria-hidden="true"><use href="#daisy"/></svg>

    {{-- ARCH: bentuk signature 70-an --}}
    <div class="arch relative z-10 w-full max-w-[19rem] overflow-hidden bg-cream px-7 pb-8 pt-14 text-center text-cocoa shadow-2xl">
        @if($inv->cover_photo)
            <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
                 alt="" class="absolute inset-0 h-full w-full object-cover opacity-20">
        @endif

        <div class="relative">
            <svg class="mx-auto h-12 w-20 text-mustard" aria-hidden="true"><use href="#sunburst"/></svg>

            <p class="mt-5 font-sans text-[10px] font-bold uppercase tracking-widest2 text-rust">Kita Menikah</p>

            <h1 class="mt-4 font-display text-5xl uppercase leading-[0.95] text-cocoa">
                {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
                <span class="my-1 block text-3xl text-rust">&amp;</span>
                {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
            </h1>

            <svg class="mx-auto mt-5 h-4 w-24 text-olive" aria-hidden="true"><use href="#wavy"/></svg>

            @if($mainEvent)
                <p class="mt-4 font-sans text-sm font-bold tracking-[0.15em] text-cocoa">
                    {{ strtoupper($mainEvent->starts_at->translatedFormat('d M Y')) }}
                </p>
            @endif
        </div>
    </div>

    {{-- Tamu + tombol, di luar arch --}}
    <div class="relative z-10 mt-7 w-full max-w-[19rem] text-center">
        @if($guestName)
            <p class="font-sans text-[10px] font-bold uppercase tracking-[0.25em] text-mustard">Kepada</p>
            <p class="mt-1 font-display text-2xl text-cream">{{ $guestName }}</p>
        @endif

        <button @click="open()"
                class="mt-5 w-full rounded-full bg-mustard px-8 py-3.5 font-sans text-sm font-bold uppercase tracking-[0.12em] text-cocoa-deep shadow-lg transition hover:bg-rust hover:text-cream focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mustard">
            Buka Undangan
        </button>
    </div>
</section>
