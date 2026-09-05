<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Batch;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBarang = Barang::count();
        $totalStok = (int) Barang::sum('stok_saat_ini');

        $stokHabis = Barang::where('stok_saat_ini', '<=', 0)->count();
        $stokMenipis = Barang::whereColumn('stok_saat_ini', '<', 'stok_minimum')
            ->where('stok_saat_ini', '>', 0)
            ->count();
        $stokAman = max(0, $totalBarang - $stokHabis - $stokMenipis);

        $hampirKedaluwarsa = Batch::where('tanggal_kedaluwarsa', '<=', now()->addDays(30))
            ->where('tanggal_kedaluwarsa', '>=', now()->startOfDay())
            ->count();

        $totalMasuk = BarangMasuk::count();
        $totalKeluar = BarangKeluar::count();

        // delta bulan ini vs bulan lalu (untuk badge ↑↓ di kartu statistik)
        $bulanIni = now()->startOfMonth();
        $bulanLalu = now()->subMonth()->startOfMonth();
        $masukBulanIni = BarangMasuk::whereBetween('tanggal', [$bulanIni, now()])->count();
        $masukBulanLalu = BarangMasuk::whereBetween('tanggal', [$bulanLalu, $bulanIni->copy()->subSecond()])->count();
        $keluarBulanIni = BarangKeluar::whereBetween('tanggal', [$bulanIni, now()])->count();
        $keluarBulanLalu = BarangKeluar::whereBetween('tanggal', [$bulanLalu, $bulanIni->copy()->subSecond()])->count();
        $deltaMasuk = $masukBulanLalu > 0 ? (int) round(($masukBulanIni - $masukBulanLalu) / $masukBulanLalu * 100) : null;
        $deltaKeluar = $keluarBulanLalu > 0 ? (int) round(($keluarBulanIni - $keluarBulanLalu) / $keluarBulanLalu * 100) : null;

        $barangKritis = Barang::whereColumn('stok_saat_ini', '<=', 'stok_minimum')
            ->with('kategori')
            ->orderBy('stok_saat_ini')
            ->take(6)
            ->get();

        // aktivitas terakhir (masuk + keluar digabung, 6 terbaru)
        $masukBaru = BarangMasuk::with('barang')->latest('tanggal')->take(3)->get()
            ->map(fn ($m) => ['tipe' => 'masuk', 'nama' => $m->barang?->nama_barang ?? '-', 'jumlah' => $m->jumlah, 'tanggal' => $m->tanggal]);
        $keluarBaru = BarangKeluar::with('barang')->latest('tanggal')->take(3)->get()
            ->map(fn ($k) => ['tipe' => 'keluar', 'nama' => $k->barang?->nama_barang ?? '-', 'jumlah' => $k->jumlah, 'tanggal' => $k->tanggal]);
        $aktivitasTerakhir = $masukBaru->concat($keluarBaru)->sortByDesc('tanggal')->take(6)->values();

        // ═══ Tren pemakaian 6 bulan (unit keluar per bulan, data transaksi asli) ═══
        $bulanTren = collect(range(5, 0))->map(fn ($i) => now()->startOfMonth()->subMonths($i));
        $pemakaian = BarangKeluar::where('tanggal', '>=', $bulanTren->first()->toDateString())
            ->get(['barang_id', 'tanggal', 'jumlah'])
            ->groupBy('barang_id')
            ->map(fn ($rows) => $rows->groupBy(fn ($r) => $r->tanggal->format('Y-m'))->map->sum('jumlah'));

        $trenBarang = Barang::with('kategori')->orderBy('nama_barang')->get()
            ->map(function ($b) use ($pemakaian, $bulanTren) {
                $usage = $bulanTren->map(fn ($bln) => (int) ($pemakaian[$b->id][$bln->format('Y-m')] ?? 0));
                $rataHarian = $b->keluar30Hari() / 30;

                return [
                    'id' => $b->id,
                    'nama' => $b->nama_barang,
                    'satuan' => $b->satuan,
                    'stok' => (int) $b->stok_saat_ini,
                    'min' => (int) $b->stok_minimum,
                    'rop' => $b->rop(),
                    'usage' => $usage->values()->all(),
                    'estimasiHabis' => $rataHarian > 0 ? (int) floor($b->stok_saat_ini / $rataHarian) : null,
                    'rataHarian' => round($rataHarian, 1),
                ];
            })
            ->values();

        // default grafik: barang yang paling aktif (paling sering keluar), bukan barang mati
        $defaultTrenId = ($trenBarang->first(fn ($t) => array_sum($t['usage']) > 0) ?? $trenBarang->first())['id'] ?? null;

        return view('dashboard', compact(
            'totalBarang',
            'totalStok',
            'stokAman',
            'stokMenipis',
            'stokHabis',
            'hampirKedaluwarsa',
            'totalMasuk',
            'totalKeluar',
            'deltaMasuk',
            'deltaKeluar',
            'barangKritis',
            'aktivitasTerakhir',
            'bulanTren',
            'trenBarang',
            'defaultTrenId',
        ));
    }
}
