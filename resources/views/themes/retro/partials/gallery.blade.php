<section class="bg-olive px-6 py-24 text-cream">
    <header class="reveal text-center">
        <svg class="mx-auto h-4 w-24 text-cream" aria-hidden="true"><use href="#wavy"/></svg>
        <h2 class="mt-4 font-display text-5xl uppercase">Galeri</h2>
    </header>
    <div class="reveal mx-auto mt-12 grid max-w-3xl grid-cols-2 gap-4 sm:grid-cols-3">
        @foreach($inv->photos as $photo)
            @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
            {{-- foto dibingkai arch, khas poster 70-an --}}
            <figure class="group arch relative aspect-[3/4] overflow-hidden bg-cream">
                <img src="{{ $src }}" alt="{{ $photo->caption }}" loading="lazy"
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                     style="filter:sepia(.22) saturate(1.15) contrast(1.02)">
            </figure>
        @endforeach
    </div>
</section>
