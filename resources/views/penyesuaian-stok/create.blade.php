@extends('layouts.app')

@section('title', 'Penyesuaian Stok Baru')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('penyesuaian-stok.store') }}">
            @csrf
            <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" required
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                        @error('tanggal')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Barang</label>
                        <select name="barang_id" required
                                class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                            <option value="">— Pilih Barang —</option>
                            @foreach ($barangs as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>
                                    {{ $b->kode_barang }} — {{ $b->nama_barang }} (stok: {{ $b->stok_saat_ini }} {{ $b->satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Jumlah Penyesuaian</label>
                        <input type="number" name="jumlah_penyesuaian" value="{{ old('jumlah_penyesuaian') }}" required placeholder="+ untuk tambah, − untuk kurang"
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                        @error('jumlah_penyesuaian')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Alasan</label>
                        <input type="text" name="alasan" value="{{ old('alasan') }}" required placeholder="mis. barang rusak / hilang / stok opname"
                               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
                        @error('alasan')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">Simpan</button>
                <a href="{{ route('penyesuaian-stok.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-400 hover:text-white">Batal</a>
            </div>
        </form>
    </div>
@endsection
