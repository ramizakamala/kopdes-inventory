@props(['kategori', 'size' => 'h-12 w-12', 'icon' => 'h-6 w-6'])

@php
    $n = mb_strtolower($kategori?->nama_kategori ?? '');
    $map = [
        'sembako' => ['bg-emerald-50 text-emerald-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />'],
        'pangan' => ['bg-emerald-50 text-emerald-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />'],
        'pertanian' => ['bg-lime-50 text-lime-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M11 20A7 7 0 019.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12" />'],
        'obat' => ['bg-sky-50 text-sky-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 20.5 3.5 13.5a4.95 4.95 0 117-7l7 7a4.95 4.95 0 01-7 7z" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 8.5 7 7" />'],
        'kesehatan' => ['bg-sky-50 text-sky-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 20.5 3.5 13.5a4.95 4.95 0 117-7l7 7a4.95 4.95 0 01-7 7z" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 8.5 7 7" />'],
    ];
    $cls = 'bg-teal-50 text-teal-700';
    $path = '<path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />';
    foreach ($map as $k => [$c, $p]) {
        if (str_contains($n, $k)) { $cls = $c; $path = $p; break; }
    }
@endphp

<div class="flex {{ $size }} shrink-0 items-center justify-center rounded-2xl {{ $cls }}">
    <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
        {!! $path !!}
    </svg>
</div>
