@php
    $n = old('nama_supplier', $supplier->nama_supplier ?? '');
    $k = old('kontak', $supplier->kontak ?? '');
    $a = old('alamat', $supplier->alamat ?? '');
    $c = old('catatan', $supplier->catatan ?? '');
@endphp

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Nama Supplier</label>
        <input type="text" name="nama_supplier" value="{{ $n }}" required placeholder="mis. Toko Berkah Jaya"
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('nama_supplier')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Kontak</label>
        <input type="text" name="kontak" value="{{ $k }}" placeholder="Telepon / WA"
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('kontak')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Alamat</label>
        <input type="text" name="alamat" value="{{ $a }}" placeholder="Opsional"
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('alamat')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Catatan</label>
        <textarea name="catatan" rows="3" placeholder="Opsional"
                  class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">{{ $c }}</textarea>
        @error('catatan')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
</div>
