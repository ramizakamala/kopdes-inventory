@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    {{-- ═══ Hero ═══ --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-teal-950 via-teal-900 to-teal-700">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-teal-400/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 right-0 h-[30rem] w-[30rem] rounded-full bg-cyan-300/10 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-5 py-20 lg:grid-cols-2 lg:px-8 lg:py-28">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-semibold text-teal-100 ring-1 ring-inset ring-white/20">
                    <span class="h-2 w-2 rounded-full bg-teal-300"></span>
                    Koperasi Desa untuk Warga
                </span>
                <h1 class="mt-6 text-4xl font-black leading-tight tracking-tight text-white lg:text-5xl">
                    Kebutuhan pokok &amp; sarana pertanian,<br class="hidden lg:block">
                    <span class="text-teal-300">harga bersahabat</span> untuk desa.
                </h1>
                <p class="mt-6 max-w-lg text-lg leading-relaxed text-teal-100/80">
                    Koperasi Desa Makmur menyediakan sembako, sarana pertanian, dan produk kesehatan
                    untuk warga desa. Stok selalu terpantau, harga jujur, pelayanan ramah.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 rounded-xl bg-teal-400 px-6 py-3.5 text-base font-bold text-teal-950 shadow-lg shadow-teal-950/30 transition hover:bg-teal-300">
                        Lihat Katalog Produk
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-6 py-3.5 text-base font-bold text-white ring-1 ring-inset ring-white/25 transition hover:bg-white/20">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            {{-- Kartu glass produk --}}
            <div class="relative">
                <div class="rounded-3xl border border-white/15 bg-white/10 p-6 shadow-2xl shadow-teal-950/40 backdrop-blur-xl">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-semibold text-teal-100">Produk Pilihan</div>
                        <a href="{{ route('produk') }}" class="text-sm font-bold text-teal-300 hover:text-teal-200">Lihat semua →</a>
                    </div>
                    <div class="mt-5 space-y-3">
                        @forelse ($produkUnggulan->take(4) as $p)
                            <div class="flex items-center gap-4 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-inset ring-white/10">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-400/20 text-teal-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="truncate text-[15px] font-bold text-white">{{ $p->nama_barang }}</div>
                                    <div class="text-xs text-teal-100/60">{{ $p->kategori?->nama_kategori ?? 'Umum' }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[15px] font-extrabold tabular-nums text-teal-300">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                    <div class="text-xs text-teal-100/50">{{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="py-8 text-center text-sm text-teal-100/60">Produk belum tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="relative border-t border-white/10">
            <div class="mx-auto grid max-w-7xl grid-cols-3 divide-x divide-white/10 px-5 py-8 lg:px-8">
                <div class="px-4 text-center">
                    <div class="text-3xl font-black tabular-nums text-white lg:text-4xl">{{ $totalBarang }}</div>
                    <div class="mt-1 text-xs font-medium uppercase tracking-wider text-teal-100/60 lg:text-sm">Jenis Produk</div>
                </div>
                <div class="px-4 text-center">
                    <div class="text-3xl font-black tabular-nums text-white lg:text-4xl">{{ $totalKategori }}</div>
                    <div class="mt-1 text-xs font-medium uppercase tracking-wider text-teal-100/60 lg:text-sm">Kategori</div>
                </div>
                <div class="px-4 text-center">
                    <div class="text-3xl font-black tabular-nums text-white lg:text-4xl">100%</div>
                    <div class="mt-1 text-xs font-medium uppercase tracking-wider text-teal-100/60 lg:text-sm">Harga Jujur</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Layanan ═══ --}}
    <section class="mx-auto max-w-7xl px-5 py-16 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-stone-900">Layanan Koperasi</h2>
            <p class="mx-auto mt-3 max-w-2xl text-[15px] leading-relaxed text-stone-500">
                Berbagai kebutuhan warga desa tersedia di koperasi kami, dikelola rapi dan transparan.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($kategoris as $kat)
                <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}" class="group card p-6 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-700 transition group-hover:bg-teal-700 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-stone-900">{{ $kat->nama_kategori }}</h3>
                    <p class="mt-1.5 text-sm leading-relaxed text-stone-500">{{ $kat->deskripsi ?? 'Kebutuhan warga desa.' }}</p>
                    <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-teal-700">
                        Lihat produk
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>
            @empty
                <p class="col-span-full py-10 text-center text-stone-500">Belum ada kategori.</p>
            @endforelse
        </div>
    </section>

    {{-- ═══ Produk unggulan ═══ --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-stone-900">Produk Unggulan</h2>
                    <p class="mt-3 text-[15px] text-stone-500">Ketersediaan stok diperbarui langsung dari sistem persediaan.</p>
                </div>
                <a href="{{ route('produk') }}" class="btn btn-outline">Semua Produk</a>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($produkUnggulan as $p)
                    <div class="card flex flex-col p-5">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-teal-500 to-teal-700 text-white shadow-sm">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>
                            </div>
                            <x-stok-badge :barang="$p" />
                        </div>
                        <h3 class="mt-4 text-[15px] font-bold leading-snug text-stone-900">{{ $p->nama_barang }}</h3>
                        <div class="mt-0.5 text-xs font-medium text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                        <div class="mt-4 flex items-end justify-between border-t border-stone-100 pt-4">
                            <div class="text-lg font-extrabold tabular-nums tracking-tight text-teal-700">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                            <div class="text-xs text-stone-400">Stok {{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-500">Produk belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ CTA ═══ --}}
    <section class="mx-auto max-w-7xl px-5 pt-16 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-teal-800 to-teal-950 px-8 py-14 text-center shadow-xl shadow-teal-900/20">
            <div class="pointer-events-none absolute -left-20 -top-20 h-64 w-64 rounded-full bg-teal-400/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-cyan-300/10 blur-3xl"></div>
            <h2 class="relative text-3xl font-extrabold tracking-tight text-white lg:text-4xl">Punya pertanyaan atau ingin bergabung?</h2>
            <p class="relative mx-auto mt-4 max-w-xl text-[15px] leading-relaxed text-teal-100/70">
                Hubungi pengurus koperasi — kami siap membantu kebutuhan Anda.
            </p>
            <div class="relative mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('kontak') }}" class="rounded-xl bg-teal-400 px-6 py-3 text-base font-bold text-teal-950 shadow-lg transition hover:bg-teal-300">Hubungi Kami</a>
                <a href="{{ route('produk') }}" class="rounded-xl bg-white/10 px-6 py-3 text-base font-bold text-white ring-1 ring-inset ring-white/25 transition hover:bg-white/20">Lihat Produk</a>
            </div>
        </div>
    </section>
@endsection
