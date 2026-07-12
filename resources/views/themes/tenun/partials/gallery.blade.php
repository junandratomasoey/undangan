<section class="bg-indigo2 px-6 py-24 text-cream">
    <header class="reveal text-center">
        <p class="font-sans text-xs uppercase tracking-[0.25em] text-cream/60">Momen Kami</p>
        <h2 class="mt-2 font-display text-4xl">Galeri</h2>
    </header>
    <div class="reveal mx-auto mt-12 grid max-w-3xl grid-cols-2 gap-3 sm:grid-cols-3">
        @foreach($inv->photos as $photo)
            @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
            <figure class="group relative aspect-[3/4] overflow-hidden bg-cream/5 ring-1 ring-ochre/30">
                <img src="{{ $src }}" alt="{{ $photo->caption }}" loading="lazy"
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
            </figure>
        @endforeach
    </div>
</section>
