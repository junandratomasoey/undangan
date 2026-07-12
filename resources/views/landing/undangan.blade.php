@php
    $waBase = 'https://wa.me/' . $wa . '?text=';
    $waGeneral = $waBase . rawurlencode('Halo nttdigital, saya mau pesan undangan pernikahan digital. Boleh info lebih lanjut?');
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undangan Pernikahan Digital — nttdigital.com</title>
    <meta name="description" content="Undangan pernikahan digital elegan buatan NTT. RSVP online, peta lokasi, galeri, amplop digital. Mulai Rp75.000.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT:'#0F766E', deep:'#0C4A44', dark:'#0A302C', mint:'#5EEAD4' },
                        sand:  '#F7F5EF',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        sans:    ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <style>
        [x-cloak]{display:none!important}
        .tenun-mask{
            -webkit-mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3E%3Cpath fill-rule='evenodd' d='M15 3 L27 15 L15 27 L3 15 Z M15 9 L21 15 L15 21 L9 15 Z'/%3E%3Cpath d='M0 0 L5 5 L10 0 Z M10 0 L15 5 L20 0 Z M20 0 L25 5 L30 0 Z'/%3E%3C/svg%3E") repeat-x center / auto 12px;
                    mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3E%3Cpath fill-rule='evenodd' d='M15 3 L27 15 L15 27 L3 15 Z M15 9 L21 15 L15 21 L9 15 Z'/%3E%3Cpath d='M0 0 L5 5 L10 0 Z M10 0 L15 5 L20 0 Z M20 0 L25 5 L30 0 Z'/%3E%3C/svg%3E") repeat-x center / auto 12px;
        }
        .gold-sheen{background:linear-gradient(115deg,#B8860B,#E8CC74 50%,#B8860B);-webkit-background-clip:text;background-clip:text;color:transparent}
    </style>
</head>
<body class="bg-sand font-sans text-brand-dark antialiased" x-data="{ nav:false }">

{{-- NAV --}}
<header class="sticky top-0 z-40 border-b border-brand/10 bg-sand/90 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
        <a href="#" class="flex items-center gap-2 font-display text-xl font-semibold text-brand-deep">
            <span class="grid h-8 w-8 place-items-center rounded-lg bg-brand text-sand">n</span>
            nttdigital
        </a>
        <nav class="hidden items-center gap-8 text-sm font-medium md:flex">
            <a href="#tema" class="hover:text-brand">Tema</a>
            <a href="#fitur" class="hover:text-brand">Fitur</a>
            <a href="#harga" class="hover:text-brand">Harga</a>
            <a href="#cara" class="hover:text-brand">Cara Pesan</a>
            <a href="{{ $waGeneral }}" target="_blank" class="rounded-full bg-brand px-5 py-2 text-sand hover:bg-brand-deep">Pesan Sekarang</a>
        </nav>
        <button @click="nav=!nav" class="md:hidden" aria-label="Menu">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <div x-show="nav" x-cloak class="border-t border-brand/10 bg-sand px-5 py-4 md:hidden">
        <div class="flex flex-col gap-3 text-sm font-medium">
            <a href="#tema" @click="nav=false">Tema</a>
            <a href="#fitur" @click="nav=false">Fitur</a>
            <a href="#harga" @click="nav=false">Harga</a>
            <a href="#cara" @click="nav=false">Cara Pesan</a>
            <a href="{{ $waGeneral }}" target="_blank" class="rounded-full bg-brand px-5 py-2 text-center text-sand">Pesan Sekarang</a>
        </div>
    </div>
</header>

{{-- HERO --}}
<section class="relative overflow-hidden bg-brand-dark text-sand">
    <div class="pointer-events-none absolute inset-0" style="background:radial-gradient(80% 60% at 80% 0%, rgba(94,234,212,.15), transparent 60%)"></div>
    <div class="relative mx-auto grid max-w-6xl gap-10 px-5 py-20 md:grid-cols-2 md:items-center md:py-28">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-mint">Undangan Pernikahan Digital</p>
            <h1 class="mt-4 font-display text-5xl font-semibold leading-tight md:text-6xl">
                Bagikan momen bahagiamu, elegan &amp; praktis.
            </h1>
            <p class="mt-5 max-w-md text-sand/80">
                Undangan digital buatan NTT — lengkap dengan RSVP online, peta lokasi, galeri, hingga amplop digital. Tinggal bagikan lewat WhatsApp.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#tema" class="rounded-full bg-brand-mint px-6 py-3 text-sm font-semibold text-brand-dark hover:brightness-105">Lihat Tema</a>
                <a href="{{ $waGeneral }}" target="_blank" class="inline-flex items-center gap-2 rounded-full border border-sand/30 px-6 py-3 text-sm font-semibold hover:bg-sand/10">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.2-1.7-.8-2-.9-.3-.1-.5-.2-.7.1-.2.3-.7.9-.9 1.1-.2.2-.3.2-.6.1-1.5-.7-2.5-1.3-3.5-3-.3-.5.3-.4.7-1.4.1-.2 0-.4 0-.5C10 9.5 9.5 8.1 9.3 7.6c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.9.9-1 2.1-1 2.2 0 .2.2 2.1 1.7 4 1.9 2.5 3.4 3.1 4.6 3.4 1.6.4 2.4.2 2.9-.1.5-.3 1.7-1.1 1.9-1.6.2-.5.2-.9.1-1-.1-.1-.3-.2-.6-.3M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.5A10 10 0 1 0 12 2"/></svg>
                    WhatsApp
                </a>
            </div>
            <p class="mt-6 text-xs text-sand/60">Dibuat di Kupang, NTT · 4 tema pilihan · Proses cepat</p>
        </div>

        {{-- Stack preview mini keempat tema --}}
        <div class="relative mx-auto grid w-full max-w-sm grid-cols-2 gap-4">
            <div class="rounded-2xl bg-[#0F3D3A] p-6 text-center shadow-xl">
                <p class="text-[9px] uppercase tracking-widest text-[#C8A04B]/80">Sasando</p>
                <p class="mt-3 font-display text-2xl text-[#EFE7D6]">A <span class="text-[#C8A04B]">&amp;</span> S</p>
            </div>
            <div class="mt-6 rounded-2xl bg-[#4E1D1D] p-6 text-center shadow-xl">
                <p class="text-[9px] uppercase tracking-widest text-[#C6892C]/90">Tenun</p>
                <p class="mt-3 font-display text-2xl text-[#EFE6D2]">Y <span class="text-[#C6892C]">&amp;</span> M</p>
                <div class="tenun-mask mx-auto mt-3 h-3 w-16 text-[#C6892C]" style="background-color:currentColor"></div>
            </div>
            <div class="rounded-2xl border border-brand/10 bg-white p-6 text-center shadow-xl">
                <p class="text-[9px] uppercase tracking-widest text-slate-400">Modern</p>
                <p class="mt-3 font-display text-2xl text-slate-900">R <span class="text-[#B08D6A]">&amp;</span> N</p>
            </div>
            <div class="mt-6 rounded-2xl bg-[#0C0B0A] p-6 text-center shadow-xl">
                <p class="text-[9px] uppercase tracking-widest text-[#E8CC74]/80">Aurum</p>
                <p class="mt-3 gold-sheen font-display text-2xl">M &amp; G</p>
            </div>
        </div>
    </div>
</section>

{{-- TEMA --}}
<section id="tema" class="mx-auto max-w-6xl px-5 py-20">
    <div class="text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand">Pilihan Tema</p>
        <h2 class="mt-2 font-display text-4xl font-semibold">Empat gaya, satu yang pas untukmu</h2>
        <p class="mx-auto mt-3 max-w-xl text-brand-dark/70">Klik "Lihat Demo" untuk membuka undangan contoh yang bisa langsung kamu jelajahi.</p>
    </div>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($themes as $t)
            <div class="flex flex-col overflow-hidden rounded-2xl border border-brand/10 bg-white shadow-sm transition hover:shadow-md">
                {{-- mini preview per tema --}}
                @if($t['key']==='sasando')
                    <div class="flex h-40 items-center justify-center bg-[#0F3D3A]"><span class="font-display text-3xl text-[#EFE7D6]">Andi <span class="text-[#C8A04B]">&amp;</span> Sinta</span></div>
                @elseif($t['key']==='tenun')
                    <div class="flex h-40 flex-col items-center justify-center bg-[#4E1D1D]"><span class="font-display text-3xl text-[#EFE6D2]">Yosef <span class="text-[#C6892C]">&amp;</span> Maria</span><div class="tenun-mask mt-3 h-3 w-24 text-[#C6892C]" style="background-color:currentColor"></div></div>
                @elseif($t['key']==='modern')
                    <div class="flex h-40 items-center justify-center border-b border-slate-100 bg-white"><span class="font-display text-3xl text-slate-900">Reza <span class="text-[#B08D6A]">&amp;</span> Nadia</span></div>
                @else
                    <div class="flex h-40 items-center justify-center bg-[#0C0B0A]"><span class="gold-sheen font-display text-3xl">Michael &amp; Gabriela</span></div>
                @endif

                <div class="flex flex-1 flex-col p-5">
                    <h3 class="font-display text-xl font-semibold">{{ $t['name'] }}</h3>
                    <p class="text-xs font-medium uppercase tracking-wide text-brand">{{ $t['tag'] }}</p>
                    <p class="mt-2 flex-1 text-sm text-brand-dark/70">{{ $t['desc'] }}</p>
                    <a href="/u/{{ $t['slug'] }}?to=Tamu+Undangan" target="_blank"
                       class="mt-4 inline-flex items-center justify-center gap-2 rounded-full bg-brand px-4 py-2 text-sm font-semibold text-sand hover:bg-brand-deep">
                        Lihat Demo
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- FITUR --}}
<section id="fitur" class="bg-white py-20">
    <div class="mx-auto max-w-6xl px-5">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand">Fitur</p>
            <h2 class="mt-2 font-display text-4xl font-semibold">Semua yang undanganmu butuhkan</h2>
        </div>
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @php $fitur = [
                ['RSVP Online', 'Tamu konfirmasi kehadiran, kamu dapat rekap otomatis.'],
                ['Peta Lokasi', 'Peta interaktif + tautan Google Maps ke lokasi acara.'],
                ['Hitung Mundur', 'Countdown menuju hari bahagia, otomatis.'],
                ['Galeri Foto', 'Pajang foto prewedding dalam galeri elegan.'],
                ['Amplop Digital', 'Rekening & QRIS, tamu bisa kirim tanda kasih.'],
                ['Buku Ucapan', 'Tamu menulis doa & ucapan, tampil langsung.'],
                ['Personalisasi Tamu', 'Nama tamu muncul otomatis di setiap link.'],
                ['Musik Latar', 'Iringan musik saat undangan dibuka.'],
                ['Bagikan via WhatsApp', 'Satu link, sebar ke ratusan tamu tanpa cetak.'],
            ]; @endphp
            @foreach($fitur as [$judul, $ket])
                <div class="rounded-xl border border-brand/10 bg-sand p-5">
                    <div class="grid h-9 w-9 place-items-center rounded-lg bg-brand/10 text-brand">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="m5 13 4 4L19 7"/></svg>
                    </div>
                    <h3 class="mt-3 font-semibold">{{ $judul }}</h3>
                    <p class="mt-1 text-sm text-brand-dark/70">{{ $ket }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- HARGA --}}
<section id="harga" class="mx-auto max-w-6xl px-5 py-20">
    <div class="text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand">Harga</p>
        <h2 class="mt-2 font-display text-4xl font-semibold">Pilih paket sesuai kebutuhan</h2>
        <p class="mx-auto mt-3 max-w-xl text-brand-dark/70">Harga sekali bayar, tanpa biaya tersembunyi. Semua paket sudah termasuk pembuatan &amp; hosting undangan.</p>
    </div>

    <div class="mt-12 grid gap-6 lg:grid-cols-3">
        @foreach($plans as $plan)
            @php $waPlan = $waBase . rawurlencode("Halo nttdigital, saya mau pesan undangan digital paket {$plan['name']}."); @endphp
            <div class="relative flex flex-col rounded-2xl border bg-white p-8 shadow-sm {{ $plan['popular'] ? 'border-brand ring-2 ring-brand' : 'border-brand/10' }}">
                @if($plan['popular'])
                    <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-brand px-4 py-1 text-xs font-semibold text-sand">Paling Laku</span>
                @endif
                <h3 class="font-display text-2xl font-semibold">{{ $plan['name'] }}</h3>
                <p class="mt-3">
                    <span class="text-sm text-brand-dark/60">Rp</span>
                    <span class="text-4xl font-bold">{{ number_format($plan['price'], 0, ',', '.') }}</span>
                </p>
                <ul class="mt-6 flex-1 space-y-3 text-sm">
                    @foreach($plan['features'] as $f)
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m5 13 4 4L19 7"/></svg>
                            <span>{{ $f }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ $waPlan }}" target="_blank"
                   class="mt-8 rounded-full py-3 text-center text-sm font-semibold {{ $plan['popular'] ? 'bg-brand text-sand hover:bg-brand-deep' : 'border border-brand text-brand hover:bg-brand hover:text-sand' }}">
                    Pesan Paket {{ $plan['name'] }}
                </a>
            </div>
        @endforeach
    </div>
</section>

{{-- CARA PESAN --}}
<section id="cara" class="bg-brand-dark py-20 text-sand">
    <div class="mx-auto max-w-5xl px-5">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-mint">Cara Pesan</p>
            <h2 class="mt-2 font-display text-4xl font-semibold">Tiga langkah, undangan siap</h2>
        </div>
        <div class="mt-12 grid gap-8 md:grid-cols-3">
            @php $langkah = [
                ['1', 'Pilih tema &amp; paket', 'Tentukan tema favorit dan paket yang sesuai kebutuhanmu.'],
                ['2', 'Kirim data via WhatsApp', 'Kirim data pasangan, foto, jadwal acara, dan info rekening.'],
                ['3', 'Undangan jadi &amp; dibagikan', 'Kami buatkan, kamu tinggal bagikan link ke para tamu.'],
            ]; @endphp
            @foreach($langkah as [$no, $judul, $ket])
                <div class="text-center">
                    <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-brand-mint font-display text-2xl font-semibold text-brand-dark">{{ $no }}</div>
                    <h3 class="mt-4 font-display text-xl font-semibold">{!! $judul !!}</h3>
                    <p class="mt-2 text-sm text-sand/70">{!! $ket !!}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            <a href="{{ $waGeneral }}" target="_blank" class="inline-flex items-center gap-2 rounded-full bg-brand-mint px-8 py-3 text-sm font-semibold text-brand-dark hover:brightness-105">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.2-1.7-.8-2-.9-.3-.1-.5-.2-.7.1-.2.3-.7.9-.9 1.1-.2.2-.3.2-.6.1-1.5-.7-2.5-1.3-3.5-3-.3-.5.3-.4.7-1.4.1-.2 0-.4 0-.5C10 9.5 9.5 8.1 9.3 7.6c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.9.9-1 2.1-1 2.2 0 .2.2 2.1 1.7 4 1.9 2.5 3.4 3.1 4.6 3.4 1.6.4 2.4.2 2.9-.1.5-.3 1.7-1.1 1.9-1.6.2-.5.2-.9.1-1-.1-.1-.3-.2-.6-.3M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.5A10 10 0 1 0 12 2"/></svg>
                Mulai Pesan Sekarang
            </a>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="mx-auto max-w-3xl px-5 py-20">
    <div class="text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand">FAQ</p>
        <h2 class="mt-2 font-display text-4xl font-semibold">Pertanyaan yang sering diajukan</h2>
    </div>
    <div class="mt-10 space-y-3" x-data="{ open:null }">
        @php $faq = [
            ['Berapa lama undangan selesai?', 'Umumnya 1–3 hari kerja setelah data lengkap kami terima, tergantung paket dan antrean.'],
            ['Bisa revisi?', 'Bisa. Revisi teks/data termasuk gratis sebelum undangan dipublikasikan. Ketentuan detail menyesuaikan paket.'],
            ['Berapa lama undangan aktif?', 'Undangan aktif hingga beberapa bulan setelah hari-H (bisa diperpanjang bila perlu).'],
            ['Apakah tamu unlimited?', 'Ya, satu link bisa dibagikan ke berapa pun tamu, dengan personalisasi nama per tamu.'],
            ['Bisa pakai domain sendiri?', 'Bisa, di paket Platinum undangan dapat memakai custom domain (mis. nama-kalian.com).'],
        ]; @endphp
        @foreach($faq as $i => [$q, $a])
            <div class="rounded-xl border border-brand/10 bg-white">
                <button @click="open === {{ $i }} ? open=null : open={{ $i }}" class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left font-medium">
                    {{ $q }}
                    <svg class="h-5 w-5 shrink-0 text-brand transition" :class="open==={{ $i }} && 'rotate-45'" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                </button>
                <div x-show="open === {{ $i }}" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="px-5 pb-4 text-sm text-brand-dark/70">{{ $a }}</div>
            </div>
        @endforeach
    </div>
</section>

{{-- FOOTER --}}
<footer class="border-t border-brand/10 bg-white">
    <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-5 py-10 text-center sm:flex-row sm:text-left">
        <div>
            <p class="font-display text-lg font-semibold text-brand-deep">nttdigital.com</p>
            <p class="text-sm text-brand-dark/60">Jasa web &amp; undangan digital · Kupang, NTT</p>
        </div>
        <a href="{{ $waGeneral }}" target="_blank" class="rounded-full bg-brand px-6 py-2 text-sm font-semibold text-sand hover:bg-brand-deep">Hubungi via WhatsApp</a>
    </div>
    <p class="pb-8 text-center text-xs text-brand-dark/40">&copy; {{ date('Y') }} nttdigital.com</p>
</footer>

{{-- Floating WA --}}
<a href="{{ $waGeneral }}" target="_blank" class="fixed bottom-5 right-5 z-50 grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-lg hover:brightness-105" aria-label="WhatsApp">
    <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.2-1.7-.8-2-.9-.3-.1-.5-.2-.7.1-.2.3-.7.9-.9 1.1-.2.2-.3.2-.6.1-1.5-.7-2.5-1.3-3.5-3-.3-.5.3-.4.7-1.4.1-.2 0-.4 0-.5C10 9.5 9.5 8.1 9.3 7.6c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.9.9-1 2.1-1 2.2 0 .2.2 2.1 1.7 4 1.9 2.5 3.4 3.1 4.6 3.4 1.6.4 2.4.2 2.9-.1.5-.3 1.7-1.1 1.9-1.6.2-.5.2-.9.1-1-.1-.1-.3-.2-.6-.3M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.5A10 10 0 1 0 12 2"/></svg>
</a>

</body>
</html>
