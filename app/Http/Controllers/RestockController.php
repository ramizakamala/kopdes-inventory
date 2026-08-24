<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RestockController extends Controller
{
    public function index(Request $request): View
    {
        $query = Barang::with('kategori')
            ->withCount(['barangKeluars as keluar_30hari' => function ($q) {
                $q->where('tanggal', '>=', now()->subDays(30)->toDateString());
            }])
            ->whereColumn('stok_saat_ini', '<=', 'stok_minimum')
            ->orderByRaw('stok_saat_ini - stok_minimum');

        if ($q = $request->query('q')) {
            $query->where(function ($w) use ($q) {
                $w->where('nama_barang', 'like', "%{$q}%")
                    ->orWhere('kode_barang', 'like', "%{$q}%");
            });
        }

        $barangs = $query->get();

        // supplier dari transaksi barang masuk terakhir tiap barang
        $supplierTerakhir = collect();
        if ($barangs->isNotEmpty()) {
            $supplierTerakhir = DB::table('barang_masuk as bm')
                ->join('supplier', 'supplier.id', '=', 'bm.supplier_id')
                ->whereIn('bm.barang_id', $barangs->pluck('id'))
                ->whereRaw('bm.tanggal = (SELECT MAX(bm2.tanggal) FROM barang_masuk bm2 WHERE bm2.barang_id = bm.barang_id)')
                ->get(['bm.barang_id', 'supplier.nama_supplier'])
                ->pluck('nama_supplier', 'barang_id');
        }

        $totalRekomendasi = $barangs->sum(fn ($b) => $this->jumlahRekomendasi($b));

        return view('restock.index', compact('barangs', 'supplierTerakhir', 'totalRekomendasi'));
    }

    /** Estimasi jumlah pengadaan: 2x stok minimum dikurangi stok saat ini. */
    private function jumlahRekomendasi(Barang $barang): int
    {
        return max(0, ($barang->stok_minimum * 2) - $barang->stok_saat_ini);
    }
}
