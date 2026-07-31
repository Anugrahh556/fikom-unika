<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // PERBAIKAN: jangan hapus akun user (termasuk akun asli mahasiswa/dosen
        // yang sudah daftar sendiri) kalau seeder ini tidak sengaja dijalankan
        // ulang di server production.
        if (app()->environment('production')) {
            $this->command->warn('DatabaseSeeder: pembuatan akun contoh dilewati di environment production.');
        } else {
            // Bersihkan data user lama agar tidak bentrok
            User::truncate();

            // 1. Suntik Akun Admin Utama FIKOM (Password diproteksi Hash Bcrypt)
            User::create([
                'name' => 'Administrator FIKOM',
                'username' => 'adminfikom',
                'email' => 'admin.fikom@unika.ac.id',
                'password' => Hash::make('admin123'), // TODO: ganti sebelum production
                'role' => 'admin',
            ]);

            // 2. Contoh Akun Dosen (Opsional untuk testing)
            User::create([
                'name' => 'Ir. Jhon Smith, M.Kom',
                'username' => 'dosenfikom',
                'email' => 'jhonsmith@unika.ac.id',
                'password' => Hash::make('dosen123'), // TODO: ganti sebelum production
                'role' => 'dosen',
            ]);

            // 3. Tambahan Akun Admin Baru (Sesuai Permintaan)
            User::create([
                'name' => 'Admin Baru',
                'username' => 'adminbaru',
                'email' => 'admin.baru@unika.ac.id',
                'password' => Hash::make('password'), // TODO: ganti sebelum production
                'role' => 'admin',
            ]);
        }

        // 4. Suntik Data Master Ruangan (Jalankan setelah migrasi 'ruangans' dibuat)
        if (Schema::hasTable('ruangans')) {
            DB::table('ruangans')->truncate();
            DB::table('ruangans')->insert([
                ['nama' => 'Ruang 1/1', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Ruang 1/2', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Ruang 1/3', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Ruang 1/4', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Ruang 1/5', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Ruang 1/6', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Ruang 1/7', 'gedung' => 'Gedung St. Thomas', 'kapasitas' => 40],
                ['nama' => 'Lab. A', 'gedung' => 'Gedung St. Robertus', 'kapasitas' => 30],
                ['nama' => 'Lab. B', 'gedung' => 'Gedung St. Robertus', 'kapasitas' => 30],
                ['nama' => 'Lab. C', 'gedung' => 'Gedung St. Robertus', 'kapasitas' => 30],
                ['nama' => 'Lab. D', 'gedung' => 'Gedung St. Robertus', 'kapasitas' => 30],
                ['nama' => 'Lab. G', 'gedung' => 'Gedung St. Robertus', 'kapasitas' => 30],
            ]);
        }

        // PERBAIKAN: dipindahkan KELUAR dari blok if(hasTable('ruangans'))
        // di atas — sebelumnya 3 seeder penting ini ikut ter-skip diam-diam
        // kalau tabel ruangans belum ada, padahal tidak saling berhubungan.
        $this->call([
            DosenSeeder::class,
            JadwalSeeder::class,
            JadwalSeninSeeder::class,
        ]);
    }
}