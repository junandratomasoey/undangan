@php $extra = $inv->data_tambahan ?? []; @endphp
<section class="border-y border-line px-6 py-28">
    <div class="mx-auto max-w-3xl">
        <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Mempelai</p>
        <div class="mt-16 grid gap-16 sm:grid-cols-[1fr_auto_1fr] sm:items-center">
            <div class="reveal text-center sm:text-right">
                <h3 class="font-display text-5xl leading-none">{{ $inv->groom_name }}</h3>
                @if(!empty($extra['groom_parents']))
                    <p class="mt-4 font-sans text-sm leading-relaxed text-ink-soft">Putra dari<br>{{ $extra['groom_parents'] }}</p>
                @endif
            </div>
            <div class="reveal hidden sm:block"><span class="font-display text-4xl italic text-accent">&amp;</span></div>
            <div class="reveal text-center sm:text-left">
                <h3 class="font-display text-5xl leading-none">{{ $inv->bride_name }}</h3>
                @if(!empty($extra['bride_parents']))
                    <p class="mt-4 font-sans text-sm leading-relaxed text-ink-soft">Putri dari<br>{{ $extra['bride_parents'] }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
