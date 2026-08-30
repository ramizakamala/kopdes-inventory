@extends('layouts.app')

@section('title', 'Pesan Masuk')

@section('subtitle', 'Pesan dari pengunjung website publik')

@section('content')
    <div class="table-wrap">
        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-stone-100 px-5 py-4">
            <h3 class="text-[15px] font-bold text-stone-900">Pesan dari Website</h3>
            <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-500">{{ $pesans->total() }} pesan</span>
        </div>

        @if ($pesans->isEmpty())
            <p class="px-5 py-14 text-center text-[15px] text-stone-500">Belum ada pesan masuk.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-stone-100 bg-stone-50/60 text-left">
                            <th class="th">Pengirim</th>
                            <th class="th">Kontak</th>
                            <th class="th">Pesan</th>
                            <th class="th">Tanggal</th>
                            <th class="th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach ($pesans as $m)
                            <tr class="align-top transition hover:bg-stone-50/70">
                                <td class="td font-semibold text-stone-900">{{ $m->nama }}</td>
                                <td class="td text-stone-500">
                                    @if ($m->telepon)
                                        <div>{{ $m->telepon }}</div>
                                    @endif
                                    @if ($m->email)
                                        <div class="text-xs">{{ $m->email }}</div>
                                    @endif
                                </td>
                                <td class="td max-w-md whitespace-pre-line text-stone-600">{{ $m->pesan }}</td>
                                <td class="td whitespace-nowrap text-stone-500">{{ $m->created_at->format('d M Y, H:i') }}</td>
                                <td class="td">
                                    <div class="flex justify-end">
                                        <form method="POST" action="{{ route('pesan.destroy', $m) }}"
                                              onsubmit="return confirm('Hapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-sm font-semibold text-red-600 hover:text-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-4">
        {{ $pesans->links() }}
    </div>
@endsection
