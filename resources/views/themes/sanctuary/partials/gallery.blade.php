<section class="bg-stone-deep px-6 py-24 text-ivory">
    <header class="reveal text-center">
        <svg class="mx-auto h-7 w-24 text-gilt/70" aria-hidden="true"><use href="#olive"/></svg>
        <h2 class="mt-4 font-display text-5xl font-light">Galeri</h2>
    </header>
    <div class="reveal mx-auto mt-12 grid max-w-3xl grid-cols-2 gap-3 sm:grid-cols-3">
        @foreach($inv->photos as $photo)
            @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
            {{-- foto dibingkai jendela gotik --}}
            <figure class="group gothic relative aspect-[3/4] overflow-hidden border border-gilt/25 bg-stone/30">
                <img src="{{ $src }}" alt="{{ $photo->caption }}" loading="lazy"
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
            </figure>
        @endforeach
    </div>
</section>
