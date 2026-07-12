<footer class="bg-cocoa-deep px-6 py-24 text-center text-cream">
    <div class="reveal mx-auto max-w-md">
        <svg class="mx-auto h-14 w-24 text-mustard" aria-hidden="true"><use href="#sunburst"/></svg>
        <p class="mt-7 font-sans text-sm leading-relaxed text-cream/80">
            Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i
            berkenan hadir dan memberikan doa restu.
        </p>
        <h2 class="mt-8 font-display text-5xl uppercase leading-tight">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            <span class="text-mustard">&amp;</span>
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h2>
        <svg class="mx-auto mt-8 h-4 w-28 text-rust" aria-hidden="true"><use href="#wavy"/></svg>
        <p class="mt-8 font-sans text-[10px] font-bold uppercase tracking-[0.25em] text-cream/50">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-mustard hover:text-cream">nttdigital.com</a>
        </p>
    </div>
</footer>
