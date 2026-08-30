@props(['barang'])

@php
    $s = match ($barang->status) {
        'habis' => ['label' => 'Habis', 'class' => 'text-red-600'],
        'menipis' => ['label' => 'Stok Menipis', 'class' => 'text-amber-600'],
        default => ['label' => 'Tersedia', 'class' => 'text-green-700'],
    };
@endphp

<span class="inline-flex items-center gap-1.5 text-[13px] font-semibold {{ $s['class'] }}">
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $s['label'] }}
</span>
