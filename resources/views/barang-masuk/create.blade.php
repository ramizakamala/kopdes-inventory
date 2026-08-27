@extends('layouts.app')

@section('title', 'Catat Barang Masuk')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('barang-masuk.store') }}">
            @csrf
            <div class="card p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required
                               class="input">
                    </div>
                    <div>
                        <label class="label">Barang</label>
                        <select name="barang_id" required
                                class="input">
                            <option value="">— Pilih Barang —</option>
                            @foreach ($barangs as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>{{ $b->nama_barang }} ({{ $b->kode_barang }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Supplier (opsional)</label>
                        <select name="supplier_id"
                                class="input">
                            <option value="">— Tanpa Supplier —</option>
                            @foreach ($suppliers as $s)
                                <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Jumlah</label>
                        <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="1" required
                               class="input">
                    </div>
                    <div>
                        <label class="label">Harga Beli (per satuan)</label>
                        <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" min="0" required
                               class="input">
                    </div>
                    <div>
                        <label class="label">Nomor Batch (opsional)</label>
                        <input type="text" name="nomor_batch" value="{{ old('nomor_batch') }}"
                               class="input">
                    </div>
                    <div>
                        <label class="label">Tanggal Kedaluwarsa (opsional)</label>
                        <input type="date" name="tanggal_kedaluwarsa" value="{{ old('tanggal_kedaluwarsa') }}"
                               class="input">
                        @error('tanggal_kedaluwarsa')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                @error('jumlah')<p class="mt-3 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang-masuk.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-500 hover:text-zinc-900">Batal</a>
            </div>
        </form>
    </div>
@endsection
