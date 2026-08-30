@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    {{-- ═══ Hero (split) ═══ --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-teal-50/70 via-white to-white">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-teal-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 top-40 h-80 w-80 rounded-full bg-amber-200/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-3xl px-5 pb-16 pt-20 text-center lg:pt-28">
            <h1 class="text-4xl font-semibold leading-[1.1] tracking-tight text-stone-900 sm:text-5xl lg:text-6xl">
                Kebutuhan pokok warga desa, <span class="text-teal-700">stoknya bisa dicek dari rumah.</span>
            </h1>
            <p class="mx-auto mt-5 max-w-xl text-lg leading-relaxed text-stone-500">
                Beras, minyak, pupuk, obat. Harganya wajar dan stoknya selalu kelihatan,
                jadi nggak perlu nebak-nebak sebelum datang ke koperasi.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3.5 text-base font-semibold text-white shadow-lg shadow-teal-700/25 transition hover:bg-teal-800">
                    Cek Stok &amp; Harga
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('kontak') }}" class="inline-flex items-center gap-1 text-base font-semibold text-teal-700 transition hover:underline">
                    Hubungi pengurus
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ Statistik (data asli) ═══ --}}
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
                <div class="text-xl font-semibold tabular-nums text-stone-900 lg:text-2xl">{{ number_format($totalStok) }}</div>
                <div class="mt-0.5 text-xs text-stone-400">Unit Stok</div>
            </div>
        </div>
    </section>

    {{-- ═══ Keunggulan ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal grid gap-12 md:grid-cols-3 md:gap-10">
                <div class="border-t-2 border-teal-600 pt-6">
                    <div class="text-4xl font-bold tabular-nums text-teal-600/25">01</div>
                    <h3 class="mt-3 text-lg font-semibold tracking-tight text-stone-900">Stok nggak pernah bohong</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">
                        Setiap barang masuk atau keluar langsung dicatat. Angka yang muncul di website ini
                        sama persis dengan yang ada di rak koperasi.
                    </p>
                </div>
                <div class="border-t-2 border-teal-600 pt-6">
                    <div class="text-4xl font-bold tabular-nums text-teal-600/25">02</div>
                    <h3 class="mt-3 text-lg font-semibold tracking-tight text-stone-900">Harga terbuka</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">
                        Harga beli dan jual tercatat rapi di kasir. Warga boleh tanya kapan saja,
                        nggak ada harga rahasia.
                    </p>
                </div>
                <div class="border-t-2 border-teal-600 pt-6">
                    <div class="text-4xl font-bold tabular-nums text-teal-600/25">03</div>
                    <h3 class="mt-3 text-lg font-semibold tracking-tight text-stone-900">Keuntungan buat desa</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">
                        Sisa hasil usaha dikembalikan untuk bantuan pertanian, beasiswa anak sekolah,
                        dan perbaikan fasilitas umum.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Layanan + form tanya barang ═══ --}}
    <section class="border-y border-stone-100 bg-stone-50">
        <div class="mx-auto max-w-6xl px-5 py-20 lg:py-24">
            <div class="reveal grid gap-10 lg:grid-cols-5">
                {{-- Daftar layanan: satu panel menyatu --}}
                <div class="lg:col-span-3">
                    <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Apa yang kami sediakan</p>
                    <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Layanan koperasi.</h2>
                    <p class="mt-3 max-w-md text-[15px] leading-relaxed text-stone-500">
                        Klik kategori untuk lihat stok dan harganya.
                    </p>

                    <div class="mt-8 divide-y divide-stone-200/70 rounded-2xl border border-stone-200 bg-white">
                        @forelse ($kategoris as $kat)
                            <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}"
                               class="group flex items-center gap-4 px-5 py-5 transition hover:bg-stone-50 sm:px-6">
                                <x-kategori-chip :kategori="$kat" size="h-11 w-11" icon="h-5 w-5" />
                                <div class="min-w-0 flex-1">
                                    <div class="text-[15px] font-semibold text-stone-900 group-hover:text-teal-700">{{ $kat->nama_kategori }}</div>
                                    <div class="mt-0.5 text-sm leading-relaxed text-stone-500">{{ $kat->deskripsi ?? 'Kebutuhan warga desa.' }}</div>
                                </div>
                                <svg class="h-4 w-4 shrink-0 text-stone-300 transition group-hover:translate-x-0.5 group-hover:text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @empty
                            <p class="px-6 py-10 text-center text-stone-400">Belum ada kategori.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Form nyata: primary action --}}
                <div class="lg:col-span-2">
                    <div class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">
                        <h3 class="text-xl font-semibold tracking-tight text-stone-900">Tanya stok atau pesan barang</h3>
                        <p class="mt-2 text-sm leading-relaxed text-stone-500">
                            Isi form ini, pesanan masuk langsung ke pengurus dan dibalas maksimal 1×24 jam.
                        </p>
                        <form method="POST" action="{{ route('kontak.kirim') }}" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <label for="lnama" class="label">Nama <span class="text-red-500">*</span></label>
                                <input id="lnama" type="text" name="nama" value="{{ old('nama') }}" required
                                       placeholder="Nama lengkap" autocomplete="name" class="input !bg-stone-50">
                            </div>
                            <div>
                                <label for="ltelepon" class="label">No. WhatsApp</label>
                                <input id="ltelepon" type="tel" name="telepon" value="{{ old('telepon') }}"
                                       placeholder="08xx-xxxx-xxxx" autocomplete="tel" inputmode="tel" class="input !bg-stone-50">
                            </div>
                            <div>
                                <label for="lbarang" class="label">Barang yang dicari</label>
                                <select id="lbarang" name="barang" class="input !bg-stone-50">
                                    <option value="">— Pilih barang (opsional) —</option>
                                    @foreach ($barangs as $b)
                                        <option value="{{ $b->nama_barang }}" @selected(old('barang') == $b->nama_barang)>{{ $b->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="lpesan" class="label">Pesan <span class="text-red-500">*</span></label>
                                <textarea id="lpesan" name="pesan" rows="4" required placeholder="mis. Beras 5kg masih ada berapa?"
                                          class="input !bg-stone-50 resize-none">{{ old('pesan') }}</textarea>
                            </div>
                            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-full bg-teal-700 px-6 py-3 text-[15px] font-semibold text-white transition hover:bg-teal-800">
                                Kirim Pertanyaan
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Produk unggulan ═══ --}}
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
                    <a href="{{ route('produk', ['kategori_id' => $p->kategori_id]) }}" class="group overflow-hidden rounded-3xl border border-stone-200/70 bg-white shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg">
                        <div class="overflow-hidden">
                            <x-produk-art :barang="$p" />
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h3 class="text-[15px] font-semibold leading-snug text-stone-900 group-hover:text-teal-700">{{ $p->nama_barang }}</h3>
                                    <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                                </div>
                                <x-stok-badge :barang="$p" />
                            </div>
                            <div class="mt-4 flex items-end justify-between gap-2">
                                <div class="text-lg font-semibold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                <div class="text-xs tabular-nums text-stone-400">{{ $p->stok_saat_ini }} / min {{ $p->stok_minimum }}</div>
                            </div>
                            <div class="mt-2.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                                <div class="h-full rounded-full {{ $bar }} transition-all duration-700" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-400">Produk belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ Testimoni ═══ --}}
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
                        "Kemarin takut kehabisan minyak goreng, eh pas buka website ini masih kelihatan
                        stoknya 8. Pas ke koperasi, beneran masih ada."
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
                        "Musim tanam kemarin pupuk sempat menipis, tapi pengurus langsung restock
                        sebelum saya butuh. Sekarang saya cek dulu dari rumah."
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
                        "Biasanya belanja di warung, sekarang cek harga dulu di sini. Ternyata beras
                        premium di koperasi lebih murah dua ribu per karung."
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

    {{-- ═══ Hubungi pengurus ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Hubungi pengurus</p>
                <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">Langsung chat pengurus.</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Balasan maksimal 1×24 jam di hari kerja. Atau datang langsung, kasir buka setiap hari.
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

            <div class="reveal mt-8 text-center">
                <a href="{{ route('kontak') }}" class="text-sm font-semibold text-teal-700 hover:underline">
                    Lebih suka tulis pesan? Buka halaman kontak ›
                </a>
            </div>
        </div>
    </section>
@endsection
