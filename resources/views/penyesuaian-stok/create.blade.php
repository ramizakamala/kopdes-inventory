@extends('layouts.app')

@section('title', 'Penyesuaian Stok Baru')

@section('content')
    @if ($errors->any())
        <div class="flash-error !mb-5">{{ $errors->first() }}</div>
    @endif
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('penyesuaian-stok.store') }}">
            @csrf
            <div class="card p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" required
                               class="input">
                        @error('tanggal')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Barang</label>
                        <select name="barang_id" required
                                class="input">
                            <option value="">— Pilih Barang —</option>
                            @foreach ($barangs as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>
                                    {{ $b->kode_barang }} — {{ $b->nama_barang }} (stok: {{ $b->stok_saat_ini }} {{ $b->satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Jumlah Penyesuaian</label>
                        <input type="number" name="jumlah_penyesuaian" value="{{ old('jumlah_penyesuaian') }}" required placeholder="+ untuk tambah, − untuk kurang"
                               class="input">
                        @error('jumlah_penyesuaian')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="label">Alasan</label>
                        <input type="text" name="alasan" value="{{ old('alasan') }}" required placeholder="mis. barang rusak / hilang / stok opname"
                               class="input">
                        @error('alasan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('penyesuaian-stok.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-500 hover:text-zinc-900">Batal</a>
            </div>
        </form>
    </div>
@endsection
