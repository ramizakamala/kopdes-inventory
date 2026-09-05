@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('barang-keluar.index') }}" class="flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 input">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>

        <a href="{{ route('barang-keluar.create') }}"
           class="btn btn-primary">
            + Catat Barang Keluar
        </a>
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Barang</th>
                        <th class="px-5 py-3">Jumlah</th>
                        <th class="px-5 py-3">Sumber Batch</th>
                        <th class="px-5 py-3">Harga Jual</th>
                        <th class="px-5 py-3">Keterangan</th>
                        <th class="px-5 py-3">Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($keluars as $k)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 text-zinc-500">{{ $k->tanggal->format('d/m/Y') }}</td>
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $k->barang?->nama_barang ?? '—' }}</td>
                            <td class="px-5 py-3 font-semibold text-zinc-600">{{ $k->jumlah }}</td>
                            <td class="px-5 py-3">
                                @if ($k->detailBatch->isEmpty())
                                    <span class="text-xs text-zinc-300">—</span>
                                @else
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($k->detailBatch as $db)
                                            <span class="rounded-md bg-teal-50 px-2 py-0.5 font-mono text-[11px] font-semibold text-teal-800 ring-1 ring-inset ring-teal-100"
                                                  title="Batch {{ $db->batch?->nomor_batch ?? '?' }} — diambil {{ $db->jumlah }} unit (FEFO)">
                                                {{ $db->batch?->nomor_batch ?? '?' }} ×{{ $db->jumlah }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-zinc-500">Rp{{ number_format($k->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $k->keterangan ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $k->user?->name ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500">Belum ada transaksi barang keluar.</td>
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
