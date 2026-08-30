@php
    $k = old('kode_barang', $barang->kode_barang ?? '');
    $n = old('nama_barang', $barang->nama_barang ?? '');
    $kat = old('kategori_id', $barang->kategori_id ?? null);
    $sat = old('satuan', $barang->satuan ?? '');
    $hb = old('harga_beli', $barang->harga_beli ?? '');
    $hj = old('harga_jual', $barang->harga_jual ?? '');
    $sm = old('stok_minimum', $barang->stok_minimum ?? 0);
    $bt = old('is_batch_tracked', $barang->is_batch_tracked ?? false);
@endphp

@if ($errors->any())
    <div class="flash-error !mb-5">{{ $errors->first() }}</div>
@endif

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="label">Kode Barang</label>
        <input type="text" name="kode_barang" value="{{ $k }}" required
               class="input">
        @error('kode_barang')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ $n }}" required
               class="input">
        @error('nama_barang')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Kategori</label>
        <select name="kategori_id" class="input">
            <option value="">— Tanpa Kategori —</option>
            @foreach ($kategoris as $katItem)
                <option value="{{ $katItem->id }}" @selected($kat == $katItem->id)>{{ $katItem->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">Satuan</label>
        <input type="text" name="satuan" value="{{ $sat }}" required placeholder="pcs / kg / liter / sak"
               class="input">
    </div>
    <div>
        <label class="label">Harga Beli</label>
        <input type="number" name="harga_beli" value="{{ $hb }}" min="0" step="1" required
               class="input">
    </div>
    <div>
        <label class="label">Harga Jual</label>
        <input type="number" name="harga_jual" value="{{ $hj }}" min="0" step="1" required
               class="input">
    </div>
    <div>
        <label class="label">Stok Minimum</label>
        <input type="number" name="stok_minimum" value="{{ $sm }}" min="0" required
               class="input">
    </div>
    <div>
        <label class="label">Lead Time (hari)</label>
        <input type="number" name="lead_time_hari" value="{{ old('lead_time_hari', $barang->lead_time_hari ?? 3) }}" min="0" required
               class="input">
        <p class="mt-1 text-xs text-zinc-600">Waktu tunggu order sampai barang tiba dari supplier</p>
    </div>
    <div>
        <label class="label">Safety Stock</label>
        <input type="number" name="safety_stock" value="{{ old('safety_stock', $barang->safety_stock ?? 0) }}" min="0" required
               class="input">
        <p class="mt-1 text-xs text-zinc-600">Stok pengaman cadangan saat menunggu order datang</p>
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm text-zinc-600">
            <input type="checkbox" name="is_batch_tracked" value="1" @checked($bt)
                   class="rounded border-zinc-300 accent-green-700">
            Lacak batch & kedaluwarsa
        </label>
    </div>
</div>
