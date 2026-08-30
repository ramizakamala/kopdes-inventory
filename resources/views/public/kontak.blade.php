@extends('public.layout')

@section('title', 'Kontak')

@section('content')
    <section class="bg-white">
        <div class="mx-auto max-w-5xl px-5 py-16 lg:py-20">
            <div class="text-center">
                <p class="text-sm font-semibold text-teal-700">Kontak</p>
                <h1 class="mt-2 text-4xl font-semibold tracking-tight text-stone-900 sm:text-5xl">Hubungi kami.</h1>
                <p class="mx-auto mt-4 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Ada pertanyaan, pesanan, atau ingin bergabung menjadi anggota?
                    Pengurus akan segera menghubungi Anda.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-5">
                {{-- Info --}}
                <div class="space-y-4 lg:col-span-2">
                    <div class="rounded-3xl bg-stone-50 p-6">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-teal-700 shadow-sm">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-stone-900">Alamat</div>
                                <div class="mt-0.5 text-sm text-stone-500">Jl. Raya Desa No. 1, Kec. Contoh, Kab. Contoh</div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-stone-50 p-6">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-teal-700 shadow-sm">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-stone-900">Telepon / WhatsApp</div>
                                <div class="mt-0.5 text-sm text-stone-500">+62 812-3456-7890</div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-stone-50 p-6">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-teal-700 shadow-sm">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-stone-900">Jam Layanan</div>
                                <div class="mt-0.5 text-sm text-stone-500">Senin – Sabtu, 07.00 – 17.00 WIB</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <div class="rounded-3xl bg-stone-50 p-7 lg:col-span-3 lg:p-9">
                    <h2 class="text-xl font-semibold tracking-tight text-stone-900">Kirim pesan.</h2>
                    <form method="POST" action="{{ route('kontak.kirim') }}" class="mt-6">
                        @csrf
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="nama" class="label">Nama <span class="text-red-500">*</span></label>
                                <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required
                                       placeholder="Nama lengkap" class="input !bg-white">
                            </div>
                            <div>
                                <label for="telepon" class="label">No. WhatsApp / Telepon</label>
                                <input id="telepon" type="text" name="telepon" value="{{ old('telepon') }}"
                                       placeholder="08xx-xxxx-xxxx" class="input !bg-white">
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="email" class="label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="nama@contoh.com" class="input !bg-white">
                        </div>
                        <div class="mt-5">
                            <label for="pesan" class="label">Pesan <span class="text-red-500">*</span></label>
                            <textarea id="pesan" name="pesan" rows="5" required placeholder="Tulis pesan Anda..."
                                      class="input !bg-white resize-none">{{ old('pesan') }}</textarea>
                        </div>
                        <button type="submit" class="mt-7 inline-flex items-center gap-2 rounded-full bg-teal-700 px-7 py-3 text-[15px] font-semibold text-white shadow-lg shadow-teal-700/25 transition hover:bg-teal-800">
                            Kirim Pesan
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
