<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Batch;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Koperasi',
            'username' => 'admin',
            'email' => 'admin@kopdes.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Pimpinan Koperasi',
            'username' => 'pimpinan',
            'email' => 'pimpinan@kopdes.test',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Petugas Gudang',
            'username' => 'petugas',
            'email' => 'petugas@kopdes.test',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Kasir Koperasi',
            'username' => 'kasir',
            'email' => 'kasir@kopdes.test',
            'password' => Hash::make('password'),
            'role' => 'kasir',
            'status' => 'aktif',
        ]);

        $sembako = Kategori::create(['nama_kategori' => 'Sembako', 'deskripsi' => 'Kebutuhan pokok']);
        $pertanian = Kategori::create(['nama_kategori' => 'Pertanian', 'deskripsi' => 'Sarana pertanian']);
        $kesehatan = Kategori::create(['nama_kategori' => 'Obat-obatan', 'deskripsi' => 'Produk kesehatan']);

        $supplierA = Supplier::create(['nama_supplier' => 'Toko Berkah Jaya', 'kontak' => '0812-3456-7890', 'alamat' => 'Jl. Raya Desa No. 1']);
        $supplierB = Supplier::create(['nama_supplier' => 'UD Tani Makmur', 'kontak' => '0813-9876-5432', 'alamat' => 'Dusun Sidomulyo']);

        $beras = Barang::create(['kode_barang' => 'BRG-001', 'nama_barang' => 'Beras Premium 5kg', 'kategori_id' => $sembako->id, 'satuan' => 'karung', 'harga_beli' => 62000, 'harga_jual' => 68000, 'stok_minimum' => 10, 'lead_time_hari' => 5, 'safety_stock' => 15, 'stok_saat_ini' => 25, 'is_batch_tracked' => false]);
        $minyak = Barang::create(['kode_barang' => 'BRG-002', 'nama_barang' => 'Minyak Goreng 1L', 'kategori_id' => $sembako->id, 'satuan' => 'pcs', 'harga_beli' => 15000, 'harga_jual' => 17000, 'stok_minimum' => 20, 'lead_time_hari' => 3, 'safety_stock' => 2, 'stok_saat_ini' => 8, 'is_batch_tracked' => false]);
        $pupuk = Barang::create(['kode_barang' => 'BRG-003', 'nama_barang' => 'Pupuk Urea 50kg', 'kategori_id' => $pertanian->id, 'satuan' => 'sak', 'harga_beli' => 110000, 'harga_jual' => 120000, 'stok_minimum' => 5, 'lead_time_hari' => 7, 'safety_stock' => 2, 'stok_saat_ini' => 0, 'is_batch_tracked' => false]);
        $obat = Barang::create(['kode_barang' => 'BRG-004', 'nama_barang' => 'Vitamin C 100mg', 'kategori_id' => $kesehatan->id, 'satuan' => 'strip', 'harga_beli' => 8000, 'harga_jual' => 10000, 'stok_minimum' => 15, 'lead_time_hari' => 4, 'safety_stock' => 3, 'stok_saat_ini' => 12, 'is_batch_tracked' => true]);
        $gula = Barang::create(['kode_barang' => 'BRG-005', 'nama_barang' => 'Gula Pasir 1kg', 'kategori_id' => $sembako->id, 'satuan' => 'pcs', 'harga_beli' => 16500, 'harga_jual' => 18000, 'stok_minimum' => 10, 'lead_time_hari' => 3, 'safety_stock' => 3, 'stok_saat_ini' => 30, 'is_batch_tracked' => false]);
        $susu = Barang::create(['kode_barang' => 'BRG-006', 'nama_barang' => 'Susu Kental Manis', 'kategori_id' => $sembako->id, 'satuan' => 'kaleng', 'harga_beli' => 9000, 'harga_jual' => 11000, 'stok_minimum' => 25, 'lead_time_hari' => 3, 'safety_stock' => 2, 'stok_saat_ini' => 5, 'is_batch_tracked' => true]);

        Batch::create(['barang_id' => $obat->id, 'nomor_batch' => 'VC-2026-08', 'tanggal_masuk' => '2026-08-01', 'tanggal_kedaluwarsa' => '2026-09-15', 'jumlah' => 12]);
        Batch::create(['barang_id' => $susu->id, 'nomor_batch' => 'SKM-2026-07', 'tanggal_masuk' => '2026-07-20', 'tanggal_kedaluwarsa' => '2026-08-30', 'jumlah' => 5]);

        BarangMasuk::create(['tanggal' => '2026-08-05', 'barang_id' => $beras->id, 'supplier_id' => $supplierA->id, 'jumlah' => 20, 'harga_beli' => 62000, 'user_id' => $admin->id]);
        BarangMasuk::create(['tanggal' => '2026-08-06', 'barang_id' => $minyak->id, 'supplier_id' => $supplierA->id, 'jumlah' => 10, 'harga_beli' => 15000, 'user_id' => $admin->id]);
        BarangMasuk::create(['tanggal' => '2026-08-07', 'barang_id' => $pupuk->id, 'supplier_id' => $supplierB->id, 'jumlah' => 5, 'harga_beli' => 110000, 'user_id' => $admin->id]);

        BarangKeluar::create(['tanggal' => '2026-08-10', 'barang_id' => $beras->id, 'jumlah' => 3, 'harga_jual' => 68000, 'hpp_satuan' => 62000, 'keterangan' => 'Penjualan anggota', 'user_id' => $admin->id]);
        BarangKeluar::create(['tanggal' => '2026-08-12', 'barang_id' => $minyak->id, 'jumlah' => 2, 'harga_jual' => 17000, 'hpp_satuan' => 15000, 'user_id' => $admin->id]);
    }
}
