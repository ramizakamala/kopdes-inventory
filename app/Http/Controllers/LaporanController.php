<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Batch;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $jenis = in_array($request->query('jenis'), ['stok', 'masuk', 'keluar', 'kedaluwarsa', 'laba'], true)
            ? $request->query('jenis')
            : 'stok';
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        return view('laporan.index', $this->dataLaporan($jenis, $dari, $sampai) + [
            'jenis' => $jenis,
            'dari' => $dari,
            'sampai' => $sampai,
        ]);
    }

    public function cetak(Request $request): View
    {
        $jenis = in_array($request->query('jenis'), ['stok', 'masuk', 'keluar', 'kedaluwarsa', 'laba'], true)
            ? $request->query('jenis')
            : 'stok';
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        Laporan::create([
            'jenis_laporan' => $jenis,
            'periode' => $dari && $sampai ? "$dari s/d $sampai" : null,
            'tanggal_dibuat' => now(),
            'user_id' => auth()->id(),
        ]);

        return view('laporan.print', $this->dataLaporan($jenis, $dari, $sampai) + [
            'jenis' => $jenis,
            'dari' => $dari,
            'sampai' => $sampai,
        ]);
    }

    private function dataLaporan(string $jenis, ?string $dari, ?string $sampai): array
    {
        return match ($jenis) {
            'masuk' => $this->dataMasuk($dari, $sampai),
            'keluar' => $this->dataKeluar($dari, $sampai),
            'kedaluwarsa' => $this->dataKedaluwarsa(),
            'laba' => $this->dataLaba($dari, $sampai),
            default => $this->dataStok(),
        };
    }

    private function dataStok(): array
    {
        $barangs = Barang::with('kategori')->orderBy('nama_barang')->get();

        return [
            'rows' => $barangs,
            'totalNilai' => $barangs->sum(fn ($b) => $b->stok_saat_ini * $b->harga_beli),
            'totalStok' => $barangs->sum('stok_saat_ini'),
        ];
    }

    private function dataMasuk(?string $dari, ?string $sampai): array
    {
        $rows = BarangMasuk::with(['barang', 'supplier', 'user'])
            ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
            ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return [
            'rows' => $rows,
            'totalJumlah' => $rows->sum('jumlah'),
            'totalBiaya' => $rows->sum(fn ($r) => $r->jumlah * $r->harga_beli),
        ];
    }

    private function dataKeluar(?string $dari, ?string $sampai): array
    {
        $rows = BarangKeluar::with(['barang', 'user'])
            ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
            ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return [
            'rows' => $rows,
            'totalJumlah' => $rows->sum('jumlah'),
            'totalPendapatan' => $rows->sum(fn ($r) => $r->jumlah * $r->harga_jual),
        ];
    }

    private function dataKedaluwarsa(): array
    {
        $rows = Batch::with('barang')
            ->where('tanggal_kedaluwarsa', '<=', now()->addDays(30)->toDateString())
            ->orderBy('tanggal_kedaluwarsa')
            ->get();

        return ['rows' => $rows];
    }

    /**
     * Laba kotor per barang pada periode: omzet (harga jual) dikurangi HPP
     * (harga beli saat transaksi, untuk barang ber-batch sudah rata-rata
     * tertimbang batch yang benar-benar terpakai — lihat BarangKeluarController).
     */
    private function dataLaba(?string $dari, ?string $sampai): array
    {
        $transaksi = BarangKeluar::with('barang')
            ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
            ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
            ->orderBy('tanggal')
            ->orderBy('id')
            ->get();

        $rows = $transaksi
            ->groupBy('barang_id')
            ->map(function ($items) {
                $barang = $items->first()->barang;
                $qty = (int) $items->sum('jumlah');
                $omzet = (float) $items->sum(fn ($r) => $r->jumlah * $r->harga_jual);
                $hpp = (float) $items->sum(fn ($r) => $r->jumlah * (float) $r->hpp_satuan);
                $laba = $omzet - $hpp;

                return [
                    'kode' => $barang?->kode_barang ?? '—',
                    'nama' => $barang?->nama_barang ?? 'Barang terhapus',
                    'satuan' => $barang?->satuan ?? '',
                    'qty' => $qty,
                    'omzet' => $omzet,
                    'hpp' => $hpp,
                    'laba' => $laba,
                    'margin' => $omzet > 0 ? round($laba / $omzet * 100, 1) : null,
                ];
            })
            ->values()
            ->sortByDesc('laba')
            ->values();

        $totalOmzet = (float) $rows->sum('omzet');
        $totalHpp = (float) $rows->sum('hpp');

        return [
            'rows' => $rows,
            'totalJumlah' => (int) $rows->sum('qty'),
            'totalOmzet' => $totalOmzet,
            'totalHpp' => $totalHpp,
            'totalLaba' => $totalOmzet - $totalHpp,
            'totalMargin' => $totalOmzet > 0 ? round(($totalOmzet - $totalHpp) / $totalOmzet * 100, 1) : null,
        ];
    }
}
