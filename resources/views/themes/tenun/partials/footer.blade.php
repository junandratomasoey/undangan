<footer class="bg-maroon-deep px-6 pb-16 pt-20 text-center text-cream">
    <div class="reveal mx-auto max-w-md">
        <div class="mx-auto mb-8 w-32 text-ochre"><div class="tenun-band tenun-band--thin"></div></div>
        <p class="font-sans text-sm leading-relaxed text-cream/70">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila
            Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.
        </p>
        <p class="mt-8 font-display text-5xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="text-ochre">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </p>
        <div class="mx-auto mt-10 w-full text-ochre/70"><div class="tenun-band"></div></div>
        <p class="mt-8 font-sans text-[11px] uppercase tracking-[0.25em] text-cream/40">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-ochre/80 hover:text-ochre">nttdigital.com</a>
        </p>
    </div>
</footer>
