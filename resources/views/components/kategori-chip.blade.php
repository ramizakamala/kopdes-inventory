@props(['kategori', 'size' => 'h-12 w-12', 'icon' => 'h-6 w-6'])

@php
    $n = mb_strtolower($kategori?->nama_kategori ?? '');
    $map = [
        'sembako' => 'bg-emerald-50 text-emerald-600',
        'pangan' => 'bg-emerald-50 text-emerald-600',
        'pertanian' => 'bg-lime-50 text-lime-600',
        'obat' => 'bg-sky-50 text-sky-600',
        'kesehatan' => 'bg-sky-50 text-sky-600',
    ];
    $cls = 'bg-teal-50 text-teal-700';
    foreach ($map as $k => $c) {
        if (str_contains($n, $k)) { $cls = $c; break; }
    }
@endphp

<div class="flex {{ $size }} shrink-0 items-center justify-center rounded-2xl {{ $cls }}">
    <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
    </svg>
</div>
