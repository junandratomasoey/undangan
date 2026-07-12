@php
    $extra = $inv->data_tambahan ?? [];
    // Ayat bisa diatur per undangan lewat data_tambahan (isi dari admin).
    // Default: 1 Korintus 13:4,7 — ayat pernikahan yang paling umum dipakai.
    $ayat   = $extra['ayat_teks']   ?? 'Kasih itu sabar; kasih itu murah hati; ia tidak cemburu. Ia menutupi segala sesuatu, percaya segala sesuatu, mengharapkan segala sesuatu, sabar menanggung segala sesuatu.';
    $sumber = $extra['ayat_sumber'] ?? '1 Korintus 13 : 4, 7';
@endphp

<section class="px-6 py-24 text-center">
    <div class="reveal mx-auto max-w-xl">
        <svg class="mx-auto h-8 w-28 text-stone/60" aria-hidden="true"><use href="#olive"/></svg>
        <p class="mt-8 font-display text-3xl font-light italic leading-relaxed text-stone-deep">
            "{{ $ayat }}"
        </p>
        <p class="mt-5 font-sans text-[10px] uppercase tracking-[0.3em] text-gilt">{{ $sumber }}</p>
    </div>
</section>
