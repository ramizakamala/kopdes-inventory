@extends('public.layout')

@section('title', 'Beranda')

@section('content')

    {{-- ═══ Hero (Clean Light) ═══ --}}
    <section class="relative overflow-hidden border-b border-stone-100 bg-white">

        {{-- Background decorations --}}
        <div class="pointer-events-none absolute inset-0">
            {{-- Soft teal glow top-right --}}
            <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-teal-200/40 blur-3xl"></div>
            {{-- Soft glow bottom-left --}}
            <div class="absolute -bottom-24 -left-24 h-80 w-80 rounded-full bg-emerald-100/50 blur-3xl"></div>
            {{-- Decorative rings --}}
            <div class="absolute right-10 top-10 h-72 w-72 rounded-full border border-teal-200/70"></div>
            <div class="absolute right-20 top-20 h-56 w-56 rounded-full border border-teal-100"></div>
            {{-- Dot grid (SVG data URI) --}}
            <div class="absolute inset-0 opacity-30"
                 style="background-image:url(&quot;data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='1' cy='1' r='1' fill='%23d6d3d1' fill-opacity='0.35'/%3E%3C/svg%3E&quot;)"></div>
        </div>

        <div class="relative mx-auto max-w-5xl px-5 pb-24 pt-20 lg:flex lg:items-center lg:gap-16 lg:pb-32 lg:pt-28">

            {{-- Left: Text content --}}
            <div class="flex-1 text-center lg:text-left">

                {{-- Trust badge --}}
                <div class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-teal-50 px-4 py-1.5 text-sm font-semibold text-teal-700">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Stok &amp; harga asli dari toko, bukan perkiraan
                </div>

                <h1 class="mt-6 text-4xl font-extrabold leading-tight tracking-tight text-stone-900 sm:text-5xl lg:text-[3.25rem]">
                    Kebutuhan pokok warga desa,
                    <span class="text-teal-700">stoknya bisa dicek dari rumah.</span>
                </h1>

                <p class="mx-auto mt-5 max-w-lg text-base leading-relaxed text-stone-600 lg:mx-0">
                    Beras, minyak, pupuk, obat. Harganya wajar dan stoknya selalu kelihatan,
                    jadi nggak perlu nebak-nebak sebelum datang ke koperasi.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                    <a href="{{ route('produk') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3.5 text-[15px] font-bold text-white shadow-sm shadow-teal-700/20 transition hover:bg-teal-800 hover:-translate-y-0.5">
                        Cek Stok &amp; Harga
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('kontak') }}"
                       class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white px-7 py-3.5 text-[15px] font-semibold text-stone-700 shadow-sm transition hover:border-teal-300 hover:text-teal-700">
                        Hubungi Pengurus
                    </a>
                </div>
            </div>

            {{-- Right: Floating product cards (desktop only, data asli dari DB) --}}
            @if($produkUnggulan->isNotEmpty())
            <div class="pointer-events-none relative mt-14 hidden w-80 shrink-0 lg:mt-0 lg:flex lg:w-96">
                {{-- Soft backdrop --}}
                <div class="absolute inset-8 rounded-full bg-teal-100/60 blur-2xl"></div>

                @php
                    $posisi = [
                        0 => 'absolute -left-4 top-0 w-52 float-slow',
                        1 => 'absolute right-0 top-24 w-48 float-alt',
                        2 => 'absolute bottom-0 left-8 w-52 float-slower',
                    ];
                    $badgeCls = fn($s) => $s === 'habis' ? 'bg-red-50 text-red-600'
                                : ($s === 'menipis' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700');
                    $barCls   = fn($s) => $s === 'habis' ? 'bg-red-500' : ($s === 'menipis' ? 'bg-amber-500' : 'bg-emerald-500');
                    $label    = fn($s) => $s === 'habis' ? 'Habis' : ($s === 'menipis' ? 'Stok menipis' : 'Stok aman');
                @endphp

                @foreach ($produkUnggulan->take(3) as $i => $p)
                    @php
                        $pct = min(100, (int) round($p->stok_saat_ini / max(1, $p->stok_minimum) * 100));
                        $st  = $p->status;
                    @endphp
                    <div class="{{ $posisi[$i] ?? $posisi[2] }}">
                        <div class="rounded-2xl border border-stone-200/80 bg-white p-4 shadow-lg shadow-stone-900/5">
                            <div class="flex items-center gap-3">
                                <x-kategori-chip :kategori="$p->kategori" size="h-10 w-10" icon="h-5 w-5" />
                                <div class="min-w-0">
                                    <div class="truncate text-sm font-bold text-stone-900">{{ $p->nama_barang }}</div>
                                    @if($i === 1)
                                        <div class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-semibold {{ $badgeCls($st) }}">
                                            {{ $label($st) }}
                                        </div>
                                    @else
                                        <div class="text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }}</div>
                                    @endif
                                </div>
                            </div>
                            @if($i !== 1)
                                <div class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                                    <div class="h-full rounded-full {{ $barCls($st) }}" style="width: {{ max(8, $pct) }}%"></div>
                                </div>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <span class="text-xs text-stone-500">{{ $label($st) }}</span>
                                    <span class="text-sm font-bold text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- ═══ Statistik (dengan Animated Counters) ═══ --}}
    <section class="bg-white border-b border-stone-100">
        <div class="mx-auto max-w-4xl px-5 py-14">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="reveal flex flex-col items-center gap-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-50 text-teal-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375C2.754 3.75 2.25 4.254 2.25 4.875v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900 lg:text-4xl"
                         data-counter="{{ $totalBarang }}">{{ $totalBarang }}</div>
                    <div class="text-sm font-medium text-stone-500">Jenis Produk</div>
                </div>
                <div class="reveal flex flex-col items-center gap-2 border-x border-stone-100">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-50 text-teal-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900 lg:text-4xl"
                         data-counter="{{ $totalKategori }}">{{ $totalKategori }}</div>
                    <div class="text-sm font-medium text-stone-500">Kategori</div>
                </div>
                <div class="reveal flex flex-col items-center gap-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-50 text-teal-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0H3.75m16.5 0l-1.883-3.766A2.25 2.25 0 0016.5 2.75h-9a2.25 2.25 0 00-1.867.984L3.75 7.5" />
                        </svg>
                    </div>
                    <div class="text-3xl font-extrabold tabular-nums tracking-tight text-stone-900 lg:text-4xl"
                         data-counter="{{ $totalStok }}">{{ number_format($totalStok) }}</div>
                    <div class="text-sm font-medium text-stone-500">Unit Stok</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Keunggulan ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal mb-12 text-center">
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Mengapa koperasi kami</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Tiga hal yang membedakan.</h2>
            </div>
            <div class="reveal grid gap-10 md:grid-cols-3">
                <div class="group rounded-3xl border border-stone-100 bg-stone-50 p-8 transition hover:border-teal-200 hover:bg-teal-50/40">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-700 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold tracking-tight text-stone-900">Stok nggak pernah bohong</h3>
                    <p class="mt-2 text-[15px] leading-relaxed text-stone-600">
                        Setiap barang masuk atau keluar langsung dicatat. Angka yang muncul di website ini
                        sama persis dengan yang ada di rak koperasi.
                    </p>
                </div>
                <div class="group rounded-3xl border border-stone-100 bg-stone-50 p-8 transition hover:border-teal-200 hover:bg-teal-50/40">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-700 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold tracking-tight text-stone-900">Harga terbuka</h3>
                    <p class="mt-2 text-[15px] leading-relaxed text-stone-600">
                        Harga jual tercatat rapi dan bisa dilihat siapa saja.
                        Warga boleh tanya kapan saja, nggak ada harga rahasia.
                    </p>
                </div>
                <div class="group rounded-3xl border border-stone-100 bg-stone-50 p-8 transition hover:border-teal-200 hover:bg-teal-50/40">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-700 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold tracking-tight text-stone-900">Keuntungan buat desa</h3>
                    <p class="mt-2 text-[15px] leading-relaxed text-stone-600">
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
                {{-- Daftar layanan --}}
                <div class="lg:col-span-3">
                    <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Apa yang kami sediakan</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Layanan koperasi.</h2>
                    <p class="mt-3 max-w-md text-[15px] leading-relaxed text-stone-600">
                        Klik kategori untuk melihat stok dan harga terkini.
                    </p>

                    <div class="mt-8 divide-y divide-stone-200/70 rounded-2xl border border-stone-200 bg-white shadow-sm">
                        @forelse ($kategoris as $kat)
                            <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}"
                               class="group flex items-center gap-4 px-5 py-5 transition hover:bg-stone-50 sm:px-6">
                                <x-kategori-chip :kategori="$kat" size="h-11 w-11" icon="h-5 w-5" />
                                <div class="min-w-0 flex-1">
                                    <div class="text-[15px] font-bold text-stone-900 group-hover:text-teal-700">{{ $kat->nama_kategori }}</div>
                                    <div class="mt-0.5 text-sm leading-relaxed text-stone-500">{{ $kat->deskripsi ?? 'Kebutuhan warga desa.' }}</div>
                                </div>
                                <svg class="h-4 w-4 shrink-0 text-stone-300 transition group-hover:translate-x-0.5 group-hover:text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @empty
                            <p class="px-6 py-10 text-center text-stone-400">Belum ada kategori.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Form tanya / pesan barang --}}
                <div class="lg:col-span-2">
                    <div class="sticky top-24 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                        <h3 class="text-xl font-bold tracking-tight text-stone-900">Tanya stok atau pesan barang</h3>
                        <p class="mt-2 text-sm leading-relaxed text-stone-600">
                            Isi form ini, pesanan masuk langsung ke pengurus dan dibalas maksimal 1&times;24 jam.
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
                                <input id="lbarang" type="text" name="barang" value="{{ old('barang') }}"
                                       placeholder="Ketik nama barang..." autocomplete="off"
                                       list="barang-list" class="input !bg-stone-50">
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
                                          class="input !bg-stone-50 resize-none">{{ old('pesan') }}</textarea>
                            </div>
                            <button type="submit"
                                    class="flex w-full items-center justify-center gap-2 rounded-full bg-teal-700 px-6 py-3 text-[15px] font-bold text-white shadow-sm transition hover:bg-teal-800 hover:-translate-y-0.5">
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
                    <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Paling dicari</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Produk unggulan.</h2>
                    <p class="mt-2 text-[15px] text-stone-600">Bar warna di kartu: hijau stok aman, kuning menipis, merah habis.</p>
                </div>
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-1 text-sm font-bold text-teal-700 hover:underline">
                    Semua produk
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($produkUnggulan as $p)
                    @php
                        $pct = min(100, (int) round($p->stok_saat_ini / max(1, $p->stok_minimum) * 100));
                        $bar = $p->status === 'habis' ? 'bg-red-500' : ($p->status === 'menipis' ? 'bg-amber-500' : 'bg-emerald-500');
                        $cardExtra = $p->status === 'menipis' ? 'pulse-menipis' : '';
                    @endphp
                    <a href="{{ route('produk', ['kategori_id' => $p->kategori_id]) }}"
                       class="group overflow-hidden rounded-3xl border border-stone-200/70 bg-white shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg {{ $cardExtra }}">
                        <div class="overflow-hidden">
                            @if ($p->foto)
                                <img src="{{ $p->foto }}" alt="{{ $p->nama_barang }}"
                                     class="aspect-[4/3] w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
                            @else
                                <x-produk-art :barang="$p" />
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h3 class="text-[15px] font-bold leading-snug text-stone-900 group-hover:text-teal-700">{{ $p->nama_barang }}</h3>
                                    <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                                    @if ($p->deskripsi)
                                        <p class="mt-2 text-[13px] leading-relaxed text-stone-500 line-clamp-2">{{ $p->deskripsi }}</p>
                                    @endif
                                </div>
                                <x-stok-badge :barang="$p" />
                            </div>
                            <div class="mt-4 flex items-end justify-between gap-2">
                                <div class="text-lg font-extrabold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                <div class="text-xs tabular-nums text-stone-400">Stok {{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
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
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Kata warga</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Mereka yang belanja di sini.</h2>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 md:grid-cols-3">
                @foreach([
                    ['BS','Bu Sari','Warga Dusun Sidomulyo','bg-teal-100 text-teal-800','"Kemarin takut kehabisan minyak goreng, eh pas buka website ini masih kelihatan stoknya 8. Pas ke koperasi, beneran masih ada."'],
                    ['PJ','Pak Joko','Petani, anggota koperasi','bg-lime-100 text-lime-800','"Musim tanam kemarin pupuk sempat menipis, tapi pengurus langsung restock sebelum saya butuh. Sekarang saya cek dulu dari rumah."'],
                    ['RN','Rina','Anggota muda koperasi','bg-sky-100 text-sky-800','"Biasanya belanja di warung, sekarang cek harga dulu di sini. Ternyata beras premium di koperasi lebih murah dua ribu per karung."'],
                ] as [$inisial,$nama,$jabatan,$avatarClass,$kutipan])
                <div class="rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm">
                    <svg class="h-7 w-7 text-teal-600/30" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                    </svg>
                    <p class="mt-4 text-[15px] leading-relaxed text-stone-600">{{ $kutipan }}</p>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $avatarClass }} text-sm font-bold">{{ $inisial }}</div>
                        <div>
                            <div class="text-sm font-bold text-stone-900">{{ $nama }}</div>
                            <div class="text-xs text-stone-400">{{ $jabatan }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ Hubungi pengurus ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Hubungi pengurus</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Langsung chat pengurus.</h2>
                <p class="mx-auto mt-3 max-w-xl text-[15px] leading-relaxed text-stone-600">
                    Balasan maksimal 1&times;24 jam di hari kerja. Atau datang langsung, kasir buka setiap hari kerja.
                </p>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
                <a href="https://wa.me/6281234567890?text=Halo%20Koperasi%20Desa%20Kradenan"
                   target="_blank" rel="noopener"
                   class="group rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-green-200 hover:shadow-lg">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 text-green-600">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold tracking-tight text-stone-900">WhatsApp</h3>
                    <p class="mt-1.5 text-sm text-stone-500">+62 812-3456-7890</p>
                    <span class="mt-4 inline-flex items-center gap-1 text-sm font-bold text-green-700">
                        Chat sekarang
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>

                <a href="tel:+6281234567890"
                   class="group rounded-3xl border border-stone-200/70 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold tracking-tight text-stone-900">Telepon</h3>
                    <p class="mt-1.5 text-sm text-stone-500">+62 812-3456-7890</p>
                    <span class="mt-4 inline-flex items-center gap-1 text-sm font-bold text-amber-700">
                        Hubungi sekarang
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
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
                    <h3 class="mt-5 text-lg font-bold tracking-tight text-stone-900">Kunjungi Koperasi</h3>
                    <p class="mt-1.5 text-sm leading-relaxed text-stone-500">Jl. Raya Sumpiuh, Kradenan, Kec. Sumpiuh, Kabupaten Banyumas, Jawa Tengah 53196</p>
                    <p class="mt-3 text-sm font-semibold text-stone-400">Senin – Jumat, 07.15 – 15.30 WIB</p>
                </div>
            </div>

            <div class="reveal mt-8 text-center">
                <a href="{{ route('kontak') }}" class="text-sm font-bold text-teal-700 hover:underline">
                    Lebih suka tulis pesan? Buka halaman kontak &rsaquo;
                </a>
            </div>
        </div>
    </section>

@endsection