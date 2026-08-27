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
            }]);

        if ($q = $request->query('q')) {
            $query->where(function ($w) use ($q) {
                $w->where('nama_barang', 'like', "%{$q}%")
                    ->orWhere('kode_barang', 'like', "%{$q}%");
            });
        }

        // ROP dihitung per barang (butuh data pemakaian), jadi filter di koleksi.
        $barangs = $query->get()
            ->filter(fn (Barang $b) => $b->stok_saat_ini <= $b->rop($b->keluar_30hari))
            ->sortByDesc(fn (Barang $b) => $b->rop($b->keluar_30hari) - $b->stok_saat_ini)
            ->values();

        // map rop per barang biar view & hitung rekomendasi pakai nilai sama
        $ropMap = $barangs->mapWithKeys(fn (Barang $b) => [$b->id => $b->rop($b->keluar_30hari)]);

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

        $totalRekomendasi = $barangs->sum(fn (Barang $b) => $this->jumlahRekomendasi($b, $ropMap[$b->id]));

        return view('restock.index', compact('barangs', 'ropMap', 'supplierTerakhir', 'totalRekomendasi'));
    }

    /** Estimasi jumlah pengadaan: 2x ROP dikurangi stok saat ini. */
    private function jumlahRekomendasi(Barang $barang, int $rop): int
    {
        return max(0, ($rop * 2) - $barang->stok_saat_ini);
    }
}
