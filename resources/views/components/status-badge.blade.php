@props(['status'])

@php
    $map = [
        'habis' => ['label' => 'Habis', 'class' => 'bg-red-50 text-red-700 ring-red-200'],
        'menipis' => ['label' => 'Menipis', 'class' => 'bg-amber-50 text-amber-700 ring-amber-200'],
        'aman' => ['label' => 'Aman', 'class' => 'bg-green-50 text-green-700 ring-green-200'],
    ];
    $s = $map[$status] ?? $map['aman'];
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $s['class'] }}">
    {{ $s['label'] }}
</span>
