<footer class="border-t border-gold/15 bg-noir-deep px-6 py-24 text-center">
    <div class="reveal mx-auto max-w-md">
        <svg class="mx-auto h-5 w-5 text-gold" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 14 10 22 12 14 14 12 22 10 14 2 12 10 10Z"/></svg>
        <p class="mt-6 font-sans text-sm leading-relaxed text-ivory/70">
            Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i
            berkenan hadir dan memberikan doa restu.
        </p>
        <h2 class="mt-8 font-script gold-sheen text-7xl leading-tight">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            &amp;
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h2>
        <p class="mt-10 font-sans text-[10px] uppercase tracking-[0.3em] text-ivory-muted">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-gold hover:text-gold-light">nttdigital.com</a>
        </p>
    </div>
</footer>
