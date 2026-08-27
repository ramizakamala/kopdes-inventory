@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
    <div class="mb-4 flex items-center justify-between gap-3">
        <div></div>
        <a href="{{ route('pengguna.create') }}"
           class="btn btn-primary">
            + Tambah Pengguna
        </a>
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Nama</th>
                        <th class="px-5 py-3">Username</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Role</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($users as $u)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 font-medium text-zinc-900">
                                {{ $u->name }}
                                @if ($u->id === auth()->id())
                                    <span class="ml-1 text-xs text-zinc-500">(Anda)</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-zinc-500">{{ $u->username }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $u->email }}</td>
                            <td class="px-5 py-3">
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $u->role === 'admin' ? 'bg-white/10 text-zinc-900' : 'bg-sky-500/15 text-sky-300' }}">
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
                                    <a href="{{ route('pengguna.edit', $u) }}" class="text-zinc-500 hover:text-zinc-900">Edit</a>
                                    <form method="POST" action="{{ route('pengguna.destroy', $u) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-700">Hapus</button>
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
