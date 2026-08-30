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
<body class="bg-white font-sans text-stone-900 antialiased">

    {{-- ═══ Navigasi ═══ --}}
    <header class="sticky top-0 z-40 border-b border-stone-200/60 bg-white/75 backdrop-blur-xl">
        <div class="mx-auto flex h-12 max-w-5xl items-center justify-between gap-4 px-5">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <x-logo size="h-7 w-7" icon="h-4 w-4" tile="rounded-lg bg-teal-700 shadow-teal-700/25" />
                <span class="text-[15px] font-semibold tracking-tight text-stone-900">Koperasi Desa Makmur</span>
            </a>

            <nav class="hidden items-center gap-6 md:flex">
                <a href="{{ route('home') }}" class="text-sm font-medium transition {{ request()->routeIs('home') ? 'text-teal-700' : 'text-stone-600 hover:text-stone-900' }}">Beranda</a>
                <a href="{{ route('produk') }}" class="text-sm font-medium transition {{ request()->routeIs('produk') ? 'text-teal-700' : 'text-stone-600 hover:text-stone-900' }}">Produk</a>
                <a href="{{ route('tentang') }}" class="text-sm font-medium transition {{ request()->routeIs('tentang') ? 'text-teal-700' : 'text-stone-600 hover:text-stone-900' }}">Tentang</a>
                <a href="{{ route('kontak') }}" class="text-sm font-medium transition {{ request()->routeIs('kontak') ? 'text-teal-700' : 'text-stone-600 hover:text-stone-900' }}">Kontak</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="hidden items-center gap-1.5 text-sm font-medium text-stone-600 transition hover:text-stone-900 sm:flex">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Login Staff</span>
                </a>
                <button id="menu-toggle" type="button" class="flex h-9 w-9 items-center justify-center rounded-lg text-stone-600 transition hover:bg-stone-100 md:hidden">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu mobile --}}
        <div id="mobile-menu" class="hidden border-t border-stone-200/60 bg-white px-5 py-3 md:hidden">
            <div class="flex flex-col">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2.5 text-[15px] font-semibold {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-800' : 'text-stone-700' }}">Beranda</a>
                <a href="{{ route('produk') }}" class="rounded-lg px-3 py-2.5 text-[15px] font-semibold {{ request()->routeIs('produk') ? 'bg-teal-50 text-teal-800' : 'text-stone-700' }}">Produk</a>
                <a href="{{ route('tentang') }}" class="rounded-lg px-3 py-2.5 text-[15px] font-semibold {{ request()->routeIs('tentang') ? 'bg-teal-50 text-teal-800' : 'text-stone-700' }}">Tentang</a>
                <a href="{{ route('kontak') }}" class="rounded-lg px-3 py-2.5 text-[15px] font-semibold {{ request()->routeIs('kontak') ? 'bg-teal-50 text-teal-800' : 'text-stone-700' }}">Kontak</a>
                <a href="{{ route('login') }}" class="mt-1 rounded-lg border-t border-stone-100 px-3 py-3 text-[15px] font-semibold text-teal-700">Login Staff</a>
            </div>
        </div>
    </header>

    {{-- ═══ Konten ═══ --}}
    <main>
        @if (session('kontak_success'))
            <div class="mx-auto mt-6 max-w-5xl px-5">
                <div class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-[15px] font-medium text-green-800">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('kontak_success') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="mx-auto mt-6 max-w-5xl px-5">
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
    <footer class="mt-24 border-t border-stone-200/70 bg-white">
        <div class="mx-auto max-w-5xl px-5 py-12">
            <p class="max-w-3xl text-xs leading-relaxed text-stone-500">
                Koperasi Desa Makmur — koperasi desa yang menyediakan kebutuhan pokok, sarana pertanian,
                dan produk kesehatan untuk kesejahteraan warga. Ketersediaan stok ditampilkan secara
                langsung dari sistem persediaan koperasi.
            </p>

            <div class="mt-8 grid grid-cols-2 gap-8 md:grid-cols-4">
                <div>
                    <div class="text-xs font-semibold text-stone-700">Menu</div>
                    <ul class="mt-3 space-y-2 text-xs text-stone-500">
                        <li><a href="{{ route('home') }}" class="hover:text-stone-900">Beranda</a></li>
                        <li><a href="{{ route('produk') }}" class="hover:text-stone-900">Katalog Produk</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-stone-900">Tentang Kami</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-stone-900">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <div class="text-xs font-semibold text-stone-700">Kategori</div>
                    <ul class="mt-3 space-y-2 text-xs text-stone-500">
                        <li><a href="{{ route('produk') }}" class="hover:text-stone-900">Sembako</a></li>
                        <li><a href="{{ route('produk') }}" class="hover:text-stone-900">Sarana Pertanian</a></li>
                        <li><a href="{{ route('produk') }}" class="hover:text-stone-900">Produk Kesehatan</a></li>
                    </ul>
                </div>
                <div>
                    <div class="text-xs font-semibold text-stone-700">Kontak</div>
                    <ul class="mt-3 space-y-2 text-xs text-stone-500">
                        <li>Jl. Raya Desa No. 1</li>
                        <li>+62 812-3456-7890</li>
                        <li>halo@koperasidesa.id</li>
                    </ul>
                </div>
                <div>
                    <div class="text-xs font-semibold text-stone-700">Jam Layanan</div>
                    <ul class="mt-3 space-y-2 text-xs text-stone-500">
                        <li>Senin – Sabtu</li>
                        <li>07.00 – 17.00 WIB</li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 flex flex-wrap items-center justify-between gap-2 border-t border-stone-200 pt-5 text-xs text-stone-400">
                <span>&copy; {{ date('Y') }} Koperasi Desa Makmur. Hak cipta dilindungi.</span>
                <a href="{{ route('login') }}" class="hover:text-stone-600">Login Staff &middot; Ditenagai SIMPERDES</a>
            </div>
        </div>
    </footer>

    <script>
        // toggle menu mobile
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // reveal on scroll
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('revealed'); io.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
    </script>
</body>
</html>
