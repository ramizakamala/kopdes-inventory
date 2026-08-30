@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    {{-- ═══ Hero ═══ --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-teal-50/70 via-white to-white">
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
            <div class="mt-14 rounded-3xl border border-stone-200/70 bg-white p-6 text-left shadow-xl shadow-stone-200/50 sm:p-10">
                <div class="flex items-baseline justify-between">
                    <h2 class="text-xl font-semibold tracking-tight text-stone-900 sm:text-2xl">Produk pilihan.</h2>
                    <a href="{{ route('produk') }}" class="text-sm font-semibold text-teal-700 hover:underline">Lihat semua ›</a>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
                    @forelse ($produkUnggulan->take(4) as $p)
                        <div class="rounded-2xl border border-stone-100 bg-stone-50 p-5 transition hover:-translate-y-0.5 hover:shadow-md">
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

    {{-- ═══ Statistik ═══ --}}
    <section class="border-y border-stone-100 bg-stone-50">
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
                    <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}" class="group rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
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
    <section class="border-t border-stone-100 bg-stone-50">
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
                    <div class="rounded-3xl border border-stone-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
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

    {{-- ═══ Hubungi kami (fungsional) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Hubungi kami</p>
                <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Punya pertanyaan?</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Pengurus koperasi siap membantu — telepon langsung, kirim WhatsApp, atau datang ke koperasi.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
                <a href="https://wa.me/6281234567890?text=Halo%20Koperasi%20Desa%20Makmur" target="_blank" rel="noopener"
                   class="group rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-50 text-teal-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold tracking-tight text-stone-900">WhatsApp</h3>
                    <p class="mt-1.5 text-sm text-stone-500">+62 812-3456-7890</p>
                    <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-teal-700">
                        Chat sekarang
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>

                <a href="tel:+6281234567890"
                   class="group rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold tracking-tight text-stone-900">Telepon</h3>
                    <p class="mt-1.5 text-sm text-stone-500">+62 812-3456-7890</p>
                    <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-teal-700">
                        Hubungi sekarang
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>

                <div class="rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-100 text-stone-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-semibold tracking-tight text-stone-900">Kunjungi Koperasi</h3>
                    <p class="mt-1.5 text-sm leading-relaxed text-stone-500">Jl. Raya Desa No. 1, Kec. Contoh, Kab. Contoh</p>
                    <p class="mt-3 text-sm text-stone-400">Senin – Sabtu, 07.00 – 17.00 WIB</p>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3 text-base font-semibold text-white shadow-lg shadow-teal-700/25 transition hover:bg-teal-800">
                    Kirim Pesan
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
