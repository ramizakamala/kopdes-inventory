<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Batch;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BarangMasukController extends Controller
{
    public function index(Request $request): View
    {
        $query = BarangMasuk::with(['barang', 'supplier', 'batch'])->orderByDesc('tanggal')->orderByDesc('id');

        if ($q = $request->query('q')) {
            $query->whereHas('barang', function ($w) use ($q) {
                $w->where('nama_barang', 'like', "%{$q}%")
                    ->orWhere('kode_barang', 'like', "%{$q}%");
            });
        }

        $masuks = $query->paginate(10)->withQueryString();

        return view('barang-masuk.index', compact('masuks'));
    }

    public function create(): View
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        return view('barang-masuk.create', compact('barangs', 'suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date'],
            'barang_id' => ['required', 'exists:barang,id'],
            'supplier_id' => ['nullable', 'exists:supplier,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'nomor_batch' => ['nullable', 'string', 'max:100'],
            'tanggal_kedaluwarsa' => ['nullable', 'date', 'required_with:nomor_batch'],
        ]);

        DB::transaction(function () use ($data) {
            $batchId = null;
            if ($data['nomor_batch'] ?? null) {
                $batch = Batch::create([
                    'barang_id' => $data['barang_id'],
                    'nomor_batch' => $data['nomor_batch'],
                    'tanggal_masuk' => $data['tanggal'],
                    'tanggal_kedaluwarsa' => $data['tanggal_kedaluwarsa'],
                    'jumlah' => $data['jumlah'],
                ]);
                $batchId = $batch->id;
            }

            BarangMasuk::create([
                'tanggal' => $data['tanggal'],
                'barang_id' => $data['barang_id'],
                'supplier_id' => $data['supplier_id'] ?? null,
                'batch_id' => $batchId,
                'jumlah' => $data['jumlah'],
                'harga_beli' => $data['harga_beli'],
                'user_id' => auth()->id(),
            ]);

            Barang::where('id', $data['barang_id'])->increment('stok_saat_ini', $data['jumlah']);
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk dicatat, stok bertambah otomatis.');
    }
}
