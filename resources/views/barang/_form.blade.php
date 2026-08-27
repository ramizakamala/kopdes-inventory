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

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Kode Barang</label>
        <input type="text" name="kode_barang" value="{{ $k }}" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('kode_barang')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ $n }}" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('nama_barang')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Kategori</label>
        <select name="kategori_id" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
            <option value="">— Tanpa Kategori —</option>
            @foreach ($kategoris as $katItem)
                <option value="{{ $katItem->id }}" @selected($kat == $katItem->id)>{{ $katItem->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Satuan</label>
        <input type="text" name="satuan" value="{{ $sat }}" required placeholder="pcs / kg / liter / sak"
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Harga Beli</label>
        <input type="number" name="harga_beli" value="{{ $hb }}" min="0" step="1" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Harga Jual</label>
        <input type="number" name="harga_jual" value="{{ $hj }}" min="0" step="1" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Stok Minimum</label>
        <input type="number" name="stok_minimum" value="{{ $sm }}" min="0" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Lead Time (hari)</label>
        <input type="number" name="lead_time_hari" value="{{ old('lead_time_hari', $barang->lead_time_hari ?? 3) }}" min="0" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        <p class="mt-1 text-xs text-zinc-600">Waktu tunggu order sampai barang tiba dari supplier</p>
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Safety Stock</label>
        <input type="number" name="safety_stock" value="{{ old('safety_stock', $barang->safety_stock ?? 0) }}" min="0" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        <p class="mt-1 text-xs text-zinc-600">Stok pengaman cadangan saat menunggu order datang</p>
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm text-zinc-300">
            <input type="checkbox" name="is_batch_tracked" value="1" @checked($bt)
                   class="rounded border-white/20 bg-zinc-900 accent-white">
            Lacak batch & kedaluwarsa
        </label>
    </div>
</div>
