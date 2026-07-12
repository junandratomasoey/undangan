<footer class="border-t border-line px-6 py-24 text-center">
    <div class="reveal mx-auto max-w-md">
        <p class="font-sans text-sm leading-relaxed text-ink-soft">
            Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i
            berkenan hadir dan memberikan doa restu.
        </p>
        <h2 class="mt-10 font-display text-6xl leading-none">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="italic text-accent">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h2>
        <p class="mt-12 font-sans text-[10px] uppercase tracking-[0.3em] text-ink-soft">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="border-b border-ink/30 text-ink hover:border-accent hover:text-accent">nttdigital.com</a>
        </p>
    </div>
</footer>
