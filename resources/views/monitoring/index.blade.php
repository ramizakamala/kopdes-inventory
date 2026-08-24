@extends('layouts.app')

@section('title', 'Monitoring Stok')

@section('content')
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-5">
            <div class="text-xs uppercase tracking-wider text-zinc-500">Total Item</div>
            <div class="mt-1 text-2xl font-semibold text-white">{{ $totalItem }}</div>
        </div>
        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-5">
            <div class="text-xs uppercase tracking-wider text-zinc-500">Nilai Stok (Harga Beli)</div>
            <div class="mt-1 text-2xl font-semibold text-white">Rp{{ number_format($totalNilaiStok, 0, ',', '.') }}</div>
        </div>
        <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-5">
            <div class="text-xs uppercase tracking-wider text-amber-400/80">Stok Menipis</div>
            <div class="mt-1 text-2xl font-semibold text-amber-300">{{ $jumlahMenipis }}</div>
        </div>
        <div class="rounded-2xl border border-red-500/20 bg-red-500/5 p-5">
            <div class="text-xs uppercase tracking-wider text-red-400/80">Stok Habis</div>
            <div class="mt-1 text-2xl font-semibold text-red-300">{{ $jumlahHabis }}</div>
        </div>
    </div>

    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('monitoring.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-56 rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">
            <select name="kategori_id" class="rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                <option value="">Semua kategori</option>
                @foreach ($kategoris as $kat)
                    <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
            <select name="status" class="rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                <option value="">Semua status</option>
                <option value="aman" @selected(request('status') === 'aman')>Aman</option>
                <option value="menipis" @selected(request('status') === 'menipis')>Menipis</option>
                <option value="habis" @selected(request('status') === 'habis')>Habis</option>
            </select>
            <button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-zinc-300 hover:bg-white/5">Filter</button>
            @if (request()->hasAny('q', 'kategori_id', 'status'))
                <a href="{{ route('monitoring.index') }}" class="rounded-lg px-3 py-2 text-sm text-zinc-500 hover:text-white">Reset</a>
            @endif
        </form>
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Kode</th>
                        <th class="px-5 py-3">Nama Barang</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">Stok</th>
                        <th class="px-5 py-3">Min.</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Nilai Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($barangs as $b)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 font-mono text-xs text-zinc-400">{{ $b->kode_barang }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $b->nama_barang }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                            <td class="px-5 py-3 font-semibold {{ $b->stok_saat_ini <= 0 ? 'text-red-400' : ($b->status === 'menipis' ? 'text-amber-300' : 'text-white') }}">{{ $b->stok_saat_ini }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $b->stok_minimum }}</td>
                            <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                            <td class="px-5 py-3 text-zinc-300">Rp{{ number_format($b->stok_saat_ini * $b->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada barang yang cocok dengan filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $barangs->links() }}
    </div>
@endsection
