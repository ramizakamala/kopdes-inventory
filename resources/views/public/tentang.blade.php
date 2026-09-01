@extends('public.layout')

@section('title', 'Tentang Kami')

@section('content')

    {{-- ═══ Hero Tentang ═══ --}}
    <section class="border-b border-stone-100 bg-white">
        <div class="mx-auto max-w-4xl px-5 py-16 text-center lg:py-20">
            <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Tentang Kami</p>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-stone-900 sm:text-5xl">
                Koperasi untuk warga, <br class="hidden sm:block">oleh warga.
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-[15px] leading-relaxed text-stone-600">
                Koperasi Desa Kradenan berdiri sebagai wadah ekonomi warga. Kami menyediakan kebutuhan
                pokok sehari-hari, sarana pertanian, hingga produk kesehatan dengan harga yang jujur
                dan terjangkau, dikelola secara gotong royong, transparan, dan tercatat rapi.
            </p>
        </div>
    </section>

    {{-- ═══ Angka nyata koperasi ═══ --}}
    <section class="bg-gradient-to-br from-emerald-950 via-teal-900 to-stone-900">
        <div class="mx-auto max-w-4xl px-5 py-14">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="reveal">
                    <div class="text-4xl font-extrabold text-teal-400 tabular-nums" data-counter="{{ $totalBarang }}">{{ $totalBarang }}</div>
                    <div class="mt-1.5 text-sm font-medium text-teal-200/70">Jenis produk tersedia</div>
                </div>
                <div class="reveal border-x border-white/10">
                    <div class="text-4xl font-extrabold text-teal-400 tabular-nums" data-counter="{{ $totalStok }}">{{ number_format($totalStok) }}</div>
                    <div class="mt-1.5 text-sm font-medium text-teal-200/70">Unit stok siap melayani</div>
                </div>
                <div class="reveal">
                    <div class="text-4xl font-extrabold text-teal-400 tabular-nums" data-counter="{{ $totalKategori }}">{{ $totalKategori }}</div>
                    <div class="mt-1.5 text-sm font-medium text-teal-200/70">Kategori kebutuhan</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Cerita koperasi (Timeline) ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-4xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Perjalanan kami</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Dari desa, untuk desa.</h2>
            </div>

            <div class="reveal relative mt-14">
                {{-- Timeline line --}}
                <div class="absolute left-5 top-0 h-full w-0.5 bg-stone-100 md:left-1/2 md:-translate-x-0.5" aria-hidden="true"></div>

                <div class="space-y-12">
                    @foreach([
                        ['Berdiri','Koperasi Desa Kradenan didirikan dengan semangat gotong royong untuk menyejahterakan warga. Dimulai dari warung kecil di balai desa.','bg-teal-700','text-teal-600'],
                        ['Berkembang','Jumlah anggota dan jenis produk terus bertambah. Koperasi mulai mengelola sarana pertanian dan produk kesehatan selain sembako.','bg-emerald-700','text-emerald-600'],
                        ['Digitalisasi','Sistem SIMPERDES diluncurkan, seluruh stok dan transaksi kini tercatat digital. Warga bisa cek stok dari rumah.','bg-teal-700','text-teal-600'],
                        ['Sekarang','Koperasi terus tumbuh. Keuntungan dialokasikan untuk beasiswa, bantuan pertanian, dan perbaikan fasilitas umum desa.','bg-emerald-700','text-emerald-600'],
                    ] as $i => [$judul,$deskripsi,$dotClass,$labelClass])
                    <div class="relative flex items-start gap-8 md:justify-end {{ $i % 2 == 1 ? 'md:flex-row-reverse' : '' }}">
                        {{-- Dot --}}
                        <div class="absolute left-5 flex h-10 w-10 shrink-0 -translate-x-5 items-center justify-center rounded-full border-4 border-white {{ $dotClass }} shadow-md md:left-1/2 md:-translate-x-5">
                            <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        {{-- Content --}}
                        <div class="ml-14 md:ml-0 md:w-5/12">
                            <div class="rounded-2xl border border-stone-100 bg-stone-50 p-6 shadow-sm">
                                <div class="{{ $labelClass }} mb-2 text-xs font-bold uppercase tracking-wider">
                                    {{ $judul }}
                                </div>
                                <p class="text-[15px] leading-relaxed text-stone-600">{{ $deskripsi }}</p>
                            </div>
                        </div>
                        {{-- Spacer for the other side (desktop) --}}
                        <div class="hidden md:block md:w-5/12"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Visi & Misi ═══ --}}
    <section class="border-y border-stone-100 bg-stone-50">
        <div class="mx-auto max-w-4xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Arah kami</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Visi &amp; Misi.</h2>
            </div>

            <div class="reveal mx-auto mt-10 grid max-w-4xl gap-6 md:grid-cols-2">
                {{-- Visi --}}
                <div class="rounded-3xl border border-teal-200/60 bg-gradient-to-br from-teal-50 to-emerald-50 p-8">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-700 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-xl font-bold tracking-tight text-stone-900">Visi</h3>
                    <p class="mt-3 text-[15px] leading-relaxed text-stone-600">
                        Menjadi koperasi desa yang mandiri, transparan, dan menjadi tulang punggung
                        ekonomi warga Kradenan.
                    </p>
                </div>

                {{-- Misi --}}
                <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-800 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-xl font-bold tracking-tight text-stone-900">Misi</h3>
                    <ul class="mt-3 space-y-3">
                        @foreach([
                            'Menyediakan kebutuhan pokok dengan harga bersahabat.',
                            'Mengelola persediaan secara transparan dan tertib.',
                            'Memberdayakan ekonomi warga dan petani desa.',
                            'Menyalurkan sisa hasil usaha untuk kemajuan desa.',
                        ] as $item)
                        <li class="flex items-start gap-2.5 text-[15px] leading-relaxed text-stone-600">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Pengurus ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-4xl px-5 py-20 lg:py-24">
            <div class="reveal text-center">
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Tim kami</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">Struktur pengurus.</h2>
                <p class="mx-auto mt-3 max-w-lg text-[15px] leading-relaxed text-stone-600">
                    Pengurus terpilih oleh anggota dan bertanggung jawab atas operasional koperasi sehari-hari.
                </p>
            </div>

            <div class="reveal mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
                @foreach([
                    ['Ketua Koperasi','Memimpin dan mengawasi seluruh kegiatan koperasi.','bg-teal-100 text-teal-700','M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z'],
                    ['Bendahara','Mengelola keuangan dan pencatatan transaksi koperasi.','bg-emerald-100 text-emerald-700','M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z'],
                    ['Sekretaris','Mengurus administrasi, surat-menyurat, dan keanggotaan.','bg-stone-100 text-stone-700','M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10'],
                ] as [$jabatan,$deskripsi,$avatarClass,$path])
                <div class="rounded-3xl border border-stone-100 bg-stone-50 p-8 text-center transition hover:border-teal-200 hover:bg-teal-50/30">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl {{ $avatarClass }}">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-base font-bold text-stone-900">{{ $jabatan }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-600">{{ $deskripsi }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ CTA ═══ --}}
    <section class="border-t border-stone-100 bg-stone-50">
        <div class="mx-auto max-w-3xl px-5 py-16 text-center">
            <h2 class="text-2xl font-bold tracking-tight text-stone-900">Mau cek stok atau gabung jadi anggota?</h2>
            <p class="mt-3 text-[15px] text-stone-600">Tanya harga, cek ketersediaan, atau daftar anggota. Pengurus siap bantu lewat WhatsApp maupun langsung di kantor.</p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('kontak') }}"
                   class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3.5 text-[15px] font-bold text-white shadow-sm transition hover:bg-teal-800 hover:-translate-y-0.5">
                    Hubungi Kami
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('produk') }}"
                   class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white px-7 py-3.5 text-[15px] font-semibold text-stone-700 transition hover:border-teal-300 hover:text-teal-700">
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>

@endsection
