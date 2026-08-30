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
                                <span class="rounded-full px-3 py-1 text-[13px] font-bold ring-1 ring-inset {{ $u->role === 'admin' ? 'bg-teal-50 text-teal-700 ring-teal-200' : 'bg-sky-50 text-sky-700 ring-sky-200' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="rounded-full px-3 py-1 text-[13px] font-bold ring-1 ring-inset {{ $u->status === 'aktif' ? 'bg-green-50 text-green-700 ring-green-200' : 'bg-red-50 text-red-700 ring-red-200' }}">
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
