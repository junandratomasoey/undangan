@php $extra = $inv->data_tambahan ?? []; @endphp
<section class="border-y border-gold/15 bg-noir-panel px-6 py-24">
    <div class="mx-auto grid max-w-3xl gap-16 sm:grid-cols-2">
        <div class="reveal text-center">
            <div class="mx-auto grid h-36 w-36 place-items-center rounded-full border border-gold/40 bg-noir">
                <span class="font-script gold-sheen text-6xl">{{ \Illuminate\Support\Str::substr($inv->groom_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-script gold-sheen text-5xl">{{ $inv->groom_name }}</h3>
            @if(!empty($extra['groom_parents']))
                <p class="mt-4 font-sans text-sm leading-relaxed text-ivory/70">Putra dari<br>{{ $extra['groom_parents'] }}</p>
            @endif
        </div>
        <div class="reveal text-center">
            <div class="mx-auto grid h-36 w-36 place-items-center rounded-full border border-gold/40 bg-noir">
                <span class="font-script gold-sheen text-6xl">{{ \Illuminate\Support\Str::substr($inv->bride_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-script gold-sheen text-5xl">{{ $inv->bride_name }}</h3>
            @if(!empty($extra['bride_parents']))
                <p class="mt-4 font-sans text-sm leading-relaxed text-ivory/70">Putri dari<br>{{ $extra['bride_parents'] }}</p>
            @endif
        </div>
    </div>
</section>
