@extends('layouts.app')

@section('title', 'Rekomendasi Restock')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('restock.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">
            <button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-zinc-300 hover:bg-white/5">Cari</button>
        </form>
        <div class="rounded-lg border border-white/10 px-4 py-2 text-sm text-zinc-300">
            Total estimasi pengadaan: <span class="font-semibold text-white">{{ $totalRekomendasi }}</span> unit
        </div>
    </div>

    <div class="mb-4 rounded-xl border border-white/5 bg-white/[0.02] px-4 py-3 text-xs text-zinc-500">
        Barang dengan stok ≤ stok minimum. Estimasi jumlah pengadaan = 2 × stok minimum − stok saat ini.
        Rata-rata pemakaian dihitung dari 30 hari terakhir.
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
                        <th class="px-5 py-3">Kekurangan</th>
                        <th class="px-5 py-3">Rata² Pemakaian/hari</th>
                        <th class="px-5 py-3">Estimasi Pengadaan</th>
                        <th class="px-5 py-3">Supplier Terakhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($barangs as $b)
                        @php $kekurangan = max(0, $b->stok_minimum - $b->stok_saat_ini); @endphp
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 font-mono text-xs text-zinc-400">{{ $b->kode_barang }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $b->nama_barang }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                            <td class="px-5 py-3 {{ $b->stok_saat_ini <= 0 ? 'font-semibold text-red-400' : 'font-semibold text-amber-300' }}">{{ $b->stok_saat_ini }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $b->stok_minimum }}</td>
                            <td class="px-5 py-3 text-zinc-300">{{ $kekurangan }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ round($b->keluar_30hari / 30, 2) }}</td>
                            <td class="px-5 py-3 font-semibold text-emerald-300">{{ max(0, ($b->stok_minimum * 2) - $b->stok_saat_ini) }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $supplierTerakhir[$b->id] ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-5 py-10 text-center text-zinc-500">Semua barang dalam kondisi stok aman. 🎉</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
