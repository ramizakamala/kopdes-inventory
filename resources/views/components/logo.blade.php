@props([
    'size' => 'h-11 w-11',
    'icon' => 'h-6 w-6',
    'tile' => 'rounded-xl bg-teal-700 shadow-teal-700/25',
])

<div class="flex {{ $size }} shrink-0 items-center justify-center {{ $tile }} text-white shadow-sm">
    <svg class="{{ $icon }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2.5 20 7v10l-8 4.5L4 17V7l8-4.5Z" stroke-width="1.6" />
        <path d="M8.5 17v-5" stroke-width="2" />
        <path d="M12 17v-6.5" stroke-width="2" />
        <path d="M15.5 17v-8" stroke-width="2" />
    </svg>
</div>
