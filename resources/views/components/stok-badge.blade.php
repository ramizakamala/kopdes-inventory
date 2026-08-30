@props(['barang'])

@php
    $s = match ($barang->status) {
        'habis' => ['label' => 'Habis', 'class' => 'bg-red-50 text-red-700 ring-red-200'],
        'menipis' => ['label' => 'Stok Menipis', 'class' => 'bg-amber-50 text-amber-700 ring-amber-200'],
        default => ['label' => 'Tersedia', 'class' => 'bg-green-50 text-green-700 ring-green-200'],
    };
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-[13px] font-bold ring-1 ring-inset {{ $s['class'] }}">
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $s['label'] }}
</span>
