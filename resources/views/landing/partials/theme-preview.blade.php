{{--
    Preview mini per tema, dipakai di kartu etalase.
    Variabel: $key (theme key), $groom, $bride
--}}
@switch($key)

    @case('sanctuary')
        <div class="flex h-44 items-center justify-center bg-[#22303B]"
             style="background-image:radial-gradient(90% 60% at 50% 0%, rgba(183,148,87,.28), transparent 65%)">
            <div class="w-28 border border-[#B79457]/50 bg-[#33424F]/60 px-3 pb-4 pt-7 text-center"
                 style="border-radius:50% 50% 6px 6px / 42% 42% 4px 4px">
                <svg viewBox="0 0 24 36" class="mx-auto h-5 w-3.5 text-[#B79457]" fill="currentColor"><rect x="10.6" y="2" width="2.8" height="32" rx="1.4"/><rect x="3" y="11" width="18" height="2.8" rx="1.4"/></svg>
                <p class="mt-2 font-display text-lg font-light leading-tight text-[#FAF7F1]">{{ $groom }}<br><span class="text-sm italic text-[#B79457]">&amp;</span><br>{{ $bride }}</p>
            </div>
        </div>
        @break

    @case('nikkah')
        <div class="relative flex h-44 items-center justify-center bg-[#0C2419]"
             style="background-image:radial-gradient(95% 60% at 50% 0%, rgba(192,160,83,.26), transparent 65%)">
            <div class="w-28 border border-[#C0A053]/50 bg-[#123528]/60 px-3 pb-4 pt-7 text-center"
                 style="border-radius:50% 50% 8px 8px / 46% 46% 5px 5px">
                <svg viewBox="0 0 40 44" class="mx-auto h-6 w-5 text-[#C0A053]" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M20 6 C 30 12, 34 22, 34 34 L 6 34 C 6 22, 10 12, 20 6 Z"/><path d="M20 6 L20 2"/></svg>
                <p class="mt-2 font-display text-lg leading-tight text-[#FAF6EC]">{{ $groom }}<br><span class="text-sm text-[#C0A053]">&amp;</span><br>{{ $bride }}</p>
            </div>
        </div>
        @break

    @case('tenun')
        <div class="flex h-44 flex-col items-center justify-center bg-[#4E1D1D]">
            <span class="font-display text-2xl text-[#EFE6D2]">{{ $groom }} <span class="text-[#C6892C]">&amp;</span> {{ $bride }}</span>
            <div class="tenun-mask mt-3 h-3 w-28 text-[#C6892C]" style="background-color:currentColor"></div>
        </div>
        @break

    @case('flora')
        <div class="relative flex h-44 items-center justify-center overflow-hidden bg-[#FBF8F3]">
            <svg viewBox="0 0 60 140" class="absolute -left-2 -top-3 h-32 w-12 rotate-12 text-[#7C9082]" aria-hidden="true">
                <path d="M30 136 C 26 100, 32 60, 30 6" fill="none" stroke="currentColor" stroke-width="1.4"/>
                <ellipse cx="17" cy="112" rx="11" ry="6" fill="currentColor" opacity=".5" transform="rotate(-28 17 112)"/>
                <ellipse cx="44" cy="94" rx="11" ry="6" fill="currentColor" opacity=".6" transform="rotate(28 44 94)"/>
                <ellipse cx="16" cy="74" rx="12" ry="6.5" fill="currentColor" opacity=".45" transform="rotate(-30 16 74)"/>
                <ellipse cx="45" cy="54" rx="11" ry="6" fill="currentColor" opacity=".55" transform="rotate(30 45 54)"/>
            </svg>
            <p class="relative text-center font-display text-2xl leading-tight text-[#3A4A40]">{{ $groom }}<br><span class="text-lg text-[#C98B7E]">&amp;</span><br>{{ $bride }}</p>
        </div>
        @break

    @case('sasando')
        <div class="flex h-44 items-center justify-center bg-[#0F3D3A]">
            <span class="font-display text-2xl text-[#EFE7D6]">{{ $groom }} <span class="text-[#C8A04B]">&amp;</span> {{ $bride }}</span>
        </div>
        @break

    @case('aurum')
        <div class="flex h-44 items-center justify-center bg-[#0C0B0A]">
            <span class="gold-sheen font-display text-2xl">{{ $groom }} &amp; {{ $bride }}</span>
        </div>
        @break

    @case('modern')
        <div class="flex h-44 items-center justify-center border-b border-slate-100 bg-white">
            <p class="text-center font-display text-2xl leading-tight text-slate-900">{{ $groom }}<br><span class="text-lg text-[#B08D6A]">&amp;</span><br>{{ $bride }}</p>
        </div>
        @break

    @case('retro')
        <div class="flex h-44 items-center justify-center bg-[#33200F] px-6">
            <div class="w-full bg-[#F5E9D4] px-3 pb-3 pt-6 text-center" style="border-radius:999px 999px 10px 10px">
                <p class="font-display text-lg uppercase leading-none text-[#4A2C1D]">{{ $groom }} <span class="text-[#C1502E]">&amp;</span> {{ $bride }}</p>
                <p class="mt-1 text-[9px] font-bold uppercase tracking-widest text-[#C1502E]">12 Sep 2026</p>
            </div>
        </div>
        @break

    @default
        <div class="flex h-44 items-center justify-center bg-slate-100">
            <span class="font-display text-2xl text-slate-500">{{ $groom }} &amp; {{ $bride }}</span>
        </div>
@endswitch
