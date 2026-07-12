<section class="border-t border-line px-6 py-28">
    <p class="reveal text-center font-sans text-[10px] uppercase tracking-widest3 text-ink-soft">Galeri</p>
    <div class="reveal mx-auto mt-12 grid max-w-4xl grid-cols-2 gap-2 sm:grid-cols-3">
        @foreach($inv->photos as $photo)
            @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
            <figure class="group relative aspect-square overflow-hidden bg-paper-warm">
                <img src="{{ $src }}" alt="{{ $photo->caption }}" loading="lazy"
                     class="h-full w-full object-cover grayscale transition duration-700 group-hover:grayscale-0 group-hover:scale-105">
            </figure>
        @endforeach
    </div>
</section>
