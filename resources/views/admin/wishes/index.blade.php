@extends('admin.layout')
@section('title', 'Moderasi Ucapan')

@section('content')
<div class="mx-auto max-w-3xl">
    <a href="{{ route('admin.invitations.edit', $invitation) }}" class="mb-6 inline-block text-sm text-slate-500 hover:underline">&larr; {{ $invitation->groom_short }} &amp; {{ $invitation->bride_short }}</a>

    <div class="space-y-3">
        @forelse($wishes as $w)
            <div class="rounded-xl border bg-white p-5 {{ $w->is_hidden ? 'opacity-60' : '' }}">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="font-medium text-navy">{{ $w->name }}
                            @if($w->is_hidden)<span class="ml-2 rounded bg-slate-200 px-2 py-0.5 text-xs text-slate-500">disembunyikan</span>@endif
                        </p>
                        <p class="mt-1 text-sm text-slate-600">{{ $w->message }}</p>
                        <p class="mt-1 text-xs text-slate-400">{{ $w->created_at->translatedFormat('d M Y H.i') }}</p>
                    </div>
                    <div class="flex shrink-0 items-center gap-3">
                        <form method="POST" action="{{ route('admin.wishes.toggle', [$invitation,$w]) }}">@csrf
                            <button class="text-xs text-navy hover:underline">{{ $w->is_hidden ? 'Tampilkan' : 'Sembunyikan' }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.wishes.destroy', [$invitation,$w]) }}">@csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:underline" onclick="return confirm('Hapus ucapan?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-xl border bg-white p-10 text-center text-slate-400">Belum ada ucapan.</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $wishes->links() }}</div>
</div>
@endsection
