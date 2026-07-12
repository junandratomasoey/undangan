@extends('admin.layout')
@section('title', 'Rekap RSVP')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.invitations.edit', $invitation) }}" class="text-sm text-slate-500 hover:underline">&larr; {{ $invitation->groom_short }} &amp; {{ $invitation->bride_short }}</a>
        <a href="{{ route('admin.rsvps.export', $invitation) }}" class="rounded-lg bg-navy px-4 py-2 text-sm font-medium text-white hover:bg-navy-deep">Export CSV</a>
    </div>

    <div class="mb-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach([
            ['Total Hadir', $summary['hadir'], 'text-emerald-600'],
            ['Berhalangan', $summary['tidak_hadir'], 'text-red-500'],
            ['Ragu', $summary['ragu'], 'text-amber-600'],
            ['Total Entri', $summary['entries'], 'text-navy'],
        ] as [$label,$val,$color])
            <div class="rounded-xl border bg-white p-5">
                <p class="text-xs uppercase tracking-wide text-slate-400">{{ $label }}</p>
                <p class="mt-1 text-3xl font-semibold {{ $color }}">{{ $val }}</p>
            </div>
        @endforeach
    </div>

    <div class="overflow-x-auto rounded-xl border bg-white">
        <table class="min-w-full divide-y text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-400">
                <tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Kehadiran</th><th class="px-5 py-3">Jumlah</th><th class="px-5 py-3">Waktu</th><th class="px-5 py-3"></th></tr>
            </thead>
            <tbody class="divide-y">
                @forelse($rsvps as $r)
                    <tr>
                        <td class="px-5 py-3 font-medium">{{ $r->name }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-2 py-1 text-xs
                                {{ $r->attendance==='hadir' ? 'bg-emerald-100 text-emerald-700' : ($r->attendance==='ragu' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                {{ str_replace('_',' ',$r->attendance) }}</span>
                        </td>
                        <td class="px-5 py-3">{{ $r->headcount }}</td>
                        <td class="px-5 py-3 text-slate-400">{{ $r->created_at->translatedFormat('d M Y H.i') }}</td>
                        <td class="px-5 py-3 text-right">
                            <form method="POST" action="{{ route('admin.rsvps.destroy', [$invitation,$r]) }}">@csrf @method('DELETE')
                                <button class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus entri?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-10 text-center text-slate-400">Belum ada konfirmasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $rsvps->links() }}</div>
</div>
@endsection
