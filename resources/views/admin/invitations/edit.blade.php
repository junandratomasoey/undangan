@extends('admin.layout')
@section('title', 'Edit Undangan')

@section('content')
<div x-data="{ tab: 'detail' }" class="mx-auto max-w-4xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-xl border bg-white p-5">
        <div>
            <h2 class="text-xl font-semibold text-navy">
                {{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }}
            </h2>
            <p class="text-sm text-slate-400">/u/{{ $inv->slug }} ·
                <span class="{{ $inv->status==='published' ? 'text-emerald-600' : 'text-amber-600' }}">{{ $inv->status }}</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.guests.index', $inv) }}" class="rounded-lg border px-4 py-2 text-sm hover:bg-slate-50">Tamu &amp; Sebar</a>
            <a href="{{ route('admin.rsvps.index', $inv) }}" class="rounded-lg border px-4 py-2 text-sm hover:bg-slate-50">RSVP</a>
            <a href="{{ route('admin.wishes.index', $inv) }}" class="rounded-lg border px-4 py-2 text-sm hover:bg-slate-50">Ucapan</a>
            @if($inv->status==='published')
                <a href="{{ route('invitation.show', $inv) }}" target="_blank" class="rounded-lg border px-4 py-2 text-sm text-gold hover:bg-slate-50">Lihat</a>
            @endif
            <form method="POST" action="{{ route('admin.invitations.publish', $inv) }}">
                @csrf
                <button class="rounded-lg px-4 py-2 text-sm font-medium text-white {{ $inv->status==='published' ? 'bg-slate-500 hover:bg-slate-600' : 'bg-emerald-600 hover:bg-emerald-700' }}">
                    {{ $inv->status==='published' ? 'Jadikan Draft' : 'Publish' }}
                </button>
            </form>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="mb-5 flex gap-1 overflow-x-auto border-b text-sm">
        @foreach(['detail'=>'Detail','acara'=>'Acara','cerita'=>'Love Story','galeri'=>'Galeri','amplop'=>'Amplop'] as $key => $label)
            <button @click="tab='{{ $key }}'"
                    :class="tab==='{{ $key }}' ? 'border-navy text-navy' : 'border-transparent text-slate-400 hover:text-slate-600'"
                    class="-mb-px border-b-2 px-4 py-2 font-medium">{{ $label }}</button>
        @endforeach
    </div>

    {{-- TAB: Detail --}}
    <section x-show="tab==='detail'" class="rounded-xl border bg-white p-6">
        <form method="POST" action="{{ route('admin.invitations.update', $inv) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            <div class="grid gap-5 sm:grid-cols-2">
                <div><label class="mb-1 block text-sm font-medium">Nama Lengkap Pria</label>
                    <input name="groom_name" value="{{ old('groom_name',$inv->groom_name) }}" required class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div><label class="mb-1 block text-sm font-medium">Panggilan Pria</label>
                    <input name="groom_short" value="{{ old('groom_short',$inv->groom_short) }}" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div><label class="mb-1 block text-sm font-medium">Nama Lengkap Wanita</label>
                    <input name="bride_name" value="{{ old('bride_name',$inv->bride_name) }}" required class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div><label class="mb-1 block text-sm font-medium">Panggilan Wanita</label>
                    <input name="bride_short" value="{{ old('bride_short',$inv->bride_short) }}" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div><label class="mb-1 block text-sm font-medium">Orang Tua Pria</label>
                    <input name="groom_parents" value="{{ old('groom_parents',$inv->data_tambahan['groom_parents'] ?? '') }}" placeholder="Bpk. … & Ibu …" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div><label class="mb-1 block text-sm font-medium">Orang Tua Wanita</label>
                    <input name="bride_parents" value="{{ old('bride_parents',$inv->data_tambahan['bride_parents'] ?? '') }}" placeholder="Bpk. … & Ibu …" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
            </div>

            <div class="grid gap-5 sm:grid-cols-3">
                <div><label class="mb-1 block text-sm font-medium">Tema</label>
                    <select name="theme" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                        @foreach($themes as $key => $label)<option value="{{ $key }}" @selected($inv->theme===$key)>{{ $label }}</option>@endforeach
                    </select></div>
                <div><label class="mb-1 block text-sm font-medium">Paket</label>
                    <select name="plan" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                        @foreach($plans as $key => $plan)<option value="{{ $key }}" @selected($inv->plan===$key)>{{ ucfirst($key) }} — Rp{{ number_format($plan['price'],0,',','.') }}</option>@endforeach
                    </select></div>
                <div><label class="mb-1 block text-sm font-medium">Warna Aksen</label>
                    <input name="accent_color" type="color" value="{{ old('accent_color',$inv->accent_color) }}" class="h-10 w-full rounded-lg border-slate-300"></div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div><label class="mb-1 block text-sm font-medium">Slug</label>
                    <input name="slug" value="{{ old('slug',$inv->slug) }}" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div><label class="mb-1 block text-sm font-medium">Masa Aktif (kedaluwarsa)</label>
                    <input name="expires_at" type="date" value="{{ old('expires_at', optional($inv->expires_at)->format('Y-m-d')) }}" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></div>
                <div class="sm:col-span-2">
                    <label class="mb-1 block text-sm font-medium">Musik Latar <span class="text-slate-400">(platinum · MP3/WAV/OGG/M4A, maks 8MB)</span></label>

                    @if($inv->music_url)
                    <div class="mb-3 flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3">
                        <audio controls preload="none" src="{{ $inv->music_url }}" class="h-9 flex-1"></audio>

                        <button type="button" onclick="confirmDeleteMusic()"
                                class="shrink-0 text-xs text-red-500 hover:underline">
                            Hapus
                        </button>
                    </div>
                @endif

                    <input type="file" name="music_file" accept=".mp3,.wav,.ogg,.m4a,audio/*"
                           class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-navy file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-navy-deep">
                    <p class="mt-1 text-xs text-slate-400">Pastikan file musik bebas royalti / berlisensi, untuk menghindari klaim hak cipta.</p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="button" x-data
                        @click="if(confirm('Hapus undangan ini beserta seluruh datanya?')) $refs.del.submit()"
                        class="text-sm text-red-500 hover:underline">Hapus undangan</button>
                <button class="rounded-lg bg-navy px-6 py-2 text-sm font-medium text-white hover:bg-navy-deep">Simpan</button>
            </div>
        </form>
    

        @if($inv->music_url)
        <form id="deleteMusicForm" method="POST"
            action="{{ route('admin.invitations.music.destroy', $inv) }}"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <script>
        function confirmDeleteMusic() {
            if (confirm('Hapus musik yang sedang terpasang?')) {
                document.getElementById('deleteMusicForm').submit();
            }
        }
        </script>
        @endif



        <form x-ref="del" method="POST" action="{{ route('admin.invitations.destroy', $inv) }}" class="hidden">@csrf @method('DELETE')</form>
    </section>

    {{-- TAB: Acara --}}
    <section x-show="tab==='acara'" x-cloak class="space-y-4">
        @foreach($inv->events as $event)
            <div class="rounded-xl border bg-white p-5">
                <div class="flex items-center justify-between">
                    <h3 class="font-medium text-navy">{{ $event->title }} <span class="text-xs text-slate-400">({{ $event->type }})</span></h3>
                    <form method="POST" action="{{ route('admin.events.destroy', [$inv,$event]) }}">@csrf @method('DELETE')
                        <button class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus acara?')">Hapus</button>
                    </form>
                </div>
                <p class="mt-1 text-sm text-slate-500">{{ $event->starts_at->translatedFormat('l, d F Y · H.i') }} — {{ $event->venue_name }}</p>
            </div>
        @endforeach

        <div class="rounded-xl border border-dashed bg-white p-5">
            <h3 class="mb-4 font-medium text-navy">Tambah Acara</h3>
            <form method="POST" action="{{ route('admin.events.store', $inv) }}" class="grid gap-4 sm:grid-cols-2">
                @csrf
                <div><label class="mb-1 block text-xs font-medium">Jenis</label>
                    <select name="type" class="w-full rounded-lg border-slate-300 text-sm">
                        <option value="akad">Akad</option><option value="resepsi" selected>Resepsi</option><option value="other">Lainnya</option>
                    </select></div>
                <div><label class="mb-1 block text-xs font-medium">Judul</label>
                    <input name="title" required placeholder="Resepsi" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div><label class="mb-1 block text-xs font-medium">Mulai</label>
                    <input name="starts_at" type="datetime-local" required class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div><label class="mb-1 block text-xs font-medium">Selesai</label>
                    <input name="ends_at" type="datetime-local" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div class="sm:col-span-2"><label class="mb-1 block text-xs font-medium">Nama Tempat</label>
                    <input name="venue_name" required class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div class="sm:col-span-2"><label class="mb-1 block text-xs font-medium">Alamat</label>
                    <input name="address" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div><label class="mb-1 block text-xs font-medium">Latitude</label>
                    <input name="lat" type="number" step="any" placeholder="-10.1772" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div><label class="mb-1 block text-xs font-medium">Longitude</label>
                    <input name="lng" type="number" step="any" placeholder="123.6070" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div class="sm:col-span-2"><label class="mb-1 block text-xs font-medium">Link Google Maps (opsional)</label>
                    <input name="maps_url" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div class="sm:col-span-2 text-right">
                    <button class="rounded-lg bg-navy px-5 py-2 text-sm font-medium text-white hover:bg-navy-deep">Tambah Acara</button>
                </div>
            </form>
        </div>
    </section>

    {{-- TAB: Love Story --}}
    <section x-show="tab==='cerita'" x-cloak class="space-y-4">
        @foreach($inv->stories as $story)
            <div class="rounded-xl border bg-white p-5">
                <div class="flex items-center justify-between">
                    <h3 class="font-medium text-navy">{{ $story->title }} <span class="text-xs text-slate-400">{{ $story->date_label }}</span></h3>
                    <form method="POST" action="{{ route('admin.stories.destroy', [$inv,$story]) }}">@csrf @method('DELETE')
                        <button class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus cerita?')">Hapus</button>
                    </form>
                </div>
                <p class="mt-1 text-sm text-slate-500">{{ $story->body }}</p>
            </div>
        @endforeach

        <div class="rounded-xl border border-dashed bg-white p-5">
            <h3 class="mb-4 font-medium text-navy">Tambah Cerita</h3>
            <form method="POST" action="{{ route('admin.stories.store', $inv) }}" class="grid gap-4 sm:grid-cols-2">
                @csrf
                <div><label class="mb-1 block text-xs font-medium">Judul</label>
                    <input name="title" required placeholder="Pertama Bertemu" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div><label class="mb-1 block text-xs font-medium">Label Tanggal</label>
                    <input name="date_label" placeholder="Maret 2021" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div class="sm:col-span-2"><label class="mb-1 block text-xs font-medium">Isi</label>
                    <textarea name="body" rows="3" required class="w-full rounded-lg border-slate-300 text-sm"></textarea></div>
                <div class="sm:col-span-2 text-right">
                    <button class="rounded-lg bg-navy px-5 py-2 text-sm font-medium text-white hover:bg-navy-deep">Tambah Cerita</button>
                </div>
            </form>
        </div>
    </section>

    {{-- TAB: Galeri --}}
    <section x-show="tab==='galeri'" x-cloak class="space-y-4">
        <div class="rounded-xl border bg-white p-5">
            @if($inv->photos->isEmpty())
                <p class="text-sm text-slate-400">Belum ada foto.</p>
            @else
                <div class="grid grid-cols-3 gap-3 sm:grid-cols-4">
                    @foreach($inv->photos as $photo)
                        @php $src = \Illuminate\Support\Str::startsWith($photo->path,'http') ? $photo->path : \Storage::url($photo->path); @endphp
                        <div class="group relative aspect-[3/4] overflow-hidden rounded-lg bg-slate-100">
                            <img src="{{ $src }}" class="h-full w-full object-cover">
                            <form method="POST" action="{{ route('admin.gallery.destroy', [$inv,$photo]) }}"
                                  class="absolute right-1 top-1 opacity-0 transition group-hover:opacity-100">@csrf @method('DELETE')
                                <button class="grid h-7 w-7 place-items-center rounded-full bg-red-600 text-white text-xs" onclick="return confirm('Hapus foto?')">&times;</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="rounded-xl border border-dashed bg-white p-5">
            <h3 class="mb-4 font-medium text-navy">Unggah Foto <span class="text-xs text-slate-400">(maks 12 sekaligus)</span></h3>
            <form method="POST" action="{{ route('admin.gallery.store', $inv) }}" enctype="multipart/form-data" class="flex flex-wrap items-center gap-3">
                @csrf
                <input type="file" name="photos[]" accept="image/*" multiple required class="text-sm">
                <button class="rounded-lg bg-navy px-5 py-2 text-sm font-medium text-white hover:bg-navy-deep">Unggah</button>
            </form>
        </div>
    </section>

    {{-- TAB: Amplop --}}
    <section x-show="tab==='amplop'" x-cloak class="space-y-4">
        @foreach($inv->giftAccounts as $gift)
            <div class="flex items-center justify-between rounded-xl border bg-white p-5">
                <div>
                    <p class="font-medium text-navy">{{ $gift->label }} <span class="text-xs text-slate-400">({{ $gift->kind }})</span></p>
                    <p class="text-sm text-slate-500">{{ $gift->account_number ?: $gift->note }} @if($gift->account_name)· {{ $gift->account_name }}@endif</p>
                </div>
                <form method="POST" action="{{ route('admin.gifts.destroy', [$inv,$gift]) }}">@csrf @method('DELETE')
                    <button class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus?')">Hapus</button>
                </form>
            </div>
        @endforeach

        <div class="rounded-xl border border-dashed bg-white p-5" x-data="{ kind:'bank' }">
            <h3 class="mb-4 font-medium text-navy">Tambah Metode Hadiah</h3>
            <form method="POST" action="{{ route('admin.gifts.store', $inv) }}" enctype="multipart/form-data" class="grid gap-4 sm:grid-cols-2">
                @csrf
                <div><label class="mb-1 block text-xs font-medium">Jenis</label>
                    <select name="kind" x-model="kind" class="w-full rounded-lg border-slate-300 text-sm">
                        <option value="bank">Rekening Bank</option><option value="ewallet">E-Wallet</option>
                        <option value="qris">QRIS</option><option value="address">Alamat Kirim Hadiah</option>
                    </select></div>
                <div><label class="mb-1 block text-xs font-medium">Label</label>
                    <input name="label" required placeholder="BCA / GoPay / QRIS" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div x-show="kind!=='qris'"><label class="mb-1 block text-xs font-medium">Atas Nama</label>
                    <input name="account_name" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div x-show="kind==='bank'||kind==='ewallet'"><label class="mb-1 block text-xs font-medium">Nomor</label>
                    <input name="account_number" class="w-full rounded-lg border-slate-300 text-sm"></div>
                <div x-show="kind==='address'" class="sm:col-span-2"><label class="mb-1 block text-xs font-medium">Alamat</label>
                    <textarea name="note" rows="2" class="w-full rounded-lg border-slate-300 text-sm"></textarea></div>
                <div x-show="kind==='qris'" class="sm:col-span-2"><label class="mb-1 block text-xs font-medium">Gambar QRIS</label>
                    <input type="file" name="qris_image" accept="image/*" class="text-sm"></div>
                <div class="sm:col-span-2 text-right">
                    <button class="rounded-lg bg-navy px-5 py-2 text-sm font-medium text-white hover:bg-navy-deep">Tambah</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
