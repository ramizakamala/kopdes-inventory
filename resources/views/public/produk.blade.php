@extends('public.layout')

@section('title', 'Katalog Produk')

@section('content')
    <section class="bg-stone-50">
        <div class="mx-auto max-w-5xl px-5 py-16 lg:py-20">
            <div class="text-center">
                <p class="text-sm font-semibold text-teal-700">Katalog</p>
                <h1 class="mt-2 text-4xl font-semibold tracking-tight text-stone-900 sm:text-5xl">Produk koperasi.</h1>
                <p class="mx-auto mt-4 max-w-xl text-[15px] leading-relaxed text-stone-500">
                    Semua produk tersedia di koperasi desa. Ketersediaan stok ditampilkan
                    langsung dari sistem persediaan.
                </p>
            </div>

            {{-- Filter --}}
            <form method="GET" action="{{ route('produk') }}" class="mt-10 flex flex-wrap items-center justify-center gap-3">
                <select name="kategori_id" onchange="this.form.submit()" class="input !w-auto min-w-56">
                    <option value="">Semua kategori</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
                @if (request()->filled('kategori_id'))
                    <a href="{{ route('produk') }}" class="text-sm font-semibold text-stone-500 hover:text-stone-900">Reset</a>
                @endif
            </form>

            {{-- Grid produk --}}
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($barangs as $p)
                    @php
                        $pct = min(100, (int) round($p->stok_saat_ini / max(1, $p->stok_minimum) * 100));
                        $bar = $p->status === 'habis' ? 'bg-red-500' : ($p->status === 'menipis' ? 'bg-amber-500' : 'bg-green-500');
                    @endphp
                    <a href="{{ route('produk', ['kategori_id' => $p->kategori_id]) }}" class="group overflow-hidden rounded-3xl bg-white shadow-sm transition hover:shadow-md">
                        <div class="overflow-hidden">
                            @if ($p->foto)
                                <img src="{{ $p->foto }}" alt="{{ $p->nama_barang }}" class="aspect-[4/3] w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
                            @else
                                <x-produk-art :barang="$p" />
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h3 class="text-base font-semibold leading-snug text-stone-900 group-hover:text-teal-700">{{ $p->nama_barang }}</h3>
                                    <div class="mt-0.5 text-xs text-stone-400">{{ $p->kategori?->nama_kategori ?? 'Umum' }} &middot; satuan {{ $p->satuan }}</div>
                                </div>
                                <x-stok-badge :barang="$p" />
                            </div>
                            <div class="mt-4 flex items-end justify-between gap-2 border-t border-stone-100 pt-4">
                                <div class="text-xl font-semibold tabular-nums tracking-tight text-stone-900">Rp{{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                                <div class="text-xs tabular-nums text-stone-400">Stok {{ $p->stok_saat_ini }} / min {{ $p->stok_minimum }}</div>
                            </div>
                            <div class="mt-2.5 h-1.5 w-full overflow-hidden rounded-full bg-stone-100">
                                <div class="h-full rounded-full {{ $bar }} transition-all duration-700" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-3xl bg-white px-6 py-16 text-center shadow-sm">
                        <p class="text-[15px] font-medium text-stone-500">Tidak ada produk pada kategori ini.</p>
                        <a href="{{ route('produk') }}" class="mt-3 inline-block text-sm font-semibold text-teal-700 hover:underline">Lihat semua produk ›</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $barangs->links() }}
            </div>
        </div>
    </section>
@endsection
