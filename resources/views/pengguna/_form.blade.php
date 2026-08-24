@php
    $n = old('name', $user->name ?? '');
    $u = old('username', $user->username ?? '');
    $e = old('email', $user->email ?? '');
    $r = old('role', $user->role ?? 'admin');
    $s = old('status', $user->status ?? 'aktif');
@endphp

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Nama Lengkap</label>
        <input type="text" name="name" value="{{ $n }}" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('name')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Username</label>
        <input type="text" name="username" value="{{ $u }}" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('username')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Email</label>
        <input type="email" name="email" value="{{ $e }}" required
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Password</label>
        <input type="password" name="password" {{ isset($user) ? '' : 'required' }} placeholder="{{ isset($user) ? 'Kosongkan jika tidak diganti' : 'Min. 8 karakter' }}"
               class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
        @error('password')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Role</label>
        <select name="role" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
            <option value="admin" @selected($r === 'admin')>Admin / Pengelola</option>
            <option value="pimpinan" @selected($r === 'pimpinan')>Pimpinan</option>
        </select>
    </div>
    <div>
        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Status</label>
        <select name="status" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white outline-none focus:border-white/30">
            <option value="aktif" @selected($s === 'aktif')>Aktif</option>
            <option value="nonaktif" @selected($s === 'nonaktif')>Nonaktif</option>
        </select>
    </div>
</div>
