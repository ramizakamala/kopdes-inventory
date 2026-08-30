<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — SIMPERDES</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @php
        $nama = auth()->user()->name;
        $role = auth()->user()->role;
        $inisial = strtoupper(mb_substr($nama, 0, 1));
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now()->dayOfWeek];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][now()->month - 1];
        $tanggalHariIni = $hari . ', ' . now()->format('j') . ' ' . $bulan . ' ' . now()->format('Y');
    @endphp
</head>
<body class="min-h-screen bg-canvas font-sans text-stone-800 antialiased">
    <div class="min-h-screen lg:flex">

        {{-- ═══ Sidebar ═══ --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-green-950 transition-transform duration-200 lg:static lg:translate-x-0">
            {{-- Brand --}}
            <div class="flex items-center gap-3 px-5 py-6">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-400 text-emerald-950 shadow-lg shadow-emerald-500/20">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-extrabold tracking-tight text-white">SIMPERDES</div>
                    <div class="text-xs font-medium text-emerald-200/60">Manajemen Persediaan</div>
                </div>
            </div>

            {{-- Navigasi --}}
            <nav class="flex-1 space-y-0.5 overflow-y-auto px-3 pb-4">
                <div class="nav-section">Ringkasan</div>
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('monitoring.index') }}"
                   class="nav-link {{ request()->routeIs('monitoring.*') ? 'nav-link-active' : '' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    Monitoring Stok
                </a>

                <div class="nav-section">Kelola Data</div>
                <a href="{{ route('barang.index') }}"
                   class="nav-link {{ request()->routeIs('barang.*') ? 'nav-link-active' : '' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                    Data Barang
                </a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('kategori.index') }}"
                       class="nav-link {{ request()->routeIs('kategori.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        Kategori
                    </a>
                    <a href="{{ route('supplier.index') }}"
                       class="nav-link {{ request()->routeIs('supplier.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        Supplier
                    </a>
                @endif

                @if (auth()->user()->isAdmin())
                    <div class="nav-section">Transaksi</div>
                    <a href="{{ route('barang-masuk.index') }}"
                       class="nav-link {{ request()->routeIs('barang-masuk.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        Barang Masuk
                    </a>
                    <a href="{{ route('barang-keluar.index') }}"
                       class="nav-link {{ request()->routeIs('barang-keluar.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-4.5-9L12 3m0 0L7.5 7.5M12 3v13.5" />
                        </svg>
                        Barang Keluar
                    </a>
                    <a href="{{ route('penyesuaian-stok.index') }}"
                       class="nav-link {{ request()->routeIs('penyesuaian-stok.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        Penyesuaian Stok
                    </a>
                @endif

                <div class="nav-section">Laporan &amp; Analisis</div>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('restock.index') }}"
                       class="nav-link {{ request()->routeIs('restock.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        Rekomendasi Restock
                    </a>
                @endif
                <a href="{{ route('laporan.index') }}"
                   class="nav-link {{ request()->routeIs('laporan.*') ? 'nav-link-active' : '' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Laporan
                </a>
                @if (auth()->user()->isAdmin())
                    <div class="nav-section">Pengaturan</div>
                    <a href="{{ route('pengguna.index') }}"
                       class="nav-link {{ request()->routeIs('pengguna.*') ? 'nav-link-active' : '' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        Pengguna
                    </a>
                @endif
            </nav>

            {{-- Profil pengguna --}}
            <div class="border-t border-white/10 px-4 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-400/15 text-sm font-bold text-emerald-300 ring-1 ring-inset ring-emerald-400/30">{{ $inisial }}</div>
                    <div class="min-w-0 flex-1">
                        <div class="truncate text-sm font-semibold text-white">{{ $nama }}</div>
                        <div class="text-xs capitalize text-emerald-200/60">{{ $role }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar" class="flex h-9 w-9 items-center justify-center rounded-xl text-emerald-200/60 transition hover:bg-white/10 hover:text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ═══ Konten utama ═══ --}}
        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-30 border-b border-stone-200/70 bg-white/85 backdrop-blur">
                <div class="flex items-center justify-between gap-4 px-5 py-4 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button id="menu-toggle" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-stone-200 bg-white text-stone-600 lg:hidden">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                        <div>
                            <h1 class="page-title">@yield('title')</h1>
                            <p class="page-subtitle">@yield('subtitle', 'Sistem Manajemen Persediaan Koperasi Desa')</p>
                        </div>
                    </div>
                    <div class="hidden items-center gap-3 sm:flex">
                        <span class="text-sm font-medium text-stone-500">{{ $tanggalHariIni }}</span>
                        <span class="h-5 w-px bg-stone-200"></span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold capitalize text-emerald-700 ring-1 ring-inset ring-emerald-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            {{ $role }}
                        </span>
                    </div>
                </div>
            </header>

            <main class="mx-auto w-full max-w-[1400px] flex-1 px-5 py-6 lg:px-8">
                @if (session('success'))
                    <div class="flash-success">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="flash-error">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="px-5 pb-5 text-center text-xs text-stone-400 lg:px-8">
                SIMPERDES — Sistem Manajemen Persediaan Koperasi Desa
            </footer>
        </div>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
