<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Koperasi Desa Kradenan') · SIMPERDES</title>
    <meta name="description" content="Koperasi Desa Kradenan, kebutuhan pokok, sarana pertanian, dan produk kesehatan untuk warga desa. Cek stok dan harga langsung dari sistem.">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-canvas font-sans text-stone-900 antialiased">

    {{-- ═══ Scroll Progress Bar ═══ --}}
    <div id="scroll-progress" class="scroll-progress"></div>

    {{-- ═══ Navigasi ═══ --}}
    <header class="sticky top-0 z-40 border-b border-stone-200/60 bg-white/85 backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-5xl items-center justify-between gap-4 px-5">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-teal-700 shadow-sm">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                </div>
                <div class="leading-none">
                    <div class="text-[15px] font-bold tracking-tight text-stone-900">Koperasi Desa</div>
                    <div class="text-[11px] font-medium text-stone-400 mt-0.5">Kradenan · SIMPERDES</div>
                </div>
            </a>

            {{-- Nav Desktop --}}
            <nav class="hidden items-center gap-1 md:flex">
                @foreach([['home','Beranda'],['produk','Produk'],['tentang','Tentang'],['kontak','Kontak']] as [$r,$label])
                <a href="{{ route($r) }}"
                   class="relative px-3 py-2 text-sm font-semibold transition-colors {{ request()->routeIs($r) ? 'text-teal-700' : 'text-stone-600 hover:text-stone-900' }}">
                    {{ $label }}
                    @if(request()->routeIs($r))
                        <span class="absolute bottom-0 left-3 right-3 h-0.5 rounded-full bg-teal-600"></span>
                    @endif
                </a>
                @endforeach
            </nav>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}"
                   class="hidden items-center gap-1.5 rounded-full border border-stone-200 bg-white px-4 py-1.5 text-sm font-semibold text-stone-700 shadow-sm transition hover:border-teal-300 hover:text-teal-700 sm:flex">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Login Staff
                </a>
                <button id="menu-toggle" type="button"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-stone-600 transition hover:bg-stone-100 md:hidden"
                        aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
                    <svg id="icon-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg id="icon-close" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu Mobile --}}
        <div id="mobile-menu" class="hidden border-t border-stone-100 bg-white/95 px-5 py-3 md:hidden">
            <div class="flex flex-col gap-0.5">
                @foreach([['home','Beranda'],['produk','Produk'],['tentang','Tentang'],['kontak','Kontak']] as [$r,$label])
                <a href="{{ route($r) }}"
                   class="rounded-xl px-4 py-3 text-[15px] font-semibold transition {{ request()->routeIs($r) ? 'bg-teal-50 text-teal-800' : 'text-stone-700 hover:bg-stone-50' }}">
                    {{ $label }}
                </a>
                @endforeach
                <a href="{{ route('login') }}"
                   class="mt-2 flex items-center gap-2 rounded-xl border border-stone-200 px-4 py-3 text-[15px] font-semibold text-stone-700">
                    <svg class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Login Staff
                </a>
            </div>
        </div>
    </header>

    {{-- ═══ Konten ═══ --}}
    <main>
        @if (session('kontak_success'))
            <div class="mx-auto mt-6 max-w-5xl px-5">
                <div class="flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-[15px] font-medium text-green-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('kontak_success') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="mx-auto mt-6 max-w-5xl px-5">
                <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-[15px] font-medium text-red-700">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ═══ Footer (Light) ═══ --}}
    <footer class="mt-24 border-t border-stone-200 bg-stone-50 text-stone-500">
        <div class="mx-auto max-w-5xl px-5 pt-16 pb-8">

            {{-- Top: Brand + Links --}}
            <div class="flex flex-col gap-12 md:flex-row md:justify-between">
                {{-- Brand --}}
                <div class="max-w-xs">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-700 shadow-sm">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                            </svg>
                        </div>
                        <div class="leading-none">
                            <div class="font-bold text-stone-900">Koperasi Desa Kradenan</div>
                            <div class="text-xs text-stone-400 mt-0.5">SIMPERDES</div>
                        </div>
                    </div>
                    <p class="mt-5 text-sm leading-relaxed text-stone-500">
                        Kebutuhan pokok, sarana pertanian, dan produk kesehatan untuk warga desa.
                        Harga jujur, stok transparan, dikelola bersama untuk kesejahteraan warga Kradenan.
                    </p>
                </div>

                {{-- Links --}}
                <div class="grid grid-cols-2 gap-10 sm:grid-cols-3">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-stone-700">Menu</div>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li><a href="{{ route('home') }}" class="transition hover:text-teal-700">Beranda</a></li>
                            <li><a href="{{ route('produk') }}" class="transition hover:text-teal-700">Katalog Produk</a></li>
                            <li><a href="{{ route('tentang') }}" class="transition hover:text-teal-700">Tentang Kami</a></li>
                            <li><a href="{{ route('kontak') }}" class="transition hover:text-teal-700">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-stone-700">Kontak</div>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li>
                                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                                   class="flex items-center gap-1.5 transition hover:text-green-700">
                                    <svg class="h-3.5 w-3.5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    +62 812-3456-7890
                                </a>
                            </li>
                            <li><a href="mailto:halo@koperasidesa.id" class="transition hover:text-teal-700">halo@koperasidesa.id</a></li>
                            <li class="text-stone-400 text-xs leading-relaxed">Jl. Raya Sumpiuh, Kradenan, Kec. Sumpiuh, Banyumas 53196</li>
                        </ul>
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-stone-700">Jam Layanan</div>
                        <div class="mt-4 space-y-3">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="h-2 w-2 rounded-full bg-green-500 shrink-0" aria-hidden="true"></span>
                                <span class="font-semibold text-stone-900">Senin – Jumat</span>
                            </div>
                            <div class="text-sm">07.15 – 15.30 WIB</div>
                            <div class="text-xs text-stone-400">Sabtu &amp; Minggu: Tutup</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="mt-12 flex flex-wrap items-center justify-between gap-3 border-t border-stone-200 pt-6 text-xs text-stone-400">
                <span>&copy; {{ date('Y') }} Koperasi Desa Kradenan. Hak cipta dilindungi.</span>
                <a href="{{ route('login') }}" class="transition hover:text-stone-600">Login Staff &middot; Ditenagai SIMPERDES</a>
            </div>
        </div>
    </footer>

    {{-- ═══ WhatsApp Floating Button ═══ --}}
    <a href="https://wa.me/6281234567890?text=Halo%20Koperasi%20Desa%20Kradenan%2C%20saya%20ingin%20menanyakan%20stok%20barang."
       target="_blank" rel="noopener" class="whatsapp-float" aria-label="Chat via WhatsApp">
        <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script>
        // ── Scroll progress bar
        (function () {
            var bar = document.getElementById('scroll-progress');
            function update() {
                var scrolled = window.scrollY / Math.max(1, document.body.scrollHeight - window.innerHeight);
                bar.style.width = Math.min(scrolled * 100, 100) + '%';
            }
            window.addEventListener('scroll', update, { passive: true });
        })();

        // ── Mobile menu toggle
        (function () {
            var btn   = document.getElementById('menu-toggle');
            var menu  = document.getElementById('mobile-menu');
            var open  = document.getElementById('icon-open');
            var close = document.getElementById('icon-close');
            if (!btn) return;
            btn.addEventListener('click', function () {
                var hidden = menu.classList.toggle('hidden');
                btn.setAttribute('aria-expanded', String(!hidden));
                open.classList.toggle('hidden', !hidden);
                close.classList.toggle('hidden', hidden);
            });
        })();

        // ── Reveal on scroll
        (function () {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) { e.target.classList.add('revealed'); io.unobserve(e.target); }
                });
            }, { threshold: 0.08 });
            document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
        })();

        // ── Animated counters
        (function () {
            function easeOutExpo(t) { return t === 1 ? 1 : 1 - Math.pow(2, -10 * t); }
            function animateCounter(el) {
                var target   = parseInt(el.dataset.counter, 10) || 0;
                var duration = 1600;
                var start    = null;
                function step(ts) {
                    if (!start) start = ts;
                    var progress = Math.min((ts - start) / duration, 1);
                    var value    = Math.floor(easeOutExpo(progress) * target);
                    el.textContent = value.toLocaleString('id-ID');
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }
            var counterObs = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) { animateCounter(e.target); counterObs.unobserve(e.target); }
                });
            }, { threshold: 0.5 });
            document.querySelectorAll('[data-counter]').forEach(function (el) { counterObs.observe(el); });
        })();

        // ── Product search (hanya halaman produk)
        (function () {
            var input = document.getElementById('search-produk');
            if (!input) return;
            input.addEventListener('input', function () {
                var q = this.value.toLowerCase().trim();
                document.querySelectorAll('[data-nama]').forEach(function (card) {
                    var match = !q || card.dataset.nama.toLowerCase().includes(q);
                    card.style.display = match ? '' : 'none';
                });
                var empty = document.getElementById('produk-empty');
                if (empty) {
                    var any = Array.from(document.querySelectorAll('[data-nama]')).some(function(c){ return c.style.display !== 'none'; });
                    empty.classList.toggle('hidden', any);
                }
            });
        })();
    </script>
</body>
</html>
