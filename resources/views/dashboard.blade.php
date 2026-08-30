@extends('layouts.app')

@section('title', 'Dashboard')

@section('subtitle', 'Ringkasan kondisi stok koperasi hari ini')

@section('content')
    @php
        $totalStatus = $stokAman + $stokMenipis + $stokHabis;
        $pAman = $totalStatus > 0 ? round($stokAman / $totalStatus * 100) : 0;
        $pMenipis = $totalStatus > 0 ? round($stokMenipis / $totalStatus * 100) : 0;
        $pHabis = max(0, 100 - $pAman - $pMenipis);
        $perluTindakan = $stokMenipis + $stokHabis;

        $nama = auth()->user()->name;
        $jam = (int) now()->format('G');
        $salam = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));
    @endphp

    {{-- ═══ Sapaan + aksi ═══ --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-stone-900">{{ $salam }}, {{ $nama }}</h2>
            <p class="mt-1 text-sm text-stone-500">
                Ada <span class="font-semibold text-amber-600">{{ $stokMenipis }} barang menipis</span> dan
                <span class="font-semibold text-red-600">{{ $stokHabis }} barang habis</span> yang perlu perhatian.
            </p>
        </div>
        <div class="flex flex-wrap gap-2.5">
            <a href="{{ route('monitoring.index') }}" class="btn btn-outline">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                Monitoring Stok
            </a>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('restock.index') }}" class="btn btn-primary">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    Lihat Restock
                </a>
            @endif
        </div>
    </div>

    {{-- ═══ Metric row ═══ --}}
    <div class="card overflow-hidden">
        <div class="grid grid-cols-2 md:grid-cols-4 md:divide-x md:divide-stone-100">
            <div class="p-5 md:p-6">
                <div class="stat-label">
                    <svg class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                    Total Barang
                </div>
                <div class="stat-value">{{ $totalBarang }}</div>
                <div class="stat-caption">jenis terdaftar</div>
            </div>
            <div class="p-5 md:p-6">
                <div class="stat-label">
                    <svg class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                    </svg>
                    Total Stok
                </div>
                <div class="stat-value">{{ number_format($totalStok) }}</div>
                <div class="stat-caption">unit keseluruhan</div>
            </div>
            <div class="p-5 md:p-6">
                <div class="stat-label">
                    <svg class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    Barang Masuk
                </div>
                <div class="stat-value">{{ $totalMasuk }}</div>
                <div class="stat-caption">transaksi masuk</div>
            </div>
            <div class="p-5 md:p-6">
                <div class="stat-label">
                    <svg class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-4.5-9L12 3m0 0L7.5 7.5M12 3v13.5" />
                    </svg>
                    Barang Keluar
                </div>
                <div class="stat-value">{{ $totalKeluar }}</div>
                <div class="stat-caption">transaksi keluar</div>
            </div>
        </div>
    </div>

    {{-- ═══ Status stok ═══ --}}
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="card flex items-center gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 text-green-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </div>
            <div class="min-w-0">
                <div class="text-sm font-medium text-stone-500">Stok Aman</div>
                <div class="text-2xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $stokAman }}</div>
            </div>
            <span class="ml-auto rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700">{{ $pAman }}%</span>
        </div>

        <div class="card flex items-center gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div class="min-w-0">
                <div class="text-sm font-medium text-stone-500">Stok Menipis</div>
                <div class="text-2xl font-extrabold tabular-nums tracking-tight text-amber-600">{{ $stokMenipis }}</div>
            </div>
            <span class="ml-auto rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">{{ $pMenipis }}%</span>
        </div>

        <div class="card flex items-center gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="min-w-0">
                <div class="text-sm font-medium text-stone-500">Stok Habis</div>
                <div class="text-2xl font-extrabold tabular-nums tracking-tight text-red-600">{{ $stokHabis }}</div>
            </div>
            <span class="ml-auto rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700">{{ $pHabis }}%</span>
        </div>
    </div>

    {{-- ═══ Bento: donut + info ═══ --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <div class="card p-6">
            <h3 class="text-[15px] font-bold text-stone-900">Komposisi Status Stok</h3>
            <div class="mt-6 flex items-center justify-center">
                <div class="relative h-40 w-40 rounded-full"
                     style="background: {{ $totalStatus > 0 ? "conic-gradient(#16a34a 0% {$pAman}%, #f59e0b {$pAman}% " . ($pAman + $pMenipis) . "%, #dc2626 " . ($pAman + $pMenipis) . "% 100%)" : '#e7e5e4' }}">
                    <div class="absolute inset-4 flex items-center justify-center rounded-full bg-white shadow-inner">
                        <div class="text-center">
                            <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $totalStatus }}</div>
                            <div class="text-[11px] font-semibold uppercase tracking-wider text-stone-400">total jenis</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 space-y-2.5 text-sm">
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 font-medium text-stone-600">
                        <span class="h-2.5 w-2.5 rounded-full bg-green-600"></span>Aman
                    </span>
                    <span class="font-bold tabular-nums text-stone-900">{{ $pAman }}%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 font-medium text-stone-600">
                        <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>Menipis
                    </span>
                    <span class="font-bold tabular-nums text-stone-900">{{ $pMenipis }}%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 font-medium text-stone-600">
                        <span class="h-2.5 w-2.5 rounded-full bg-red-600"></span>Habis
                    </span>
                    <span class="font-bold tabular-nums text-stone-900">{{ $pHabis }}%</span>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-[15px] font-bold text-stone-900">Perlu Tindakan</h3>
            <div class="mt-6 flex items-end gap-2">
                <div class="text-4xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $perluTindakan }}</div>
                <div class="pb-1 text-sm font-medium text-stone-500">barang menipis / habis</div>
            </div>
            <div class="mt-4 flex items-center gap-2.5 rounded-xl bg-amber-50 px-4 py-3 text-sm font-medium text-amber-700">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                Segera lakukan pengadaan sebelum stok kosong.
            </div>
            <div class="mt-4">
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('restock.index') }}" class="btn btn-primary w-full">Lihat Rekomendasi Restock</a>
                @else
                    <a href="{{ route('monitoring.index') }}" class="btn btn-outline w-full">Lihat Detail Stok</a>
                @endif
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-[15px] font-bold text-stone-900">Batch Hampir Kedaluwarsa</h3>
            <div class="mt-6 flex items-end gap-2">
                <div class="text-4xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $hampirKedaluwarsa }}</div>
                <div class="pb-1 text-sm font-medium text-stone-500">batch (30 hari)</div>
            </div>
            <div class="mt-4 flex items-center gap-2.5 rounded-xl bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Segera cek batch sebelum kedaluwarsa.
            </div>
            <div class="mt-4">
                <a href="{{ route('laporan.index', ['jenis' => 'kedaluwarsa']) }}" class="text-sm font-semibold text-teal-700 hover:text-teal-800">
                    Lihat laporan kedaluwarsa →
                </a>
            </div>
        </div>
    </div>

    {{-- ═══ Barang perlu perhatian ═══ --}}
    <div class="table-wrap mt-4">
        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-stone-100 px-5 py-4">
            <h3 class="text-[15px] font-bold text-stone-900">Barang Perlu Perhatian</h3>
            <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-500">{{ $barangKritis->count() }} barang kritis</span>
        </div>

        @if ($barangKritis->isEmpty())
            <p class="px-5 py-10 text-center text-[15px] text-stone-500">Tidak ada barang kritis. Stok aman semua.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-stone-100 bg-stone-50/60 text-left">
                            <th class="th">Barang</th>
                            <th class="th">Kategori</th>
                            <th class="th">Stok</th>
                            <th class="th">Min.</th>
                            <th class="th">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach ($barangKritis as $b)
                            <tr class="transition hover:bg-stone-50/70">
                                <td class="td font-semibold text-stone-900">{{ $b->nama_barang }}</td>
                                <td class="td text-stone-500">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                                <td class="td font-bold tabular-nums {{ $b->stok_saat_ini <= 0 ? 'text-red-600' : 'text-amber-600' }}">{{ $b->stok_saat_ini }}</td>
                                <td class="td tabular-nums text-stone-500">{{ $b->stok_minimum }}</td>
                                <td class="td"><x-status-badge :status="$b->status" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
