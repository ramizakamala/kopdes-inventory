<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Koperasi Desa Makmur') — SIMPERDES</title>
    <meta name="description" content="Koperasi Desa — kebutuhan pokok, sarana pertanian, dan produk kesehatan untuk warga desa.">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-canvas font-sans text-stone-800 antialiased">

    {{-- ═══ Navigasi ═══ --}}
    <header class="sticky top-0 z-40 border-b border-white/40 bg-white/70 backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-5 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <x-logo size="h-10 w-10" icon="h-5 w-5" />
                <span class="text-lg font-extrabold tracking-tight text-stone-900">
                    Koperasi Desa <span class="text-teal-700">Makmur</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}" class="rounded-lg px-3.5 py-2 text-[15px] font-semibold transition {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-800' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">Beranda</a>
                <a href="{{ route('produk') }}" class="rounded-lg px-3.5 py-2 text-[15px] font-semibold transition {{ request()->routeIs('produk') ? 'bg-teal-50 text-teal-800' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">Produk</a>
                <a href="{{ route('tentang') }}" class="rounded-lg px-3.5 py-2 text-[15px] font-semibold transition {{ request()->routeIs('tentang') ? 'bg-teal-50 text-teal-800' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">Tentang</a>
                <a href="{{ route('kontak') }}" class="rounded-lg px-3.5 py-2 text-[15px] font-semibold transition {{ request()->routeIs('kontak') ? 'bg-teal-50 text-teal-800' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">Kontak</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-[15px] font-semibold text-stone-700 shadow-sm transition hover:border-stone-300 hover:bg-stone-50">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Login Staff
                </a>
                <a href="{{ route('produk') }}" class="hidden rounded-xl bg-teal-700 px-4 py-2 text-[15px] font-bold text-white shadow-sm shadow-teal-700/25 transition hover:bg-teal-800 sm:inline-flex">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    </header>

    {{-- ═══ Konten ═══ --}}
    <main>
        @if (session('kontak_success'))
            <div class="mx-auto mt-6 max-w-7xl px-5 lg:px-8">
                <div class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-[15px] font-medium text-green-800">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('kontak_success') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="mx-auto mt-6 max-w-7xl px-5 lg:px-8">
                <div class="flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-[15px] font-medium text-red-700">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ═══ Footer ═══ --}}
    <footer class="mt-20 bg-teal-950 text-teal-100/80">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 py-14 md:grid-cols-3 lg:px-8">
            <div>
                <div class="flex items-center gap-3">
                    <x-logo size="h-10 w-10" icon="h-5 w-5" tile="rounded-xl bg-teal-500 shadow-teal-500/25" />
                    <span class="text-lg font-extrabold tracking-tight text-white">Koperasi Desa Makmur</span>
                </div>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-teal-100/60">
                    Koperasi desa yang menyediakan kebutuhan pokok, sarana pertanian, dan produk kesehatan
                    dengan harga bersahabat untuk kesejahteraan warga.
                </p>
            </div>
            <div>
                <div class="text-sm font-bold uppercase tracking-wider text-teal-300/70">Menu</div>
                <ul class="mt-4 space-y-2.5 text-[15px]">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('produk') }}" class="transition hover:text-white">Katalog Produk</a></li>
                    <li><a href="{{ route('tentang') }}" class="transition hover:text-white">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="transition hover:text-white">Kontak</a></li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-white">Login Staff</a></li>
                </ul>
            </div>
            <div>
                <div class="text-sm font-bold uppercase tracking-wider text-teal-300/70">Kontak</div>
                <ul class="mt-4 space-y-2.5 text-[15px]">
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-teal-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Jl. Raya Desa No. 1, Kec. Contoh, Kab. Contoh
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 shrink-0 text-teal-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        +62 812-3456-7890
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 shrink-0 text-teal-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        halo@koperasidesa.id
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 shrink-0 text-teal-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Senin – Sabtu, 07.00 – 17.00 WIB
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-2 px-5 py-5 text-xs text-teal-100/50 lg:px-8">
                <span>&copy; {{ date('Y') }} Koperasi Desa Makmur</span>
                <span>Ditenagai SIMPERDES &middot; Sistem Manajemen Persediaan Koperasi Desa</span>
            </div>
        </div>
    </footer>
</body>
</html>
