@php $mainEvent = $inv->main_event; @endphp

<section class="fixed inset-0 z-40 flex flex-col items-center justify-center overflow-hidden bg-ivory px-8 text-bark"
         :class="opened ? 'pointer-events-none' : ''"
         x-transition:leave="transition duration-1000 ease-in-out"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-6"
         x-show="!opened" x-cloak>

    @if($inv->cover_photo)
        <img src="{{ \Illuminate\Support\Str::startsWith($inv->cover_photo,'http') ? $inv->cover_photo : \Storage::url($inv->cover_photo) }}"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-15">
    @endif

    {{-- ranting di sudut: kiri-atas & kanan-bawah (asimetris, lebih hidup) --}}
    <svg class="pointer-events-none absolute -left-4 -top-6 h-44 w-20 rotate-12 text-sage" aria-hidden="true"><use href="#branch"/></svg>
    <svg class="pointer-events-none absolute -right-4 -bottom-6 h-44 w-20 rotate-[190deg] text-sage" aria-hidden="true"><use href="#branch"/></svg>
    <svg class="pointer-events-none absolute right-6 top-10 h-10 w-10 text-blush" aria-hidden="true"><use href="#bloom"/></svg>
    <svg class="pointer-events-none absolute bottom-12 left-8 h-8 w-8 text-blush/70" aria-hidden="true"><use href="#bloom"/></svg>

    <div class="relative z-10 w-full max-w-md text-center">
        <p class="font-sans text-[10px] uppercase tracking-widest2 text-sage-deep">Undangan Pernikahan</p>

        <svg class="mx-auto mt-6 h-8 w-28 text-sage" aria-hidden="true"><use href="#sprig"/></svg>

        <h1 class="mt-6 font-script text-6xl leading-tight text-sage-dark sm:text-7xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
        </h1>
        <span class="my-1 block font-script text-4xl text-blush">&amp;</span>
        <h1 class="font-script text-6xl leading-tight text-sage-dark sm:text-7xl">
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h1>

        @if($mainEvent)
            <p class="mt-8 font-sans text-sm tracking-[0.15em] text-bark/75">
                {{ $mainEvent->starts_at->translatedFormat('d F Y') }}
            </p>
        @endif

        @if($guestName)
            <div class="mt-10 rounded-2xl bg-sage-pale/60 px-6 py-4">
                <p class="font-sans text-[10px] uppercase tracking-[0.25em] text-sage-deep">Kepada Yth.</p>
                <p class="mt-1 font-script text-2xl text-sage-dark">{{ $guestName }}</p>
            </div>
        @endif

        <button @click="open()"
                class="group mt-8 inline-flex items-center gap-2 rounded-full bg-sage-deep px-8 py-3 font-sans text-sm font-medium text-ivory shadow-sm transition hover:bg-sage-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sage">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            Buka Undangan
        </button>
    </div>
</section>
