@extends('layouts.app')

@section('title', 'Catat Barang Keluar')

@section('content')
    @if ($errors->any())
        <div class="flash-error !mb-5">{{ $errors->first() }}</div>
    @endif
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('barang-keluar.store') }}">
            @csrf
            <div class="card p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required
                               class="input">
                    </div>
                    <div>
                        <label class="label">Barang</label>
                        <select name="barang_id" id="barang-select" required
                                class="input">
                            <option value="">— Pilih Barang —</option>
                            @foreach ($barangs as $b)
                                <option value="{{ $b->id }}"
                                        data-harga="{{ $b->harga_jual }}"
                                        data-stok="{{ $b->stok_saat_ini }}"
                                        data-satuan="{{ $b->satuan }}"
                                        data-batch="{{ $b->is_batch_tracked ? '1' : '0' }}"
                                        @selected(old('barang_id') == $b->id)>{{ $b->nama_barang }} — stok: {{ $b->stok_saat_ini }} {{ $b->satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah-input" value="{{ old('jumlah') }}" min="1" required
                               class="input">
                        <p id="stok-hint" class="mt-1 hidden text-xs text-amber-600"></p>
                        @error('jumlah')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Harga Jual (per satuan)</label>
                        <input type="number" name="harga_jual" id="harga-input" value="{{ old('harga_jual') }}" min="0" required
                               class="input">
                        <p class="mt-1 text-xs text-stone-400">Terisi otomatis dari harga barang, bisa diubah.</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="label">Keterangan (opsional)</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" placeholder="mis. penjualan anggota"
                               class="input">
                    </div>
                </div>

                {{-- Panel batch: muncul kalau barang terpilih dicatat per batch --}}
                <div id="batch-panel" class="mt-5 hidden rounded-xl border border-teal-100 bg-teal-50/50 p-4">
                    <div class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-teal-700" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                        </svg>
                        <div class="min-w-0 flex-1">
                            <div class="text-sm font-bold text-teal-900">Barang ber-batch — pengambilan FEFO</div>
                            <p class="mt-0.5 text-xs leading-relaxed text-teal-800/80">
                                Stok diambil otomatis dari batch yang kedaluwarsanya paling dekat (first-expired-first-out),
                                sampai jumlah terpenuhi. Satu transaksi bisa memakai beberapa batch.
                            </p>
                            <ul id="batch-list" class="mt-2.5 space-y-1.5"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang-keluar.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-500 hover:text-zinc-900">Batal</a>
            </div>
        </form>
    </div>

    <script>
        // data batch per barang (cuma yang masih punya sisa), sudah urut FEFO dari server
        var batchData = @json($batchByBarang->map(function ($group) {
            return $group->map(function ($b) {
                return ['nomor' => $b->nomor_batch, 'exp' => $b->tanggal_kedaluwarsa->format('d/m/Y'), 'jumlah' => (int) $b->jumlah];
            })->values();
        })->toArray());

        var select = document.getElementById('barang-select');
        var harga = document.getElementById('harga-input');
        var jumlah = document.getElementById('jumlah-input');
        var hint = document.getElementById('stok-hint');
        var panel = document.getElementById('batch-panel');
        var list = document.getElementById('batch-list');

        function tampilkanBatch(barangId, stok, satuan) {
            var batches = batchData[barangId] || [];
            var totalBatch = batches.reduce(function (acc, b) { return acc + b.jumlah; }, 0);

            list.innerHTML = '';
            if (batches.length === 0) {
                var li = document.createElement('li');
                li.className = 'rounded-lg bg-white/70 px-3 py-2 text-xs font-semibold text-amber-700';
                li.textContent = 'Belum ada batch dengan sisa stok — catat barang masuk (dengan batch) dulu.';
                list.appendChild(li);
                panel.classList.remove('hidden');
                hint.textContent = 'Barang ber-batch tapi belum punya batch tersisa.';
                hint.classList.remove('hidden');
                return totalBatch;
            }

            batches.forEach(function (b, i) {
                var li = document.createElement('li');
                li.className = 'flex items-center justify-between gap-3 rounded-lg bg-white/70 px-3 py-1.5 text-xs';
                li.innerHTML = '<span class="font-mono font-semibold text-teal-800">' + b.nomor + '</span>' +
                    '<span class="text-teal-700/70">' + (i === 0 ? 'kedaluwarsa ' : '') + b.exp + '</span>' +
                    '<span class="font-bold tabular-nums text-teal-900">sisa ' + b.jumlah + ' ' + satuan + '</span>';
                list.appendChild(li);
            });
            panel.classList.remove('hidden');
            return totalBatch;
        }

        select.addEventListener('change', function () {
            var opt = select.selectedOptions[0];
            if (opt && opt.value) {
                harga.value = opt.dataset.harga;
                var stok = parseInt(opt.dataset.stok, 10);

                if (opt.dataset.batch === '1') {
                    var totalBatch = tampilkanBatch(opt.value, stok, opt.dataset.satuan);
                    var maks = Math.min(stok, totalBatch || stok);
                    jumlah.max = maks;
                    hint.textContent = 'Maksimal ' + maks + ' ' + opt.dataset.satuan + ' (sisa batch). ' +
                        'Batch kedaluwarsa terdekat dipakai duluan.';
                    hint.classList.remove('hidden');
                } else {
                    panel.classList.add('hidden');
                    jumlah.max = stok;
                    hint.textContent = 'Maksimal ' + stok + ' ' + opt.dataset.satuan + ' sesuai stok tersedia.';
                    hint.classList.remove('hidden');
                }
            } else {
                harga.value = '';
                jumlah.removeAttribute('max');
                hint.classList.add('hidden');
                panel.classList.add('hidden');
            }
        });
    </script>
@endsection
