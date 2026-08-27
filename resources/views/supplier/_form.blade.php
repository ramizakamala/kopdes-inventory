@php
    $n = old('nama_supplier', $supplier->nama_supplier ?? '');
    $k = old('kontak', $supplier->kontak ?? '');
    $a = old('alamat', $supplier->alamat ?? '');
    $c = old('catatan', $supplier->catatan ?? '');
@endphp

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label class="label">Nama Supplier</label>
        <input type="text" name="nama_supplier" value="{{ $n }}" required placeholder="mis. Toko Berkah Jaya"
               class="input">
        @error('nama_supplier')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Kontak</label>
        <input type="text" name="kontak" value="{{ $k }}" placeholder="Telepon / WA"
               class="input">
        @error('kontak')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Alamat</label>
        <input type="text" name="alamat" value="{{ $a }}" placeholder="Opsional"
               class="input">
        @error('alamat')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="label">Catatan</label>
        <textarea name="catatan" rows="3" placeholder="Opsional"
                  class="input">{{ $c }}</textarea>
        @error('catatan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
</div>
