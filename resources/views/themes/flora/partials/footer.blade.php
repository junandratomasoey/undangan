<footer class="relative overflow-hidden bg-sage-deep px-6 py-24 text-center text-ivory">
    <svg class="pointer-events-none absolute -left-5 top-6 h-40 w-20 rotate-12 text-ivory/15" aria-hidden="true"><use href="#branch"/></svg>
    <svg class="pointer-events-none absolute -right-5 bottom-6 h-40 w-20 rotate-[192deg] text-ivory/15" aria-hidden="true"><use href="#branch"/></svg>

    <div class="reveal relative mx-auto max-w-md">
        <svg class="mx-auto h-9 w-9 text-blush-soft" aria-hidden="true"><use href="#bloom"/></svg>
        <p class="mt-6 font-sans text-sm leading-relaxed text-ivory/80">
            Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i
            berkenan hadir dan memberikan doa restu.
        </p>
        <h2 class="mt-8 font-script text-6xl leading-tight">
            {{ $inv->groom_short ?? \Illuminate\Support\Str::before($inv->groom_name,' ') }}
            &amp;
            {{ $inv->bride_short ?? \Illuminate\Support\Str::before($inv->bride_name,' ') }}
        </h2>
        <p class="mt-10 font-sans text-[10px] uppercase tracking-[0.3em] text-ivory/60">
            Undangan digital oleh
            <a href="https://nttdigital.com" class="text-blush-soft hover:text-ivory">nttdigital.com</a>
        </p>
    </div>
</footer>
