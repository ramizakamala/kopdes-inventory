@props(['status'])

@php
    $map = [
        'habis' => ['label' => 'Habis', 'class' => 'bg-red-50 text-red-700 ring-red-200'],
        'menipis' => ['label' => 'Menipis', 'class' => 'bg-amber-50 text-amber-700 ring-amber-200'],
        'aman' => ['label' => 'Aman', 'class' => 'bg-emerald-50 text-emerald-700 ring-emerald-200'],
    ];
    $s = $map[$status] ?? $map['aman'];
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-[13px] font-bold ring-1 ring-inset {{ $s['class'] }}">
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $s['label'] }}
</span>
