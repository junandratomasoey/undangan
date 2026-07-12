@php $extra = $inv->data_tambahan ?? []; @endphp
<section class="relative overflow-hidden bg-sage-pale/50 px-6 py-24">
    <svg class="pointer-events-none absolute -left-6 top-8 h-40 w-20 rotate-[15deg] text-sage/50" aria-hidden="true"><use href="#branch"/></svg>
    <svg class="pointer-events-none absolute -right-6 bottom-8 h-40 w-20 rotate-[195deg] text-sage/50" aria-hidden="true"><use href="#branch"/></svg>

    <div class="relative mx-auto grid max-w-3xl gap-14 sm:grid-cols-2">
        <div class="reveal text-center">
            <div class="mx-auto grid h-36 w-36 place-items-center rounded-full border-2 border-sage/40 bg-ivory">
                <span class="font-script text-6xl text-sage-deep">{{ \Illuminate\Support\Str::substr($inv->groom_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-script text-4xl text-sage-dark">{{ $inv->groom_name }}</h3>
            @if(!empty($extra['groom_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-bark/70">Putra dari<br>{{ $extra['groom_parents'] }}</p>
            @endif
        </div>
        <div class="reveal text-center">
            <div class="mx-auto grid h-36 w-36 place-items-center rounded-full border-2 border-sage/40 bg-ivory">
                <span class="font-script text-6xl text-sage-deep">{{ \Illuminate\Support\Str::substr($inv->bride_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-script text-4xl text-sage-dark">{{ $inv->bride_name }}</h3>
            @if(!empty($extra['bride_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-bark/70">Putri dari<br>{{ $extra['bride_parents'] }}</p>
            @endif
        </div>
    </div>
</section>
