@extends('public.layout')

@section('title', 'Katalog Produk')

@section('content')
    <section class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
        <div class="max-w-2xl">
            <span class="text-sm font-bold uppercase tracking-wider text-teal-700">Katalog</span>
            <h1 class="mt-2 text-4xl font-extrabold tracking-tight text-stone-900">Produk Koperasi</h1>
            <p class="mt-3 text-[15px] leading-relaxed text-stone-500">
                Semua produk tersedia di koperasi desa. Badge status menunjukkan ketersediaan stok
                terkini langsung dari sistem persediaan.
            </p>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('produk') }}" class="mt-8 flex flex-wrap items-center gap-3">
            <select name="kategori_id" onchange="this.form.submit()" class="input !w-auto min-w-52">
                <option value="">Semua kategori</option>
                @foreach ($kategoris as $kat)
                    <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
            @if (request()->filled('kategori_id'))
                <a href="{{ route('produk') }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-stone-500 hover:text-stone-900">Reset filter</a>
            @endif
            <span class="ml-auto text-sm font-medium text-stone-400">{{ $barangs->total() }} produk</span>
        </form>

        {{-- Grid produk --}}
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($barangs as $p)
                <div class="card flex flex-col p-5">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-teal-500 to-teal-700 text-white shadow-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <x-stok-badge :barang="$p" />
                    </div>
                    <h3 class="mt-4 text-base font-bold leading-snug text-stone-900">{{ $p->nama_barang }}</h3>
                    <div class="mt-0.5 text-xs font-medium text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; satuan {{ $p->satuan }}</div>
                    <div class="mt-4 flex items-end justify-between border-t border-stone-100 pt-4">
                        <div class="text-xl font-extrabold tabular-nums tracking-tight text-teal-700">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                        <div class="text-xs text-stone-400">Stok {{ $p->stok_saat_ini }} {{ $p->satuan }}</div>
                    </div>
                </div>
            @empty
                <div class="col-span-full card px-6 py-16 text-center">
                    <p class="text-[15px] font-medium text-stone-500">Tidak ada produk pada kategori ini.</p>
                    <a href="{{ route('produk') }}" class="mt-4 inline-block text-sm font-bold text-teal-700 hover:text-teal-800">Lihat semua produk →</a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $barangs->links() }}
        </div>
    </section>
@endsection
