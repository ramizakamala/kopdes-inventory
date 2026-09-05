@extends('public.layout')

@section('title', 'Beranda')

@section('content')
    @php
        $tersedia = $barangs->where('stok_saat_ini', '>', 0)->count();
        $menipis = $barangs->filter(fn ($b) => $b->stok_saat_ini > 0 && $b->stok_saat_ini < $b->stok_minimum)->count();
        $habis = $barangs->where('stok_saat_ini', '<=', 0)->count();
        $inisial = fn ($nama) => mb_strtoupper(mb_substr($nama, 0, 1));
    @endphp

    {{-- ═══ Hero: teks kiri + papan "stok hari ini" kanan ═══ --}}
    <section class="border-b border-stone-200/70 bg-white">
        <div class="mx-auto grid max-w-5xl grid-cols-1 gap-14 px-5 pb-16 pt-14 sm:pb-20 sm:pt-16 lg:grid-cols-12 lg:gap-10 lg:pb-24 lg:pt-20">
            <div class="flex flex-col justify-center lg:col-span-7">
                <p class="text-[13px] font-bold uppercase tracking-[0.16em] text-stone-400">Koperasi Desa Kradenan · Banyumas</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-[1.1] tracking-tight text-stone-900 sm:text-5xl lg:text-[3.4rem]">
                    Kebutuhan pokok warga desa,<br class="hidden sm:block">
                    <span class="text-teal-700">stoknya bisa dicek dari rumah.</span>
                </h1>
                <p class="mt-5 max-w-xl text-base leading-relaxed text-stone-600">
                    Beras, minyak, pupuk, obat. Harganya wajar dan stoknya selalu kelihatan,
                    jadi nggak perlu nebak-nebak sebelum datang ke koperasi.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-x-7 gap-y-4">
                    <a href="{{ route('produk') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-6 py-3 text-[15px] font-bold text-white shadow-sm transition hover:bg-teal-800">
                        Cek Stok &amp; Harga
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('kontak') }}"
                       class="text-[15px] font-bold text-stone-500 underline decoration-stone-300 decoration-2 underline-offset-4 transition hover:text-teal-700 hover:decoration-teal-600">
                        Tanya stok lewat WhatsApp
                    </a>
                </div>
                <div class="mt-7 flex flex-wrap items-center gap-x-2 gap-y-1.5 text-[13px] text-stone-400">
                    <span>Angka di situs ini catatan toko asli, bukan perkiraan.</span>
                    <span class="h-1 w-1 rounded-full bg-stone-300"></span>
                    <span>Toko buka Senin&ndash;Jumat, 07.15&ndash;15.30 WIB</span>
                </div>
            </div>

            <div class="lg:col-span-5 lg:pt-2">
                @if ($produkUnggulan->isNotEmpty())
                    <div class="rounded-xl border border-stone-200 bg-stone-50">
                        <div class="flex items-baseline justify-between gap-3 border-b border-stone-200 px-5 py-3.5">
                            <h2 class="text-[13px] font-bold uppercase tracking-[0.14em] text-stone-500">Stok hari ini</h2>
                            <span class="text-[13px] font-semibold tabular-nums text-teal-700">{{ $tersedia }} dari {{ $totalBarang }} produk tersedia</span>
                        </div>
                        <ul class="divide-y divide-stone-200">
                            @foreach ($produkUnggulan->take(4) as $p)
                                <li class="flex items-center gap-4 px-5 py-3">
                                    @if ($p->foto)
                                        <img src="{{ $p->foto }}" alt="" class="h-11 w-11 shrink-0 rounded-lg border border-stone-200 object-cover">
                                    @else
                                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-stone-200/60 text-sm font-bold text-stone-500">{{ $inisial($p->nama_barang) }}</span>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <div class="truncate text-sm font-semibold text-stone-900">{{ $p->nama_barang }}</div>
                                        <div class="text-xs text-stone-500">Stok {{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[15px] font-bold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                        <x-stok-badge :barang="$p" />
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('produk') }}"
                           class="flex items-center justify-between rounded-b-xl border-t border-stone-200 px-5 py-3 text-[13px] font-bold text-teal-700 transition hover:bg-stone-100">
                            Lihat semua produk
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="rounded-xl border border-stone-200 bg-stone-50 px-6 py-10 text-center">
                        <p class="text-sm font-semibold text-stone-700">Semua stok sedang kosong.</p>
                        <p class="mt-1.5 text-sm text-stone-500">Pengurus lagi restock. Tanya lewat WhatsApp biar dikabari begitu barang masuk.</p>
                        <a href="{{ route('kontak') }}" class="mt-4 inline-block text-sm font-bold text-teal-700 hover:underline">Hubungi pengurus</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ═══ Angka (strip data asli, bukan kartu) ═══ --}}
    <section class="border-b border-stone-200/70 bg-white">
        <div class="mx-auto grid max-w-5xl grid-cols-3 px-5">
            <div class="py-7 sm:py-9">
                <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900 sm:text-4xl" data-counter="{{ $totalBarang }}">{{ $totalBarang }}</div>
                <div class="mt-1 text-[13px] font-medium text-stone-500">jenis produk</div>
            </div>
            <div class="border-l border-stone-200 py-7 pl-6 sm:py-9 sm:pl-8">
                <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900 sm:text-4xl" data-counter="{{ $totalKategori }}">{{ $totalKategori }}</div>
                <div class="mt-1 text-[13px] font-medium text-stone-500">kategori kebutuhan</div>
            </div>
            <div class="border-l border-stone-200 py-7 pl-6 sm:py-9 sm:pl-8">
                <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900 sm:text-4xl" data-counter="{{ $totalStok }}">{{ number_format($totalStok) }}</div>
                <div class="mt-1 text-[13px] font-medium text-stone-500">unit stok tersedia</div>
            </div>
        </div>
    </section>

    {{-- ═══ Tiga hal yang membedakan (blok editorial bernomor) ═══ --}}
    <section class="border-b border-stone-200/70 bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-16 sm:py-20">
            <div class="max-w-2xl">
                <p class="text-[13px] font-bold uppercase tracking-[0.16em] text-teal-700">Mengapa koperasi kami</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">Tiga hal yang membedakan.</h2>
            </div>

            <div class="mt-10 border-y border-stone-200">
                <div class="grid grid-cols-[3rem_1fr] gap-x-4 border-b border-stone-200 py-7 last:border-b-0 sm:grid-cols-[5rem_1fr] sm:gap-x-8 sm:py-8">
                    <div class="text-2xl font-extrabold tabular-nums text-stone-300 sm:text-4xl">01</div>
                    <div class="max-w-2xl">
                        <h3 class="text-lg font-bold tracking-tight text-stone-900 sm:text-xl">Stok yang benar-benar ada</h3>
                        <p class="mt-2 text-[15px] leading-relaxed text-stone-600">
                            Setiap barang masuk atau keluar langsung dicatat. Angka yang muncul di website ini
                            sama persis dengan yang ada di rak koperasi.
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-[3rem_1fr] gap-x-4 border-b border-stone-200 py-7 last:border-b-0 sm:grid-cols-[5rem_1fr] sm:gap-x-8 sm:py-8">
                    <div class="text-2xl font-extrabold tabular-nums text-stone-300 sm:text-4xl">02</div>
                    <div class="max-w-2xl">
                        <h3 class="text-lg font-bold tracking-tight text-stone-900 sm:text-xl">Harga yang transparan</h3>
                        <p class="mt-2 text-[15px] leading-relaxed text-stone-600">
                            Harga jual tercatat rapi dan bisa dilihat siapa saja.
                            Warga boleh tanya kapan saja, nggak ada harga rahasia.
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-[3rem_1fr] gap-x-4 py-7 sm:grid-cols-[5rem_1fr] sm:gap-x-8 sm:py-8">
                    <div class="text-2xl font-extrabold tabular-nums text-stone-300 sm:text-4xl">03</div>
                    <div class="max-w-2xl">
                        <h3 class="text-lg font-bold tracking-tight text-stone-900 sm:text-xl">Keuntungan kembali ke desa</h3>
                        <p class="mt-2 text-[15px] leading-relaxed text-stone-600">
                            Sisa hasil usaha dikembalikan untuk bantuan pertanian, beasiswa anak sekolah,
                            dan perbaikan fasilitas umum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Layanan: daftar kategori + form tanya barang ═══ --}}
    <section class="border-b border-stone-200/70 bg-white">
        <div class="mx-auto max-w-5xl px-5 py-16 sm:py-20">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-14">
                <div class="lg:col-span-7">
                    <p class="text-[13px] font-bold uppercase tracking-[0.16em] text-stone-400">Apa yang kami sediakan</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">Layanan koperasi.</h2>
                    <p class="mt-3 max-w-md text-[15px] leading-relaxed text-stone-600">
                        Klik kategori untuk melihat stok dan harga terkini.
                    </p>

                    <div class="mt-8">
                        @forelse ($kategoris as $kat)
                            <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}"
                               class="group grid grid-cols-1 items-baseline gap-1 border-b border-stone-200 py-5 transition sm:grid-cols-12 sm:items-center sm:gap-6">
                                <div class="sm:col-span-5">
                                    <span class="text-lg font-bold tracking-tight text-stone-900 transition group-hover:text-teal-700">{{ $kat->nama_kategori }}</span>
                                    <span class="ml-2 text-xs font-semibold tabular-nums text-stone-400">{{ $kat->barangs_count }} produk</span>
                                </div>
                                <p class="text-sm leading-relaxed text-stone-500 sm:col-span-5">{{ $kat->deskripsi ?? 'Kebutuhan warga desa.' }}</p>
                                <div class="flex items-center gap-1.5 text-sm font-bold text-stone-400 transition group-hover:text-teal-700 sm:col-span-2 sm:justify-end">
                                    Lihat
                                    <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </div>
                            </a>
                        @empty
                            <p class="border-b border-stone-200 py-10 text-center text-stone-400">Belum ada kategori.</p>
                        @endforelse
                    </div>

                    <p class="mt-6 text-sm text-stone-500">
                        Butuh barang yang belum tercantum? Tulis di form sebelah, nanti pengurus carikan.
                    </p>
                </div>

                <div class="lg:col-span-5">
                    <div class="rounded-lg border border-stone-200 bg-stone-50 p-6 sm:p-7">
                        <h3 class="text-lg font-bold tracking-tight text-stone-900">Tanya stok atau pesan barang</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-stone-600">
                            Isi form ini, pesanan masuk langsung ke pengurus dan dibalas maksimal 1&times;24 jam.
                        </p>
                        <form method="POST" action="{{ route('kontak.kirim') }}" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <label for="lnama" class="label">Nama <span class="text-red-500">*</span></label>
                                <input id="lnama" type="text" name="nama" value="{{ old('nama') }}" required
                                       placeholder="Nama lengkap" autocomplete="name" class="input">
                            </div>
                            <div>
                                <label for="ltelepon" class="label">No. WhatsApp</label>
                                <input id="ltelepon" type="tel" name="telepon" value="{{ old('telepon') }}"
                                       placeholder="08xx-xxxx-xxxx" autocomplete="tel" inputmode="tel" class="input">
                            </div>
                            <div>
                                <label for="lbarang" class="label">Barang yang dicari</label>
                                <input id="lbarang" type="text" name="barang" value="{{ old('barang') }}"
                                       placeholder="Ketik nama barang..." autocomplete="off"
                                       list="barang-list" class="input">
                                <datalist id="barang-list">
                                    @foreach ($barangs as $b)
                                        <option value="{{ $b->nama_barang }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div>
                                <label for="lpesan" class="label">Pesan <span class="text-red-500">*</span></label>
                                <textarea id="lpesan" name="pesan" rows="4" required
                                          placeholder="mis. Beras 5kg masih ada berapa?"
                                          class="input resize-none">{{ old('pesan') }}</textarea>
                            </div>
                            <button type="submit"
                                    class="flex w-full items-center justify-center gap-2 rounded-full bg-teal-700 px-6 py-3 text-[15px] font-bold text-white shadow-sm transition hover:bg-teal-800">
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
    <section class="border-b border-stone-200/70 bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-16 sm:py-20">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="text-[13px] font-bold uppercase tracking-[0.16em] text-stone-400">Paling dicari</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">Produk unggulan.</h2>
                    <p class="mt-2 text-[15px] text-stone-600">Harga dan sisa stok sesuai catatan koperasi.</p>
                </div>
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-1 text-sm font-bold text-teal-700 hover:underline">
                    Semua produk
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($produkUnggulan as $p)
                    <a href="{{ route('produk', ['kategori_id' => $p->kategori_id]) }}"
                       class="group flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white transition hover:border-teal-600/60">
                        <div class="overflow-hidden">
                            @if ($p->foto)
                                <img src="{{ $p->foto }}" alt="{{ $p->nama_barang }}"
                                     class="aspect-[4/3] w-full object-cover transition duration-300 group-hover:scale-[1.03]" loading="lazy">
                            @else
                                <x-produk-art :barang="$p" />
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }}</div>
                                    <h3 class="mt-1 text-[15px] font-bold leading-snug text-stone-900 group-hover:text-teal-700">{{ $p->nama_barang }}</h3>
                                </div>
                                <x-stok-badge :barang="$p" />
                            </div>
                            <div class="mt-4 flex items-end justify-between gap-2 border-t border-stone-100 pt-3">
                                <div class="text-lg font-extrabold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                <div class="text-xs tabular-nums text-stone-400">sisa {{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full py-10 text-center text-stone-400">Produk belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ═══ Testimoni (quote sederhana, tanpa kartu) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-16 sm:py-20">
            <div class="max-w-2xl">
                <p class="text-[13px] font-bold uppercase tracking-[0.16em] text-stone-400">Kata warga</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">Mereka yang belanja di sini.</h2>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-10 md:grid-cols-3 md:gap-0">
                @foreach([
                    ['BS','Bu Sari','Warga Dusun Sidomulyo','"Kemarin takut kehabisan minyak goreng, eh pas buka website ini masih kelihatan stoknya 8. Pas ke koperasi, beneran masih ada."'],
                    ['PJ','Pak Joko','Petani, anggota koperasi','"Musim tanam kemarin pupuk sempat menipis, tapi pengurus langsung restock sebelum saya butuh. Sekarang saya cek dulu dari rumah."'],
                    ['RN','Rina','Anggota muda koperasi','"Biasanya belanja di warung, sekarang cek harga dulu di sini. Ternyata beras premium di koperasi lebih murah dua ribu per karung."'],
                ] as [$inisialAvatar, $nama, $jabatan, $kutipan])
                    <figure class="md:px-8 md:first:pl-0 md:last:pr-0 {{ $loop->first ? '' : 'md:border-l md:border-stone-200' }}">
                        <blockquote class="text-[15px] leading-relaxed text-stone-700">{{ $kutipan }}</blockquote>
                        <figcaption class="mt-5 flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-stone-200/80 text-[13px] font-bold text-stone-600">{{ $inisialAvatar }}</span>
                            <span>
                                <span class="block text-sm font-bold text-stone-900">{{ $nama }}</span>
                                <span class="block text-xs text-stone-400">{{ $jabatan }}</span>
                            </span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ Hubungi pengurus (info praktis, bukan kartu) ═══ --}}
    <section class="border-t border-stone-200/70 bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-16 sm:py-20">
            <div class="max-w-2xl">
                <p class="text-[13px] font-bold uppercase tracking-[0.16em] text-teal-700">Hubungi pengurus</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">Langsung, tanpa antre.</h2>
                <p class="mt-3 text-[15px] leading-relaxed text-stone-600">
                    Tanya stok, nanya harga, atau pesan barang. Balasan maksimal 1&times;24 jam di hari kerja.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-0 md:grid-cols-3 md:gap-0">
                <a href="https://wa.me/6281234567890?text=Halo%20Koperasi%20Desa%20Kradenan"
                   target="_blank" rel="noopener"
                   class="group border-b border-stone-200 py-6 md:border-b-0 md:py-0 md:pr-8">
                    <div class="flex items-center gap-2 text-stone-400">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span class="text-[11px] font-bold uppercase tracking-[0.14em] text-stone-400">WhatsApp</span>
                    </div>
                    <div class="mt-3 text-lg font-bold tabular-nums tracking-tight text-stone-900">+62 812-3456-7890</div>
                    <div class="mt-1 inline-flex items-center gap-1 text-sm font-bold text-teal-700">
                        Chat sekarang
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </a>

                <a href="tel:+6281234567890"
                   class="group border-b border-stone-200 py-6 md:border-b-0 md:border-l md:border-stone-200 md:px-8 md:py-0">
                    <div class="flex items-center gap-2 text-stone-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <span class="text-[11px] font-bold uppercase tracking-[0.14em] text-stone-400">Telepon</span>
                    </div>
                    <div class="mt-3 text-lg font-bold tabular-nums tracking-tight text-stone-900">+62 812-3456-7890</div>
                    <div class="mt-1 inline-flex items-center gap-1 text-sm font-bold text-teal-700">
                        Hubungi sekarang
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </a>

                <div class="py-6 md:border-l md:border-stone-200 md:px-8 md:py-0">
                    <div class="flex items-center gap-2 text-stone-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="text-[11px] font-bold uppercase tracking-[0.14em] text-stone-400">Kunjungi toko</span>
                    </div>
                    <div class="mt-3 text-[15px] font-bold leading-snug text-stone-900">Jl. Raya Sumpiuh, Kradenan, Kec. Sumpiuh, Banyumas 53196</div>
                    <div class="mt-1 text-sm text-stone-500">Senin&ndash;Jumat, 07.15&ndash;15.30 WIB</div>
                </div>
            </div>

            <div class="mt-10 border-t border-stone-200 pt-6">
                <a href="{{ route('kontak') }}" class="text-sm font-bold text-teal-700 hover:underline">
                    Lebih suka tulis pesan? Buka halaman kontak &rsaquo;
                </a>
            </div>
        </div>
    </section>
@endsection
