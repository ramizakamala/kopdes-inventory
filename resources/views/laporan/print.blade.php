<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan — SIMPERDES</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #111; margin: 32px; font-size: 13px; }
        h1 { font-size: 18px; margin: 0 0 2px; }
        .sub { color: #555; margin-bottom: 16px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th { background: #f1f1f1; text-align: left; padding: 8px 10px; font-size: 11px; text-transform: uppercase; letter-spacing: .04em; }
        td { padding: 7px 10px; border-bottom: 1px solid #e2e2e2; }
        tfoot td { font-weight: 700; border-top: 2px solid #999; background: #fafafa; }
        .ta-r { text-align: right; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 99px; font-size: 11px; }
        .aman { background: #dcfce7; color: #166534; }
        .menipis { background: #fef3c7; color: #92400e; }
        .habis { background: #fee2e2; color: #991b1b; }
        .kedaluwarsa { background: #fee2e2; color: #991b1b; }
        .mendekati { background: #fef3c7; color: #92400e; }
        .ttd { margin-top: 56px; display: flex; justify-content: space-between; width: 100%; }
        .ttd div { width: 40%; text-align: center; font-size: 12px; }
        .ttd .nama { margin-top: 64px; font-weight: 600; text-decoration: underline; }
        @media print { body { margin: 16px; } .no-print { display: none; } }
    </style>
</head>
<body>
    <button class="no-print" onclick="window.print()" style="position:fixed;top:16px;right:16px;padding:8px 16px;border:1px solid #999;border-radius:8px;background:#fff;cursor:pointer;">🖨 Cetak</button>

    <h1>SIMPERDES — Laporan {{ match ($jenis) { 'stok' => 'Persediaan', 'masuk' => 'Barang Masuk', 'keluar' => 'Barang Keluar', 'laba' => 'Laba Kotor', 'kedaluwarsa' => 'Kedaluwarsa', default => '' } }}</h1>
    <div class="sub">
        Koperasi Desa · Dicetak {{ now()->format('d M Y H:i') }} oleh {{ auth()->user()->name }}
        @if ($dari && $sampai) · Periode {{ \Carbon\Carbon::parse($dari)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }} @endif
    </div>

    <table>
        <thead>
            <tr>
                @if ($jenis === 'stok')
                    <th>Kode</th><th>Nama Barang</th><th>Kategori</th><th class="ta-r">Stok</th><th class="ta-r">Min.</th><th>Status</th><th class="ta-r">Nilai Stok</th>
                @elseif ($jenis === 'masuk')
                    <th>Tanggal</th><th>Barang</th><th>Supplier</th><th class="ta-r">Jumlah</th><th class="ta-r">Harga Beli</th><th class="ta-r">Total</th><th>Oleh</th>
                @elseif ($jenis === 'keluar')
                    <th>Tanggal</th><th>Barang</th><th class="ta-r">Jumlah</th><th class="ta-r">Harga Jual</th><th class="ta-r">Total</th><th>Keterangan</th><th>Oleh</th>
                @elseif ($jenis === 'laba')
                    <th>Barang</th><th class="ta-r">Terjual</th><th class="ta-r">Omzet</th><th class="ta-r">HPP</th><th class="ta-r">Laba Kotor</th><th class="ta-r">Margin</th>
                @else
                    <th>Batch</th><th>Barang</th><th>Tanggal Masuk</th><th>Kedaluwarsa</th><th class="ta-r">Jumlah</th><th>Status</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $r)
                <tr>
                    @if ($jenis === 'stok')
                        <td>{{ $r->kode_barang }}</td><td>{{ $r->nama_barang }}</td><td>{{ $r->kategori?->nama_kategori ?? '—' }}</td>
                        <td class="ta-r">{{ $r->stok_saat_ini }}</td><td class="ta-r">{{ $r->stok_minimum }}</td>
                        <td><span class="badge {{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                        <td class="ta-r">Rp{{ number_format($r->stok_saat_ini * $r->harga_beli, 0, ',', '.') }}</td>
                    @elseif ($jenis === 'masuk')
                        <td>{{ $r->tanggal->format('d M Y') }}</td><td>{{ $r->barang?->nama_barang ?? '—' }}</td><td>{{ $r->supplier?->nama_supplier ?? '—' }}</td>
                        <td class="ta-r">{{ $r->jumlah }}</td><td class="ta-r">Rp{{ number_format($r->harga_beli, 0, ',', '.') }}</td>
                        <td class="ta-r">Rp{{ number_format($r->jumlah * $r->harga_beli, 0, ',', '.') }}</td><td>{{ $r->user?->name ?? '—' }}</td>
                    @elseif ($jenis === 'keluar')
                        <td>{{ $r->tanggal->format('d M Y') }}</td><td>{{ $r->barang?->nama_barang ?? '—' }}</td>
                        <td class="ta-r">{{ $r->jumlah }}</td><td class="ta-r">Rp{{ number_format($r->harga_jual, 0, ',', '.') }}</td>
                        <td class="ta-r">Rp{{ number_format($r->jumlah * $r->harga_jual, 0, ',', '.') }}</td><td>{{ $r->keterangan ?? '—' }}</td><td>{{ $r->user?->name ?? '—' }}</td>
                    @elseif ($jenis === 'laba')
                        <td>{{ $r['nama'] }}<br><small style="color:#888">{{ $r['kode'] }}</small></td>
                        <td class="ta-r">{{ number_format($r['qty']) }} {{ $r['satuan'] }}</td>
                        <td class="ta-r">Rp{{ number_format($r['omzet'], 0, ',', '.') }}</td>
                        <td class="ta-r">Rp{{ number_format($r['hpp'], 0, ',', '.') }}</td>
                        <td class="ta-r">Rp{{ number_format($r['laba'], 0, ',', '.') }}</td>
                        <td class="ta-r">{{ $r['margin'] !== null ? number_format($r['margin'], 1, ',', '.') . '%' : '—' }}</td>
                    @else
                        @php $lewat = $r->tanggal_kedaluwarsa->lt(now()->startOfDay()); @endphp
                        <td>{{ $r->nomor_batch }}</td><td>{{ $r->barang?->nama_barang ?? '—' }}</td>
                        <td>{{ $r->tanggal_masuk?->format('d M Y') ?? '—' }}</td><td>{{ $r->tanggal_kedaluwarsa->format('d M Y') }}</td>
                        <td class="ta-r">{{ $r->jumlah }}</td>
                        <td><span class="badge {{ $lewat ? 'kedaluwarsa' : 'mendekati' }}">{{ $lewat ? 'Kedaluwarsa' : 'Mendekati' }}</span></td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;color:#777;padding:24px;">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
        @if ($jenis === 'stok')
            <tfoot><tr><td colspan="6" class="ta-r">Total stok {{ $totalStok }} unit · Total nilai stok</td><td class="ta-r">Rp{{ number_format($totalNilai, 0, ',', '.') }}</td></tr></tfoot>
        @elseif ($jenis === 'masuk')
            <tfoot><tr><td colspan="5" class="ta-r">Total {{ $totalJumlah }} unit · Total biaya</td><td class="ta-r">Rp{{ number_format($totalBiaya, 0, ',', '.') }}</td><td></td></tr></tfoot>
        @elseif ($jenis === 'keluar')
            <tfoot><tr><td colspan="4" class="ta-r">Total {{ $totalJumlah }} unit · Total pendapatan</td><td class="ta-r">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td><td colspan="2"></td></tr></tfoot>
        @elseif ($jenis === 'laba')
            <tfoot><tr><td colspan="2" class="ta-r">Total {{ number_format($totalJumlah) }} unit</td><td class="ta-r">Rp{{ number_format($totalOmzet, 0, ',', '.') }}</td><td class="ta-r">Rp{{ number_format($totalHpp, 0, ',', '.') }}</td><td class="ta-r">Rp{{ number_format($totalLaba, 0, ',', '.') }}</td><td class="ta-r">{{ $totalMargin !== null ? number_format($totalMargin, 1, ',', '.') . '%' : '—' }}</td></tr></tfoot>
        @endif
    </table>

    <div class="ttd">
        <div>Mengetahui,<br>Pimpinan Koperasi<div class="nama">( ____________________ )</div></div>
        <div>Dicetak oleh,<br>{{ auth()->user()->name }}<div class="nama">( ____________________ )</div></div>
    </div>
</body>
</html>
