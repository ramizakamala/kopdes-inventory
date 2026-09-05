<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\KontakMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        $totalBarang = Barang::where('tampil_publik', true)->count();
        $totalKategori = Kategori::count();
        $totalStok = (int) Barang::where('tampil_publik', true)->sum('stok_saat_ini');
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $barangs = Barang::where('tampil_publik', true)->orderBy('nama_barang')->get();
        $produkUnggulan = Barang::with('kategori')
            ->where('tampil_publik', true)
            ->where('stok_saat_ini', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('public.index', compact('totalBarang', 'totalKategori', 'totalStok', 'kategoris', 'barangs', 'produkUnggulan'));
    }

    public function produk(Request $request): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $barangs = Barang::with('kategori')
            ->where('tampil_publik', true)
            ->when($request->filled('kategori_id'), fn ($q) => $q->where('kategori_id', $request->integer('kategori_id')))
            ->orderBy('nama_barang')
            ->paginate(9)
            ->withQueryString();

        return view('public.produk', compact('barangs', 'kategoris'));
    }

    public function tentang(): View
    {
        $totalBarang = Barang::where('tampil_publik', true)->count();
        $totalKategori = Kategori::count();
        $totalStok = (int) Barang::where('tampil_publik', true)->sum('stok_saat_ini');

        return view('public.tentang', compact('totalBarang', 'totalKategori', 'totalStok'));
    }

    public function kontak(): View
    {
        return view('public.kontak');
    }

    public function kirimPesan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'barang' => ['nullable', 'string', 'max:255'],
            'pesan' => ['required', 'string', 'max:1000'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
        ]);

        // form layanan: tandai barang yang dicari di awal pesan
        if (! empty($data['barang'])) {
            $data['pesan'] = "Permintaan barang: {$data['barang']}.\n{$data['pesan']}";
        }
        unset($data['barang']);

        KontakMessage::create($data);

        return back()->with('kontak_success', 'Terima kasih! Pesan Anda sudah kami terima dan akan segera kami balas.');
    }
}
