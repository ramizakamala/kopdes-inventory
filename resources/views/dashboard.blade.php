@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $totalStatus = $stokAman + $stokMenipis + $stokHabis;
        $pAman = $totalStatus > 0 ? round($stokAman / $totalStatus * 100) : 0;
        $pMenipis = $totalStatus > 0 ? round($stokMenipis / $totalStatus * 100) : 0;
        $pHabis = max(0, 100 - $pAman - $pMenipis);
        $perluTindakan = $stokMenipis + $stokHabis;
    @endphp

    {{-- Bento: stat utama --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-6">
        <div class="card xl:col-span-2 p-5">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Total Barang</div>
                    <div class="mt-2 text-4xl font-bold tracking-tight text-zinc-900">{{ $totalBarang }}</div>
                    <div class="mt-1 text-xs text-zinc-500">jenis barang terdaftar</div>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="card xl:col-span-2 p-5">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Total Stok</div>
                    <div class="mt-2 text-4xl font-bold tracking-tight text-zinc-900">{{ number_format($totalStok) }}</div>
                    <div class="mt-1 text-xs text-zinc-500">unit keseluruhan</div>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="card xl:col-span-1 p-5">
            <div class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Barang Masuk</div>
            <div class="mt-2 text-3xl font-bold tracking-tight text-zinc-900">{{ $totalMasuk }}</div>
            <div class="mt-1 text-xs text-zinc-500">transaksi</div>
        </div>

        <div class="card xl:col-span-1 p-5">
            <div class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Barang Keluar</div>
            <div class="mt-2 text-3xl font-bold tracking-tight text-zinc-900">{{ $totalKeluar }}</div>
            <div class="mt-1 text-xs text-zinc-500">transaksi</div>
        </div>
    </div>

    {{-- Bento: status stok --}}
    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3 xl:grid-cols-6">
        <div class="card xl:col-span-2 border-green-100 bg-green-50/50 p-5">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-green-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-green-800">Stok Aman</div>
                    <div class="text-3xl font-bold tracking-tight text-green-700">{{ $stokAman }}</div>
                </div>
            </div>
        </div>

        <div class="card xl:col-span-2 border-amber-100 bg-amber-50/50 p-5">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-amber-700">Stok Menipis</div>
                    <div class="text-3xl font-bold tracking-tight text-amber-600">{{ $stokMenipis }}</div>
                </div>
            </div>
        </div>

        <div class="card xl:col-span-2 border-red-100 bg-red-50/50 p-5">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-red-700">Stok Habis</div>
                    <div class="text-3xl font-bold tracking-tight text-red-600">{{ $stokHabis }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bento: donut + info --}}
    <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-3">
        <div class="card p-6">
            <h2 class="text-sm font-semibold text-zinc-900">Komposisi Status Stok</h2>
            <div class="mt-5 flex items-center justify-center">
                <div class="relative h-40 w-40 rounded-full"
                     style="background: {{ $totalStatus > 0 ? "conic-gradient(#16a34a 0% {$pAman}%, #f59e0b {$pAman}% " . ($pAman + $pMenipis) . "%, #dc2626 " . ($pAman + $pMenipis) . "% 100%)" : '#e4e4e7' }}">
                    <div class="absolute inset-4 flex items-center justify-center rounded-full bg-white shadow-inner">
                        <div class="text-center">
                            <div class="text-2xl font-bold tracking-tight text-zinc-900">{{ $totalStatus }}</div>
                            <div class="text-[10px] font-semibold uppercase tracking-wider text-zinc-500">total jenis</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 space-y-2 text-sm">
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-zinc-600"><span class="h-2.5 w-2.5 rounded-full bg-green-600"></span>Aman</span>
                    <span class="font-semibold text-zinc-900">{{ $pAman }}%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-zinc-600"><span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>Menipis</span>
                    <span class="font-semibold text-zinc-900">{{ $pMenipis }}%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-zinc-600"><span class="h-2.5 w-2.5 rounded-full bg-red-600"></span>Habis</span>
                    <span class="font-semibold text-zinc-900">{{ $pHabis }}%</span>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <h2 class="text-sm font-semibold text-zinc-900">Batch Hampir Kedaluwarsa</h2>
            <div class="mt-5 flex items-end gap-2">
                <div class="text-4xl font-bold tracking-tight text-zinc-900">{{ $hampirKedaluwarsa }}</div>
                <div class="pb-1 text-sm text-zinc-500">batch (30 hari)</div>
            </div>
            <div class="mt-4 flex items-center gap-2 rounded-xl bg-amber-50 px-4 py-3 text-sm text-amber-700">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                Segera cek batch sebelum kedaluwarsa.
            </div>
        </div>

        <div class="card p-6">
            <h2 class="text-sm font-semibold text-zinc-900">Perlu Tindakan</h2>
            <div class="mt-5 flex items-end gap-2">
                <div class="text-4xl font-bold tracking-tight text-zinc-900">{{ $perluTindakan }}</div>
                <div class="pb-1 text-sm text-zinc-500">barang menipis/habis</div>
            </div>
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ route('restock.index') }}" class="btn btn-primary">Lihat Restock</a>
                <a href="{{ route('monitoring.index') }}" class="btn btn-outline">Monitoring</a>
            </div>
        </div>
    </div>

    {{-- Barang perlu perhatian --}}
    <div class="card mt-5 overflow-hidden">
        <div class="flex items-center justify-between border-b border-zinc-100 px-5 py-4">
            <h2 class="text-sm font-semibold text-zinc-900">Barang Perlu Perhatian</h2>
            <span class="text-xs text-zinc-500">{{ $hampirKedaluwarsa }} batch hampir kedaluwarsa (30 hari)</span>
        </div>

        @if ($barangKritis->isEmpty())
            <p class="px-5 py-8 text-center text-sm text-zinc-500">Tidak ada barang kritis. Stok aman semua.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Kategori</th>
                            <th class="px-5 py-3">Stok</th>
                            <th class="px-5 py-3">Min.</th>
                            <th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($barangKritis as $b)
                            <tr class="transition hover:bg-zinc-50/60">
                                <td class="px-5 py-3 font-medium text-zinc-900">{{ $b->nama_barang }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                                <td class="px-5 py-3 font-semibold text-zinc-800">{{ $b->stok_saat_ini }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $b->stok_minimum }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
