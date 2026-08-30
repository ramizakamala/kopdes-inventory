@php
    $n = old('name', $user->name ?? '');
    $u = old('username', $user->username ?? '');
    $e = old('email', $user->email ?? '');
    $r = old('role', $user->role ?? 'admin');
    $s = old('status', $user->status ?? 'aktif');
@endphp

@if ($errors->any())
    <div class="flash-error !mb-5">{{ $errors->first() }}</div>
@endif

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="label">Nama Lengkap</label>
        <input type="text" name="name" value="{{ $n }}" required
               class="input">
        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Username</label>
        <input type="text" name="username" value="{{ $u }}" required
               class="input">
        @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Email</label>
        <input type="email" name="email" value="{{ $e }}" required
               class="input">
        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Password</label>
        <input type="password" name="password" {{ isset($user) ? '' : 'required' }} placeholder="{{ isset($user) ? 'Kosongkan jika tidak diganti' : 'Min. 8 karakter' }}"
               class="input">
        @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label">Role</label>
        <select name="role" class="input">
            <option value="admin" @selected($r === 'admin')>Admin / Pengelola</option>
            <option value="petugas" @selected($r === 'petugas')>Petugas / Operator</option>
            <option value="pimpinan" @selected($r === 'pimpinan')>Pimpinan</option>
        </select>
    </div>
    <div>
        <label class="label">Status</label>
        <select name="status" class="input">
            <option value="aktif" @selected($s === 'aktif')>Aktif</option>
            <option value="nonaktif" @selected($s === 'nonaktif')>Nonaktif</option>
        </select>
    </div>
</div>
