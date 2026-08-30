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
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $produkUnggulan = Barang::with('kategori')
            ->where('stok_saat_ini', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('public.index', compact('totalBarang', 'totalKategori', 'kategoris', 'produkUnggulan'));
    }

    public function produk(Request $request): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $barangs = Barang::with('kategori')
            ->when($request->filled('kategori_id'), fn ($q) => $q->where('kategori_id', $request->integer('kategori_id')))
            ->orderBy('nama_barang')
            ->paginate(9)
            ->withQueryString();

        return view('public.produk', compact('barangs', 'kategoris'));
    }

    public function tentang(): View
    {
        return view('public.tentang');
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
            'pesan' => ['required', 'string', 'max:1000'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
        ]);

        KontakMessage::create($data);

        return back()->with('kontak_success', 'Terima kasih! Pesan Anda sudah kami terima dan akan segera kami balas.');
    }
}
