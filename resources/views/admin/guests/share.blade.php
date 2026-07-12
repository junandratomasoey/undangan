@extends('admin.layout')
@section('title', 'Sebar Undangan')

@section('content')
<div class="mx-auto max-w-4xl" x-data="{ showTpl:false }">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <a href="{{ route('admin.invitations.edit', $invitation) }}" class="text-sm text-slate-500 hover:underline">
            &larr; {{ $invitation->groom_short }} &amp; {{ $invitation->bride_short }}
        </a>
        <button @click="showTpl=!showTpl" class="rounded-lg border px-4 py-2 text-sm hover:bg-slate-50">Edit Template Pesan</button>
    </div>

    <div class="mb-6 grid grid-cols-2 gap-4">
        <div class="rounded-xl border bg-white p-5">
            <p class="text-xs uppercase tracking-wide text-slate-400">Total Tamu</p>
            <p class="mt-1 text-3xl font-semibold text-navy">{{ $guests->count() }}</p>
        </div>
        <div class="rounded-xl border bg-white p-5">
            <p class="text-xs uppercase tracking-wide text-slate-400">Punya Nomor WA</p>
            <p class="mt-1 text-3xl font-semibold text-navy">{{ $sent }}</p>
        </div>
    </div>

    {{-- Template editor --}}
    <div x-show="showTpl" x-cloak class="mb-6 rounded-xl border bg-white p-5">
        <h3 class="mb-3 font-medium text-navy">Template Pesan WhatsApp</h3>
        <p class="mb-3 text-xs text-slate-500">Gunakan <code class="rounded bg-slate-100 px-1">{nama}</code> dan <code class="rounded bg-slate-100 px-1">{link}</code> — akan otomatis diganti untuk tiap tamu.</p>
        <form method="POST" action="{{ route('admin.guests.template', $invitation) }}">
            @csrf @method('PUT')
            <textarea name="template" rows="7" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">{{ $template }}</textarea>
            <div class="mt-3 text-right">
                <button class="rounded-lg bg-navy px-5 py-2 text-sm font-medium text-white hover:bg-navy-deep">Simpan Template</button>
            </div>
        </form>
    </div>

    {{-- Tambah tamu --}}
    <div class="mb-6 rounded-xl border border-dashed bg-white p-5">
        <h3 class="mb-3 font-medium text-navy">Tambah Tamu</h3>
        <p class="mb-3 text-xs text-slate-500">Satu tamu per baris. Format: <b>Nama</b> atau <b>Nama, 08xxxxxxxxxx</b> (dengan nomor WA agar tombol kirim aktif).</p>
        <form method="POST" action="{{ route('admin.guests.store', $invitation) }}" class="space-y-3">
            @csrf
            <textarea name="entries" rows="5" required placeholder="Budi Santoso, 081234567890&#10;Keluarga Andi, 082198765432&#10;Bpk. Hidayat" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy"></textarea>
            <div class="flex items-end gap-3">
                <div>
                    <label class="mb-1 block text-xs font-medium">Grup (opsional)</label>
                    <input name="group" placeholder="Keluarga / Kantor" class="rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                </div>
                <button class="ml-auto rounded-lg bg-navy px-5 py-2 text-sm font-medium text-white hover:bg-navy-deep">Tambah</button>
            </div>
        </form>
    </div>

    {{-- Daftar tamu --}}
    <div class="overflow-hidden rounded-xl border bg-white">
        <div class="border-b px-5 py-3 text-sm font-medium text-navy">Daftar Tamu &amp; Kirim</div>
        <ul class="divide-y">
            @forelse($guests as $g)
                <li class="flex flex-wrap items-center justify-between gap-3 px-5 py-4" x-data="{ copied:false }">
                    <div class="min-w-0">
                        <p class="font-medium">{{ $g['model']->name }}
                            @if($g['model']->group)<span class="ml-2 text-xs text-slate-400">{{ $g['model']->group }}</span>@endif
                        </p>
                        <p class="truncate text-xs text-slate-400">{{ $g['model']->phone ?: 'tanpa nomor' }} · {{ $g['link'] }}</p>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <button @click="navigator.clipboard.writeText(@js($g['message'])); copied=true; setTimeout(()=>copied=false,1500)"
                                class="rounded-lg border px-3 py-1.5 text-xs hover:bg-slate-50">
                            <span x-show="!copied">Salin Pesan</span><span x-show="copied" x-cloak>Tersalin ✓</span>
                        </button>
                        @if($g['wa_url'])
                            <a href="{{ $g['wa_url'] }}" target="_blank"
                               class="inline-flex items-center gap-1.5 rounded-lg bg-[#25D366] px-3 py-1.5 text-xs font-medium text-white hover:brightness-105">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.2-1.7-.8-2-.9-.3-.1-.5-.2-.7.1-.2.3-.7.9-.9 1.1-.2.2-.3.2-.6.1-1.5-.7-2.5-1.3-3.5-3-.3-.5.3-.4.7-1.4.1-.2 0-.4 0-.5C10 9.5 9.5 8.1 9.3 7.6c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.9.9-1 2.1-1 2.2 0 .2.2 2.1 1.7 4 1.9 2.5 3.4 3.1 4.6 3.4 1.6.4 2.4.2 2.9-.1.5-.3 1.7-1.1 1.9-1.6.2-.5.2-.9.1-1-.1-.1-.3-.2-.6-.3M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.5A10 10 0 1 0 12 2"/></svg>
                                Kirim WA
                            </a>
                        @else
                            <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs text-slate-400">Tanpa nomor</span>
                        @endif
                        <form method="POST" action="{{ route('admin.guests.destroy', [$invitation,$g['model']]) }}">@csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus tamu?')">Hapus</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="px-5 py-10 text-center text-sm text-slate-400">Belum ada tamu. Tambahkan di atas.</li>
            @endforelse
        </ul>
    </div>

    <p class="mt-4 text-xs text-slate-400">
        Tips: klik "Kirim WA" akan membuka WhatsApp dengan pesan &amp; link personal sudah terisi — tinggal tekan kirim.
        Kirim per tamu (bukan blast massal) agar aman dari pemblokiran WhatsApp.
    </p>
</div>
@endsection
