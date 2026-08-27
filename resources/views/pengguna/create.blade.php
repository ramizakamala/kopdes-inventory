@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('pengguna.store') }}">
            @csrf
            <div class="card p-6">
                @include('pengguna._form', ['user' => null])
            </div>
            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pengguna.index') }}" class="rounded-lg px-4 py-2 text-sm text-zinc-500 hover:text-zinc-900">Batal</a>
            </div>
        </form>
    </div>
@endsection
