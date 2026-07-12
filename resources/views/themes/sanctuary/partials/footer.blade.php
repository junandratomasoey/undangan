@php
    $extra   = $inv->data_tambahan ?? [];
    $berkat  = $extra['ayat_penutup'] ?? 'Apa yang telah dipersatukan Allah, tidak boleh diceraikan manusia.';
    $sumberB = $extra['ayat_penutup_sumber'] ?? 'Matius 19 : 6';
@endphp
<footer class="bg-stone-dark px-6 py-24 text-center text-ivory">
    <div class="reveal mx-auto max-w-md">
        <svg class="mx-auto h-10 w-7 text-gilt" aria-hidden="true"><use href="#cross"/></svg>

        <p class="mt-8 font-display text-2xl font-light italic leading-relaxed text-ivory/90">"{{ $berkat }}"</p>
        <p class="mt-3 font-sans text-[10px] uppercase tracking-[0.25em] text-gilt">{{ $sumberB }}</p>

        <div class="rule-gilt mx-auto mt-10 flex items-center justify-center gap-4"></div>

        <p class="mt-8 font-sans text-sm leading-relaxed text-ivory/75">
            Merupakan suatu kehormatan dan sukacita bagi kami apabila Bapak/Ibu/Saudara/i
            berkenan hadir dan memberikan doa restu.
        </p>

        <h2 class="mt-8 font-display text-5xl font-light leading-tight">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="italic text-gilt">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h2>

        <p class="mt-10 font-sans text-[10px] uppercase tracking-[0.3em] text-ivory/45">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-gilt hover:text-ivory">nttdigital.com</a>
        </p>
    </div>
</footer>
