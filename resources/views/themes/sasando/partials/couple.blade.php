@php
    $extra = $inv->data_tambahan ?? [];
@endphp
<section class="bg-forest px-6 py-24 text-ivory">
    <div class="mx-auto grid max-w-3xl gap-16 sm:grid-cols-2">
        {{-- Groom --}}
        <div class="reveal text-center">
            <div class="mx-auto grid h-40 w-40 place-items-center rounded-full bg-ivory/5 ring-1 ring-accent/40">
                <span class="font-display text-5xl text-accent">{{ \Illuminate\Support\Str::substr($inv->groom_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-display text-4xl">{{ $inv->groom_name }}</h3>
            @if(!empty($extra['groom_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-ivory/70">
                    Putra dari<br>{{ $extra['groom_parents'] }}
                </p>
            @endif
        </div>
        {{-- Bride --}}
        <div class="reveal text-center">
            <div class="mx-auto grid h-40 w-40 place-items-center rounded-full bg-ivory/5 ring-1 ring-accent/40">
                <span class="font-display text-5xl text-accent">{{ \Illuminate\Support\Str::substr($inv->bride_name,0,1) }}</span>
            </div>
            <h3 class="mt-6 font-display text-4xl">{{ $inv->bride_name }}</h3>
            @if(!empty($extra['bride_parents']))
                <p class="mt-3 font-sans text-sm leading-relaxed text-ivory/70">
                    Putri dari<br>{{ $extra['bride_parents'] }}
                </p>
            @endif
        </div>
    </div>
</section>
