<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function index(Request $request): View
    {
        $query = Barang::with('kategori')->orderBy('nama_barang');

        if ($q = $request->query('q')) {
            $query->where(function ($w) use ($q) {
                $w->where('nama_barang', 'like', "%{$q}%")
                    ->orWhere('kode_barang', 'like', "%{$q}%");
            });
        }

        if ($kategoriId = $request->query('kategori_id')) {
            $query->where('kategori_id', $kategoriId);
        }

        if ($status = $request->query('status')) {
            if ($status === 'habis') {
                $query->where('stok_saat_ini', '<=', 0);
            } elseif ($status === 'menipis') {
                $query->whereColumn('stok_saat_ini', '<', 'stok_minimum')->where('stok_saat_ini', '>', 0);
            } elseif ($status === 'aman') {
                $query->whereColumn('stok_saat_ini', '>=', 'stok_minimum')->where('stok_saat_ini', '>', 0);
            }
        }

        $barangs = $query->paginate(10)->withQueryString();

        $totalItem = Barang::count();
        $totalNilaiStok = (int) Barang::selectRaw('COALESCE(SUM(stok_saat_ini * harga_beli), 0) AS total')->value('total');
        $jumlahMenipis = Barang::whereColumn('stok_saat_ini', '<', 'stok_minimum')->where('stok_saat_ini', '>', 0)->count();
        $jumlahHabis = Barang::where('stok_saat_ini', '<=', 0)->count();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('monitoring.index', compact(
            'barangs',
            'kategoris',
            'totalItem',
            'totalNilaiStok',
            'jumlahMenipis',
            'jumlahHabis'
        ));
    }
}
