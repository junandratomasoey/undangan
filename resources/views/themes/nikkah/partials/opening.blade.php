@php
    $extra = $inv->data_tambahan ?? [];
    // Ayat bisa diganti per undangan lewat data_tambahan.
    $ayatAr = $extra['ayat_arab'] ?? 'وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا وَجَعَلَ بَيْنَكُم مَّوَدَّةً وَرَحْمَةً';
    $ayat   = $extra['ayat_teks']   ?? 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu pasangan hidup dari jenismu sendiri, supaya kamu merasa tenteram di sisinya, dan dijadikan-Nya di antaramu rasa kasih dan sayang.';
    $sumber = $extra['ayat_sumber'] ?? 'Q.S. Ar-Rum : 21';
@endphp

<section class="relative overflow-hidden px-6 py-24 text-center">
    <div class="reveal relative mx-auto max-w-xl">
        <svg class="mx-auto h-6 w-28 text-emerald2/50" aria-hidden="true"><use href="#arabesque"/></svg>

        <p class="mt-8 font-display text-3xl leading-[2] text-emerald2-deep" dir="rtl" lang="ar">{{ $ayatAr }}</p>

        <p class="mt-6 font-display text-xl italic leading-relaxed text-ink/85">"{{ $ayat }}"</p>
        <p class="mt-4 font-sans text-[10px] uppercase tracking-[0.3em] text-gold">{{ $sumber }}</p>
    </div>
</section>
