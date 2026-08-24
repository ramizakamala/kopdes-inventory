@extends('layouts.app')

@section('title', 'Penyesuaian Stok')

@section('content')
    <div class="mb-4 flex items-center justify-between gap-3">
        <div></div>
        <a href="{{ route('penyesuaian-stok.create') }}"
           class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
            + Penyesuaian Baru
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Barang</th>
                        <th class="px-5 py-3">Penyesuaian</th>
                        <th class="px-5 py-3">Alasan</th>
                        <th class="px-5 py-3">Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($adjustments as $a)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-3 text-zinc-400">{{ $a->tanggal->format('d M Y') }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $a->barang?->nama_barang ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="{{ $a->jumlah_penyesuaian > 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                    {{ $a->jumlah_penyesuaian > 0 ? '+' : '' }}{{ $a->jumlah_penyesuaian }}
                                </span>
                                <span class="text-xs text-zinc-500">{{ $a->barang?->satuan }}</span>
                            </td>
                            <td class="px-5 py-3 text-zinc-300">{{ $a->alasan }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $a->user?->name ?? '—' }}</td>
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
