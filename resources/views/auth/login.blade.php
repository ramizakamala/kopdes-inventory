<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — SIMPERDES</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-[#F5F5F5] font-sans text-zinc-800 antialiased">
    <div class="w-full max-w-sm px-4">
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-green-700 shadow-lg shadow-green-700/20">
                <svg class="h-7 w-7 text-zinc-900" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
            </div>
            <div class="text-2xl font-bold tracking-tight text-zinc-900">SIMPERDES</div>
            <div class="mt-1 text-sm text-zinc-500">Manajemen Persediaan Koperasi Desa</div>
        </div>

        <div class="card p-6">
            @if ($errors->any())
                <div class="flash-error !mb-4">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label class="label">Username / Email</label>
                <input type="text" name="login" value="{{ old('login') }}" required autofocus
                       class="input mb-4">

                <label class="label">Password</label>
                <input type="password" name="password" required
                       class="input mb-5">

                <button type="submit" class="btn btn-primary w-full py-2.5 font-semibold">
                    Masuk
                </button>
            </form>
        </div>

        <p class="mt-4 text-center text-xs text-zinc-500">Demo: admin / password &middot; pimpinan / password</p>
    </div>
</body>
</html>
