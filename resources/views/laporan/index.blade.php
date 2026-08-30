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
        <div class="flex flex-wrap gap-1 rounded-xl border border-stone-200/80 bg-white p-1 shadow-sm">
            @foreach ($tabs as $key => $label)
                <a href="{{ route('laporan.index', ['jenis' => $key]) }}"
                   class="rounded-lg px-4 py-2 text-sm font-semibold transition {{ $jenis === $key ? 'bg-teal-700 text-white shadow-sm' : 'text-stone-500 hover:bg-stone-100 hover:text-stone-900' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if (in_array($jenis, ['masuk', 'keluar'], true))
                <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-center gap-2">
                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                    <input type="date" name="dari" value="{{ $dari }}" class="input">
                    <span class="text-zinc-600">s/d</span>
                    <input type="date" name="sampai" value="{{ $sampai }}" class="input">
                    <button type="submit" class="btn btn-outline">Terapkan</button>
                </form>
            @endif
            <a href="{{ route('laporan.cetak', array_filter(['jenis' => $jenis, 'dari' => $dari, 'sampai' => $sampai])) }}"
               target="_blank"
               class="btn btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5z" />
                </svg>
                Cetak
            </a>
        </div>
    </div>

    <div class="overflow-hidden card">
        <div class="overflow-x-auto">
            @if ($jenis === 'stok')
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Kode</th><th class="px-5 py-3">Nama Barang</th>
                            <th class="px-5 py-3">Kategori</th><th class="px-5 py-3">Stok</th>
                            <th class="px-5 py-3">Min.</th><th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Nilai Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse ($rows as $b)
                            <tr class="transition hover:bg-zinc-50/60">
                                <td class="px-5 py-3 font-mono text-xs text-zinc-500">{{ $b->kode_barang }}</td>
                                <td class="px-5 py-3 font-medium text-zinc-900">{{ $b->nama_barang }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $b->kategori?->nama_kategori ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-600">{{ $b->stok_saat_ini }} {{ $b->satuan }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $b->stok_minimum }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$b->status" /></td>
                                <td class="px-5 py-3 text-zinc-600">Rp{{ number_format($b->stok_saat_ini * $b->harga_beli, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-zinc-100 text-sm">
                            <td colspan="6" class="px-5 py-3 text-right text-zinc-500">Total stok: {{ $totalStok }} unit · Total nilai stok</td>
                            <td class="px-5 py-3 font-semibold text-zinc-900">Rp{{ number_format($totalNilai, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @elseif ($jenis === 'masuk')
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Supplier</th><th class="px-5 py-3">Jumlah</th>
                            <th class="px-5 py-3">Harga Beli</th><th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse ($rows as $r)
                            <tr class="transition hover:bg-zinc-50/60">
                                <td class="px-5 py-3 text-zinc-500">{{ $r->tanggal->format('d M Y') }}</td>
                                <td class="px-5 py-3 font-medium text-zinc-900">{{ $r->barang?->nama_barang ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $r->supplier?->nama_supplier ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-600">{{ $r->jumlah }}</td>
                                <td class="px-5 py-3 text-zinc-500">Rp{{ number_format($r->harga_beli, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-600">Rp{{ number_format($r->jumlah * $r->harga_beli, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $r->user?->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada data pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-zinc-100 text-sm">
                            <td colspan="3" class="px-5 py-3 text-right text-zinc-500">Total: {{ $totalJumlah }} unit · Total biaya</td>
                            <td colspan="4" class="px-5 py-3 font-semibold text-zinc-900">Rp{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @elseif ($jenis === 'keluar')
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Jumlah</th><th class="px-5 py-3">Harga Jual</th>
                            <th class="px-5 py-3">Total</th><th class="px-5 py-3">Keterangan</th>
                            <th class="px-5 py-3">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse ($rows as $r)
                            <tr class="transition hover:bg-zinc-50/60">
                                <td class="px-5 py-3 text-zinc-500">{{ $r->tanggal->format('d M Y') }}</td>
                                <td class="px-5 py-3 font-medium text-zinc-900">{{ $r->barang?->nama_barang ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-600">{{ $r->jumlah }}</td>
                                <td class="px-5 py-3 text-zinc-500">Rp{{ number_format($r->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-600">Rp{{ number_format($r->jumlah * $r->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $r->keterangan ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $r->user?->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-5 py-10 text-center text-zinc-500">Tidak ada data pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-zinc-100 text-sm">
                            <td colspan="4" class="px-5 py-3 text-right text-zinc-500">Total: {{ $totalJumlah }} unit · Total pendapatan</td>
                            <td colspan="3" class="px-5 py-3 font-semibold text-zinc-900">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 bg-zinc-50/60 text-left text-xs uppercase tracking-wider text-zinc-500">
                            <th class="px-5 py-3">Batch</th><th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Tanggal Masuk</th><th class="px-5 py-3">Kedaluwarsa</th>
                            <th class="px-5 py-3">Jumlah</th><th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse ($rows as $r)
                            @php $lewat = $r->tanggal_kedaluwarsa->lt(now()->startOfDay()); @endphp
                            <tr class="transition hover:bg-zinc-50/60">
                                <td class="px-5 py-3 font-mono text-xs text-zinc-500">{{ $r->nomor_batch }}</td>
                                <td class="px-5 py-3 font-medium text-zinc-900">{{ $r->barang?->nama_barang ?? '—' }}</td>
                                <td class="px-5 py-3 text-zinc-500">{{ $r->tanggal_masuk?->format('d M Y') ?? '—' }}</td>
                                <td class="px-5 py-3 {{ $lewat ? 'font-semibold text-red-600' : 'font-semibold text-amber-600' }}">{{ $r->tanggal_kedaluwarsa->format('d M Y') }}</td>
                                <td class="px-5 py-3 text-zinc-600">{{ $r->jumlah }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-3 py-1 text-[13px] font-bold ring-1 ring-inset {{ $lewat ? 'bg-red-50 text-red-700 ring-red-200' : 'bg-amber-50 text-amber-700 ring-amber-200' }}">
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
