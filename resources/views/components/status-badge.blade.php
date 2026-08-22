@props(['status'])

@php
    $map = [
        'habis' => ['label' => 'Habis', 'class' => 'bg-red-500/10 text-red-400 ring-red-500/20'],
        'menipis' => ['label' => 'Menipis', 'class' => 'bg-amber-500/10 text-amber-400 ring-amber-500/20'],
        'aman' => ['label' => 'Aman', 'class' => 'bg-emerald-500/10 text-emerald-400 ring-emerald-500/20'],
    ];
    $s = $map[$status] ?? $map['aman'];
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset {{ $s['class'] }}">
    {{ $s['label'] }}
</span>
