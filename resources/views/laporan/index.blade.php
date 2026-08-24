@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    @php
        $tabs = [
            'stok' => 'Stok',
            'masuk' => 'Barang Masuk',
            'keluar' => 'Barang Keluar',
            'kedaluwarsa' => 'Kedaluwarsa',
        ];
    @endphp

    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap gap-1 rounded-xl border border-white/5 bg-white/[0.03] p-1">
            @foreach ($tabs as $key => $label)
                <a href="{{ route('laporan.index', ['jenis' => $key]) }}"
                   class="rounded-lg px-4 py-2 text-sm font-medium {{ $jenis === $key ? 'bg-white text-zinc-950' : 'text-zinc-400 hover:text-white' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if (in_array($jenis, ['masuk', 'keluar'], true))
                <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-center gap-2">
                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                    <input type="date" name="dari" value="{{ $dari }}" class="rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                    <span class="text-zinc-600">s/d</span>
                    <input type="date" name="sampai" value="{{ $sampai }}" class="rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                    <button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-zinc-300 hover:bg-white/5">Terapkan</button>
                </form>
            @endif
            <a href="{{ route('laporan.cetak', array_filter(['jenis' => $jenis, 'dari' => $dari, 'sampai' => $sampai])) }}"
               target="_blank"
               class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                🖨 Cetak
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.03]">
        <div class="overflow-x-auto">
            @if ($jenis === 'stok')
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Kode</th><th class="px-5 py-3">Nama Barang</th>
                            <th class="px-5 py-3">Kategori</th><th class="px-5 py-3">Stok</th>
                            <th class="px-5 py-3">Min.</th><th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Nilai Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($rows as $b)
                            <tr class="transition hover:bg-white/[0.02]">
                                <td class="px-5 py-3 font-mono text-xs text-zinc-400">{{ $b->kode_barang }}</td>
                                <td class="px-5 py-3 font-medium text-white">{{ $b->nama_barang }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-300">{{ $b->stok_saat_ini }} {{ $b->satuan }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $b->stok_minimum }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                                <td class="px-5 py-3 text-zinc-300">Rp{{ number_format($b->stok_saat_ini * $b->harga_beli, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-white/5 text-sm">
                            <td colspan="6" class="px-5 py-3 text-right text-zinc-400">Total stok: {{ $totalStok }} unit · Total nilai stok</td>
                            <td class="px-5 py-3 font-semibold text-white">Rp{{ number_format($totalNilai, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @elseif ($jenis === 'masuk')
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Supplier</th><th class="px-5 py-3">Jumlah</th>
                            <th class="px-5 py-3">Harga Beli</th><th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($rows as $r)
                            <tr class="transition hover:bg-white/[0.02]">
                                <td class="px-5 py-3 text-zinc-400">{{ $r->tanggal->format('d M Y') }}</td>
                                <td class="px-5 py-3 font-medium text-white">{{ $r->barang?->nama_barang ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $r->supplier?->nama_supplier ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-300">{{ $r->jumlah }}</td>
                                <td class="px-5 py-3 text-zinc-400">Rp{{ number_format($r->harga_beli, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-300">Rp{{ number_format($r->jumlah * $r->harga_beli, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $r->user?->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada data pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-white/5 text-sm">
                            <td colspan="3" class="px-5 py-3 text-right text-zinc-400">Total: {{ $totalJumlah }} unit · Total biaya</td>
                            <td colspan="4" class="px-5 py-3 font-semibold text-white">Rp{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @elseif ($jenis === 'keluar')
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Jumlah</th><th class="px-5 py-3">Harga Jual</th>
                            <th class="px-5 py-3">Total</th><th class="px-5 py-3">Keterangan</th>
                            <th class="px-5 py-3">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($rows as $r)
                            <tr class="transition hover:bg-white/[0.02]">
                                <td class="px-5 py-3 text-zinc-400">{{ $r->tanggal->format('d M Y') }}</td>
                                <td class="px-5 py-3 font-medium text-white">{{ $r->barang?->nama_barang ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-300">{{ $r->jumlah }}</td>
                                <td class="px-5 py-3 text-zinc-400">Rp{{ number_format($r->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-300">Rp{{ number_format($r->jumlah * $r->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $r->keterangan ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $r->user?->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada data pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-white/5 text-sm">
                            <td colspan="4" class="px-5 py-3 text-right text-zinc-400">Total: {{ $totalJumlah }} unit · Total pendapatan</td>
                            <td colspan="3" class="px-5 py-3 font-semibold text-white">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Batch</th><th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Tanggal Masuk</th><th class="px-5 py-3">Kedaluwarsa</th>
                            <th class="px-5 py-3">Jumlah</th><th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($rows as $r)
                            @php $lewat = $r->tanggal_kedaluwarsa->lt(now()->startOfDay()); @endphp
                            <tr class="transition hover:bg-white/[0.02]">
                                <td class="px-5 py-3 font-mono text-xs text-zinc-400">{{ $r->nomor_batch }}</td>
                                <td class="px-5 py-3 font-medium text-white">{{ $r->barang?->nama_barang ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-400">{{ $r->tanggal_masuk?->format('d M Y') ?? '—' }}</td>
                                <td class="px-5 py-3 {{ $lewat ? 'font-semibold text-red-400' : 'text-amber-300' }}">{{ $r->tanggal_kedaluwarsa->format('d M Y') }}</td>
                                <td class="px-5 py-3 text-zinc-300">{{ $r->jumlah }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $lewat ? 'bg-red-500/15 text-red-300' : 'bg-amber-500/15 text-amber-300' }}">
                                        {{ $lewat ? 'Kedaluwarsa' : 'Mendekati' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-10 text-center text-zinc-500">Tidak ada batch yang mendekati kedaluwarsa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
