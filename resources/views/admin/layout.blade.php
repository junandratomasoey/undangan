<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Undangan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            navy: { DEFAULT:'#003366', deep:'#002347' }, gold:'#F4A81D',
        } } } };
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-slate-100 text-slate-800" x-data="{ nav:false }">
<div class="flex min-h-full">

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-30 w-64 -translate-x-full bg-navy text-white transition-transform lg:static lg:translate-x-0"
           :class="nav && '!translate-x-0'">
        <div class="flex h-16 items-center gap-2 px-6 text-lg font-semibold">
            <span class="grid h-8 w-8 place-items-center rounded bg-gold text-navy">U</span>
            Undangan Admin
        </div>
        <nav class="mt-4 space-y-1 px-3 text-sm">
            @php $r = request()->route()?->getName(); @endphp
            <a href="{{ route('admin.dashboard') }}"
               class="block rounded px-3 py-2 {{ $r==='admin.dashboard' ? 'bg-white/15 font-medium' : 'hover:bg-white/10' }}">Dashboard</a>
            <a href="{{ route('admin.invitations.index') }}"
               class="block rounded px-3 py-2 {{ str_starts_with($r ?? '','admin.invitations') || str_contains($r ?? '','rsvp') || str_contains($r ?? '','ucapan') ? 'bg-white/15 font-medium' : 'hover:bg-white/10' }}">Undangan</a>
            <a href="{{ route('admin.invitations.create') }}"
               class="mt-2 block rounded bg-gold px-3 py-2 text-center font-medium text-navy hover:brightness-105">+ Undangan Baru</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="absolute bottom-4 left-3 right-3">
            @csrf
            <button class="w-full rounded px-3 py-2 text-left text-sm text-white/70 hover:bg-white/10">Keluar</button>
        </form>
    </aside>

    <div @click="nav=false" x-show="nav" class="fixed inset-0 z-20 bg-black/40 lg:hidden" x-cloak></div>

    {{-- Main --}}
    <div class="flex min-w-0 flex-1 flex-col">
        <header class="sticky top-0 z-10 flex h-16 items-center gap-3 border-b bg-white px-4 lg:px-8">
            <button @click="nav=true" class="lg:hidden" aria-label="Menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-lg font-semibold text-navy">@yield('title', 'Dashboard')</h1>
            <div class="ml-auto text-sm text-slate-500">{{ auth()->user()->name ?? '' }}</div>
        </header>

        <main class="flex-1 p-4 lg:p-8">
            @if(session('ok'))
                <div x-data="{ show:true }" x-show="show" x-init="setTimeout(()=>show=false,4000)"
                     class="mb-6 flex items-center justify-between rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    <span>{{ session('ok') }}</span>
                    <button @click="show=false" class="text-emerald-500">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
