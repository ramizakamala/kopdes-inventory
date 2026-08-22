@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-5">
            <div class="text-sm text-zinc-500">Total Barang</div>
            <div class="mt-1 text-3xl font-semibold text-white">{{ $totalBarang }}</div>
        </div>
        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-5">
            <div class="text-sm text-zinc-500">Total Stok</div>
            <div class="mt-1 text-3xl font-semibold text-white">{{ number_format($totalStok) }}</div>
        </div>
        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-5">
            <div class="text-sm text-zinc-500">Barang Masuk</div>
            <div class="mt-1 text-3xl font-semibold text-white">{{ $totalMasuk }}</div>
        </div>
        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-5">
            <div class="text-sm text-zinc-500">Barang Keluar</div>
            <div class="mt-1 text-3xl font-semibold text-white">{{ $totalKeluar }}</div>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-5">
            <div class="text-sm text-zinc-500">Stok Aman</div>
            <div class="mt-1 text-2xl font-semibold text-emerald-400">{{ $stokAman }}</div>
        </div>
        <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-5">
            <div class="text-sm text-zinc-500">Stok Menipis</div>
            <div class="mt-1 text-2xl font-semibold text-amber-400">{{ $stokMenipis }}</div>
        </div>
        <div class="rounded-2xl border border-red-500/20 bg-red-500/5 p-5">
            <div class="text-sm text-zinc-500">Stok Habis</div>
            <div class="mt-1 text-2xl font-semibold text-red-400">{{ $stokHabis }}</div>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="flex items-center justify-between border-b border-white/5 px-5 py-4">
            <h2 class="text-sm font-semibold text-white">Barang Perlu Perhatian</h2>
            <span class="text-xs text-zinc-500">{{ $hampirKedaluwarsa }} batch hampir kedaluwarsa (30 hari)</span>
        </div>

        @if ($barangKritis->isEmpty())
            <p class="px-5 py-8 text-center text-sm text-zinc-500">Tidak ada barang kritis. Stok aman semua.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Kategori</th>
                            <th class="px-5 py-3">Stok</th>
                            <th class="px-5 py-3">Min.</th>
                            <th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($barangKritis as $b)
                            <tr>
                                <td class="px-5 py-3 font-medium text-white">{{ $b->nama_barang }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-300">{{ $b->stok_saat_ini }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $b->stok_minimum }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
