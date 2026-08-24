<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderByRaw("CASE role WHEN 'admin' THEN 0 ELSE 1 END")->orderBy('name')->paginate(10);

        return view('pengguna.index', compact('users'));
    }

    public function create(): View
    {
        return view('pengguna.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,pimpinan'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        User::create($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        return view('pengguna.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,'.$user->id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:admin,pimpinan'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus admin terakhir.');
        }

        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
