# SIMPERDES — Sistem Manajemen Persediaan Koperasi Desa

Aplikasi web manajemen inventaris untuk koperasi desa berbasis **Laravel 13** + **SQLite** dengan UI dark glass modern. Dibangun bertahap, satu fitur per commit, sesuai SRS skripsi (14/14 kebutuhan fungsional terpenuhi).

## Fitur

- **Autentikasi & peran** — admin / pimpinan, middleware role, redirect sesuai peran
- **Data Barang** — CRUD, kategori, satuan, harga beli/jual, stok minimum, status otomatis (aman / menipis / habis)
- **Barang Masuk** — catat penerimaan, stok bertambah otomatis, dukungan batch & kedaluwarsa, pilih supplier
- **Barang Keluar** — catat penjualan, stok berkurang otomatis, validasi stok cukup
- **Kategori & Supplier** — CRUD dengan guard hapus (diblokir jika masih terpakai)
- **Monitoring Stok** — statistik + filter (pencarian, kategori, status)
- **Rekomendasi Restock** — deteksi stok ≤ minimum, estimasi pengadaan (2×min − stok), rata-rata pemakaian 30 hari, supplier terakhir
- **Laporan** — 4 tab (stok, barang masuk, barang keluar, kedaluwarsa), filter periode, cetak dengan metadata tersimpan
- **Penyesuaian Stok** — stok opname dengan alasan, transaksi DB + lock, tolak stok negatif
- **Manajemen Pengguna** — CRUD user, aktif/nonaktif, reset password, guard hapus diri sendiri & admin terakhir

## Tech Stack

Laravel 13 · SQLite · Tailwind CSS v4 · Vite · Alpine.js (dark glass UI, tanpa template Breeze)

## Menjalankan

```bash
composer install
npm install && npm run build
cp .env.example .env   # sesuaikan DB_CONNECTION=sqlite
touch database/database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Akun demo (seeder): `admin/password` (admin), `pimpinan/password` (pimpinan).
