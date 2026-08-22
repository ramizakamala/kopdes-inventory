@extends('layouts.app')

@section('title', 'Catat Barang Keluar')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('barang-keluar.store') }}">
            @csrf
            <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Barang</label>
                        <select name="barang_id" required
                                class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                            <option value="">— Pilih Barang —</option>
                            @foreach ($barangs as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>{{ $b->nama_barang }} — stok: {{ $b->stok_saat_ini }} {{ $b->satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Jumlah</label>
                        <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="1" required
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                        @error('jumlah')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Harga Jual (per satuan)</label>
                        <input type="number" name="harga_jual" value="{{ old('harga_jual') }}" min="0" required
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Keterangan (opsional)</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" placeholder="mis. penjualan anggota"
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                    </div>
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">Simpan</button>
                <a href="{{ route('barang-keluar.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-400 hover:text-white">Batal</a>
            </div>
        </form>
    </div>
@endsection
