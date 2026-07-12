@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-5">
        @foreach([
            ['Total Undangan', $stats['total'], 'text-navy'],
            ['Tayang', $stats['published'], 'text-emerald-600'],
            ['Draft', $stats['draft'], 'text-amber-600'],
            ['Total Hadir (RSVP)', $stats['hadir'], 'text-navy'],
            ['Ucapan Masuk', $stats['wishes'], 'text-navy'],
        ] as [$label, $value, $color])
            <div class="rounded-xl border bg-white p-5">
                <p class="text-xs uppercase tracking-wide text-slate-400">{{ $label }}</p>
                <p class="mt-2 text-3xl font-semibold {{ $color }}">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-xl border bg-white">
            <div class="flex items-center justify-between border-b px-5 py-4">
                <h2 class="font-semibold text-navy">Undangan Terbaru</h2>
                <a href="{{ route('admin.invitations.index') }}" class="text-sm text-gold hover:underline">Lihat semua</a>
            </div>
            <ul class="divide-y">
                @forelse($recent as $inv)
                    <li class="flex items-center justify-between px-5 py-3">
                        <div>
                            <a href="{{ route('admin.invitations.edit', $inv) }}" class="font-medium text-navy hover:underline">
                                {{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }}
                            </a>
                            <p class="text-xs text-slate-400">/u/{{ $inv->slug }} · {{ ucfirst($inv->plan) }}</p>
                        </div>
                        <span class="rounded-full px-3 py-1 text-xs {{ $inv->status==='published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                            {{ $inv->status }}
                        </span>
                    </li>
                @empty
                    <li class="px-5 py-8 text-center text-sm text-slate-400">Belum ada undangan. Buat yang pertama.</li>
                @endforelse
            </ul>
        </div>

        <div class="rounded-xl border bg-white">
            <div class="border-b px-5 py-4"><h2 class="font-semibold text-navy">Akan Kedaluwarsa</h2></div>
            <ul class="divide-y">
                @forelse($expiring as $inv)
                    <li class="px-5 py-3">
                        <a href="{{ route('admin.invitations.edit', $inv) }}" class="text-sm font-medium text-navy hover:underline">
                            {{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }}
                        </a>
                        <p class="text-xs text-amber-600">{{ $inv->expires_at->translatedFormat('d M Y') }}</p>
                    </li>
                @empty
                    <li class="px-5 py-8 text-center text-sm text-slate-400">Tidak ada dalam 14 hari.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
