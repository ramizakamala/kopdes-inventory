@extends('layouts.app')

@section('title', 'Catat Barang Keluar')

@section('content')
    @if ($errors->any())
        <div class="flash-error !mb-5">{{ $errors->first() }}</div>
    @endif
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('barang-keluar.store') }}">
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
                        <select name="barang_id" id="barang-select" required
                                class="input">
                            <option value="">— Pilih Barang —</option>
                            @foreach ($barangs as $b)
                                <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}" data-stok="{{ $b->stok_saat_ini }}" data-satuan="{{ $b->satuan }}" @selected(old('barang_id') == $b->id)>{{ $b->nama_barang }} — stok: {{ $b->stok_saat_ini }} {{ $b->satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah-input" value="{{ old('jumlah') }}" min="1" required
                               class="input">
                        <p id="stok-hint" class="mt-1 hidden text-xs text-amber-600"></p>
                        @error('jumlah')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Harga Jual (per satuan)</label>
                        <input type="number" name="harga_jual" id="harga-input" value="{{ old('harga_jual') }}" min="0" required
                               class="input">
                        <p class="mt-1 text-xs text-stone-400">Terisi otomatis dari harga barang, bisa diubah.</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="label">Keterangan (opsional)</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" placeholder="mis. penjualan anggota"
                               class="input">
                    </div>
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang-keluar.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-500 hover:text-zinc-900">Batal</a>
            </div>
        </form>
    </div>

    <script>
        // autofill harga jual + batasi jumlah sesuai stok (kurangi kerja & cegah error)
        var select = document.getElementById('barang-select');
        var harga = document.getElementById('harga-input');
        var jumlah = document.getElementById('jumlah-input');
        var hint = document.getElementById('stok-hint');
        select.addEventListener('change', function () {
            var opt = select.selectedOptions[0];
            if (opt && opt.value) {
                harga.value = opt.dataset.harga;
                jumlah.max = opt.dataset.stok;
                hint.textContent = 'Maksimal ' + opt.dataset.stok + ' ' + opt.dataset.satuan + ' sesuai stok tersedia.';
                hint.classList.remove('hidden');
            } else {
                harga.value = '';
                jumlah.removeAttribute('max');
                hint.classList.add('hidden');
            }
        });
    </script>
@endsection
