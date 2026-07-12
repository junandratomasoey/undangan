<section class="bg-emerald2-deep px-6 py-24 text-ivory">
    <header class="reveal text-center">
        <svg class="mx-auto h-6 w-28 text-gold/70" aria-hidden="true"><use href="#arabesque"/></svg>
        <h2 class="mt-4 font-display text-5xl">Galeri</h2>
    </header>
    <div class="reveal mx-auto mt-12 grid max-w-3xl grid-cols-2 gap-3 sm:grid-cols-3">
        @foreach($inv->photos as $photo)
            @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
            {{-- foto dibingkai mihrab --}}
            <figure class="group mihrab relative aspect-[3/4] overflow-hidden border border-gold/25 bg-emerald2/40">
                <img src="{{ $src }}" alt="{{ $photo->caption }}" loading="lazy"
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
            </figure>
        @endforeach
    </div>
</section>
