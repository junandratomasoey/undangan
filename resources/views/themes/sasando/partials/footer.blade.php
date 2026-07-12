<footer class="bg-forest-deep px-6 py-20 text-center text-ivory">
    <div class="reveal mx-auto max-w-md">
        <svg class="mx-auto h-6 w-6 text-accent" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2c2 4 6 5 6 9a6 6 0 0 1-12 0c0-4 4-5 6-9Z"/></svg>
        <p class="mt-6 font-sans text-sm leading-relaxed text-ivory/70">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila
            Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.
        </p>
        <p class="mt-8 font-display text-5xl">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="text-accent">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </p>
        <p class="mt-12 font-sans text-[11px] uppercase tracking-[0.25em] text-ivory/40">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-accent/80 hover:text-accent">nttdigital.com</a>
        </p>
    </div>
</footer>
