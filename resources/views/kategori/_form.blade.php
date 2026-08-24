@php
    $n = old('nama_kategori', $kategori->nama_kategori ?? '');
    $d = old('deskripsi', $kategori->deskripsi ?? '');
@endphp

<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Nama Kategori</label>
        <input type="text" name="nama_kategori" value="{{ $n }}" required placeholder="mis. Sembako"
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('nama_kategori')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Deskripsi</label>
        <textarea name="deskripsi" rows="3" placeholder="Opsional"
                  class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">{{ $d }}</textarea>
        @error('deskripsi')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
</div>
