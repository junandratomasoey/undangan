@extends('admin.layout')
@section('title', 'Undangan Baru')

@section('content')
    <div class="mx-auto max-w-2xl rounded-xl border bg-white p-6 lg:p-8">
        <form method="POST" action="{{ route('admin.invitations.store') }}" class="space-y-6">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-medium">Nama Lengkap Pria</label>
                    <input name="groom_name" value="{{ old('groom_name') }}" required
                           class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Panggilan Pria</label>
                    <input name="groom_short" value="{{ old('groom_short') }}" placeholder="Andi"
                           class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Nama Lengkap Wanita</label>
                    <input name="bride_name" value="{{ old('bride_name') }}" required
                           class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Panggilan Wanita</label>
                    <input name="bride_short" value="{{ old('bride_short') }}" placeholder="Sinta"
                           class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-medium">Tema</label>
                    <select name="theme" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                        @foreach($themes as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Paket</label>
                    <select name="plan" class="w-full rounded-lg border-slate-300 text-sm focus:border-navy focus:ring-navy">
                        @foreach($plans as $key => $plan)
                            <option value="{{ $key }}" @selected($key===config('undangan.default_plan'))>
                                {{ ucfirst($key) }} — Rp{{ number_format($plan['price'],0,',','.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Warna Aksen</label>
                    <input name="accent_color" type="color" value="{{ old('accent_color','#C8A04B') }}"
                           class="h-10 w-full rounded-lg border-slate-300">
                </div>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium">Slug <span class="text-slate-400">(opsional — otomatis dari nama)</span></label>
                <div class="flex items-center rounded-lg border border-slate-300 focus-within:border-navy focus-within:ring-1 focus-within:ring-navy">
                    <span class="pl-3 text-sm text-slate-400">/u/</span>
                    <input name="slug" value="{{ old('slug') }}" placeholder="andi-sinta"
                           class="w-full border-0 bg-transparent text-sm focus:ring-0">
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.invitations.index') }}" class="rounded-lg px-5 py-2 text-sm text-slate-500 hover:bg-slate-100">Batal</a>
                <button class="rounded-lg bg-navy px-6 py-2 text-sm font-medium text-white hover:bg-navy-deep">Simpan &amp; Lanjut</button>
            </div>
        </form>
    </div>
@endsection
