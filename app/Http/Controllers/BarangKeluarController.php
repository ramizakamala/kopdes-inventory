<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarBatch;
use App\Models\Batch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BarangKeluarController extends Controller
{
    public function index(Request $request): View
    {
        $query = BarangKeluar::with(['barang', 'detailBatch.batch'])->orderByDesc('tanggal')->orderByDesc('id');

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

        // batch yang masih punya sisa & belum kedaluwarsa, urut kedaluwarsa terdekat (urutan FEFO)
        $batchByBarang = Batch::where('jumlah', '>', 0)
            ->whereDate('tanggal_kedaluwarsa', '>=', now()->toDateString())
            ->orderBy('tanggal_kedaluwarsa')
            ->orderBy('tanggal_masuk')
            ->get(['id', 'barang_id', 'nomor_batch', 'tanggal_kedaluwarsa', 'jumlah'])
            ->groupBy('barang_id');

        return view('barang-keluar.create', compact('barangs', 'batchByBarang'));
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

            if ($barang->is_batch_tracked) {
                $this->catatKeluarFefo($barang, $data);
            } else {
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
                    'hpp_satuan' => $barang->harga_beli,
                    'keterangan' => $data['keterangan'] ?? null,
                    'user_id' => auth()->id(),
                ]);
            }

            $barang->decrement('stok_saat_ini', $data['jumlah']);
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar dicatat, stok berkurang otomatis.');
    }

    /**
     * Barang ber-batch: kurangi batch yang kedaluwarsanya PALING DEKAT duluan (FEFO).
     * Satu transaksi bisa memakai beberapa batch — tiap alokasi dicatat di
     * barang_keluar_batch supaya riwayatnya bisa diaudit & HPP batch kehitung.
     */
    private function catatKeluarFefo(Barang $barang, array $data): void
    {
        // batch yang masih layak jual: sisa > 0 & belum lewat tanggal kedaluwarsa.
        // batch expired tidak ikut terpakai — harus dibuang lewat penyesuaian stok.
        $batches = Batch::where('barang_id', $barang->id)
            ->where('jumlah', '>', 0)
            ->whereDate('tanggal_kedaluwarsa', '>=', now()->toDateString())
            ->orderBy('tanggal_kedaluwarsa')
            ->orderBy('tanggal_masuk')
            ->lockForUpdate()
            ->get();

        $sisaBatch = (int) $batches->sum('jumlah');

        if ($sisaBatch < $data['jumlah']) {
            throw ValidationException::withMessages([
                'jumlah' => "Stok batch belum kedaluwarsa tidak mencukupi. Tersedia: {$sisaBatch} {$barang->satuan} (batch lain sudah kedaluwarsa). Catat barang masuk (dengan nomor batch) terlebih dahulu.",
            ]);
        }

        $keluar = BarangKeluar::create([
            'tanggal' => $data['tanggal'],
            'barang_id' => $data['barang_id'],
            'jumlah' => $data['jumlah'],
            'harga_jual' => $data['harga_jual'],
            'hpp_satuan' => 0, // dihitung dari harga beli batch (commit laporan laba)
            'keterangan' => $data['keterangan'] ?? null,
            'user_id' => auth()->id(),
        ]);

        $sisa = (int) $data['jumlah'];
        foreach ($batches as $batch) {
            if ($sisa <= 0) {
                break;
            }

            $ambil = min($batch->jumlah, $sisa);
            $batch->decrement('jumlah', $ambil);

            BarangKeluarBatch::create([
                'barang_keluar_id' => $keluar->id,
                'batch_id' => $batch->id,
                'jumlah' => $ambil,
            ]);

            $sisa -= $ambil;
        }
    }
}
