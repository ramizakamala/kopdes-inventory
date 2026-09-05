<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Halaman Tidak Ditemukan</title>
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen flex-col items-center justify-center bg-white px-5 font-sans text-stone-900 antialiased">
    <div class="text-center">
        <div class="mx-auto flex justify-center">
            <x-logo size="h-16 w-16" icon="h-8 w-8" tile="rounded-2xl bg-teal-700 shadow-teal-700/25" />
        </div>
        <div class="mt-8 text-7xl font-extrabold tabular-nums tracking-tight text-teal-700">404</div>
        <h1 class="mt-3 text-2xl font-semibold tracking-tight text-stone-900">Halaman tidak ditemukan</h1>
        <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-stone-500">
            Alamat yang Anda buka tidak ada atau sudah dipindahkan. Cek kembali tautannya, atau kembali ke beranda.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-700 px-6 py-3 text-[15px] font-semibold text-white shadow-lg shadow-teal-700/25 transition hover:bg-teal-800">
                Kembali ke Beranda
            </a>
            <a href="{{ route('login') }}" class="rounded-full border border-stone-200 px-6 py-3 text-[15px] font-semibold text-stone-700 transition hover:bg-stone-50">
                Login Staff
            </a>
        </div>
    </div>
    <p class="mt-12 text-xs text-stone-400">SIMPERDES &middot; Sistem Manajemen Persediaan Koperasi Desa</p>
</body>
</html>
