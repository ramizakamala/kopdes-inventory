@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    {{-- ═══ Hero ═══ --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-teal-50/80 via-white to-white">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-teal-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 top-40 h-80 w-80 rounded-full bg-amber-200/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-5xl px-5 pb-14 pt-16 text-center lg:pt-24">
            <span class="inline-flex items-center gap-2 rounded-full bg-teal-700/10 px-4 py-1.5 text-sm font-semibold text-teal-700 ring-1 ring-inset ring-teal-700/15">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
                Koperasi Desa Makmur
            </span>
            <h1 class="mx-auto mt-5 max-w-3xl text-4xl font-semibold leading-[1.1] tracking-tight text-stone-900 sm:text-5xl lg:text-6xl">
                Kebutuhan pokok untuk <span class="text-teal-700">seluruh warga</span> desa.
            </h1>
            <p class="mx-auto mt-5 max-w-xl text-lg leading-relaxed text-stone-500">
                Sembako, sarana pertanian, dan produk kesehatan dengan harga jujur —
                stok selalu terpantau langsung dari sistem persediaan.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3.5 text-base font-semibold text-white shadow-lg shadow-teal-700/25 transition hover:bg-teal-800">
                    Beli Sekarang
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('kontak') }}" class="inline-flex items-center gap-1 text-base font-semibold text-teal-700 transition hover:underline">
                    Hubungi kami
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            {{-- Preview katalog live --}}
            <div class="mt-14 rounded-3xl border border-stone-200/60 bg-white p-6 text-left shadow-xl shadow-stone-200/60 sm:p-10">
                <div class="flex items-baseline justify-between">
                    <h2 class="text-xl font-semibold tracking-tight text-stone-900 sm:text-2xl">Produk pilihan.</h2>
                    <a href="{{ route('produk') }}" class="text-sm font-semibold text-teal-700 hover:underline">Lihat semua ›</a>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
                    @forelse ($produkUnggulan->take(4) as $p)
                        <div class="rounded-2xl border border-stone-100 bg-[#FAF7F1] p-5 transition hover:-translate-y-0.5 hover:shadow-md">
                            <x-kategori-chip :kategori="$p->kategori" size="h-10 w-10" icon="h-5 w-5" />
                            <div class="mt-3 truncate text-[15px] font-semibold text-stone-900">{{ $p->nama_barang }}</div>
                            <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }}</div>
                            <div class="mt-3 flex items-end justify-between gap-2">
                                <div class="text-[15px] font-semibold tabular-nums text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
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
    <section class="border-y border-stone-200/60 bg-[#FAF7F1]">
        <div class="mx-auto grid max-w-5xl grid-cols-3 px-5 py-7">
            <div class="text-center">
                <div class="text-xl font-semibold tabular-nums text-stone-900 lg:text-2xl">{{ $totalBarang }}</div>
                <div class="mt-0.5 text-xs text-stone-400">Jenis Produk</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-semibold tabular-nums text-stone-900 lg:text-2xl">{{ $totalKategori }}</div>
                <div class="mt-0.5 text-xs text-stone-400">Kategori</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-semibold tabular-nums text-amber-600 lg:text-2xl">100%</div>
                <div class="mt-0.5 text-xs text-stone-400">Harga Jujur</div>
            </div>
        </div>
    </section>

    {{-- ═══ Layanan ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Apa yang kami sediakan</p>
                <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Layanan koperasi.</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Kebutuhan warga desa tersedia di koperasi kami — dikelola rapi, transparan, dan selalu ada.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($kategoris as $kat)
                    <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}" class="group rounded-3xl border border-stone-200/60 bg-[#FAF7F1] p-7 transition hover:-translate-y-1 hover:shadow-lg">
                        <x-kategori-chip :kategori="$kat" />
                        <h3 class="mt-5 text-lg font-semibold tracking-tight text-stone-900">{{ $kat->nama_kategori }}</h3>
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

    {{-- ═══ Produk unggulan ═══ --}}
    <section class="bg-[#FAF7F1]">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Paling dicari</p>
                    <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Produk unggulan.</h2>
                    <p class="mt-3 text-[15px] text-stone-500">Ketersediaan stok diperbarui langsung dari sistem persediaan.</p>
                </div>
                <a href="{{ route('produk') }}" class="text-sm font-semibold text-teal-700 hover:underline">Semua produk ›</a>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($produkUnggulan as $p)
                    <div class="rounded-3xl border border-stone-200/60 bg-white p-6 transition hover:-translate-y-1 hover:shadow-lg">
                        <x-kategori-chip :kategori="$p->kategori" />
                        <h3 class="mt-4 text-[15px] font-semibold leading-snug text-stone-900">{{ $p->nama_barang }}</h3>
                        <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                        <div class="mt-4 flex items-end justify-between gap-2 border-t border-stone-100 pt-4">
                            <div class="text-lg font-semibold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                            <x-stok-badge :barang="$p" />
                        </div>
                    </div>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-400">Produk belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ CTA ═══ --}}
    <section class="bg-white pb-4">
        <div class="mx-auto max-w-5xl px-5">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-teal-700 via-teal-800 to-teal-950 px-8 py-16 text-center shadow-xl shadow-teal-900/25">
                <div class="pointer-events-none absolute -left-20 -top-20 h-64 w-64 rounded-full bg-teal-400/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-amber-300/10 blur-3xl"></div>
                <svg class="pointer-events-none absolute right-10 top-8 h-8 w-8 text-amber-300/40" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
                <h2 class="relative text-3xl font-semibold tracking-tight text-white sm:text-4xl">Ada pertanyaan atau ingin bergabung?</h2>
                <p class="relative mx-auto mt-4 max-w-xl text-[15px] leading-relaxed text-teal-100/70">
                    Hubungi pengurus koperasi — kami siap membantu kebutuhan Anda.
                </p>
                <div class="relative mt-8 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-7 py-3 text-base font-semibold text-teal-800 shadow-lg transition hover:bg-teal-50">
                        Hubungi Kami
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('produk') }}" class="inline-flex items-center gap-1 text-base font-semibold text-teal-300 transition hover:text-white hover:underline">
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
