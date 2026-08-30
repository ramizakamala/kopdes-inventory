@php
    $n = old('nama_kategori', $kategori->nama_kategori ?? '');
    $d = old('deskripsi', $kategori->deskripsi ?? '');
@endphp

@if ($errors->any())
    <div class="flash-error !mb-5">{{ $errors->first() }}</div>
@endif

<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="label">Nama Kategori</label>
        <input type="text" name="nama_kategori" value="{{ $n }}" required placeholder="mis. Sembako"
               class="input">
        @error('nama_kategori')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Deskripsi</label>
        <textarea name="deskripsi" rows="3" placeholder="Opsional"
                  class="input">{{ $d }}</textarea>
        @error('deskripsi')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
</div>
