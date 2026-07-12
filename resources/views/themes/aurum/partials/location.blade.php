<section class="border-t border-gold/15 px-6 py-24">
    <div class="mx-auto max-w-3xl">
        <header class="reveal text-center">
            <p class="font-sans text-[10px] uppercase tracking-widest3 text-ivory-muted">Lokasi Acara</p>
            <h2 class="mt-2 font-script gold-sheen text-5xl">{{ $event->venue_name }}</h2>
        </header>
        <div class="reveal mt-10 border border-gold/40">
            <div id="map" class="h-80 w-full" style="z-index:0"></div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    (function () {
        const lat = {{ $event->lat }}, lng = {{ $event->lng }};
        function boot() {
            const map = L.map('map', { scrollWheelZoom:false }).setView([lat, lng], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution:'&copy; OpenStreetMap', maxZoom:19,
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup(@js($event->venue_name)).openPopup();
            setTimeout(() => map.invalidateSize(), 300);
        }
        document.readyState === 'loading'
            ? document.addEventListener('DOMContentLoaded', boot) : boot();
    })();
</script>
