<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StockAdjustment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StockAdjustmentController extends Controller
{
    public function index(): View
    {
        $adjustments = StockAdjustment::with(['barang', 'user'])
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10);

        return view('penyesuaian-stok.index', compact('adjustments'));
    }

    public function create(): View
    {
        $barangs = Barang::orderBy('nama_barang')->get(['id', 'nama_barang', 'kode_barang', 'stok_saat_ini', 'satuan']);

        return view('penyesuaian-stok.create', compact('barangs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date'],
            'barang_id' => ['required', 'exists:barang,id'],
            'jumlah_penyesuaian' => ['required', 'integer', 'not_in:0'],
            'alasan' => ['required', 'string', 'max:255'],
        ]);

        try {
            DB::transaction(function () use ($data, $request) {
                $barang = Barang::whereKey($data['barang_id'])->lockForUpdate()->firstOrFail();
                $stokBaru = $barang->stok_saat_ini + $data['jumlah_penyesuaian'];

                if ($stokBaru < 0) {
                    throw new \RuntimeException('Stok tidak boleh negatif. Stok saat ini: '.$barang->stok_saat_ini);
                }

                $barang->update(['stok_saat_ini' => $stokBaru]);

                StockAdjustment::create($data + ['user_id' => $request->user()->id]);
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('penyesuaian-stok.index')->with('success', 'Penyesuaian stok berhasil disimpan.');
    }
}
