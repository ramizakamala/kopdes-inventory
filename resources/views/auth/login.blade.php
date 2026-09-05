<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — SIMPERDES</title>
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen bg-canvas font-sans text-stone-800 antialiased">

    {{-- Panel kiri: brand --}}
    <div class="relative hidden w-1/2 overflow-hidden bg-gradient-to-br from-teal-50 via-white to-stone-100 lg:flex lg:flex-col lg:justify-between">
        <div class="pointer-events-none absolute -left-24 -top-24 h-96 w-96 rounded-full bg-teal-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-32 -right-16 h-[28rem] w-[28rem] rounded-full bg-cyan-200/30 blur-3xl"></div>

        <div class="relative flex items-center gap-3 px-12 pt-12">
            <x-logo size="h-12 w-12" icon="h-7 w-7" />
            <div>
                <div class="text-2xl font-extrabold tracking-tight text-stone-900">SIMPERDES</div>
                <div class="text-sm text-stone-500">Manajemen Persediaan Koperasi Desa</div>
            </div>
        </div>

        <div class="relative px-12">
            <h2 class="max-w-md text-3xl font-extrabold leading-tight tracking-tight text-stone-900">
                Kelola stok koperasi desa jadi lebih mudah &amp; rapi.
            </h2>
            <ul class="mt-8 space-y-4">
                <li class="flex items-center gap-3 text-stone-700">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-teal-100 text-teal-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </span>
                    Pantau stok barang secara real-time
                </li>
                <li class="flex items-center gap-3 text-stone-700">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-teal-100 text-teal-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </span>
                    Catat barang masuk &amp; keluar dengan mudah
                </li>
                <li class="flex items-center gap-3 text-stone-700">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-teal-100 text-teal-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </span>
                    Peringatan otomatis saat stok menipis
                </li>
            </ul>
        </div>

        <div class="relative px-12 pb-10 text-sm text-stone-400">
            &copy; {{ date('Y') }} SIMPERDES &middot; Sistem Manajemen Persediaan Koperasi Desa
        </div>
    </div>

    {{-- Panel kanan: form --}}
    <div class="flex flex-1 items-center justify-center px-5 py-12">
        <div class="w-full max-w-md">
            <div class="mb-8 flex flex-col items-center text-center lg:hidden">
                <div class="mb-3 flex flex-col items-center">
                    <x-logo size="h-14 w-14" icon="h-7 w-7" tile="rounded-2xl bg-teal-700 shadow-teal-700/25" />
                </div>
                <div class="text-2xl font-extrabold tracking-tight text-stone-900">SIMPERDES</div>
                <div class="mt-1 text-sm text-stone-500">Manajemen Persediaan Koperasi Desa</div>
            </div>

            <div class="mb-8 lg:mb-10">
                <h1 class="text-3xl font-extrabold tracking-tight text-stone-900">Selamat datang</h1>
                <p class="mt-2 text-[15px] text-stone-500">Masuk dengan akun Anda untuk mulai mengelola persediaan.</p>
            </div>

            <div class="card p-7">
                @if ($errors->any())
                    <div class="flash-error !mb-5">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="login" class="label">Username / Email</label>
                    <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                           placeholder="contoh: admin" class="input mb-5">

                    <label for="password" class="label">Password</label>
                    <input id="password" type="password" name="password" required placeholder="••••••••"
                           class="input mb-6">

                    <button type="submit" class="btn btn-primary w-full py-3 text-base">
                        Masuk
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <p class="mt-5 text-center text-sm text-stone-500">
                Akun demo: <code class="rounded-md bg-stone-100 px-1.5 py-0.5 font-semibold text-stone-700">admin</code> / <code class="rounded-md bg-stone-100 px-1.5 py-0.5 font-semibold text-stone-700">password</code>
            </p>
        </div>
    </div>
</body>
</html>
