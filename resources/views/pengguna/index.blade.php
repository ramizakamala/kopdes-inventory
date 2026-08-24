@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
    <div class="mb-4 flex items-center justify-between gap-3">
        <div></div>
        <a href="{{ route('pengguna.create') }}"
           class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
            + Tambah Pengguna
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Nama</th>
                        <th class="px-5 py-3">Username</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Role</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($users as $u)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 font-medium text-white">
                                {{ $u->name }}
                                @if ($u->id === auth()->id())
                                    <span class="ml-1 text-xs text-zinc-500">(Anda)</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-zinc-400">{{ $u->username }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $u->email }}</td>
                            <td class="px-5 py-3">
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $u->role === 'admin' ? 'bg-white/10 text-white' : 'bg-sky-500/15 text-sky-300' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $u->status === 'aktif' ? 'bg-emerald-500/15 text-emerald-300' : 'bg-red-500/15 text-red-300' }}">
                                    {{ ucfirst($u->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('pengguna.edit', $u) }}" class="text-zinc-400 hover:text-white">Edit</a>
                                    <form method="POST" action="{{ route('pengguna.destroy', $u) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-400 hover:text-red-300">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-zinc-500">Belum ada pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
