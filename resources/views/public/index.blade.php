@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    {{-- ═══ Hero ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 pb-10 pt-16 text-center lg:pt-24">
            <p class="text-sm font-semibold text-teal-700">Koperasi Desa Makmur</p>
            <h1 class="mx-auto mt-3 max-w-3xl text-4xl font-semibold leading-[1.1] tracking-tight text-[#1d1d1f] sm:text-5xl lg:text-6xl">
                Kebutuhan pokok untuk seluruh warga desa.
            </h1>
            <p class="mx-auto mt-5 max-w-xl text-lg leading-relaxed text-stone-500">
                Sembako, sarana pertanian, dan produk kesehatan dengan harga jujur —
                stok selalu terpantau langsung dari sistem persediaan.
            </p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-x-8 gap-y-3">
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-1 text-[17px] font-semibold text-teal-700 transition hover:underline">
                    Beli sekarang
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('kontak') }}" class="inline-flex items-center gap-1 text-[17px] font-semibold text-teal-700 transition hover:underline">
                    Hubungi kami
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            {{-- Preview katalog live --}}
            <div class="mt-14 rounded-3xl bg-[#f5f5f7] p-6 text-left sm:p-10">
                <div class="flex items-baseline justify-between">
                    <h2 class="text-xl font-semibold tracking-tight text-[#1d1d1f] sm:text-2xl">Produk pilihan.</h2>
                    <a href="{{ route('produk') }}" class="text-sm font-semibold text-teal-700 hover:underline">Lihat semua ›</a>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
                    @forelse ($produkUnggulan->take(4) as $p)
                        <div class="rounded-2xl bg-white p-5 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#f5f5f7] text-stone-500">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>
                            </div>
                            <div class="mt-3 truncate text-[15px] font-semibold text-[#1d1d1f]">{{ $p->nama_barang }}</div>
                            <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }}</div>
                            <div class="mt-3 flex items-end justify-between gap-2">
                                <div class="text-[15px] font-semibold tabular-nums text-[#1d1d1f]">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                <x-stok-badge :barang="$p" />
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full py-8 text-center text-sm text-stone-400">Produk belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Statistik tipis ═══ --}}
    <section class="border-y border-stone-100 bg-white">
        <div class="mx-auto grid max-w-5xl grid-cols-3 px-5 py-6">
            <div class="text-center">
                <div class="text-xl font-semibold tabular-nums text-[#1d1d1f] lg:text-2xl">{{ $totalBarang }}</div>
                <div class="mt-0.5 text-xs text-stone-400">Jenis Produk</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-semibold tabular-nums text-[#1d1d1f] lg:text-2xl">{{ $totalKategori }}</div>
                <div class="mt-0.5 text-xs text-stone-400">Kategori</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-semibold tabular-nums text-[#1d1d1f] lg:text-2xl">100%</div>
                <div class="mt-0.5 text-xs text-stone-400">Harga Jujur</div>
            </div>
        </div>
    </section>

    {{-- ═══ Layanan (abu muda) ═══ --}}
    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-[#1d1d1f] sm:text-4xl">Layanan koperasi.</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Kebutuhan warga desa tersedia di koperasi kami — dikelola rapi, transparan, dan selalu ada.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($kategoris as $kat)
                    <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}" class="group rounded-3xl bg-white p-7 shadow-sm transition hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#f5f5f7] text-stone-500 transition group-hover:bg-teal-50 group-hover:text-teal-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <h3 class="mt-5 text-lg font-semibold tracking-tight text-[#1d1d1f]">{{ $kat->nama_kategori }}</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-stone-500">{{ $kat->deskripsi ?? 'Kebutuhan warga desa.' }}</p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-teal-700">
                            Lihat produk
                            <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-400">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ Produk unggulan (putih) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-semibold tracking-tight text-[#1d1d1f] sm:text-4xl">Produk unggulan.</h2>
                    <p class="mt-3 text-[15px] text-stone-500">Ketersediaan stok diperbarui langsung dari sistem persediaan.</p>
                </div>
                <a href="{{ route('produk') }}" class="text-sm font-semibold text-teal-700 hover:underline">Semua produk ›</a>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($produkUnggulan as $p)
                    <div class="rounded-3xl bg-[#f5f5f7] p-6 transition hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-stone-500 shadow-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-[15px] font-semibold leading-snug text-[#1d1d1f]">{{ $p->nama_barang }}</h3>
                        <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                        <div class="mt-4 flex items-end justify-between gap-2 border-t border-stone-200/60 pt-4">
                            <div class="text-lg font-semibold tabular-nums tracking-tight text-[#1d1d1f]">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                            <x-stok-badge :barang="$p" />
                        </div>
                    </div>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-400">Produk belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ CTA hitam ═══ --}}
    <section class="bg-white pb-4">
        <div class="mx-auto max-w-5xl px-5">
            <div class="rounded-3xl bg-[#1d1d1f] px-8 py-16 text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">Ada pertanyaan atau ingin bergabung?</h2>
                <p class="mx-auto mt-4 max-w-xl text-[15px] leading-relaxed text-stone-400">
                    Hubungi pengurus koperasi — kami siap membantu kebutuhan Anda.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-x-8 gap-y-3">
                    <a href="{{ route('kontak') }}" class="inline-flex items-center gap-1 text-[17px] font-semibold text-teal-400 transition hover:underline">
                        Hubungi kami
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('produk') }}" class="inline-flex items-center gap-1 text-[17px] font-semibold text-teal-400 transition hover:underline">
                        Lihat produk
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
