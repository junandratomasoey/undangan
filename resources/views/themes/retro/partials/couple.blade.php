@php $extra = $inv->data_tambahan ?? []; @endphp
<section class="bg-rust px-6 py-24 text-cream">
    <div class="mx-auto grid max-w-3xl gap-12 sm:grid-cols-2">
        <div class="reveal text-center">
            <div class="arch mx-auto grid h-48 w-36 place-items-center bg-cream text-cocoa">
                <span class="font-display text-6xl">{{ \Illuminate\Support\Str::substr($inv->groom_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-display text-3xl uppercase">{{ $inv->groom_name }}</h3>
            @if(!empty($extra['groom_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-cream/80">Putra dari<br>{{ $extra['groom_parents'] }}</p>
            @endif
        </div>
        <div class="reveal text-center">
            <div class="arch mx-auto grid h-48 w-36 place-items-center bg-cream text-cocoa">
                <span class="font-display text-6xl">{{ \Illuminate\Support\Str::substr($inv->bride_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-display text-3xl uppercase">{{ $inv->bride_name }}</h3>
            @if(!empty($extra['bride_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-cream/80">Putri dari<br>{{ $extra['bride_parents'] }}</p>
            @endif
        </div>
    </div>
</section>
