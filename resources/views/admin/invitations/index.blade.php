@extends('admin.layout')
@section('title', 'Undangan')

@section('content')
    <form method="GET" class="mb-5 flex flex-wrap gap-3">
        <input name="q" value="{{ request('q') }}" placeholder="Cari nama / slug…"
               class="w-full max-w-xs rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
        <select name="status" class="rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
            <option value="">Semua status</option>
            <option value="published" @selected(request('status')==='published')>Published</option>
            <option value="draft" @selected(request('status')==='draft')>Draft</option>
        </select>
        <button class="rounded-lg bg-navy px-4 py-2 text-sm font-medium text-white hover:bg-navy-deep">Filter</button>
    </form>

    <div class="overflow-x-auto rounded-xl border bg-white">
        <table class="min-w-full divide-y text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-400">
                <tr>
                    <th class="px-5 py-3">Pasangan</th>
                    <th class="px-5 py-3">Plan</th>
                    <th class="px-5 py-3">RSVP</th>
                    <th class="px-5 py-3">Ucapan</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($invitations as $inv)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3">
                            <a href="{{ route('admin.invitations.edit', $inv) }}" class="font-medium text-navy hover:underline">
                                {{ $inv->groom_short ?? $inv->groom_name }} &amp; {{ $inv->bride_short ?? $inv->bride_name }}
                            </a>
                            <p class="text-xs text-slate-400">/u/{{ $inv->slug }}</p>
                        </td>
                        <td class="px-5 py-3 capitalize">{{ $inv->plan }}</td>
                        <td class="px-5 py-3">
                            <a href="{{ route('admin.rsvps.index', $inv) }}" class="text-navy hover:underline">{{ $inv->rsvps_count }}</a>
                        </td>
                        <td class="px-5 py-3">
                            <a href="{{ route('admin.wishes.index', $inv) }}" class="text-navy hover:underline">{{ $inv->wishes_count }}</a>
                        </td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs {{ $inv->status==='published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">{{ $inv->status }}</span>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                @if($inv->status==='published')
                                    <a href="{{ route('invitation.show', $inv) }}" target="_blank" class="text-xs text-gold hover:underline">Lihat</a>
                                @endif
                                <a href="{{ route('admin.invitations.edit', $inv) }}" class="text-xs text-navy hover:underline">Edit</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-10 text-center text-slate-400">Belum ada undangan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $invitations->links() }}</div>
@endsection
