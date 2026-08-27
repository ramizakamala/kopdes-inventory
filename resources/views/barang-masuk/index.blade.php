@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('barang-masuk.index') }}" class="flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 input">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>

        <a href="{{ route('barang-masuk.create') }}"
           class="btn btn-primary">
            + Catat Barang Masuk
        </a>
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Barang</th>
                        <th class="px-5 py-3">Supplier</th>
                        <th class="px-5 py-3">Jumlah</th>
                        <th class="px-5 py-3">Harga Beli</th>
                        <th class="px-5 py-3">Batch</th>
                        <th class="px-5 py-3">Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($masuks as $m)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 text-zinc-500">{{ $m->tanggal->format('d/m/Y') }}</td>
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $m->barang?->nama_barang ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $m->supplier?->nama_supplier ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-600">{{ $m->jumlah }}</td>
                            <td class="px-5 py-3 text-zinc-500">Rp{{ number_format($m->harga_beli, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-zinc-500">{{ $m->batch?->nomor_batch ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $m->user?->name ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500">Belum ada transaksi barang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $masuks->links() }}
    </div>
@endsection
