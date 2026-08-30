@extends('layouts.app')

@section('title', 'Rekomendasi Restock')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('restock.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 input">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
        <div class="rounded-xl border border-stone-200/80 bg-stone-50 px-4 py-2.5 text-sm text-stone-600">
            Total estimasi pengadaan: <span class="font-bold text-stone-900">{{ $totalRekomendasi }}</span> unit
        </div>
    </div>

    <div class="mb-4 rounded-xl border border-stone-200/80 bg-white px-4 py-3 text-[13px] text-stone-500 shadow-sm">
        Barang dengan stok ≤ <span class="font-semibold text-stone-700">ROP</span> (Reorder Point).
        ROP = (rata² pemakaian/hari × lead time) + safety stock, minimal stok minimum.
        Estimasi jumlah pengadaan = 2 × ROP − stok saat ini. Rata-rata pemakaian dihitung dari 30 hari terakhir.
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Kode</th>
                        <th class="px-5 py-3">Nama Barang</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">Stok</th>
                        <th class="px-5 py-3">ROP</th>
                        <th class="px-5 py-3">Kekurangan</th>
                        <th class="px-5 py-3">Rata² Pemakaian/hari</th>
                        <th class="px-5 py-3">Estimasi Pengadaan</th>
                        <th class="px-5 py-3">Supplier Terakhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($barangs as $b)
                        @php $rop = $ropMap[$b->id]; @endphp
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 font-mono text-xs text-zinc-500">{{ $b->kode_barang }}</td>
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $b->nama_barang }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                            <td class="px-5 py-3 {{ $b->stok_saat_ini <= 0 ? 'font-semibold text-red-600' : 'font-semibold text-amber-600' }}">{{ $b->stok_saat_ini }}</td>
                            <td class="px-5 py-3">
                                <span class="font-semibold text-zinc-900">{{ $rop }}</span>
                                <span class="block text-[10px] text-zinc-600">LT {{ $b->lead_time_hari }} hr · SS {{ $b->safety_stock }}</span>
                            </td>
                            <td class="px-5 py-3 text-zinc-600">{{ max(0, $rop - $b->stok_saat_ini) }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ round($b->keluar_30hari / 30, 2) }}</td>
                            <td class="px-5 py-3 font-bold text-teal-700">{{ max(0, ($rop * 2) - $b->stok_saat_ini) }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $supplierTerakhir[$b->id] ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-5 py-10 text-center text-zinc-500">Semua barang dalam kondisi stok aman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
