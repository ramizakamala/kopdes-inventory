<?php

namespace App\Http\Controllers;

use App\Models\KontakMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PesanController extends Controller
{
    public function index(): View
    {
        $pesans = KontakMessage::latest()->paginate(10);

        return view('pesan.index', compact('pesans'));
    }

    public function destroy(KontakMessage $pesan): RedirectResponse
    {
        $pesan->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
