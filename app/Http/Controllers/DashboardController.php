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
        ));
    }
}
