@php
    $extra   = $inv->data_tambahan ?? [];
    $doa     = $extra['doa_penutup'] ?? 'بَارَكَ اللَّهُ لَكَ وَبَارَكَ عَلَيْكَ وَجَمَعَ بَيْنَكُمَا فِي خَيْرٍ';
    $doaLat  = $extra['doa_penutup_arti'] ?? 'Semoga Allah memberkahimu dan menyatukan kalian berdua dalam kebaikan.';
@endphp
<footer class="girih-bg relative overflow-hidden bg-emerald2-dark px-6 py-24 text-center text-ivory">
    <div class="reveal relative mx-auto max-w-md">
        <svg class="mx-auto h-11 w-10 text-gold" aria-hidden="true"><use href="#dome"/></svg>

        <p class="mt-8 font-display text-2xl leading-[2] text-gold-soft" dir="rtl" lang="ar">{{ $doa }}</p>
        <p class="mt-3 font-display text-lg italic text-ivory/80">"{{ $doaLat }}"</p>

        <div class="rule-gold mx-auto mt-10 flex items-center justify-center gap-4"></div>

        <p class="mt-8 font-sans text-sm leading-relaxed text-ivory/75">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i
            berkenan hadir dan memberikan doa restu.
        </p>

        <h2 class="mt-8 font-display text-5xl leading-tight">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="text-gold">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h2>

        <p class="mt-6 font-sans text-xs tracking-wide text-ivory/60">Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>

        <p class="mt-10 font-sans text-[10px] uppercase tracking-[0.3em] text-ivory/45">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-gold hover:text-ivory">nttdigital.com</a>
        </p>
    </div>
</footer>
