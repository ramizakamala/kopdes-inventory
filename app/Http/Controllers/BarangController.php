<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BarangController extends Controller
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

        return view('barang.index', compact('barangs'));
    }

    public function create(): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        // suggest kode berikutnya biar nggak diketik manual (urangi kerja)
        $last = Barang::where('kode_barang', 'like', 'BRG-%')->orderBy('kode_barang', 'desc')->value('kode_barang');
        $suggestedKode = 'BRG-001';
        if ($last) {
            $num = (int) substr($last, 4);
            $suggestedKode = 'BRG-' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
        }

        return view('barang.create', compact('kategoris', 'suggestedKode'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode_barang' => ['required', 'string', 'max:50', 'unique:barang,kode_barang'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori_id' => ['nullable', 'exists:kategori,id'],
            'satuan' => ['required', 'string', 'max:20'],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'lead_time_hari' => ['required', 'integer', 'min:0'],
            'safety_stock' => ['required', 'integer', 'min:0'],
            'is_batch_tracked' => ['boolean'],
            // info tampilan website publik
            'deskripsi' => ['nullable', 'string', 'max:600'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'tampil_publik' => ['boolean'],
        ]);

        $data['is_batch_tracked'] = $request->boolean('is_batch_tracked');
        $data['tampil_publik'] = $request->boolean('tampil_publik');
        $data['stok_saat_ini'] = 0;

        $barang = Barang::create($data);

        if ($request->hasFile('foto')) {
            $this->simpanFoto($request, $barang);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang): RedirectResponse
    {
        $data = $request->validate([
            'kode_barang' => ['required', 'string', 'max:50', 'unique:barang,kode_barang,'.$barang->id],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori_id' => ['nullable', 'exists:kategori,id'],
            'satuan' => ['required', 'string', 'max:20'],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'lead_time_hari' => ['required', 'integer', 'min:0'],
            'safety_stock' => ['required', 'integer', 'min:0'],
            'is_batch_tracked' => ['boolean'],
            // info tampilan website publik
            'deskripsi' => ['nullable', 'string', 'max:600'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'tampil_publik' => ['boolean'],
        ]);

        $data['is_batch_tracked'] = $request->boolean('is_batch_tracked');
        $data['tampil_publik'] = $request->boolean('tampil_publik');

        $barang->update($data);

        if ($request->hasFile('foto')) {
            // ganti foto lama kalau ada
            if ($barang->foto_path) {
                Storage::disk('public')->delete($barang->foto_path);
            }

            $this->simpanFoto($request, $barang);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Simpan foto upload ke storage/app/public/produk (→ /storage/produk).
     * Nama file pakai id barang supaya stabil walau nama/kode barang berubah.
     */
    private function simpanFoto(Request $request, Barang $barang): void
    {
        $file = $request->file('foto');
        $nama = 'produk/barang-' . $barang->id . '-' . Str::lower(Str::random(6)) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('produk', basename($nama), 'public');

        $barang->update(['foto_path' => $path]);
    }

    public function destroy(Barang $barang): RedirectResponse
    {
        $hasHistory = $barang->barangMasuks()->exists()
            || $barang->barangKeluars()->exists()
            || $barang->stockAdjustments()->exists()
            || $barang->batches()->exists();

        if ($hasHistory) {
            return back()->with('error', 'Barang tidak bisa dihapus karena masih punya riwayat transaksi.');
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
