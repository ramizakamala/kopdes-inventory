@extends('layouts.app')

@section('title', 'Penyesuaian Stok')

@section('content')
    <div class="mb-4 flex items-center justify-between gap-3">
        <div></div>
        <a href="{{ route('penyesuaian-stok.create') }}"
           class="btn btn-primary">
            + Penyesuaian Baru
        </a>
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Barang</th>
                        <th class="px-5 py-3">Penyesuaian</th>
                        <th class="px-5 py-3">Alasan</th>
                        <th class="px-5 py-3">Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($adjustments as $a)
                        <tr class="transition hover:bg-zinc-50/60">
                            <td class="px-5 py-3 text-zinc-500">{{ $a->tanggal->format('d M Y') }}</td>
                            <td class="px-5 py-3 font-medium text-zinc-900">{{ $a->barang?->nama_barang ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="{{ $a->jumlah_penyesuaian > 0 ? 'text-emerald-400' : 'text-red-600' }}">
                                    {{ $a->jumlah_penyesuaian > 0 ? '+' : '' }}{{ $a->jumlah_penyesuaian }}
                                </span>
                                <span class="text-xs text-zinc-500">{{ $a->barang?->satuan }}</span>
                            </td>
                            <td class="px-5 py-3 text-zinc-600">{{ $a->alasan }}</td>
                            <td class="px-5 py-3 text-zinc-500">{{ $a->user?->name ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-zinc-500">Belum ada penyesuaian stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $adjustments->links() }}
    </div>
@endsection
