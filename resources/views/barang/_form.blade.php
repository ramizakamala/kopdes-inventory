@php
    $k = old('kode_barang', $barang->kode_barang ?? $suggestedKode ?? '');
    $n = old('nama_barang', $barang->nama_barang ?? '');
    $kat = old('kategori_id', $barang->kategori_id ?? null);
    $sat = old('satuan', $barang->satuan ?? '');
    $hb = old('harga_beli', $barang->harga_beli ?? '');
    $hj = old('harga_jual', $barang->harga_jual ?? '');
    $sm = old('stok_minimum', $barang->stok_minimum ?? 0);
    $bt = old('is_batch_tracked', $barang->is_batch_tracked ?? false);
    $d = old('deskripsi', $barang->deskripsi ?? '');
    $tp = old('tampil_publik', $barang->tampil_publik ?? true);
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

{{-- Info website publik: foto & deskripsi diunggah dari sini, tanpa sentuh kode --}}
<div class="mt-6 border-t border-stone-200 pt-5">
    <div class="flex items-center gap-2">
        <svg class="h-4 w-4 text-teal-700" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
        </svg>
        <h4 class="text-sm font-bold text-stone-900">Website Publik</h4>
    </div>
    <p class="mt-1 text-xs text-stone-400">Foto, deskripsi &amp; visibilitas produk di website koperasi — diunggah dari sini, tidak perlu edit file.</p>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <label class="label">Deskripsi produk (opsional)</label>
            <textarea name="deskripsi" rows="3" maxlength="600" placeholder="mis. Beras premium hasil panen lokal, dikemas 5 kg..."
                      class="input resize-none">{{ $d }}</textarea>
            <p class="mt-1 text-xs text-stone-400">Ditampilkan di kartu produk website publik. Maksimal 600 karakter.</p>
        </div>

        <div>
            <label class="label">Foto produk</label>
            <input type="file" name="foto" accept="image/jpeg,image/png,image/webp"
                   class="input file:mr-3 file:rounded-lg file:border-0 file:bg-teal-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-teal-700 hover:file:bg-teal-100">
            <p class="mt-1 text-xs text-stone-400">JPG / PNG / WebP, maks 2 MB. Kalau kosong, kartu produk memakai ilustrasi otomatis.</p>
        </div>
        <div class="flex items-end gap-3 pb-1">
            @if (!empty($barang) && $barang->foto)
                <img src="{{ $barang->foto }}" alt="Foto produk saat ini"
                     class="h-14 w-20 rounded-lg border border-stone-200 object-cover">
                <span class="text-xs text-stone-400">Foto saat ini — upload baru untuk mengganti.</span>
            @endif
        </div>

        <div class="flex items-center pt-1 sm:col-span-2">
            <label class="flex items-center gap-2 text-sm text-zinc-600">
                <input type="checkbox" name="tampil_publik" value="1" @checked($tp)
                       class="rounded border-zinc-300 accent-teal-700">
                Tampilkan di website publik
            </label>
        </div>
    </div>
</div>
