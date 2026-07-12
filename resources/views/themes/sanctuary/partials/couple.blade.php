@php $extra = $inv->data_tambahan ?? []; @endphp
<section class="bg-stone-deep px-6 py-24 text-ivory">
    <div class="mx-auto grid max-w-3xl gap-14 sm:grid-cols-2">
        <div class="reveal text-center">
            <div class="gothic mx-auto grid h-44 w-32 place-items-center border border-gilt/40 bg-stone/30">
                <span class="font-display text-6xl font-light text-gilt">{{ \Illuminate\Support\Str::substr($inv->groom_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-display text-4xl font-light">{{ $inv->groom_name }}</h3>
            @if(!empty($extra['groom_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-ivory/70">Putra dari<br>{{ $extra['groom_parents'] }}</p>
            @endif
        </div>
        <div class="reveal text-center">
            <div class="gothic mx-auto grid h-44 w-32 place-items-center border border-gilt/40 bg-stone/30">
                <span class="font-display text-6xl font-light text-gilt">{{ \Illuminate\Support\Str::substr($inv->bride_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-display text-4xl font-light">{{ $inv->bride_name }}</h3>
            @if(!empty($extra['bride_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-ivory/70">Putri dari<br>{{ $extra['bride_parents'] }}</p>
            @endif
        </div>
    </div>
</section>
