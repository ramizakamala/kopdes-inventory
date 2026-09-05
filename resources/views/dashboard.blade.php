@extends('layouts.app')

@section('title', 'Dashboard')

@section('subtitle', 'Ringkasan kondisi stok koperasi hari ini')

@section('content')
    @php
        $totalStatus = max(1, $stokAman + $stokMenipis + $stokHabis);
        $pAman = round($stokAman / $totalStatus * 100);
        $pMenipis = round($stokMenipis / $totalStatus * 100);
        $pHabis = max(0, 100 - $pAman - $pMenipis);

        $deltaBadge = function ($delta) {
            if ($delta === null) return '<span class="inline-flex items-center gap-1 rounded-full bg-stone-100 px-2 py-0.5 text-xs font-semibold text-stone-500">baru</span>';
            $up = $delta >= 0;
            $cls = $up ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600';
            $arr = $up ? '↑' : '↓';
            return '<span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-bold ' . $cls . '">' . $arr . ' ' . abs($delta) . '%</span>';
        };
    @endphp

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="card flex items-start gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-medium text-stone-500">Total Barang</div>
                <div class="mt-1 text-3xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $totalBarang }}</div>
                <div class="mt-1.5 text-xs text-stone-400">jenis terdaftar</div>
            </div>
        </div>

        <div class="card flex items-start gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-medium text-stone-500">Total Stok</div>
                <div class="mt-1 text-3xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ number_format($totalStok) }}</div>
                <div class="mt-1.5 text-xs text-stone-400">unit keseluruhan</div>
            </div>
        </div>

        <div class="card flex items-start gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 text-green-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-medium text-stone-500">Barang Masuk</div>
                <div class="mt-1 text-3xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $totalMasuk }}</div>
                <div class="mt-1.5 flex items-center gap-2">
                    {!! $deltaBadge($deltaMasuk) !!}
                    <span class="text-xs text-stone-400">vs bulan lalu</span>
                </div>
            </div>
        </div>

        <div class="card flex items-start gap-4 p-5">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-4.5-9L12 3m0 0L7.5 7.5M12 3v13.5" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-medium text-stone-500">Barang Keluar</div>
                <div class="mt-1 text-3xl font-extrabold tabular-nums tracking-tight text-stone-900">{{ $totalKeluar }}</div>
                <div class="mt-1.5 flex items-center gap-2">
                    {!! $deltaBadge($deltaKeluar) !!}
                    <span class="text-xs text-stone-400">vs bulan lalu</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ Konten utama: daftar kritis + panel samping ═══ --}}
    <div class="mt-4 grid grid-cols-1 gap-4 xl:grid-cols-3">

        {{-- Barang perlu perhatian --}}
        <div class="table-wrap xl:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-stone-100 px-5 py-4">
                <div>
                    <h3 class="text-[15px] font-bold text-stone-900">Barang Perlu Perhatian</h3>
                    <p class="mt-0.5 text-xs text-stone-400">Stok di bawah atau sama dengan batas minimum</p>
                </div>
                <div class="flex items-center gap-2">
                    @if ($hampirKedaluwarsa > 0)
                        <a href="{{ route('laporan.index', ['jenis' => 'kedaluwarsa']) }}"
                           class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                            {{ $hampirKedaluwarsa }} batch kedaluwarsa
                        </a>
                    @endif
                    @if (auth()->user()->canViewLaporan())
                        <a href="{{ route('monitoring.index') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800">Lihat semua →</a>
                    @else
                        <a href="{{ route('barang.index') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800">Lihat semua →</a>
                    @endif
                </div>
            </div>

            @if ($barangKritis->isEmpty())
                <p class="px-5 py-12 text-center text-sm text-stone-500">Tidak ada barang kritis. Stok aman semua.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-stone-100 bg-stone-50/60 text-left">
                                <th class="th">Barang</th>
                                <th class="th">Kategori</th>
                                <th class="th">Stok</th>
                                <th class="th">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach ($barangKritis as $b)
                                <tr class="transition hover:bg-stone-50/70">
                                    <td class="td font-semibold text-stone-900">{{ $b->nama_barang }}</td>
                                    <td class="td text-stone-500">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                                    <td class="td font-bold tabular-nums {{ $b->stok_saat_ini <= 0 ? 'text-red-600' : 'text-amber-600' }}">{{ $b->stok_saat_ini }} <span class="font-normal text-stone-400">/ min {{ $b->stok_minimum }}</span></td>
                                    <td class="td"><x-status-badge :status="$b->status" /></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Panel samping --}}
        <div class="flex flex-col gap-4">
            {{-- Status stok --}}
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-[15px] font-bold text-stone-900">Status Stok</h3>
                    <span class="rounded-full bg-stone-100 px-2.5 py-0.5 text-xs font-semibold text-stone-500">{{ $stokAman + $stokMenipis + $stokHabis }} barang</span>
                </div>
                <div class="mt-4 space-y-3.5">
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-stone-600">Aman</span>
                            <span class="font-bold tabular-nums text-stone-900">{{ $stokAman }} <span class="text-xs font-normal text-stone-400">({{ $pAman }}%)</span></span>
                        </div>
                        <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                            <div class="h-full rounded-full bg-emerald-500" style="width: {{ $pAman }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-stone-600">Menipis</span>
                            <span class="font-bold tabular-nums text-stone-900">{{ $stokMenipis }} <span class="text-xs font-normal text-stone-400">({{ $pMenipis }}%)</span></span>
                        </div>
                        <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                            <div class="h-full rounded-full bg-amber-500" style="width: {{ $pMenipis }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-stone-600">Habis</span>
                            <span class="font-bold tabular-nums text-stone-900">{{ $stokHabis }} <span class="text-xs font-normal text-stone-400">({{ $pHabis }}%)</span></span>
                        </div>
                        <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                            <div class="h-full rounded-full bg-red-500" style="width: {{ max(2, $pHabis) }}%"></div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('restock.index') }}" class="btn btn-primary mt-5 w-full">Lihat Rekomendasi Restock</a>
                @else
                    <a href="{{ route('monitoring.index') }}" class="btn btn-outline mt-5 w-full">Lihat Detail Stok</a>
                @endif
            </div>

            {{-- Aktivitas terakhir --}}
            <div class="card p-5">
                <h3 class="text-[15px] font-bold text-stone-900">Aktivitas Terakhir</h3>
                <ul class="mt-3 divide-y divide-stone-100">
                    @forelse ($aktivitasTerakhir as $a)
                        <li class="flex items-center gap-3 py-2.5">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ $a['tipe'] === 'masuk' ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600' }}">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['tipe'] === 'masuk' ? 'M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5' : 'M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-4.5-9L12 3m0 0L7.5 7.5M12 3v13.5' }}" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <div class="truncate text-sm font-semibold text-stone-900">{{ $a['nama'] }}</div>
                                <div class="text-xs capitalize text-stone-400">{{ $a['tipe'] }} {{ $a['jumlah'] }} unit</div>
                            </div>
                            <span class="shrink-0 text-xs tabular-nums text-stone-400">{{ \Carbon\Carbon::parse($a['tanggal'])->format('d M') }}</span>
                        </li>
                    @empty
                        <li class="py-6 text-center text-sm text-stone-400">Belum ada aktivitas.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- ═══ Tren pemakaian 6 bulan ═══ --}}
    <div class="card mt-4 p-5">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h3 class="text-[15px] font-bold text-stone-900">Tren Pemakaian 6 Bulan</h3>
                <p class="mt-0.5 text-xs text-stone-400">Unit keluar per bulan dari transaksi asli — garis putus-putus = batas reorder point & stok minimum</p>
            </div>
            <select id="tren-select" class="input w-full sm:w-80">
                @foreach ($trenBarang as $item)
                    <option value="{{ $item['id'] }}" @selected((string) $defaultTrenId === (string) $item['id'])>{{ $item['nama'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4 grid grid-cols-1 gap-6 lg:grid-cols-4">
            <div class="lg:col-span-3">
                <svg id="tren-chart" viewBox="0 0 640 230" class="w-full" role="img"
                     aria-label="Grafik tren pemakaian barang"></svg>
                <div class="mt-1 flex items-center gap-4 text-[11px] text-stone-400">
                    <span class="inline-flex items-center gap-1.5"><span class="h-2 w-2 rounded-sm bg-teal-700"></span>pemakaian (keluar)</span>
                    <span class="inline-flex items-center gap-1.5"><span class="inline-block h-0 w-5 border-t-2 border-dashed border-amber-500"></span>reorder point</span>
                    <span class="inline-flex items-center gap-1.5"><span class="inline-block h-0 w-5 border-t-2 border-dashed border-red-400"></span>stok minimum</span>
                </div>
            </div>
            <div class="flex flex-col justify-center gap-2 rounded-xl bg-stone-50 p-4 text-sm" id="tren-meta"></div>
        </div>
    </div>

    <script>
        var TREN = @json([
            'months' => $bulanTren->map(fn ($b) => $b->format('M'))->values()->all(),
            'items' => $trenBarang->all(),
        ]);

        function trenRender(id) {
            var item = null;
            TREN.items.forEach(function (it) { if (String(it.id) === String(id)) item = it; });
            if (!item) return;

            var W = 640, H = 230, padL = 6, padR = 6, padT = 14, padB = 28;
            var plotW = W - padL - padR, plotH = H - padT - padB;
            var vals = item.usage.slice();
            var maxV = Math.max(1, Math.max.apply(null, vals.concat([item.rop, item.min])) * 1.15);
            var n = TREN.months.length;
            var slot = plotW / n, barW = Math.min(46, slot * 0.5);
            var y = function (v) { return padT + plotH - (v / maxV) * plotH; };

            var s = '';
            // garis bantu + label sumbu kiri (0, setengah, maksimal)
            [0, 0.5, 1].forEach(function (f) {
                var gy = padT + plotH - f * plotH;
                s += '<line x1="' + padL + '" y1="' + gy + '" x2="' + (W - padR) + '" y2="' + gy + '" stroke="#e7e5e4" stroke-width="1"/>';
                s += '<text x="' + (padL + 2) + '" y="' + (gy - 4) + '" font-size="10" fill="#a8a29e">' + Math.round(maxV * f) + '</text>';
            });
            // garis batas ROP & stok minimum
            var yRop = y(item.rop), yMin = y(item.min);
            if (item.rop > 0) s += '<line x1="' + padL + '" y1="' + yRop + '" x2="' + (W - padR) + '" y2="' + yRop + '" stroke="#f59e0b" stroke-width="1.5" stroke-dasharray="5 4"/>';
            if (item.min > 0) s += '<line x1="' + padL + '" y1="' + yMin + '" x2="' + (W - padR) + '" y2="' + yMin + '" stroke="#f87171" stroke-width="1.5" stroke-dasharray="5 4"/>';
            // batang + label bulan
            vals.forEach(function (v, i) {
                var cx = padL + slot * i + slot / 2;
                var bh = (v / maxV) * plotH;
                if (v > 0) {
                    s += '<rect x="' + (cx - barW / 2) + '" y="' + (padT + plotH - bh) + '" width="' + barW + '" height="' + bh + '" rx="6" fill="#0f766e"/>';
                    s += '<text x="' + cx + '" y="' + (padT + plotH - bh - 6) + '" font-size="11" font-weight="700" fill="#0f766e" text-anchor="middle">' + v + '</text>';
                } else {
                    s += '<line x1="' + (cx - 5) + '" y1="' + (padT + plotH - 6) + '" x2="' + (cx + 5) + '" y2="' + (padT + plotH + 2) + '" stroke="#d6d3d1" stroke-width="1.5"/>';
                }
                s += '<text x="' + cx + '" y="' + (H - 8) + '" font-size="11" fill="#78716c" text-anchor="middle">' + TREN.months[i] + '</text>';
            });
            document.getElementById('tren-chart').innerHTML = s;

            // meta stok di samping grafik
            var meta = document.getElementById('tren-meta');
            var est;
            if (item.stok <= 0) est = '<span class="font-bold text-red-600">stok habis</span>';
            else if (item.estimasiHabis === null) est = '<span class="text-stone-400">belum ada data pemakaian 30 hari</span>';
            else est = '± ' + item.estimasiHabis + ' hari';
            meta.innerHTML =
                '<div class="flex justify-between"><span class="text-stone-500">Stok saat ini</span><span class="font-bold text-stone-900">' + item.stok + ' ' + item.satuan + '</span></div>' +
                '<div class="flex justify-between"><span class="text-stone-500">Pemakaian rata-rata</span><span class="font-bold text-stone-900">' + item.rataHarian + ' /hari</span></div>' +
                '<div class="flex justify-between"><span class="text-stone-500">Estimasi cukup sampai</span><span class="font-bold ' + (item.stok <= 0 || (item.estimasiHabis !== null && item.estimasiHabis <= 7) ? 'text-amber-600' : 'text-stone-900') + '">' + est + '</span></div>' +
                '<div class="flex justify-between"><span class="text-stone-500">Reorder point (ROP)</span><span class="font-bold text-amber-600">' + item.rop + ' ' + item.satuan + '</span></div>' +
                '<div class="flex justify-between"><span class="text-stone-500">Stok minimum</span><span class="font-bold text-red-400">' + item.min + ' ' + item.satuan + '</span></div>';
        }

        document.getElementById('tren-select').addEventListener('change', function () {
            trenRender(this.value);
        });
        trenRender(@json($defaultTrenId));
    </script>
@endsection
