@extends('public.layout')

@section('title', 'Kontak')

@section('content')
    {{-- ═══ Hero: jelas, kalem, fungsional ═══ --}}
    <section class="border-b border-stone-100 bg-white">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-5 py-16 lg:grid-cols-2 lg:py-20">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-teal-700">Kontak</p>
                <h1 class="mt-3 text-4xl font-semibold leading-tight tracking-tight text-stone-900 sm:text-5xl">
                    Ngobrol langsung dengan pengurus.
                </h1>
                <p class="mt-4 max-w-xl text-lg leading-relaxed text-stone-500">
                    Kirim pesan, telepon, atau mampir ke koperasi. Kami bantu dengan senang hati.
                </p>
                <ul class="mt-7 space-y-3 text-[15px] text-stone-600">
                    <li class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Balasan maksimal 1×24 jam di hari kerja
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Dibalas langsung oleh pengurus koperasi
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 shrink-0 text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Konsultasi &amp; tanya harga tidak dipungut biaya
                    </li>
                </ul>
            </div>

            {{-- Quick action WhatsApp (fungsional, bukan dekorasi) --}}
            <div class="mx-auto w-full max-w-sm lg:mx-0">
                <div class="rounded-2xl border border-stone-200 bg-stone-50 p-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-700 text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-stone-900">WhatsApp Pengurus</div>
                            <div class="text-sm tabular-nums text-stone-500">+62 812-3456-7890</div>
                        </div>
                    </div>
                    <a href="https://wa.me/6281234567890?text=Halo%20Koperasi%20Desa%20Kradenan" target="_blank" rel="noopener"
                       class="mt-5 flex w-full items-center justify-center gap-2 rounded-full bg-teal-700 px-5 py-3 text-[15px] font-semibold text-white transition hover:bg-teal-800">
                        Chat sekarang
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <p class="mt-3 text-center text-xs text-stone-400">Senin – Jumat, 07.15 – 15.30 WIB</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Info kontak: satu panel menyatu ═══ --}}
    <section class="border-b border-stone-100 bg-stone-50">
        <div class="mx-auto max-w-6xl px-5 py-14">
            <h2 class="text-2xl font-semibold tracking-tight text-stone-900">Informasi kontak</h2>
            <div class="mt-6 divide-y divide-stone-200/70 rounded-2xl border border-stone-200 bg-white">
                <div class="flex items-center gap-4 px-5 py-5 sm:px-6">
                    <svg class="h-5 w-5 shrink-0 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <div class="min-w-0">
                        <div class="text-[13px] font-medium text-stone-400">Alamat</div>
                        <div class="mt-0.5 text-[15px] font-medium text-stone-900">Jl. Raya Sumpiuh, Kradenan, Kec. Sumpiuh, Kabupaten Banyumas, Jawa Tengah 53196</div>
                    </div>
                </div>
                <a href="tel:+6281234567890" class="group flex items-center gap-4 px-5 py-5 transition hover:bg-stone-50 sm:px-6">
                    <svg class="h-5 w-5 shrink-0 text-stone-400 transition group-hover:text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <div class="min-w-0 flex-1">
                        <div class="text-[13px] font-medium text-stone-400">Telepon</div>
                        <div class="mt-0.5 text-[15px] font-medium text-stone-900">+62 812-3456-7890</div>
                    </div>
                    <svg class="h-4 w-4 shrink-0 text-stone-300 transition group-hover:text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="mailto:halo@koperasidesa.id" class="group flex items-center gap-4 px-5 py-5 transition hover:bg-stone-50 sm:px-6">
                    <svg class="h-5 w-5 shrink-0 text-stone-400 transition group-hover:text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <div class="min-w-0 flex-1">
                        <div class="text-[13px] font-medium text-stone-400">Email</div>
                        <div class="mt-0.5 text-[15px] font-medium text-stone-900">halo@koperasidesa.id</div>
                    </div>
                    <svg class="h-4 w-4 shrink-0 text-stone-300 transition group-hover:text-teal-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <div class="flex items-center gap-4 px-5 py-5 sm:px-6">
                    <svg class="h-5 w-5 shrink-0 text-stone-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="min-w-0">
                        <div class="text-[13px] font-medium text-stone-400">Jam Layanan</div>
                        <div class="mt-0.5 text-[15px] font-medium text-stone-900">Senin – Jumat, 07.15 – 15.30 WIB</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ Form: primary action ═══ --}}
    <section class="bg-white">
        <div class="mx-auto max-w-2xl px-5 py-16 lg:py-20">
            <h2 class="text-2xl font-semibold tracking-tight text-stone-900">Kirim pesan</h2>
            <p class="mt-2 text-[15px] leading-relaxed text-stone-500">
                Isi form di bawah, pengurus akan membalas lewat nomor atau email yang Anda berikan.
            </p>

            <div class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">
                <form method="POST" action="{{ route('kontak.kirim') }}">
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="nama" class="label">Nama <span class="text-red-500">*</span></label>
                            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required
                                   placeholder="Nama lengkap" autocomplete="name" class="input">
                        </div>
                        <div>
                            <label for="telepon" class="label">No. WhatsApp / Telepon</label>
                            <input id="telepon" type="tel" name="telepon" value="{{ old('telepon') }}"
                                   placeholder="08xx-xxxx-xxxx" autocomplete="tel" inputmode="tel" class="input">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="email" class="label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               placeholder="nama@contoh.com" autocomplete="email" class="input">
                    </div>
                    <div class="mt-5">
                        <label for="pesan" class="label">Pesan <span class="text-red-500">*</span></label>
                        <textarea id="pesan" name="pesan" rows="5" required placeholder="Tulis pesan Anda..."
                                  class="input resize-none">{{ old('pesan') }}</textarea>
                    </div>
                    <button type="submit" class="mt-7 flex w-full items-center justify-center gap-2 rounded-full bg-teal-700 px-7 py-3.5 text-base font-semibold text-white transition hover:bg-teal-800 sm:w-auto">
                        Kirim Pesan
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
