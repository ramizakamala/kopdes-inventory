@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('kategori.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kategori..."
                   class="w-64 input">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('kategori.create') }}"
               class="btn btn-primary">
                + Tambah Kategori
            </a>
        @endif
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Nama Kategori</th>
                        <th class="px-5 py-3">Deskripsi</th>
                        <th class="px-5 py-3">Jumlah Barang</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-5 py-3 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($kategoris as $k)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $k->nama_kategori }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $k->deskripsi ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-600">{{ $k->barangs_count }}</td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-5 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('kategori.edit', $k) }}" class="text-zinc-500 hover:text-zinc-900">Edit</a>
                                        <form method="POST" action="{{ route('kategori.destroy', $k) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-zinc-500">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $kategoris->links() }}
    </div>
@endsection
