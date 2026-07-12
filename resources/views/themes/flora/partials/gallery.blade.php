<section class="bg-ivory-warm px-6 py-24">
    <header class="reveal text-center">
        <svg class="mx-auto h-8 w-28 text-sage" aria-hidden="true"><use href="#sprig"/></svg>
        <h2 class="mt-4 font-script text-5xl text-sage-dark">Galeri</h2>
    </header>
    <div class="reveal mx-auto mt-12 grid max-w-3xl grid-cols-2 gap-4 sm:grid-cols-3">
        @foreach($inv->photos as $photo)
            @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
            <figure class="group relative aspect-[3/4] overflow-hidden rounded-2xl bg-sage-pale shadow-sm">
                <img src="{{ $src }}" alt="{{ $photo->caption }}" loading="lazy"
                     class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
            </figure>
        @endforeach
    </div>
</section>
