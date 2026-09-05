@extends('public.layout')

@section('title', 'Katalog Produk')

@section('content')
    {{-- ═══ Header halaman ═══ --}}
    <section class="border-b border-stone-100 bg-white">
        <div class="mx-auto max-w-5xl px-5 py-14 lg:py-16">
            <div class="text-center">
                <p class="text-sm font-bold uppercase tracking-wider text-teal-600">Katalog</p>
                <h1 class="mt-2 text-4xl font-extrabold tracking-tight text-stone-900 sm:text-5xl">Produk koperasi.</h1>
                <p class="mx-auto mt-4 max-w-xl text-[15px] leading-relaxed text-stone-600">
                    Semua produk tersedia di koperasi desa. Ketersediaan stok ditampilkan
                    langsung dari sistem persediaan, jadi angka yang muncul selalu yang terbaru.
                </p>
            </div>

            {{-- Search bar --}}
            <div class="mt-8 flex justify-center">
                <div class="relative w-full max-w-md">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-stone-400"
                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z" />
                    </svg>
                    <input id="search-produk"
                           type="search"
                           placeholder="Cari produk..."
                           autocomplete="off"
                           class="input pl-11 pr-4"
                           aria-label="Cari produk">
                </div>
            </div>

            {{-- Filter chips --}}
            <div class="mt-5 flex flex-wrap items-center justify-center gap-2">
                <a href="{{ route('produk') }}"
                   class="chip {{ !request('kategori_id') ? 'chip-active' : 'chip-idle' }}"
                   aria-current="{{ !request('kategori_id') ? 'true' : 'false' }}">
                    Semua
                </a>
                @foreach ($kategoris as $kat)
                    <a href="{{ route('produk', ['kategori_id' => $kat->id]) }}"
                       class="chip {{ request('kategori_id') == $kat->id ? 'chip-active' : 'chip-idle' }}"
                       aria-current="{{ request('kategori_id') == $kat->id ? 'true' : 'false' }}">
                        {{ $kat->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ Grid produk ═══ --}}
    <section class="bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-12 lg:py-16">

            {{-- Badge info filter aktif --}}
            @if(request()->filled('kategori_id'))
                @php $aktif = $kategoris->firstWhere('id', request('kategori_id')); @endphp
                @if($aktif)
                    <div class="mb-6 flex items-center justify-between">
                        <p class="text-sm text-stone-500">
                            Menampilkan kategori: <span class="font-bold text-stone-900">{{ $aktif->nama_kategori }}</span>
                        </p>
                        <a href="{{ route('produk') }}"
                           class="inline-flex items-center gap-1 rounded-full border border-stone-200 bg-white px-3 py-1 text-sm font-semibold text-stone-600 hover:border-stone-300 hover:text-stone-900 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset filter
                        </a>
                    </div>
                @endif
            @endif

            {{-- Grid --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($barangs as $p)
                    @php
                        $pct    = min(100, (int) round($p->stok_saat_ini / max(1, $p->stok_minimum) * 100));
                        $bar    = $p->status === 'habis' ? 'bg-red-500' : ($p->status === 'menipis' ? 'bg-amber-500' : 'bg-emerald-500');
                        $extra  = $p->status === 'menipis' ? 'pulse-menipis' : '';
                    @endphp
                    <a href="{{ route('produk', ['kategori_id' => $p->kategori_id]) }}"
                       data-nama="{{ $p->nama_barang }}"
                       class="group overflow-hidden rounded-3xl border border-stone-200/70 bg-white shadow-sm transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg {{ $extra }}">
                        <div class="overflow-hidden">
                            @if ($p->foto)
                                <img src="{{ $p->foto }}" alt="{{ $p->nama_barang }}"
                                     class="aspect-[4/3] w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
                            @else
                                <x-produk-art :barang="$p" />
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <h3 class="text-base font-bold leading-snug text-stone-900 group-hover:text-teal-700">{{ $p->nama_barang }}</h3>
                                    <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; {{ $p->satuan }}</div>
                                    @if ($p->deskripsi)
                                        <p class="mt-2 text-[13px] leading-relaxed text-stone-500 line-clamp-2">{{ $p->deskripsi }}</p>
                                    @endif
                                </div>
                                <x-stok-badge :barang="$p" />
                            </div>
                            <div class="mt-4 flex items-end justify-between gap-2 border-t border-stone-100 pt-4">
                                <div class="text-xl font-extrabold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                <div class="text-xs tabular-nums text-stone-400">Stok {{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
                            </div>
                            <div class="mt-2.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                                <div class="h-full rounded-full {{ $bar }} transition-all duration-700" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-3xl bg-white px-6 py-16 text-center shadow-sm">
                        <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375C2.754 3.75 2.25 4.254 2.25 4.875v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <p class="mt-4 text-[15px] font-medium text-stone-500">Tidak ada produk pada kategori ini.</p>
                        <a href="{{ route('produk') }}" class="mt-3 inline-block text-sm font-bold text-teal-700 hover:underline">Lihat semua produk &rsaquo;</a>
                    </div>
                @endforelse
            </div>

            {{-- Empty state saat search tidak ketemu --}}
            <div id="produk-empty" class="hidden col-span-full rounded-3xl bg-white px-6 py-16 text-center shadow-sm mt-5">
                <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z" />
                </svg>
                <p class="mt-4 text-[15px] font-medium text-stone-500">Produk tidak ditemukan.</p>
                <button onclick="document.getElementById('search-produk').value='';document.getElementById('search-produk').dispatchEvent(new Event('input'))"
                        class="mt-3 inline-block text-sm font-bold text-teal-700 hover:underline">
                    Hapus pencarian &rsaquo;
                </button>
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $barangs->links() }}
            </div>
        </div>
    </section>
@endsection
