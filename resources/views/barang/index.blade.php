@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('barang.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kode barang..."
                   class="w-64 input">
            <select name="status" onchange="this.form.submit()"
                    class="input">
                <option value="">Semua status</option>
                <option value="aman" @selected(request('status') === 'aman')>Aman</option>
                <option value="menipis" @selected(request('status') === 'menipis')>Menipis</option>
                <option value="habis" @selected(request('status') === 'habis')>Habis</option>
            </select>
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('barang.create') }}"
               class="btn btn-primary">
                + Tambah Barang
            </a>
        @endif
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
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
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($barangs as $b)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 font-mono text-xs text-zinc-500">{{ $b->kode_barang }}</td>
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $b->nama_barang }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $b->satuan }}</td>
                            <td class="px-5 py-3 text-zinc-500">Rp{{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-500">Rp{{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-600">{{ $b->stok_saat_ini }}</td>
                            <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-5 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('barang.edit', $b) }}" class="text-zinc-500 hover:text-zinc-900">Edit</a>
                                        <form method="POST" action="{{ route('barang.destroy', $b) }}" onsubmit="return confirm('Hapus barang ini?')">
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
