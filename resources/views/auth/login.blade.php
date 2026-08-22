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
<body class="flex min-h-screen items-center justify-center bg-zinc-950 font-sans text-zinc-200 antialiased">
    <div class="w-full max-w-sm">
        <div class="mb-8 text-center">
            <div class="text-2xl font-semibold tracking-tight text-white">SIMPERDES</div>
            <div class="mt-1 text-sm text-zinc-500">Manajemen Persediaan Koperasi Desa</div>
        </div>

        <div class="rounded-2xl border border-white/5 bg-white/[0.03] p-6">
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label class="mb-1.5 block text-sm font-medium text-zinc-300">Username / Email</label>
                <input type="text" name="login" value="{{ old('login') }}" required autofocus
                       class="mb-4 w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">

                <label class="mb-1.5 block text-sm font-medium text-zinc-300">Password</label>
                <input type="password" name="password" required
                       class="mb-5 w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white placeholder-zinc-600 outline-none focus:border-white/30">

                <button type="submit"
                        class="w-full rounded-lg bg-white px-3 py-2 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                    Masuk
                </button>
            </form>
        </div>

        <p class="mt-4 text-center text-xs text-zinc-600">Demo: admin / password &middot; pimpinan / password</p>
    </div>
</body>
</html>
