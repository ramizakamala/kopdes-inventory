@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('supplier.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kontak / alamat..."
                   class="w-64 input">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('supplier.create') }}"
               class="btn btn-primary">
                + Tambah Supplier
            </a>
        @endif
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Nama Supplier</th>
                        <th class="px-5 py-3">Kontak</th>
                        <th class="px-5 py-3">Alamat</th>
                        <th class="px-5 py-3">Transaksi Masuk</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-5 py-3 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($suppliers as $s)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $s->nama_supplier }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $s->kontak ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $s->alamat ?? '—' }}</td>
                            <td class="px-5 py-3 text-zinc-600">{{ $s->barang_masuks_count }}</td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-5 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('supplier.edit', $s) }}" class="text-zinc-500 hover:text-zinc-900">Edit</a>
                                        <form method="POST" action="{{ route('supplier.destroy', $s) }}" onsubmit="return confirm('Hapus supplier ini?')">
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
                            <td colspan="5" class="px-5 py-10 text-center text-zinc-500">Belum ada data supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>
@endsection
