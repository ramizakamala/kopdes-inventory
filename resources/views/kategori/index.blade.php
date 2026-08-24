@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('kategori.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kategori..."
                   class="w-64 rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">
            <button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-zinc-300 hover:bg-white/5">Cari</button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('kategori.create') }}"
               class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                + Tambah Kategori
            </a>
        @endif
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Nama Kategori</th>
                        <th class="px-5 py-3">Deskripsi</th>
                        <th class="px-5 py-3">Jumlah Barang</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-5 py-3 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($kategoris as $k)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 font-medium text-white">{{ $k->nama_kategori }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $k->deskripsi ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-300">{{ $k->barangs_count }}</td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-5 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('kategori.edit', $k) }}" class="text-zinc-400 hover:text-white">Edit</a>
                                        <form method="POST" action="{{ route('kategori.destroy', $k) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-400 hover:text-red-300">Hapus</button>
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
