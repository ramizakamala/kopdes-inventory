@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('supplier.update', $supplier) }}">
            @csrf
            @method('PUT')
            <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-6">
                @include('supplier._form')
            </div>
            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">Simpan</button>
                <a href="{{ route('supplier.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-400 hover:text-white">Batal</a>
            </div>
        </form>
    </div>
@endsection
