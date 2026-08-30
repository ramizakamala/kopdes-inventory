@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    {{-- ═══ Hero (split: teks kiri, visual kanan) ═══ --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-teal-50/70 via-white to-white">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-teal-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 top-40 h-80 w-80 rounded-full bg-amber-200/30 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-6xl items-center gap-14 px-5 pb-16 pt-16 lg:grid-cols-2 lg:pt-24">
            {{-- Teks --}}
            <div class="text-center lg:text-left">
                <span class="inline-flex items-center gap-2 rounded-full bg-teal-700/10 px-4 py-1.5 text-sm font-semibold text-teal-700 ring-1 ring-inset ring-teal-700/15">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-teal-500 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-teal-600"></span>
                    </span>
                    Stok terpantau real-time
                </span>
                <h1 class="mt-5 text-4xl font-semibold leading-[1.1] tracking-tight text-stone-900 sm:text-5xl lg:text-6xl">
                    Kebutuhan pokok untuk <span class="text-teal-700">seluruh warga</span> desa.
                </h1>
                <p class="mx-auto mt-5 max-w-xl text-lg leading-relaxed text-stone-500 lg:mx-0">
                    Sembako, sarana pertanian, dan produk kesehatan dengan harga jujur —
                    ketersediaan stok bisa dicek langsung di website ini.
                </p>
                <div class="mt-8 flex flex-wrap items-center justify-center gap-4 lg:justify-start">
                    <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3.5 text-base font-semibold text-white shadow-lg shadow-teal-700/25 transition hover:bg-teal-800">
                        Lihat Produk
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
            </div>

            {{-- Visual: heksagon + chip melayang --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="relative rounded-[2rem] border border-stone-200/70 bg-gradient-to-br from-white to-teal-50/50 p-10 shadow-xl shadow-stone-200/60">
                    <svg class="float-slow mx-auto h-44 w-44" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <defs>
                            <linearGradient id="hexGrad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#0d9488" />
                                <stop offset="100%" stop-color="#134e4a" />
                            </linearGradient>
                        </defs>
                        <path d="M12 2.5 20 7v10l-8 4.5L4 17V7l8-4.5Z" stroke="url(#hexGrad)" stroke-width="1.4" />
                        <path d="M8.5 17v-5" stroke="#0d9488" stroke-width="1.8" />
                        <path d="M12 17v-6.5" stroke="#14b8a6" stroke-width="1.8" />
                        <path d="M15.5 17v-8" stroke="#2dd4bf" stroke-width="1.8" />
                    </svg>

                    <div class="float-slower absolute -left-3 top-8 flex items-center gap-2.5 rounded-2xl border border-stone-200/70 bg-white/95 px-4 py-2.5 shadow-lg shadow-stone-200/60 backdrop-blur">
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-sm">
                            <div class="font-semibold text-stone-900">Stok real-time</div>
                            <div class="text-xs text-stone-400">selalu diperbarui</div>
                        </div>
                    </div>

                    <div class="float-slow absolute -right-2 bottom-12 flex items-center gap-2.5 rounded-2xl border border-stone-200/70 bg-white/95 px-4 py-2.5 shadow-lg shadow-stone-200/60 backdrop-blur">
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </div>
                        <div class="text-sm">
                            <div class="font-semibold text-stone-900">Harga jujur</div>
                            <div class="text-xs text-stone-400">tanpa markup</div>
                        </div>
                    </div>

                    <div class="float-slower absolute -bottom-4 left-8 flex items-center gap-2.5 rounded-2xl border border-stone-200/70 bg-white/95 px-4 py-2.5 shadow-lg shadow-stone-200/60 backdrop-blur">
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-teal-50 text-teal-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z" />
                            </svg>
                        </div>
                        <div class="text-sm">
                            <div class="font-semibold text-stone-900">Layanan ramah</div>
                            <div class="text-xs text-stone-400">untuk semua warga</div>
                        </div>
                    </div>
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

    {{-- ═══ Keunggulan (nomor besar) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal grid gap-10 md:grid-cols-3">
                <div class="border-t-2 border-teal-600 pt-6">
                    <div class="text-4xl font-bold tabular-nums text-teal-600/25">01</div>
                    <h3 class="mt-3 text-lg font-semibold tracking-tight text-stone-900">Stok selalu terpantau</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">
                        Ketersediaan barang diperbarui langsung dari sistem persediaan koperasi — warga bisa cek sebelum datang.
                    </p>
                </div>
                <div class="border-t-2 border-teal-600 pt-6">
                    <div class="text-4xl font-bold tabular-nums text-teal-600/25">02</div>
                    <h3 class="mt-3 text-lg font-semibold tracking-tight text-stone-900">Harga jujur &amp; transparan</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">
                        Setiap transaksi tercatat rapi. Tidak ada harga diam-diam — semua warga mendapat harga yang sama.
                    </p>
                </div>
                <div class="border-t-2 border-teal-600 pt-6">
                    <div class="text-4xl font-bold tabular-nums text-teal-600/25">03</div>
                    <h3 class="mt-3 text-lg font-semibold tracking-tight text-stone-900">Dikelola gotong royong</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">
                        Diurus pengurus terpilih dari warga, keuntungan kembali untuk kemajuan desa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Layanan ═══ --}}
    <section class="border-y border-stone-100 bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Apa yang kami sediakan</p>
                <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Layanan koperasi.</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Kebutuhan warga desa tersedia di koperasi kami — dikelola rapi, transparan, dan selalu ada.
                </p>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($kategoris as $kat)
                    <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}" class="group rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg">
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

    {{-- ═══ Produk unggulan (dengan progress stok) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Paling dicari</p>
                    <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Produk unggulan.</h2>
                    <p class="mt-3 text-[15px] text-stone-500">Bar stok menunjukkan posisi stok dibanding batas minimum.</p>
                </div>
                <a href="{{ route('produk') }}" class="text-sm font-semibold text-teal-700 hover:underline">Semua produk ›</a>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($produkUnggulan as $p)
                    @php
                        $pct = min(100, (int) round($p->stok_saat_ini / max(1, $p->stok_minimum) * 100));
                        $bar = $p->status === 'habis' ? 'bg-red-500' : ($p->status === 'menipis' ? 'bg-amber-500' : 'bg-green-500');
                    @endphp
                    <div class="group rounded-3xl border border-stone-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg">
                        <div class="flex items-start justify-between gap-2">
                            <x-kategori-chip :kategori="$p->kategori" />
                            <x-stok-badge :barang="$p" />
                        </div>
                        <h3 class="mt-4 text-[15px] font-semibold leading-snug text-stone-900">{{ $p->nama_barang }}</h3>
                        <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                        <div class="mt-4 flex items-end justify-between gap-2">
                            <div class="text-lg font-semibold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                            <div class="text-xs tabular-nums text-stone-400">{{ $p->stok_saat_ini }} / min {{ $p->stok_minimum }}</div>
                        </div>
                        <div class="mt-2.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                            <div class="h-full rounded-full {{ $bar }} transition-all duration-700" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-400">Produk belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ Testimoni warga ═══ --}}
    <section class="border-y border-stone-100 bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Kata warga</p>
                <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Mereka yang belanja di sini.</h2>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 md:grid-cols-3">
                <div class="rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm">
                    <svg class="h-6 w-6 text-teal-600/40" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                    </svg>
                    <p class="mt-4 text-[15px] leading-relaxed text-stone-600">
                        "Beras dan minyak selalu ada, harganya wajar. Tinggal cek stoknya di website dulu, nggak sia-sia ke koperasi."
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-100 text-sm font-bold text-teal-800">BS</div>
                        <div>
                            <div class="text-sm font-semibold text-stone-900">Bu Sari</div>
                            <div class="text-xs text-stone-400">Warga Dusun Sidomulyo</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm">
                    <svg class="h-6 w-6 text-teal-600/40" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                    </svg>
                    <p class="mt-4 text-[15px] leading-relaxed text-stone-600">
                        "Kalau butuh pupuk atau obat tanaman, tinggal ke koperasi. Stoknya jelas, nggak pernah kehabisan drama."
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-lime-100 text-sm font-bold text-lime-800">PJ</div>
                        <div>
                            <div class="text-sm font-semibold text-stone-900">Pak Joko</div>
                            <div class="text-xs text-stone-400">Petani, anggota koperasi</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm">
                    <svg class="h-6 w-6 text-teal-600/40" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                    </svg>
                    <p class="mt-4 text-[15px] leading-relaxed text-stone-600">
                        "Website-nya keren, pelayanannya juga ramah. Anak muda kayak saya jadi betah belanja di koperasi sendiri."
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sky-100 text-sm font-bold text-sky-800">RN</div>
                        <div>
                            <div class="text-sm font-semibold text-stone-900">Rina</div>
                            <div class="text-xs text-stone-400">Anggota muda koperasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Hubungi kami (fungsional) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Hubungi kami</p>
                <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Punya pertanyaan?</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Pengurus koperasi siap membantu — telepon langsung, kirim WhatsApp, atau datang ke koperasi.
                </p>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
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

            <div class="reveal mt-10 text-center">
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
