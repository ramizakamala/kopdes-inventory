@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('barang.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">
            <select name="status" onchange="this.form.submit()"
                    class="rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                <option value="">Semua status</option>
                <option value="aman" @selected(request('status') === 'aman')>Aman</option>
                <option value="menipis" @selected(request('status') === 'menipis')>Menipis</option>
                <option value="habis" @selected(request('status') === 'habis')>Habis</option>
            </select>
            <button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-zinc-300 hover:bg-white/5">Cari</button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('barang.create') }}"
               class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                + Tambah Barang
            </a>
        @endif
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Kode</th>
                        <th class="px-5 py-3">Nama Barang</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">Satuan</th>
                        <th class="px-5 py-3">Harga Beli</th>
                        <th class="px-5 py-3">Harga Jual</th>
                        <th class="px-5 py-3">Stok</th>
                        <th class="px-5 py-3">Status</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-5 py-3 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($barangs as $b)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 font-mono text-xs text-zinc-400">{{ $b->kode_barang }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $b->nama_barang }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $b->satuan }}</td>
                            <td class="px-5 py-3 text-zinc-400">Rp{{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-400">Rp{{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-300">{{ $b->stok_saat_ini }}</td>
                            <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-5 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('barang.edit', $b) }}" class="text-zinc-400 hover:text-white">Edit</a>
                                        <form method="POST" action="{{ route('barang.destroy', $b) }}" onsubmit="return confirm('Hapus barang ini?')">
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
                            <td colspan="9" class="px-5 py-10 text-center text-zinc-500">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $barangs->links() }}
    </div>
@endsection
