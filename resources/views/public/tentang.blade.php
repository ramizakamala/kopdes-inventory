@extends('public.layout')

@section('title', 'Tentang Kami')

@section('content')
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-16 lg:py-20">
            <div class="text-center">
                <p class="text-sm font-semibold text-teal-700">Tentang</p>
                <h1 class="mt-2 text-4xl font-semibold tracking-tight text-stone-900 sm:text-5xl">Tentang koperasi kami.</h1>
            </div>

            <div class="mx-auto mt-10 max-w-3xl space-y-5 text-center text-[15px] Jleading-relaxed text-stone-600">
                <p>
                    Koperasi Desa berdiri sebagai wadah ekonomi warga. Kami menyediakan kebutuhan
                    pokok sehari-hari, sarana pertanian, hingga produk kesehatan dengan harga yang
                    jujur dan terjangkau.
                </p>
                <p>
                    Seluruh pengelolaan dilakukan secara gotong royong oleh pengurus terpilih.
                    Setiap transaksi dicatat rapi, stok dipantau real-time, sehingga warga bisa
                    percaya bahwa setiap rupiah dikelola dengan transparan.
                </p>
                <p>
                    Keuntungan koperasi dikembalikan untuk kemajuan desa, mulai dari bantuan
                    pertanian, beasiswa anak sekolah, hingga perbaikan fasilitas umum.
                </p>
            </div>

            {{-- Visi Misi --}}
            <div class="mx-auto mt-14 grid max-w-4xl gap-5 md:grid-cols-2">
                <div class="rounded-3xl bg-stone-50 p-8">
                    <h2 class="text-2xl font-semibold tracking-tight text-stone-900">Visi.</h2>
                    <p class="mt-3 text-[15px] leading-relaxed text-stone-600">
                        Menjadi koperasi desa yang mandiri, transparan, dan menjadi tulang punggung
                        ekonomi warga.
                    </p>
                </div>
                <div class="rounded-3xl bg-stone-50 p-8">
                    <h2 class="text-2xl font-semibold tracking-tight text-stone-900">Misi.</h2>
                    <ul class="mt-3 space-y-3 text-[15px] leading-relaxed text-stone-600">
                        <li class="flex gap-2.5">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Menyediakan kebutuhan pokok dengan harga bersahabat.
                        </li>
                        <li class="flex gap-2.5">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Mengelola persediaan secara transparan dan tertib.
                        </li>
                        <li class="flex gap-2.5">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Memberdayakan ekonomi warga dan petani desa.
                        </li>
                        <li class="flex gap-2.5">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Menyalurkan sisa hasil usaha untuk kemajuan desa.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Pengurus --}}
            <div class="mt-16">
                <h2 class="text-center text-3xl font-semibold tracking-tight text-stone-900">Struktur pengurus.</h2>
                <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="rounded-3xl bg-stone-50 p-8 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-stone-500 shadow-sm">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-stone-900">Ketua Koperasi</h3>
                        <p class="mt-1 text-sm text-stone-500">Memimpin dan mengawasi seluruh kegiatan koperasi.</p>
                    </div>
                    <div class="rounded-3xl bg-stone-50 p-8 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-stone-500 shadow-sm">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-stone-900">Bendahara</h3>
                        <p class="mt-1 text-sm text-stone-500">Mengelola keuangan dan pencatatan transaksi koperasi.</p>
                    </div>
                    <div class="rounded-3xl bg-stone-50 p-8 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-stone-500 shadow-sm">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-stone-900">Sekretaris</h3>
                        <p class="mt-1 text-sm text-stone-500">Mengurus administrasi, surat-menyurat, dan keanggotaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
