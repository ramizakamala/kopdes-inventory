@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('barang-keluar.index') }}" class="flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">
            <button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-zinc-300 hover:bg-white/5">Cari</button>
        </form>

        <a href="{{ route('barang-keluar.create') }}"
           class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
            + Catat Barang Keluar
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Barang</th>
                        <th class="px-5 py-3">Jumlah</th>
                        <th class="px-5 py-3">Harga Jual</th>
                        <th class="px-5 py-3">Keterangan</th>
                        <th class="px-5 py-3">Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($keluars as $k)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 text-zinc-400">{{ $k->tanggal->format('d/m/Y') }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $k->barang?->nama_barang ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-300">{{ $k->jumlah }}</td>
                            <td class="px-5 py-3 text-zinc-400">Rp{{ number_format($k->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $k->keterangan ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $k->user?->name ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-zinc-500">Belum ada transaksi barang keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $keluars->links() }}
    </div>
@endsection
