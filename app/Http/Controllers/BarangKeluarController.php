<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BarangKeluarController extends Controller
{
    public function index(Request $request): View
    {
        $query = BarangKeluar::with('barang')->orderByDesc('tanggal')->orderByDesc('id');

        if ($q = $request->query('q')) {
            $query->whereHas('barang', function ($w) use ($q) {
                $w->where('nama_barang', 'like', "%{$q}%")
                    ->orWhere('kode_barang', 'like', "%{$q}%");
            });
        }

        $keluars = $query->paginate(10)->withQueryString();

        return view('barang-keluar.index', compact('keluars'));
    }

    public function create(): View
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('barang-keluar.create', compact('barangs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date'],
            'barang_id' => ['required', 'exists:barang,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($data) {
            $barang = Barang::where('id', $data['barang_id'])->lockForUpdate()->firstOrFail();

            if ($barang->stok_saat_ini < $data['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => "Stok tidak mencukupi. Stok tersedia: {$barang->stok_saat_ini} {$barang->satuan}.",
                ]);
            }

            BarangKeluar::create([
                'tanggal' => $data['tanggal'],
                'barang_id' => $data['barang_id'],
                'jumlah' => $data['jumlah'],
                'harga_jual' => $data['harga_jual'],
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => auth()->id(),
            ]);

            $barang->decrement('stok_saat_ini', $data['jumlah']);
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar dicatat, stok berkurang otomatis.');
    }
}
