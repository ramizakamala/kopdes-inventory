@props([
    'size' => 'h-11 w-11',
])

{{-- Logo Koperasi Desa Kradenan (asli) — dipakai di sidebar admin, login, dan halaman error. --}}
<img src="{{ asset('images/logo-kopdes.jpg') }}" alt="Logo Koperasi Desa Kradenan"
     class="{{ $size }} shrink-0 rounded-[16%] object-contain">
